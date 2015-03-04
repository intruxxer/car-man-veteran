<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driver extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->database();
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('jumbotron');
		$this->load->view('navigation');
		$this->load->view('driver');
		$this->load->view('footer');
	}

	public function create()
	{
		$this->load->model('Driver_model');
		$this->load->helper('date');

		$datestring = "%Y-%m-%d %h:%i:%a";
		$time = mdate($datestring, time());

		$data['UserID'] = 0; //The one who created this entry
		$data['Username'] = $this->input->post('driverHolderName');
		$data['Cellphone'] = $this->input->post('driverHolderCellphone');
		$data['Personincharge'] = $this->input->post('driverHolderPersonInCharge');
		$data['Carincharge'] = $this->input->post('driverHolderCarInCharge');
		$data['Position'] = $this->input->post('driverHolderPosition');
		$data['Role'] = "driver";
		$data['CreatedTime'] = $time;
		$data['CreatedUsername'] = "admin";

		$this->Driver_model->insert_new_driver_holder($data);

		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('jumbotron');
		$this->load->view('navigation');
		$this->load->view('driver');
		$this->load->view('footer');
	}

	/*
	public function index()
	{
		if($this->input->post('foo'))
		{ // there something was POSTed
		     $this->load->library('form_validation');
		     //validation rules
		} 
		else
		{ 
		  // normal view
		}

		$this->load->view('home');		    
	}
	*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */