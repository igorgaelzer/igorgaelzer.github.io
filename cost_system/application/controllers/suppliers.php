<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers extends MY_Controller {
	
	protected $models = array('suppliers');
	protected $helpers = array('form');

	//---------------------------------------------------------------------------------------

	public function index()
	{
		$this->data['suppliers'] = $this->suppliers->get_all();		
	}

	//---------------------------------------------------------------------------------------

	public function add() 
	{
		if($_POST) 
		{
			$form_data = array(
				'company_name'   => $this->input->post('company_name'),
				'city' 			 => $this->input->post('city'),
				'state' 		 => $this->input->post('state'),
				'email' 		 => $this->input->post('email'),
				'phone' 		 => $this->input->post('phone'),
				'representative' => $this->input->post('representative'),
			);

			if($this->suppliers->insert($form_data))
			{
				$this->session->set_flashdata('feedback', '<div class="alert alert-success">Fornecedor adicionado com sucesso</div>');
				redirect('/suppliers');
			}
		}

		$this->view = 'suppliers/form.php';
	}

	//---------------------------------------------------------------------------------------

	public function update($id)
	{
		if(!$this->suppliers->get($id))
		{
			$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Fornecedor inexistente</div>');
			redirect('/suppliers');
		}

		if($this->input->post('company_name')) {
			$form_data = array(
				'company_name'   => $this->input->post('company_name'),
				'city' 			 => $this->input->post('city'),
				'state' 		 => $this->input->post('state'),
				'email' 		 => $this->input->post('email'),
				'phone' 		 => $this->input->post('phone'),
				'representative' => $this->input->post('representative'),
			);

			if($this->suppliers->update($id, $form_data))
			{
				$this->session->set_flashdata('feedback', '<div class="alert alert-success">Fornecedor alterado com sucesso</div>');
				redirect('/suppliers');
			}	
		} 
		else 
		{
			$this->data['suppliers'] = $this->suppliers->get($id);
		}

		$this->view = 'suppliers/form.php';		
	}

}