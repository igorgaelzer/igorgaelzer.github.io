<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller {
	
	protected $models = array('users');
	protected $helpers = array('form');

	//---------------------------------------------------------------------------------------

	public function index()
	{
		$this->_check_admin();

		$this->data['users'] = $this->users->get_all();

		$this->view = 'users/index.php';
	}

	//---------------------------------------------------------------------------------------

	public function add() 
	{
		$this->_check_admin();

		if($_POST) 
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('name', 'Nome', 'required');
			$this->form_validation->set_rules('password', 'Senha', 'required|matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password', 'Confirmar Senha', 'required');
			$this->form_validation->set_rules('username', 'Email', 'required|email|is_unique[users.username]');

			if ($this->form_validation->run() == TRUE)
			{
				$form_data = array(
					'name'     => $this->input->post('name'),
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password')),
					'is_admin' => $this->input->post('is_admin')				
				);

				if($this->users->insert($form_data))
				{
					$this->session->set_flashdata('feedback', '<div class="alert alert-success">Usuário adicionado com sucesso</div>');
					redirect('/users');
				}
			}
		}

		$this->view = 'users/form.php';
	}

	//---------------------------------------------------------------------------------------

	public function update($id) 
	{
		$this->_check_admin();

		if(!$this->users->get($id))
		{
			$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Usuário inexistente</div>');
			redirect('/users');
		}

		if($_POST) 
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('name', 'Nome', 'required');
			$this->form_validation->set_rules('password', 'Senha', 'matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password', 'Confirmar Senha', '');
			$this->form_validation->set_rules('username', 'Email', 'required|email|is_unique[users.username.id.'.$id.']');

			if ($this->form_validation->run() == TRUE)
			{
				$form_data = array(
					'name'     => $this->input->post('name'),
					'username' => $this->input->post('username'),					
					'is_admin' => $this->input->post('is_admin')				
				);

				if($this->users->update($id, $form_data, TRUE))
				{
					$this->session->set_flashdata('feedback', '<div class="alert alert-success">Usuário alterado com sucesso</div>');
					redirect('/users');
				}
			}
		}
		
		$this->data['users'] = $this->users->get($id);
		$this->view = 'users/update_form.php';
	}

	//---------------------------------------------------------------------------------------

	public function update_password($id) 
	{
		$this->_check_admin();
		
		if(!$this->users->get($id))
		{
			$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Usuário inexistente</div>');
			redirect('/users');
		}

		if($_POST) 
		{
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('password', 'Senha', 'required|matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password', 'Confirmar Senha', 'required');

			if ($this->form_validation->run() == TRUE)
			{
				$form_data = array(
					'password' => md5($this->input->post('password')),
				);

				if($this->users->update($id, $form_data, TRUE))
				{
					$this->session->set_flashdata('feedback', '<div class="alert alert-success">Senha alterada com sucesso</div>');
					redirect('/users');
				}
			}
		}

		$this->data['users'] = $this->users->get($id);
		$this->view = 'users/update_form.php';
	}

	//---------------------------------------------------------------------------------------

	public function edit_password() 
	{		
		if($_POST) 
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('old_password', 'Senha atual', 'required|callback__check_old_password');
			$this->form_validation->set_rules('password', 'Nova Senha', 'required|matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password', 'Confirma Senha', 'required');			

			if ($this->form_validation->run() == TRUE)
			{
				$form_data = array(
					'password'   => md5($this->input->post('password')),					
				);

				if($this->users->update($this->session->userdata('user')->id, $form_data, TRUE))
				{
					$this->session->set_flashdata('feedback', '<div class="alert alert-success">Senha alterada com sucesso</div>');
					redirect('/');
				}
			}
		}

		$this->view = 'users/change_password.php';
	}

	//---------------------------------------------------------------------------------------

	public function login()
	{
		if($_POST)
		{	
			$user = $this->users->login($this->input->post('username'), $this->input->post('password'));
			if($user)
			{
				$this->session->set_userdata(array('user' => $user));
				redirect('/');
			}
			else
			{
				$this->session->set_flashdata('feedback', '<div class="alert alert-danger">Email ou senha inválido</div>');
				redirect('/login');
			}			
		}

		$this->layout = 'layouts/login';
		$this->view = 'users/login.php';
	}

	//---------------------------------------------------------------------------------------

	public function logout()
	{
		$this->session->unset_userdata('user');
		redirect('/login');
	}

	//---------------------------------------------------------------------------------------

	public function _check_old_password($str)
	{
		$user = $this->users->get($this->session->userdata('user')->id);
		
		if(md5($str) == $user->password)
		{
			return true;
		}
		$this->form_validation->set_message('_check_old_password', 'Senha Atual inválida.');
		return false;
	}

	//---------------------------------------------------------------------------------------

	private function _check_admin()
	{
		if($this->session->userdata('user')->is_admin != 1)
		{
			$this->session->set_flashdata('feedback', '<div class="alert alert-warning">Você não tem acesso ao gerenciamento de usuários.</div>');
			redirect('/');
		}
	}

	//---------------------------------------------------------------------------------------
}