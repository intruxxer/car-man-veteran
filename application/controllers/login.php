<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller 
{
	public function index()
	{
		//Check Logged in
		if($this->session->userdata('loggedin')==true) 
		{
			redirect('dashboard');
		}

		$data['login_message'] = "";

		if($this->session->flashdata('login_message') != null)
		{
			$data['login_message'] = $this->session->flashdata('login_message');
		}

		$this->load->view('header');
		$this->load->view('login', $data);
	}

	public function doLogin()
	{
		$this->load->model('loginmodel');

		$data = $this->input->post();

		$result = $this->loginmodel->doLogin($data['username'], md5($data['password']));

		if(!isset($data['username']) || $data['username'] == "")
		{
			$this->session->set_flashdata('login_message', "Email must be filled");

			redirect('login');
		}

		if(!isset($data['password']) || $data['password'] == "")
		{
			$this->session->set_flashdata('login_message', "Password must be filled");

			redirect('login');
		}
		
		if($result != null)
		{
			$this->session->set_userdata('userid',$result[0]['userid']);
			$this->session->set_userdata('username',$result[0]['username']);
			$this->session->set_userdata('role',$result[0]['role']);
			$this->session->set_userdata('loggedin',true);

			redirect('dashboard');
		}
		else
		{
			$this->session->set_flashdata('login_message', "Email or password incorrect");

			redirect('login');
		}
	}

	public function doLogOut()
	{
		$this->session->sess_destroy();

		redirect('login');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */