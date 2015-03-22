<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class caradmin extends CI_Controller 
{
	public function index()
	{
		$this->mainfunction(null, 1);
	}

	public function page($currentPage)
	{
		$this->mainfunction(null, $currentPage);
	}

	public function mainfunction($carid, $currentPage)
	{
		//Check Logged in
		if($this->session->userdata('loggedin')==NULL) 
		{
			$this->session->set_flashdata('login_message', "You must login first");
			redirect('login');
		}

		$this->load->model('carmodel');

		$startlimit = ($currentPage-1)*10;

		$data['userList'] = $this->carmodel->getUserList();
		$data['carList'] = $this->carmodel->getCarList($startlimit, 10);
		$data['totalData'] = $this->carmodel->getTotalCar();
		$data['currentPage'] = $currentPage;

		if(isset($carid) && $carid != null)
		{
			$data['carID'] = $carid;
			$data['carData'] = $this->carmodel->getCarDataByID($carid);
		}

		$data['caradmin_message'] = "";

		if($this->session->flashdata('caradmin_message') != null)
		{
			$data['caradmin_message'] = $this->session->flashdata('caradmin_message');
		}

		$this->load->view('header');
		$data['username'] = $this->session->userdata('username');
		$this->load->view('headertitle',$data);
		$data['role'] = $this->session->userdata('role');
		$this->load->view('navigation', $data);
		$this->load->view('caradmin', $data);
		$this->load->view('footer');
	}

	public function edit($carid)
	{
		$this->mainfunction($carid, 1);
	}

	public function createCar()
	{
		//Check Logged in
		if($this->session->userdata('loggedin')==NULL) 
		{
			$this->session->set_flashdata('login_message', "You must login first");
			redirect('login');
		}

		$this->load->model('carmodel');

		$data = $this->input->post();

		$getcarid = $this->carmodel->getCarID();

		$result = $this->carmodel->createCar($getcarid[0]['carid'], $data['brandname'], $data['typename'], $data['transmitiontype'], 
			$data['platenumber'], $data['stnkexpiry'], $data['machinenumber'], $data['casisnumber'], $data['manufactureyear'], 
			$data['personincharge'], $this->session->userdata('userid'));
			

		$this->session->set_flashdata('caradmin_message', "Car data have been successfully submited");

		$this->output->set_output(json_encode($result));
	}

	public function updateCar()
	{
		//Check Logged in
		if($this->session->userdata('loggedin')==NULL) 
		{
			$this->session->set_flashdata('login_message', "You must login first");
			redirect('login');
		}

		$this->load->model('carmodel');

		$data = $this->input->post();

		$result = $this->carmodel->updateCar($data['carid'], $data['brandname'], $data['typename'], $data['transmitiontype'], 
			$data['platenumber'], $data['stnkexpiry'], $data['machinenumber'], $data['casisnumber'], $data['manufactureyear'], 
			$data['personincharge'], $this->session->userdata('userid'));

		$this->session->set_flashdata('caradmin_message', "Car data have been successfully updated");

		$this->output->set_output(json_encode($result));
	}

	public function delete($carid)
	{
		//Check Logged in
		if($this->session->userdata('loggedin')==NULL) 
		{
			$this->session->set_flashdata('login_message', "You must login first");
			redirect('login');
		}

		$this->load->model('carmodel');

		$result = $this->carmodel->deleteCarData($carid, $this->session->userdata('userid'));

		$this->session->set_flashdata('caradmin_message', "Car data have been successfully deleted");

		redirect('/caradmin', 'refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */