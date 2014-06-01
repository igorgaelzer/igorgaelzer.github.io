<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_model extends MY_Model {

	public $before_create = array('timestamps');
    public $before_update = array('timestamps_update');
    public $has_many      = array('materials_model' => array('model' => 'materials_model_model', 'primary_key' => 'model_id'));
	
    public $validate = array(
        array( 'field' => 'reference', 
               'label' => 'Referência',
               'rules' => 'required' ),        
        /*array( 'field' => 'description', 
               'label' => 'Descrição',
               'rules' => 'required' ),
        array( 'field' => 'brand', 
               'label' => 'Marca',
               'rules' => 'required' ),
        array( 'field' => 'client', 
               'label' => 'Cliente',
               'rules' => 'required' ),*/
    );

    //---------------------------------------------------------------------------------------

    function __construct()
    {
        parent::__construct();
        $this->load->model('materials_model_model');
        $this->load->model('materials_model');
    }

    //---------------------------------------------------------------------------------------

    protected function timestamps($data)
    {
        $data['created'] = $data['updated'] = date('Y-m-d H:i:s');
        return $data;
    }

    //---------------------------------------------------------------------------------------

    protected function timestamps_update($data)
    {
        $data['updated'] = date('Y-m-d H:i:s');
        return $data;
    }

    //---------------------------------------------------------------------------------------

    public function add($upload_file = '')
    {
        $form_data = array(
            'reference'   => $this->input->post('reference'),
            'description' => $this->input->post('description'),
            'brand'       => $this->input->post('brand'),
            'client'      => $this->input->post('client'),
        );

        if($upload_file != '')
        {
            $form_data['image'] = $upload_file;
        }

        $model_id = $this->insert($form_data);

        if($model_id)
        {
            $this->save_model_items($model_id);
            return true;
        }
    }

    //---------------------------------------------------------------------------------------

    public function update_data($id, $image_file = null)
    {
        $form_data = array(
            'reference'   => $this->input->post('reference'),
            'description' => $this->input->post('description'),
            'brand'       => $this->input->post('brand'),
            'client'      => $this->input->post('client'),
        );

        if(!is_null($image_file))
        {
            $form_data['image'] = $image_file;
        }

        if($this->update($id, $form_data))
        {
            $this->save_model_items($id);
            return true;
        }
    }

    //---------------------------------------------------------------------------------------

    private function save_model_items($model_id)
    {
        $material_id = $this->input->post('material_id');
        $quantity    = $this->input->post('quantity');

        if(is_array($material_id) && !empty($material_id)) 
        {
            //first, delete all materials realted with this model
            $this->materials_model_model->delete_by('model_id', $model_id);

            $order = 1;//set the first order

            foreach ($material_id as $key => $m) 
            {
                if($m != '' && $quantity[$key] != '')
                {
                    $material_model_item = array(
                        'model_id'    => $model_id,
                        'material_id' => $m,
                        'quantity'    => str_replace(',', '.', $quantity[$key]),
                        'order'       => $order, 
                    );                   
                    $this->materials_model_model->insert($material_model_item);
                }
                $order++;
            }
        }        
    }

    //---------------------------------------------------------------------------------------

    public function get_models()
    {
        $res = $this->db->query(
            "SELECT 
                models.*, SUM(model_items.quantity * materials.price) as total_price 
            FROM 
                models as models, materials_models as model_items
            INNER JOIN
                materials as materials
            ON
                model_items.material_id = materials.id
            WHERE 
                model_items.model_id = models.id
            group by 
                models.id");

        return $res->result();
    }

    //---------------------------------------------------------------------------------------

    public function get_models_by_filter($brand, $client)
    {

        $filter = " 1 = 1 ";

        if(trim($brand) != '')
        {
            $filter .= " AND models.brand LIKE '%".$brand."%'";
        }

        if(trim($client) != '')
        {
            $filter .= " AND models.client LIKE '%".$client."%'";
        }

        $res = $this->db->query(
            "SELECT 
                models.*, SUM(model_items.quantity * materials.price) as total_price 
            FROM 
                models as models, materials_models as model_items
            INNER JOIN
                materials as materials
            ON
                model_items.material_id = materials.id
            WHERE 
                ".$filter."
            AND
                model_items.model_id = models.id
            group by 
                models.id");

        return $res->result();
    }

    //---------------------------------------------------------------------------------------

    public function get_models_materials($id = null)
    {
        $result = array();
        $models = $this->with('materials_model')->get($id);

        foreach($models as $d)
        {
            $result = $models;
            if(!empty($models->materials_model))
            {            
                foreach($models->materials_model as $k => $m)
                {
                    $material = $this->materials_model->get($m->material_id);                    
                    $m->material_description = $material->description;
                    $m->material_price       = $material->price;
                    $result->materials[$m->order] = $m;
                }
            }            
            unset($models->materials_model);            
        }

        if(!empty($result->materials))
        {
            ksort($result->materials);    
        }

        return $result;        
    }

    //---------------------------------------------------------------------------------------

    public function distinct_list($var)
    {
        $list = array();

        $this->db->select('DISTINCT('.$var.'), id');        
        $res = $this->get_all();

        foreach($res as $k => $b)
        {
            $list[$b->$var] = $b->$var;
        }
        
        return $list;
    }

    //---------------------------------------------------------------------------------------
   
    public function duplicate($id)
    {       
        $model = (array) $this->get_models_materials($id);

        if($model)
        {
            $array_data = array(
                'reference'   => $model['reference'],
                'description' => $model['description'],
                'brand'       => $model['brand'],
                'client'      => $model['client'],
                //'image'       => $model['image'],
            );

            $NewImageName = '';

            if($model['image'] != '')
            {
                $ImageExt = substr($model['image'], strrpos($model['image'], '.'));
                $ImageExt = str_replace('.','',$ImageExt);

                $ImageName = preg_replace("/\\.[^.\\s]{3,4}$/", "", $model['image']); 

                $rand = rand(0, 99999);

                $NewImageName = $ImageName."-".$rand.$ImageExt;

                if(!copy('./models_image/'.$model['image'], './models_image/'.$NewImageName))
                {
                    //exit('error');
                }
            }

            $array_data['image'] = $NewImageName;

            $model_id = $this->insert($array_data);

            if($model_id)
            {
                foreach ($model['materials'] as $key => $m) 
                {                    
                    $material_model_item = array(
                        'model_id'    => $model_id,
                        'material_id' => $m->material_id,
                        'quantity'    => $m->quantity,
                        'order'       => $m->order, 

                    );                   
                    $this->materials_model_model->insert($material_model_item);
                }

                return $model_id;
            }
        }

        return false;
    }

    //---------------------------------------------------------------------------------------

    public function delete_image($id)
    {   
        $this->db->where('id', $id);
        return $this->db->update('models', array('image' => '')); 
        //return $this->update($id, array('image' => ''));
    }

}