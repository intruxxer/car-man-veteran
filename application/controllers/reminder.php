<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class reminder extends CI_Controller 
{
	public function index()
	{
		$this->load->model('remindermodel');

		$data['renewalSTNKList'] = $this->remindermodel->getRenewalSTNK();
		$data['reminderServiceList'] = $this->remindermodel->getReminderService();

		$this->load->view('header');
		$data['username'] = $this->session->userdata('username');
		$this->load->view('headertitle',$data);
		$data['role'] = $this->session->userdata('role');
		$this->load->view('navigation', $data);
		$this->load->view('reminder', $data);
		$this->load->view('footer');
	}
}