<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class useradmin extends CI_Controller 
{
	public function index()
	{
		$this->mainfunction(null, 1);
	}

	public function page($currentPage)
	{
		$this->mainfunction(null, $currentPage);
	}

	public function mainfunction($userid, $currentPage)
	{
		//Check Logged in
		if($this->session->userdata('loggedin')==NULL) 
		{
			$this->session->set_flashdata('login_message', "You must login first");
			redirect('login');
		}

		$this->load->model('carmodel');
		$this->load->model('usermodel');

		$startlimit = ($currentPage-1)*10;

		$data['userList'] = $this->carmodel->getUserList();

		$data['userListData'] = $this->usermodel->getUserListData($startlimit, 10);

		$data['totalData'] = $this->usermodel->getTotalUser();
		$data['currentPage'] = $currentPage;

		if(isset($userid) && $userid != null)
		{
			$data['userID'] = $userid;
			$data['userData'] = $this->usermodel->getUserDataByID($userid);
		}

		$data['useradmin_message'] = "";

		if($this->session->flashdata('useradmin_message') != null)
		{
			$data['useradmin_message'] = $this->session->flashdata('useradmin_message');
		}

		$this->load->view('header');
		$data['username'] = $this->session->userdata('username');
		$this->load->view('headertitle',$data);
		$data['role'] = $this->session->userdata('role');
		$this->load->view('navigation', $data);
		$this->load->view('useradmin', $data);
		$this->load->view('footer');
	}

	public function edit($userid)
	{
		$this->mainfunction($userid, 1);
	}

	public function createUser()
	{
		//Check Logged in
		if($this->session->userdata('loggedin')==NULL) 
		{
			$this->session->set_flashdata('login_message', "You must login first");
			redirect('login');
		}

		$this->load->model('usermodel');

		$data = $this->input->post();

		$getuserid = $this->usermodel->getUserID();

		$result = $this->usermodel->createUser($getuserid[0]['userid'], $data['username'], md5('veteran'), $data['cellphone'], 
			$data['email'], $data['position'], $data['role'], $data['personincharge'], $this->session->userdata('userid'));
			

		$this->session->set_flashdata('useradmin_message', "User data have been successfully submited");

		$this->output->set_output(json_encode($result));
	}

	public function updateUser()
	{
		//Check Logged in
		if($this->session->userdata('loggedin')==NULL) 
		{
			$this->session->set_flashdata('login_message', "You must login first");
			redirect('login');
		}

		$this->load->model('usermodel');

		$data = $this->input->post();

		$result = $this->usermodel->updateUser($data['userid'], $data['username'], $data['hashkey'], $data['cellphone'], 
			$data['email'], $data['position'], $data['role'], $data['personincharge'], $this->session->userdata('userid'));

		$this->session->set_flashdata('useradmin_message', "User data have been successfully updated");

		$this->output->set_output(json_encode($result));
	}

	public function delete($userid)
	{
		//Check Logged in
		if($this->session->userdata('loggedin')==NULL) 
		{
			$this->session->set_flashdata('login_message', "You must login first");
			redirect('login');
		}

		$this->load->model('usermodel');

		$result = $this->usermodel->deleteUserData($userid, $this->session->userdata('userid'));

		$this->session->set_flashdata('useradmin_message', "User data have been successfully deleted");

		redirect('/useradmin', 'refresh');
	}

	public function resetpassword()
	{
		//Check Logged in
		if($this->session->userdata('loggedin')==NULL) 
		{
			$this->session->set_flashdata('login_message', "You must login first");
			redirect('login');
		}

		$this->load->model('usermodel');

		$data = $this->input->post();

		$userData = $this->usermodel->getUserDataByID($data['resetuserid']);

		$result = $this->usermodel->updateUser($data['resetuserid'], $userData[0]['username'], md5('veteran'), 
			$userData[0]['cellphone'], $userData[0]['email'], $userData[0]['position'], $userData[0]['role'], $userData[0]['personincharge'], 
			$this->session->userdata('userid'));

		$this->session->set_flashdata('useradmin_message', "User password have been successfully reset");

		$this->output->set_output(json_encode($result));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */