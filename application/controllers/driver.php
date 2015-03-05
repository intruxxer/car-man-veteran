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
		$this->load->library('session');
		$this->load->model('driver_model', 'drivermodel');
		$this->load->helper('url');
		$this->load->helper('date');
		error_reporting(E_ALL);
		ini_set('display_errors', 1);
	}

	public function index()
	{
		$tablename = 'msuser';
		$driverholder_list = $this->drivermodel->getall_driver_holder($tablename);
		$data['driverholderlist'] = $driverholder_list;
		//var_dump($driverholder_list);

		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('headertitle');
		$this->load->view('navigation');
		$this->load->view('driver', $data);
		$this->load->view('footer');
	}

	public function profile($id)
	{
		$tablename = 'msuser';
		$driverholder_list = $this->drivermodel->getall_driver_holder($tablename);
		$driverholder_profile = $this->drivermodel->getone_driver_holder($tablename, $id);
		$data['driverholderlist'] = $driverholder_list;
		$data['driverholderprofile'] = $driverholder_profile;
		//var_dump($driverholder_list);
		//var_dump($driverholder_profile);

		$this->load->helper('form');
		$this->load->view('header');
		$this->load->view('headertitle');
		$this->load->view('navigation');
		$this->load->view('driverprofile', $data);
		$this->load->view('footer');
	}

	public function create()
	{
		$tablename = 'msuser';
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = mdate($datestring, time());

		$lastUserID = $this->drivermodel->getmaxID_driver_holder($tablename);

		$data = array(

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

		//var_dump($data);

		$new_driver = $this->drivermodel->insert_driver_holder($tablename, $data);
		if($new_driver)
		{
			set_flash('new_driver', 'alert alert-success', 
				'You have successfully added a driver/holder. <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 'driver');
		}
		else
		{
			set_flash('new_driver', 'alert alert-danger', 
				'You are not successful adding a driver/holder. <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 'driver');
		}
	}

	public function update()
	{
		$tablename = 'msuser';
		$userid = $this->input->post('UserID');
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = mdate($datestring, time());

		$data = array(
		
			'ModifiedTime'=>$time,
			'ModifiedUsername'=>0,
			'RowStatus'=>'U'

		);

		$del = $this->input->post('deleteDriverHolder');
		if($del == true) { 
			$data['RowStatus'] = 'D';
			$updated_driver = $this->drivermodel->update_driver_holder($tablename, $data, $userid);
			//if($updated_driver)
			//{
				set_flash('new_driver', 'alert alert-success', 
					'You have successfully deleted a driver/holder. &nbsp;&nbsp;<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 'driver');
			//}
			//else
			//{
			//	set_flash('new_driver', 'alert alert-danger', 
			//		'You are not successful deleting a driver/holder. <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 'driver');
			//}
		}else
		{
			$dataTrail = array(
		
			'UserID'=>$userid,
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

			$updated_driver = $this->drivermodel->update_driver_holder($tablename, $data, $userid);
			$updated_driver_trail = $this->drivermodel->insert_driver_holder($tablename, $dataTrail);

			//var_dump($updated_driver);
			//var_dump($updated_driver_trail);

			if($updated_driver || $updated_driver_trail)
			{
				set_flash('new_driver', 'alert alert-success', 
					'You have successfully updated a driver/holder. &nbsp;&nbsp;<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 'driver');
			}
			else
			{
				set_flash('new_driver', 'alert alert-danger', 
					'You are not successful adding a driver/holder. &nbsp;&nbsp;<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 'driver');
			}
		}

	}

	public function delete()
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
			'ModifiedTime'=>$time,
			'ModifiedUsername'=>0,
			'RowStatus'=>'D'

		);

		$where = $this->input->post('UserID');
		$updated_driver = $this->drivermodel->update_driver_holder($tablename, $data, $where);

		if($updated_driver)
		{
			set_flash('new_driver', 'alert alert-success', 
				'You have successfully updated a driver/holder. <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 'driver');
		}
		else
		{
			set_flash('new_driver', 'alert alert-danger', 
				'You are not successful adding a driver/holder. <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>', 'driver');
		}
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