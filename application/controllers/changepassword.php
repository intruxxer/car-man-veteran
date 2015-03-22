<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class changepassword extends CI_Controller 
{
	public function index()
	{
		//Check Logged in
		if($this->session->userdata('loggedin')==NULL) 
		{
			$this->session->set_flashdata('login_message', "You must login first");
			redirect('login');
		}

		$data['changepassword_message'] = "";

		if($this->session->flashdata('changepassword_message') != null)
		{
			$data['changepassword_message'] = $this->session->flashdata('changepassword_message');
		}
		
		$this->load->view('header');

		$data['username'] = $this->session->userdata('username');
		$this->load->view('headertitle',$data);
		$data['role'] = $this->session->userdata('role');
		$this->load->view('navigation', $data);
		$this->load->view('changepassword', $data);
		$this->load->view('footer');
		
	}

	public function doChangePassword()
	{
		$this->load->model('loginmodel');

		$data = $this->input->post();

		$result1 = $this->loginmodel->doCheckOldPassword($this->session->userdata('userid'), md5($data['oldpassword']));

		if(!isset($data['oldpassword']) || $data['oldpassword'] == "")
		{
			$this->session->set_flashdata('changepassword_message', "Old password must be filled");

			redirect('changepassword');
		}

		if(!isset($data['newpassword']) || $data['newpassword'] == "")
		{
			$this->session->set_flashdata('changepassword_message', "New password must be filled");

			redirect('changepassword');
		}

		
		if(!isset($data['confirmpassword']) || $data['confirmpassword'] == "")
		{
			$this->session->set_flashdata('changepassword_message', "Confirm password must be filled");

			redirect('changepassword');
		}

		if($result1 == null)
		{
			$this->session->set_flashdata('changepassword_message', "Old password incorrect");

			redirect('changepassword');
		}

		if($data['newpassword'] != $data['confirmpassword'])
		{
			$this->session->set_flashdata('changepassword_message', "New Password not match");

			redirect('changepassword');
		}
		
		$result2 = $this->loginmodel->doChangePassword(md5($data['newpassword']), $this->session->userdata('userid'));

		$this->session->set_flashdata('changepassword_message', "Change password successfully updated");

		redirect('changepassword');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */