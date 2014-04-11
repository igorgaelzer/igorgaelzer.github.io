<?php
	/**
	* 
	*/
	class SupplierAdd extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view("nav_view");
			$this->load->view("title_view");
			$this->load->view("supplier_form_view");
		}
	}

?>