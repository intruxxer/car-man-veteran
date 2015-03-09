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
		$this->load->library('pagination');
		$this->load->model('booking_model', 'bookingmodel');
		$this->load->helper('url');
		$this->load->helper('date');
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index($pageNo=NULL)
	{
		if($pageNo!=NULL){
			$this->page($pageNo);
		}
		else
		{	
			$tableone = 'trcarbooking';
			$tabletwo = 'msuser';

			$config['base_url'] = base_url('booking/page');
			$config['total_rows'] = $this->db->get($tableone)->num_rows();
			$config['per_page'] = 5;
			$config['num_links'] =4;
			$config['uri_segment'] = 3;
			$config['cur_tag_open'] = '<a href="#"><b>';
			$config['cur_tag_close'] = '</b></a>';
			$config['full_tag_open'] = '<div id="pagination">';
			$config['full_tag_close'] = '</div>';
			
			$this->pagination->initialize($config);

			// *Here, there are params TABLE NAME, LIM, OFF 
			//  i.e. LIM 5, 2 means to pick 2 records AFTER 5 records -> to take row 6, 7 in a table

			//$data['voters'] = $this->db->get('pemilihcomplete', $config['per_page'], $this->uri->segment(4));
			//$data['dpstln'] = $this->table->generate($data['voters']);
			//$data['links'] = $this->pagination->create_links();

			//var_dump($config['total_rows']); 

			//MAIN
			//$booking_list = $this->bookingmodel->getall_booking_join_byid($tableone, $tabletwo);
			//$data['bookinglist'] = $booking_list;
			//END MAIN


			//underconstruction
			$data['bookinglist'] = $this->bookingmodel
			->getall_booking_join_byid_withlimitoffset($tableone, $tabletwo, $config['per_page'], $pageNo);
			$data['links'] = $this->pagination->create_links();

			//var_dump($booking_list);
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('booking', $data);
			$this->load->view('footer');
		}

	}

	public function page($pageNo=NULL)
	{	
			$tableone = 'trcarbooking';
			$tabletwo = 'msuser';

			$config['base_url'] = base_url('booking/page');
			$config['total_rows'] = $this->db->get($tableone)->num_rows();
			$config['per_page'] = 5;
			$config['num_links'] =4;
			$config['uri_segment'] = 3;
			$config['cur_tag_open'] = '<a href="#"><b>';
			$config['cur_tag_close'] = '</b></a>';
			$config['full_tag_open'] = '<li>';
			$config['full_tag_close'] = '</li>';
			
			$this->pagination->initialize($config);

			// *Here, there are params TABLE NAME, LIM, OFF 
			//  i.e. LIM 5, 2 means to pick 2 records AFTER 5 records -> to take row 6, 7 in a table

			//$data['voters'] = $this->db->get('pemilihcomplete', $config['per_page'], $this->uri->segment(4));
			//$data['dpstln'] = $this->table->generate($data['voters']);
			//$data['links'] = $this->pagination->create_links();

			//var_dump($config['total_rows']); 

			//MAIN
			//$booking_list = $this->bookingmodel->getall_booking_join_byid($tableone, $tabletwo);
			//$data['bookinglist'] = $booking_list;
			//END MAIN


			//underconstruction
			$data['bookinglist'] = $this->bookingmodel
			->getall_booking_join_byid_withlimitoffset($tableone, $tabletwo, $config['per_page'], $pageNo);
			$data['links'] = $this->pagination->create_links();

			//var_dump($booking_list);
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('booking', $data);
			$this->load->view('footer');

	}

	public function pending($pageNo=NULL)
	{
		//To update pending req to approval
		$this->load->helper('form');
		if($this->input->post('submitBookingApproval'))
		{
			$tableone = 'trcarbooking';
			$whereid = $this->input->post('BookingID');
			
			$bookingData = array(

				'BookingID'=>$whereid,
				'CarID'=>$this->input->post('CarID'),
				'UserBooking'=>$this->input->post('UserBooking'),
				'Driver'=>$this->input->post('Driver'),
				'BookingStart'=>$this->input->post('BookingStart'),
				'BookingEnd'=>$this->input->post('BookingEnd'),
				'CheckedBy'=>$this->input->post('CheckedBy'),
				'Destination'=>$this->input->post('Destination'),
				'Remarks'=>$this->input->post('Remarks'),
				'CreatedTime'=>$this->input->post('CreatedTime'),
				'CreatedUsername'=>$this->input->post('CreatedUsername'),
				'BookingStatus'=>$this->input->post('BookingStatus'),
				'RowStatus'=>'A'

			);
			$update_booking = $this->bookingmodel->update_booking($tableone, $bookingData, $whereid);
			set_flash('req_approval', 'alert alert-success', 
					'You have successfully decided on a request. &nbsp;&nbsp;<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 'booking/pending');

		}
		else
		{
			$tableone = 'trcarbooking';
			$tabletwo = 'msuser';
			
			$config['base_url'] = base_url('booking/pending');
			$config['total_rows'] = $this->db->get_where($tableone, array('BookingStatus'=>4))->num_rows();
			$config['per_page'] = 5;
			$config['num_links'] =4;
			$config['uri_segment'] = 3;
			$config['cur_tag_open'] = '<a href="#"><b>';
			$config['cur_tag_close'] = '</b></a>';
			$config['full_tag_open'] = '<li>';
			$config['full_tag_close'] = '</li>';
			
			$this->pagination->initialize($config);

			$booking_list = $this->bookingmodel->getallpending_booking_withlimitoffset($tableone, $tabletwo, $config['per_page'], $pageNo);
			$data['bookinglist'] = $booking_list;
			$data['links'] = $this->pagination->create_links();
			//var_dump($booking_list);
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('bookingpending', $data);
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
				'UserBooking'=>4,
				'Driver'=>$this->input->post('Driver'),
				'BookingStart'=>$this->input->post('BookingStart'),
				'BookingEnd'=>$this->input->post('BookingEnd'),
				'Destination'=>$this->input->post('Destination'),
				'Remarks'=>$this->input->post('Remarks'),
				'CreatedTime'=>$time,
				'CreatedUsername'=>1,
				'BookingStatus'=>4,
				'RowStatus'=>'A'

			);

			//var_dump($bookingData);

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

	public function bytoday($pageNo=NULL)
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

			$config['base_url'] = base_url('booking/bytoday');
			$config['total_rows'] = $this->bookingmodel->getnum_all_booking_today($tableone, $tabletwo)->num_rows();
			$config['per_page'] = 5;
			$config['num_links'] =4;
			$config['uri_segment'] = 3;
			$config['cur_tag_open'] = '<a href="#"><b>';
			$config['cur_tag_close'] = '</b></a>';
			$config['full_tag_open'] = '<li>';
			$config['full_tag_close'] = '</li>';
			//var_dump($config['total_rows']);
			
			$this->pagination->initialize($config);

			$booking_list = $this->bookingmodel
							->getall_booking_today_join_byid_withlimitoffset($tableone, $tabletwo, $config['per_page'], $pageNo);
			$data['bookinglist'] = $booking_list;
			$data['links'] = $this->pagination->create_links();
			//var_dump($booking_list);
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('booking', $data);
			$this->load->view('footer');
		}
	}

	public function bythisweek($pageNo=NULL)
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

			$config['base_url'] = base_url('booking/bythisweek');
			$config['total_rows'] = $this->bookingmodel->getnum_all_booking_thisweek_join_byid($tableone, $tabletwo)->num_rows();
			$config['per_page'] = 5;
			$config['num_links'] =4;
			$config['uri_segment'] = 3;
			$config['cur_tag_open'] = '<a href="#"><b>';
			$config['cur_tag_close'] = '</b></a>';
			$config['full_tag_open'] = '<li>';
			$config['full_tag_close'] = '</li>';

			//var_dump($config['total_rows']);
			
			$this->pagination->initialize($config);

			$data['links'] = $this->pagination->create_links();

			$booking_list = $this->bookingmodel
							->getall_booking_thisweek_join_byid_withlimitoffset($tableone, $tabletwo, $config['per_page'], $pageNo);
			$data['bookinglist'] = $booking_list;
			$data['links'] = $this->pagination->create_links();
			//var_dump($booking_list);
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('booking', $data);
			$this->load->view('footer');
		}
	}

	public function bythismonth($pageNo=NULL)
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

			$config['base_url'] = base_url('booking/bythismonth');
			$config['total_rows'] = $this->bookingmodel->getnum_all_booking_thismonth_join_byid($tableone, $tabletwo)->num_rows();
			$config['per_page'] = 5;
			$config['num_links'] =4;
			$config['uri_segment'] = 3;
			$config['cur_tag_open'] = '<a href="#"><b>';
			$config['cur_tag_close'] = '</b></a>';
			$config['full_tag_open'] = '<li>';
			$config['full_tag_close'] = '</li>';

			//var_dump($config['total_rows']);
			
			$this->pagination->initialize($config);

			$booking_list = $this->bookingmodel
							->getall_booking_thismonth_join_byid_withlimitoffset($tableone, $tabletwo, $config['per_page'], $pageNo);
			$data['bookinglist'] = $booking_list;
			$data['links'] = $this->pagination->create_links();
			//var_dump($booking_list);
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('booking', $data);
			$this->load->view('footer');
		}
	}

	public function bydate($pageNo=NULL)
	{
		$this->load->helper('form');
		if($this->input->post('submitBookingSearch'))
		{
			 // Request to search for Bookings
		     // $this->load->library('form_validation');
		     // validation rules, if desired
			$tableone = 'trcarbooking';
			$tabletwo = 'msuser';
			$startDate = $this->input->post('searchBookingStart'); 
			$endDate = $this->input->post('searchBookingEnd');

			$config['base_url'] = base_url('booking/bydate');
			$config['total_rows'] = $this->bookingmodel
									->getnum_all_booking_inperiod_join_byid($tableone, $tabletwo, $startDate, $endDate)
									->num_rows();
			$config['per_page'] = 5;
			$config['num_links'] =4;
			$config['uri_segment'] = 3;
			$config['cur_tag_open'] = '<a href="#"><b>';
			$config['cur_tag_close'] = '</b></a>';
			$config['full_tag_open'] = '<li>';
			$config['full_tag_close'] = '</li>';

			//var_dump($config['total_rows']);
			
			$this->pagination->initialize($config);

			$booking_list = $this->bookingmodel
							->getall_booking_inperiod_join_byid_withlimitoffset($tableone, $tabletwo, $startDate, $endDate, $config['per_page'], $pageNo);
			$data['bookinglist'] = $booking_list;
			$data['links'] = $this->pagination->create_links();
			//var_dump($booking_list);

			if($booking_list)
			{
				//set_flash('search_booking', 'alert alert-success', 
				//	'Booking(s) found within your specified date. <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>');

				$data['resultmessage'] = '<a class="alert alert-success">Booking(s) found within your specified date. 
										  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>';
				$this->load->view('header');
				$this->load->view('headertitle');
				$this->load->view('navigation');
				$this->load->view('bookingsearch', $data);
				$this->load->view('footer');
			}
			else
			{
				set_flash('search_booking', 'alert alert-danger', 
					'Booking(s) are not found within your specified date. 
					<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>');
			}

		}
		else
		{
			$this->load->view('header');
			$this->load->view('headertitle');
			$this->load->view('navigation');
			$this->load->view('bookingsearchform');
			$this->load->view('footer');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */