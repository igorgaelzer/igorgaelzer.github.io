<?php
	/**
	* 
	*/
	class Multipliers extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view("nav_view");
			$this->load->view("title_add_view");
			$this->load->view("table_view");
		}
	}

?>