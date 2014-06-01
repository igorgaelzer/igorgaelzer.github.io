<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Multipliers extends MY_Controller {
	
	protected $models  = array('multipliers', 'multipliers_items');
	protected $helpers = array('form');

	//---------------------------------------------------------------------------------------

	public function index()
	{
		$this->data['multipliers'] = $this->multipliers->get_multipliers();
	}

	//---------------------------------------------------------------------------------------

	public function add()
	{
		if($_POST)
		{			
			if($this->multipliers->add())
			{
				$this->session->set_flashdata('feedback', '<div class="alert alert-success">Multiplicador adicionado com sucesso</div>');
				redirect('/multipliers');
			}
		}

		$this->view = 'multipliers/form.php';
	}

	//---------------------------------------------------------------------------------------

	public function update($id)
	{
		if(!$this->multipliers->get($id))
		{
			$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Fornecedor inexistente</div>');
			redirect('/multipliers');
		}

		if($this->input->post('name')) 
		{	
			if($this->multipliers->update_data($id))
			{
				$this->session->set_flashdata('feedback', '<div class="alert alert-success">Multiplicador alterado com sucesso</div>');
				redirect('/multipliers');
			}	
		} 
		
		$this->data['multipliers'] = $this->multipliers->with('multipliers_items')->get($id);
	}

	//---------------------------------------------------------------------------------------

	public function duplicate($id)
	{
		if(!$this->multipliers->get($id))
		{
			$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Fornecedor inexistente</div>');
			redirect('/multipliers');
		}

		$multiplier_id = $this->multipliers->duplicate($id);
        if($multiplier_id)
        {
        	$this->session->set_flashdata('feedback', '<div class="alert alert-warning">Registro duplicado.</div>');
        	redirect('/multipliers/update/'.$multiplier_id);
        }
        else
        {
        	$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Não foi possível duplicar esse registro.</div>');
            redirect('/multipliers');
        }
	}

	//---------------------------------------------------------------------------------------

}