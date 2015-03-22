<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		/* 
			GET SESSION DATA

			$this->session->userdata('userid');
			$this->session->userdata('username');
			$this->session->userdata('role');
			$this->session->userdata('loggedin');
		*/
			
		//Check Logged in
		if($this->session->userdata('loggedin')==NULL) 
		{
			redirect('login');
		}


		
		$this->load->view('header');

		$data['username'] = $this->session->userdata('username');
		$this->load->view('headertitle',$data);
		
		$data['role'] = $this->session->userdata('role');
		$this->load->view('navigation', $data);
		$this->load->view('dashboard');
		$this->load->view('footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */