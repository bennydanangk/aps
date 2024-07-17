<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {


	function __construct(){
		parent::__construct();	
		$this->load->library('App');	
		$this->load->model('m_dashboard');
		$this->load->library('../../Api/controllers/Api');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}

		
	}

	public function index()
	{
			$data['nama_modul'] = 'Dashboard';
			$data['config'] = $this->api->config();
			$data['nama_pengguna'] = $this->session->userdata('nama_pegawai');
			// $this->load->view('template',$data);
			$id_role = $this->session->userdata('id_role');

			$data['menu'] = $this->api->menu($id_role);

			$this->load->view('backend/a_header',$data);
			$this->load->view('backend/b_sidebar',$data);
			$this->load->view('backend/c_main',$data);
			$this->load->view('backend/d_footer',$data);
	
		
	

	}


	
		
}
