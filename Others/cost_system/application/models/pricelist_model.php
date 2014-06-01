<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pricelist_model extends MY_Model {

    public $_table = 'price_list';

	public $before_create = array('timestamps');
    public $before_update = array('timestamps_update');
    public $has_many      = array('models_pricelist' => array('model' => 'models_pricelist_model', 'primary_key' => 'price_list_id'));
	
    public $validate = array(
        array( 'field' => 'name', 
               'label' => 'Nome da Lista',
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
        $this->load->model('models_pricelist_model');
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

    public function add()
    {
        $form_data = array(
            'name'          => $this->input->post('name'),
            'description'   => $this->input->post('description'),
            'brand'         => $this->input->post('brand'),
            'client'        => $this->input->post('client'),
            'multiplier_id' => $this->input->post('multiplier_id'),
        );

        $pricelist_id = $this->insert($form_data);

        if($pricelist_id)
        {
            $this->save_pricelist_items($pricelist_id);
            return true;
        }
    }

    //---------------------------------------------------------------------------------------

    public function update_data($id)
    {
        $form_data = array(
            'name'          => $this->input->post('name'),
            'description'   => $this->input->post('description'),
            'brand'         => $this->input->post('brand'),
            'client'        => $this->input->post('client'),
            'multiplier_id' => $this->input->post('multiplier_id'),
        );

        if($this->update($id, $form_data))
        {
            $this->save_pricelist_items($id);
            return true;
        }
    }

    //---------------------------------------------------------------------------------------

    private function save_pricelist_items($pricelist_id)
    {
        $models_list = $this->input->post('models_list');        

        if(is_array($models_list) && !empty($models_list)) 
        {
            //first, delete all models from this price list
            $this->models_pricelist_model->delete_by('price_list_id', $pricelist_id);            

            foreach ($models_list as $key => $model_id) 
            {                
                $model_item = array(
                    'price_list_id' => $pricelist_id,
                    'model_id'     => $model_id,                    
                );                
                $this->models_pricelist_model->insert($model_item);             
            }
        }        
    }

    //---------------------------------------------------------------------------------------

    public function view_price_list($id)
    {

        $res = $this->db->query("
            SELECT 
                price_list.multiplier_id,
                models.id, 
                models.reference, 
                models.description, 
                SUM(materials_models.quantity * materials.price) as total_price 
            FROM 
                price_list, price_list_models
            JOIN
                models
            ON
                price_list_models.model_id = models.id
            JOIN
                materials_models
            ON
                materials_models.model_id = models.id
            JOIN
                materials
            ON
                materials.id = materials_models.material_id
            WHERE
                price_list.id = ".$id."
            AND
                price_list_models.price_list_id = price_list.id
            GROUP BY
                models.id")->result();

        foreach($res as $k => $v)
        {   
            $m = $this->db->query("SELECT 100/(100 - SUM(multipliers_items.cost_value)) as TOTAL FROM multipliers_items WHERE multiplier_id = ".$v->multiplier_id)->result();
            $multiplier = $m[0]->TOTAL;

            $price = ($multiplier * $v->total_price);
            //$multiplier_price = ($price * $multiplier);

            $res[$k]->multiplier_price = $price;

        }

        return $res;
    }

    //---------------------------------------------------------------------------------------

    public function duplicate($id)
    {
        $pricelist = $this->with('models_pricelist')->get($id);

        if($pricelist)
        {
            $array_data = array(
                'name'          => $pricelist->name,
                'description'   => $pricelist->description,
                'brand'         => $pricelist->brand,
                'client'        => $pricelist->client,
                'multiplier_id' => $pricelist->multiplier_id,
            );

            $pricelist_id = $this->insert($array_data);

            if($pricelist_id)
            {
                foreach ($pricelist->models_pricelist as $key => $m) 
                {                    
                    $model_item = array(
                        'price_list_id' => $pricelist_id,
                        'model_id'      => $m->model_id, 
                    );                   
                    $this->models_pricelist_model->insert($model_item);
                }

                return $pricelist_id;
            }
        }

        return false;
    }

    //---------------------------------------------------------------------------------------

}