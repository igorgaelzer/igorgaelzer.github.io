<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multipliers_model extends MY_Model {

	public $before_create = array('timestamps');
    public $before_update = array('timestamps_update');
    public $has_many      = array('multipliers_items');    
	
    public $validate = array(
        array( 'field' => 'name', 
               'label' => 'Nome',
               'rules' => 'required' ),        
        array( 'field' => 'description', 
               'label' => 'Descrição',
               'rules' => 'required' ),
    );

    //---------------------------------------------------------------------------------------

    function __construct()
    {
        parent::__construct();
        $this->load->model('multipliers_items_model');
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

    public function get_multipliers()
    {
        $res = $this->db->query('SELECT 
                        multipliers.*, 100 / (100 - SUM(items.cost_value)) as TOTAL 
                    FROM 
                        multipliers as multipliers
                    RIGHT JOIN
                        multipliers_items as items
                    ON
                        items.multiplier_id = multipliers.id
                    WHERE
                        multipliers.id != "" 
                    GROUP BY 
                        multipliers.id');
       
        return $res->result();
    }

    //---------------------------------------------------------------------------------------

    public function add()
    {
        $form_data = array(
            'name'        => $this->input->post('name'),
            'description' => $this->input->post('description'),
        );

        $multiplier_id = $this->insert($form_data);

        if($multiplier_id)
        {
            $this->save_multiplier_items($multiplier_id);
            return true;
        }
    }

    //---------------------------------------------------------------------------------------

    public function update_data($id)
    {
        $form_data = array(
            'name'        => $this->input->post('name'),
            'description' => $this->input->post('description'),
        );

        if($this->update($id, $form_data))
        {
            $this->save_multiplier_items($id);
            return true;
        }
    }

    //---------------------------------------------------------------------------------------

    private function save_multiplier_items($multiplier_id)
    {
        $cost_name = $this->input->post('cost_name');
        $value     = $this->input->post('value');

        if(is_array($cost_name) && !empty($cost_name)) 
        {
            $this->multipliers_items->delete_by('multiplier_id', $multiplier_id);            
            foreach ($cost_name as $key => $c) 
            {
                if($c != '' && $value[$key] != '')
                {
                    $multiplier_item = array(
                        'multiplier_id' => $multiplier_id,
                        'cost_name'     => $c,
                        'cost_value'    => $value[$key]
                    );
                    $this->multipliers_items->insert($multiplier_item);
                }
            }
        }
    }

    //---------------------------------------------------------------------------------------

    public function multipliers_list()
    {
        $list = array();
        $this->db->select('id, name');
        foreach($this->get_all() as $key => $m)
        {
            $list[$m->id] = $m->name;
        }
        return $list;
    }

    //---------------------------------------------------------------------------------------

    public function duplicate($id)
    {
        $multiplier = $this->with('multipliers_items')->get($id);

        if($multiplier)
        {
            $array_data = array(
                'name'        => $multiplier->name,
                'description' => $multiplier->description,
            );

            $multiplier_id = $this->insert($array_data);

            if($multiplier_id)
            {
                foreach ($multiplier->multipliers_items as $key => $m) 
                {
                    $multiplier_item = array(                        
                        'multiplier_id' => $multiplier_id,
                        'cost_name'     => $m->cost_name,
                        'cost_value'    => $m->cost_value
                    );
                    $this->multipliers_items->insert($multiplier_item);                 
                }

                return $multiplier_id;
            }
        }

        return false;
    }

}