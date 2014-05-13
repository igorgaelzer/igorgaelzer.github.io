<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Models_pricelist_model extends MY_Model {

    public $_table = 'price_list_models';

	//public $before_create = array('timestamps');
    //public $before_update = array('timestamps_update');
    public $belongs_to    = array('pricelist');

	public $validate = array(
        
    );

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