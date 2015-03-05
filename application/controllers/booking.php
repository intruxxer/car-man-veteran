<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {

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
		$this->load->library('session');
		$this->load->model('booking_model', 'bookingmodel');
		$this->load->helper('url');
		$this->load->helper('date');
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('headertitle');
		$this->load->view('navigation');
		$this->load->view('booking');
		$this->load->view('footer');
	}

	public function  request()
	{
		if($this->input->post('book'))
		{
			 // Request to Book
		     // $this->load->library('form_validation');
		     // validation rules, if desired
			$tablename = 'trcarbooking';
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = mdate($datestring, time());

			$bookingID = $this->bookingmodel->getmaxID_driver_holder($tablename);

			$bookingData = array(

				'UserID'=>$lastUserID,
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
		} 
		else
		{ 
		  	 // Normal View
			$this->load->helper('form');
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('bookingform');
			$this->load->view('footer');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */