<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Price_list extends MY_Controller {
	
	protected $models  = array('pricelist', 'model', 'multipliers');
	protected $helpers = array('form');

	//---------------------------------------------------------------------------------------

	public function index()
	{		
		$this->data['pricelist_list'] = $this->pricelist->get_all();
	}

	//---------------------------------------------------------------------------------------

	public function add()
	{
		if($_POST)
		{
			if($this->pricelist->add())
			{
				$this->session->set_flashdata('feedback', '<div class="alert alert-success">Lista de preço adicionada com sucesso</div>');
				redirect('/price_list');
			}
		}

		$this->data['client_list']		= $this->model->distinct_list('client');
		$this->data['brand_list']		= $this->model->distinct_list('brand');
		$this->data['models_list']      = $this->model->get_models();
		$this->data['multipliers_list'] = $this->multipliers->multipliers_list();
		$this->view = 'price_list/form.php';
	}

	//---------------------------------------------------------------------------------------

	public function update($id)
	{
		if(!$this->pricelist->get($id))
		{
			$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Lista de Preços inexistente</div>');
			redirect('/price_list');
		}

		if($_POST) 
		{
			if($this->pricelist->update_data($id))
			{
				$this->session->set_flashdata('feedback', '<div class="alert alert-success">Lista de preço alterada com sucesso</div>');
				redirect('/price_list');
			}
		} 
		else 
		{
			$this->data['price_list'] = $this->pricelist->with('models_pricelist')->get($id);
		}

		$this->data['client_list']		= $this->model->distinct_list('client');
		$this->data['brand_list']		= $this->model->distinct_list('brand');
		$this->data['models_list']      = $this->model->get_models();
		$this->data['multipliers_list'] = $this->multipliers->multipliers_list();

		$this->view = 'price_list/form_update.php';
	}

	//---------------------------------------------------------------------------------------

	public function view($id)
	{
		$list_data = $this->pricelist->get($id);
		$this->data['page_title']       = "";
		$this->data['pdf_message']      = $list_data->name . "  -  " . date('d/m/Y', strtotime($list_data->updated));
		$this->data['price_list']       = $list_data;
		$this->data['price_list_items'] = $this->pricelist->view_price_list($id);
		$this->view = 'price_list/view.php';
	}

	//---------------------------------------------------------------------------------------

	public function delete($id)
    {
        if(!$this->pricelist->get($id))
        {
            $this->session->set_flashdata('feedback', '<div class="alert alert-danger">Registro inexistente</div>');
            redirect('/price_list');
        }

        if($this->pricelist->delete($id))
        {
            $this->session->set_flashdata('feedback', '<div class="alert alert-success">Registro deletado com sucesso</div>');
            redirect('/price_list');
        }
        else
        {
            $this->session->set_flashdata('feedback', '<div class="alert alert-warning">Não foi possível apagar esse registro. Verifique as dependências.</div>');
            redirect('/price_list');
        }
    }

    //---------------------------------------------------------------------------------------

    public function list_models()
    {
    	if($this->input->is_ajax_request())    		
    	{
    		$this->layout = FALSE;

    		$brand  = $this->input->post('brand');
    		$client = $this->input->post('client');

    		$datapassed['models_list'] = $this->model->get_models_by_filter($brand, $client);
    		$data = $this->load->view('price_list/list_models', $datapassed, TRUE);
    		echo $data;
    		exit;
    	}
    	else
    	{
    		redirect('/');
    	}
    }

    //---------------------------------------------------------------------------------------

    public function duplicate($id)
	{
		if(!$this->pricelist->get($id))
		{
			$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Fornecedor inexistente</div>');
			redirect('/price_list');
		}

		$pricelist_id = $this->pricelist->duplicate($id);
        if($pricelist_id)
        {
        	$this->session->set_flashdata('feedback', '<div class="alert alert-warning">Registro duplicado.</div>');
        	redirect('/price_list/update/'.$pricelist_id);
        }
        else
        {
        	$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Não foi possível duplicar esse registro.</div>');
            redirect('/price_list');
        }
	}

    //---------------------------------------------------------------------------------------

}