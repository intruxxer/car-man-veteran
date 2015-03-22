<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class maintenance extends CI_Controller 
{
	public function index()
	{
		$this->mainfunction(null, 1);
	}

	public function page($currentPage)
	{
		$this->mainfunction(null, $currentPage);
	}

	public function mainfunction($serviceid, $currentPage)
	{
		$this->load->model('maintenancemodel');

		$startlimit = ($currentPage-1)*10;

		$data['serviceHistoryList'] = $this->maintenancemodel->getServiceHistoryList($startlimit,10);
		$data['carList'] = $this->maintenancemodel->getCarList();
		$data['totalData'] = $this->maintenancemodel->getTotalServiceHistory();
		$data['currentPage'] = $currentPage;

		if(isset($serviceid) && $serviceid != null)
		{
			$data['serviceID'] = $serviceid;
			$data['serviceHistoryData'] = $this->maintenancemodel->getServiceDataByID($serviceid);
		}

		$data['message'] = "";

		if($this->session->flashdata('message') != null)
		{
			$data['message'] = $this->session->flashdata('message');
		}

		$this->load->view('header');
		$data['username'] = $this->session->userdata('username');
		$this->load->view('headertitle',$data);
		$data['role'] = $this->session->userdata('role');
		$this->load->view('navigation', $data);
		$this->load->view('maintenance', $data);
		$this->load->view('footer');
	}

	public function edit($serviceid)
	{
		$this->mainfunction($serviceid, 1);
	}

	public function createServiceHistory()
	{
		$this->load->model('maintenancemodel');

		$data = $this->input->post();

		$getserviceid = $this->maintenancemodel->getServiceID();

		$result = $this->maintenancemodel->createServiceHistory($getserviceid[0]['serviceid'], $data['carid'], $data['servicedate'], 
			$data['nextservicekm'], $data['remarks'], $this->session->userdata('userid'));

		$this->session->set_flashdata('message', "Service history have been successfully submited");

		$this->output->set_output(json_encode($result));
	}

	public function updateServiceHistory()
	{
		$this->load->model('maintenancemodel');

		$data = $this->input->post();

		$result = $this->maintenancemodel->updateServiceHistory($data['serviceid'], $data['carid'], $data['servicedate'], 
			$data['nextservicekm'], $data['remarks'], $this->session->userdata('userid'));

		$this->session->set_flashdata('message', "Service history have been successfully updated");

		$this->output->set_output(json_encode($result));
	}

	public function delete($serviceid)
	{
		$this->load->model('maintenancemodel');

		$result = $this->maintenancemodel->deleteServiceHistory($serviceid, $this->session->userdata('userid'));

		$this->session->set_flashdata('message', "Service history have been successfully deleted");

		redirect('/maintenance', 'refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */