<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Materials extends MY_Controller {
	
	protected $models = array('materials', 'suppliers');
	protected $helpers = array('form');

	//---------------------------------------------------------------------------------------

	public function index()
	{
		$this->data['materials'] = $this->materials->with('suppliers')->get_all();		
	}

	//---------------------------------------------------------------------------------------

	public function add() 
	{
		if($_POST) 
		{
			$form_data = array(
				'suppliers_id' => $this->input->post('suppliers_id'),
				'description'  => $this->input->post('description'),
				'reference'    => $this->input->post('reference'),
				'price'        => $this->input->post('price'),
				'measure'      => $this->input->post('measure'),
				'brand'        => $this->input->post('brand'),
			);

			if($this->materials->insert($form_data)) 
			{
				$this->session->set_flashdata('feedback', '<div class="alert alert-success">Material adicionado com sucesso</div>');
				redirect('/materials');
			}
		}

		$this->data['suppliers_list'] = $this->suppliers->suppliers_list();
		$this->view = 'materials/form.php';
	}

	//---------------------------------------------------------------------------------------

	public function update($id)
	{
		if(!$id OR !$this->materials->get($id))
		{
			$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Material inexistente</div>');
			redirect('/materials');
		}

		if($this->input->post('description')) 
		{
			$form_data = array(
				'suppliers_id' => $this->input->post('suppliers_id'),
				'description'  => $this->input->post('description'),
				'reference'    => $this->input->post('reference'),
				'price'        => $this->input->post('price'),
				'measure'      => $this->input->post('measure'),
				'brand'        => $this->input->post('brand'),
			);

			if($this->materials->update($id, $form_data))
			{
				$this->session->set_flashdata('feedback', '<div class="alert alert-success">Material alterado com sucesso</div>');
				redirect('/materials');
			}	
		} 
		else 
		{
			$this->data['materials'] = $this->materials->get($id);
		}

		$this->data['suppliers_list'] = $this->suppliers->suppliers_list();
		$this->view = 'materials/form.php';		
	}

	//---------------------------------------------------------------------------------------

	public function get_materials()
	{
		$term = $this->input->post('term');
		$result = array();
		if($term != '')
		{
			$res = $this->materials->get_materials($term);
			if(!empty($res)) 
			{
				foreach($res as $k => $m)
				{
					$result[] = array(
						'id'          => $m->id, 
						'description' => $m->description,
						'brand'       => $m->brand,
						'price'       => $m->price,
						'measure'     => $m->measure,
					);					
				}
			}
		}
		echo json_encode($result);		
		exit;
	}

}