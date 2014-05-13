<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materials_model extends MY_Model {

	public $before_create = array('timestamps', 'format_price');
    public $before_update = array('timestamps_update', 'format_price');
    public $after_get     = array('format_price_real');
    public $belongs_to    = array('suppliers');

	public $validate = array(
        /*array( 'field' => 'suppliers_id', 
               'label' => 'Fornecedor',
               'rules' => 'required' ),*/
        array( 'field' => 'description', 
               'label' => 'Descrição',
               'rules' => 'required' ),
        /*array( 'field' => 'reference', 
               'label' => 'Referência',
               'rules' => 'required' ),*/
    );

    //---------------------------------------------------------------------------------------

    function __construct()
    {
        parent::__construct();
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

    protected function format_price($data)
    {
        $source = array('.', ',');  
        $replace = array('', '.');          
        $data['price'] = str_replace($source, $replace, $data['price']);        
        return $data;
    }

    //---------------------------------------------------------------------------------------

    protected function format_price_real($data)
    {
        $data->price = number_format($data->price, 2, ',', '.');
        return $data;
    }

    //---------------------------------------------------------------------------------------

    public function get_materials($term)
    {
        $this->return_type = 'array';
        $this->db->like('description', $term);
        $this->db->or_like('brand', $term);
        $res = $this->get_all();

        return $res;
    }

}