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
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('driver_model', 'drivermodel');
		$this->load->helper('url');
		$this->load->helper('date');
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}

	public function index()
	{
		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('jumbotron');
		$this->load->view('navigation');
		$this->load->view('driver');
		$this->load->view('footer');
	}

	public function create()
	{
		$tablename = 'msuser';
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = mdate($datestring, time());

		$data = array(
		
			'Username'=>$this->input->post('driverHolderName'),
			'Cellphone'=>$this->input->post('driverHolderCellphone'),
			'Personincharge'=>$this->input->post('driverHolderPersonInCharge'),
			'Carincharge'=>$this->input->post('driverHolderCarInCharge'),
			'Position'=>$this->input->post('driverHolderPosition'),
			'Role'=>"driver",
			'CreatedTime'=>$time,
			'CreatedUsername'=>0,
			'RowStatus'=>'A'

		);

		var_dump($data);

		$new_driver = $this->drivermodel->insert_new_driver_holder($tablename, $data);

		redirect("driver/index");
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