<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Models extends MY_Controller {
	
	protected $models  = array('model', 'materials_model');
	protected $helpers = array('form');

	//---------------------------------------------------------------------------------------

	public function index()
	{
		$this->data['models'] = $this->model->get_models();
	}

	//---------------------------------------------------------------------------------------

	public function add()
	{
		if($_POST)
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('reference', 'Referência', 'required');

			if ($this->form_validation->run() == TRUE)
			{
				$this->data['image_error'] = array();
				$upload_file = '';

				if(isset($_FILES['image_model']['size']) && $_FILES['image_model']['size'] > 0)
				{
					$config = array(
						'upload_path'   => './models_image/',
						'allowed_types' => 'gif|jpg|png',
					);				

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('image_model'))
					{					
						$this->data['image_error'] = $this->upload->display_errors('', '');
					}
					else
					{
						$file_data = $this->upload->data();	
						$upload_file = $file_data['file_name'];
						//change permission to 0777
						chmod("./models_image/".$file_data['file_name'], 0777);
					}
				}
	
				if(empty($this->data['image_error']))
				{
					if($this->model->add($upload_file))
					{
						$this->session->set_flashdata('feedback', '<div class="alert alert-success">Modelo adicionado com sucesso</div>');
						redirect('/models');
					}	
				}				
			}			
		}

		$this->view = 'models/form.php';
	}

	//---------------------------------------------------------------------------------------

	public function update($id)
	{		
		if(!$this->model->get($id))
		{
			$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Modelo inexistente</div>');			
			redirect('/models');
		}

		if($_POST) 
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('reference', 'Referência', 'required');

			if ($this->form_validation->run() == TRUE)
			{
				$this->data['image_error'] = array();
				$upload_file = null;

				if(isset($_FILES['image_model']['size']) && $_FILES['image_model']['size'] > 0)
				{
					$config = array(
						'upload_path'   => './models_image/',
						'allowed_types' => 'gif|jpg|png',
					);				

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('image_model'))
					{					
						$this->data['image_error'] = $this->upload->display_errors('', '');
					}
					else
					{
						$file_data = $this->upload->data();	
						$upload_file = $file_data['file_name'];
						chmod("./models_image/".$file_data['file_name'], 0777);
					}
				}
	
				if(empty($this->data['image_error']))
				{
					if($this->model->update_data($id, $upload_file))
					{
						$this->session->set_flashdata('feedback', '<div class="alert alert-success">Modelo atualizado com sucesso</div>');
						redirect('/models');
					}
				}				
			}
			
		} 
					
		$this->data['models'] = $this->model->get_models_materials($id);
		

		$this->view = 'models/form_update.php';		
	}

	//---------------------------------------------------------------------------------------

	public function delete($id)
    {
        if(!$this->model->get($id))
        {
            $this->session->set_flashdata('feedback', '<div class="alert alert-danger">Registro inexistente</div>');
            redirect('/models');
        }

        $data = $this->model->get($id);

        if($this->model->delete($id))
        {
        	//delete image file
        	$file = read_file('./models_image/'.$data->image);
	        if($file)
	        {
	        	unlink('./models_image/'.$data->image);
	        }

            $this->session->set_flashdata('feedback', '<div class="alert alert-success">Registro deletado com sucesso</div>');
            redirect('/models');
        }
        else
        {
            $this->session->set_flashdata('feedback', '<div class="alert alert-warning">Não foi possível apagar esse registro. Verifique as dependências.</div>');
            redirect('/models');
        }
    }

    //---------------------------------------------------------------------------------------

    public function duplicate($id)
    {    	
    	if(!$this->model->get($id))
        {
            $this->session->set_flashdata('feedback', '<div class="alert alert-danger">Registro inexistente</div>');
            redirect('/models');
        }

        $model_id = $this->model->duplicate($id);

        if($model_id)
        {
        	$this->session->set_flashdata('feedback', '<div class="alert alert-warning">Registro duplicado.</div>');
        	redirect('/models/update/'.$model_id);
        }
        else
        {
        	$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Não foi possível duplicar esse registro.</div>');
            redirect('/models');
        }
    }

    //---------------------------------------------------------------------------------------

    public function delete_image($id)
    {
    	if($this->input->is_ajax_request())    		
    	{
	    	if(!$this->model->get($id))
	        {
	            $this->session->set_flashdata('feedback', '<div class="alert alert-danger">Registro inexistente</div>');
	            echo '<script> window.location="'.base_url('/models').'"</script>';
	        }

	        $data = $this->model->get($id);	        

	        if($this->model->delete_image($id))
	        {
		        $file = read_file('./models_image/'.$data->image);
		        if($file)
		        {
		        	unlink('./models_image/'.$data->image);
		        }

	        	echo 'success';
	        }
	        else
	        {
	        	echo 'error';
	        }
	        exit;
	    }
	    else     
	    {
	    	redirect('/models');
	    }
    }

}