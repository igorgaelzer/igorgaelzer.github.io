<?php
	
	/**
	* 
	*/
	class Supplier extends CI_Model
	{
		
		public function get()
		{
			$q = $this->db->get('user');
		}

		return $q->result_array();
	}

?>