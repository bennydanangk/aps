<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends MY_Controller {


	function __construct(){
		parent::__construct();	
		$this->load->library('App');	
		$this->load->model('m_pengguna');
		$this->load->library('../../Api/controllers/Api');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("auth"));
		}

		
	}

	public function index()
	{
			$data['nama_modul'] = 'Pengguna';
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

	function get_data()  {
		$list = $this->m_pengguna->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $field->kode_pegawai;
				$row[] = $field->nama_pegawai;
				$row[] = $field->state;
				$row[] = '<a onclick="f_edit('.$field->id_pegawai.')" class="btn btn-sm btn-secondary"><span class="fa fa-check"></span> </a> 
				<a onclick="f_delete('.$field->id_pegawai.')" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span> </a>
				<a onclick="f_detail('.$field->id_pegawai.')" class="btn btn-sm btn-success"><span class="fa fa-eye"></span> </a>
				';

				$data[] = $row;
		}

		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->m_pengguna->count_all(),
				"recordsFiltered" => $this->m_pengguna->count_filtered(),
				"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}


	
		
}
