<?php
	
	class Home extends CI_Controller
	{
		
		public function index()
		{
			$this->load->view("home/inc/header_view");
			$this->load->view("home/home_view");
			$this->load->view("home/inc/footer_view");
		}

		// public function test()
		// {
		// 	$q = $this->db->get('user');
		// 	print_r($q->result());

		// 	// $this->db->insert('user' , [
		// 	// 'login' => 'igorgaelzer'
		// 	// ]);

		// 	// $this->db->where(['user_id' => 4]);
		// 	// $this->db->update('user' , ['login' => 'Sammy']);

		// 	// $this->db->where(['user_id' => 4]);
		// 	// $this->db->delete('user' , ['user_id' => 3]);

		// }
	}

?>