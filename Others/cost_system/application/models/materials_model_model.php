<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materials_model_model extends MY_Model {

	public $before_create = array('timestamps');
    public $before_update = array('timestamps_update');
    public $belongs_to    = array('model');

	public $validate = array(
        
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

}