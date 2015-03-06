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
		if(false){
			//If there is update for these particular bookings
		}
		else
		{
			//$tablename = 'trcarbooking';
			//$booking_list = $this->bookingmodel->getall_booking($tablename);
			$tableone = 'trcarbooking';
			$tabletwo = 'msuser';
			$booking_list = $this->bookingmodel->getoneuser_booking_join_byid($tableone, $tabletwo);
			$data['bookinglist'] = $booking_list;
			//var_dump($booking_list);
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('booking', $data);
			$this->load->view('footer');
		}

	}

	public function pending()
	{
		//To update pending req to approval (later)
		if(false)
		{

		}
		else
		{
			$tableone = 'trcarbooking';
			$tabletwo = 'msuser';
			$booking_list = $this->bookingmodel->getallpending_booking($tableone, $tabletwo);
			$data['bookinglist'] = $booking_list;
			//var_dump($booking_list);
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('booking', $data);
			$this->load->view('footer');
		}

	}

	public function id()
	{
		// To update the particular's booking
		// $this->uri->segment(n); n=1 for controller, n=2 for method, etc
		// e.q "{URL}/booking/user/1" if $this->uri->segment(3); it return '1'
		if (false) 
		{

		}
		else
		{
			$userid = $this->uri->segment(3);
			$tablename = 'trcarbooking';
			$booking_list = $this->bookingmodel->getone_booking($tablename, $userid);
			$name_list = $this->bookingmodel->getusername_byid($booking_list[0]->UserBooking);
			$data['bookinglist'] = $booking_list;
			$data['namelist'] = $name_list;
			//print_r($name_list);
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('bookingbyid', $data);
			$this->load->view('footer');
		}

	}

	public function userid()
	{
		// To update the user itself's booking
		// $this->uri->segment(n); n=1 for controller, n=2 for method, etc
		// e.q "{URL}/booking/userid/1" if $this->uri->segment(3); it return '1'
		if (true)
		{
			$userid = $this->uri->segment(3);
			$tablename = 'trcarbooking';
			$booking_list = $this->bookingmodel->getoneuser_booking_byid($tablename, $userid);
			$name_list = $this->bookingmodel->getusername_byid($userid);
			$data['bookinglist'] = $booking_list;
			$data['namelist'] = $name_list;
			//var_dump($booking_list);
			//var_dump($name_list);
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('bookingbyuserid', $data);
			$this->load->view('footer');
		}

	}
/*
	public function username()
	{
		// To update the user itself's booking
		// $this->uri->segment(n); n=1 for controller, n=2 for method, etc
		// e.q "{URL}/booking/username/Admin" if $this->uri->segment(3); it return '1'
		$username = $this->uri->segment(3);
		if (true)
		{
			$tablename = 'trcarbooking';
			$booking_list = $this->bookingmodel->getoneuserbyname_booking($tablename, $username);
			$data['bookinglist'] = $booking_list;
			//var_dump($booking_list);
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('booking', $data);
			$this->load->view('footer');
		}

	}
*/
	public function  request()
	{
		if($this->input->post('csrf_test_name') || $this->input->post('submitBooking'))
		{
			 // Request to Book
		     // $this->load->library('form_validation');
		     // validation rules, if desired
			$tablename = 'trcarbooking';
			$datestring = "%Y-%m-%d %h:%i:%s";
			$time = mdate($datestring, time());

			$bookingID = $this->bookingmodel->getmaxID_booking($tablename) + 1;
			var_dump($bookingID);

			$bookingData = array(

				'BookingID'=>$bookingID,
				'CarID'=>$this->input->post('CarID'),
				'UserBooking'=>0,
				'UserBookingName'=>'Admin',
				'Driver'=>$this->input->post('Driver'),
				'BookingStart'=>$this->input->post('BookingStart'),
				'BookingEnd'=>$this->input->post('BookingEnd'),
				'Destination'=>$this->input->post('Destination'),
				'Remarks'=>$this->input->post('Remarks'),
				'CreatedTime'=>$time,
				'CreatedUsername'=>0,
				'BookingStatus'=>4,
				'RowStatus'=>'A'

			);

			var_dump($bookingData);

			$new_booking = $this->bookingmodel->insert_booking($tablename, $bookingData);
			if($new_booking)
			{
				set_flash('new_booking', 'alert alert-success', 
					'You have successfully requested a BRI Veteran vehicle booking pending supervisor approval. <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 'booking/request');
			}
			else
			{
				set_flash('new_booking', 'alert alert-danger', 
					'You are not successful in booking a BRI Veteran vehicle. <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 'booking/request');
			}
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