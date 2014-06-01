<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model {

    public $before_create = array('timestamps');
    public $before_update = array('timestamps_update');

    public $validate = array(
        array( 'field' => 'name', 
               'label' => 'Nome',
               'rules' => 'required' ),
        array( 'field' => 'username', 
               'label' => 'Email',
               'rules' => 'required|email|is_unique[users.username]' ),
        array( 'field' => 'password', 
               'label' => 'Senha',
               'rules' => 'required' ),
    );

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

    public function login($username, $password)
    {
        $this->db->select('*');
        $res = $this->get_by('username', $username);
        if(!empty($res)) 
        {
        	if(md5($password) == $res->password) 
        	{
        		return $res;
        	}
        }
        return false;
    }
}