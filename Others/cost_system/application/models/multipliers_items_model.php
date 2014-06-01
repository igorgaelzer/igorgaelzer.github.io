<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multipliers_items_model extends MY_Model {

	public $before_create = array('timestamps');
    public $before_update = array('timestamps_update');    
	
    function __construct()
    {
        parent::__construct();
    }

    protected function timestamps($data)
    {
        $data['created'] = $data['updated'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function timestamps_update($data)
    {
        $data['updated'] = date('Y-m-d H:i:s');
        return $data;
    }

}