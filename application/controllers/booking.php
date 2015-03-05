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
		     $this->load->library('form_validation');
		     //validation rules
		} 
		else
		{ 
		  	 // Normal View
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