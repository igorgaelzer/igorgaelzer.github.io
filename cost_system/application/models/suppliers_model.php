<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers_model extends MY_Model {

	public $before_create = array('timestamps');
    public $before_update = array('timestamps_update');

	public $validate = array(
        array( 'field' => 'company_name', 
               'label' => 'Empresa',
               'rules' => 'required' ),
        /*array( 'field' => 'email', 
               'label' => 'Email',
               'rules' => 'required|email' ),
        array( 'field' => 'phone', 
               'label' => 'Telefone',
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

    public function suppliers_list()
    {
        $list = array();
        $this->db->select('id, company_name');
        foreach($this->get_all() as $key => $s)
        {
            $list[$s->id] = $s->company_name;
        }
        return $list;
    }
}