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


			$data['menu'] = '
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">          

              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
			  
            </ul>
          </li>
';

			$this->load->view('backend/a_header',$data);
			$this->load->view('backend/b_sidebar',$data);
			$this->load->view('backend/c_main',$data);
			$this->load->view('backend/d_footer',$data);
	
		
	

	}


	
		
}
