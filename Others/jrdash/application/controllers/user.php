<?php
	class User extends CI_Controller
	{
		
		
		public function __construct()
		{
			parent:: __construct();
			$this->load->model('user_model');
		}

		public function get()
		{
			$data = $this->user_model->get(2);
			
			print_r($data);
		}

		public function insert()
		{
			$result = $this->user_model->insert([
					'login' => 'igorgaelzer'
				]);
			
			print_r($result);
		}


	// 	public function update()
	// 	{
	// 		$result = $this->user_model->update([
	// 				'login' => 'itgaelzer'
	// 			] , 5);

	// 		print_r($result);
	// 	}


	// 	public function delete()
	// 	{
	// 		$result = $this->user_model->delete(1);

	// 		print_r($result)
	// 	}
	
	}

?>