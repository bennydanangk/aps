<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {


	function __construct(){
		parent::__construct();	
		$this->load->library('App');	
		$this->load->model('m_auth');
		$this->load->library('../../Api/controllers/Api');

		
	}

	public function index()
	{
		if($this->session->userdata('status') == "login"){
			redirect(base_url("dashboard"));
		}else{
			$data['config'] = $this->api->config();
			$this->load->view('login',$data);
		}
		
	

	}
	function login()  {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$where = array(
			'username' => $username,
			'state' => 'aktif'
			);

		$cek = $this->m_auth->get_data('pegawai',$where)->num_rows();
		if($cek > 0){

			$c_ = $this->m_auth->get_data('pegawai',$where)->result();
			$_password = $c_[0]->password;
			$_password = $this->app->out($_password);

			if($password == $_password){
				
				$c_ = $this->m_auth->get_data('pegawai',$where)->result();
				
			$data_session = array(
				'nama_pegawai' => $c_[0]->nama_pegawai,
				'kode_pegawai' => $c_[0]->kode_pegawai,
				'id_role' => $c_[0]->id_role,
				'status' => "login",
				'date_login' => date('Y-m-d H:i:s')
				);
 
			$this->session->set_userdata($data_session);
			$log =json_encode($data_session);
			$_log = array(
				'log'=>$log,
				'state' => 'login',
				'date'=> date('Y-m-d H:i:s')

			);
			$this->m_auth->insert('log',$_log);

			// echo "Login Berhasil";
			
					echo '<script language="javascript">' .
			'alert("Success! Login Berhasil");' .
			'setTimeout(function(){ window.location.href = "'.base_url('dashboard').'"; }, 1000);' .
			'</script>';

			}else{
				// echo "Username & Password Tidak Sesuai";
				echo '<script language="javascript">' .
				'alert("Gagal!Username & Password Tidak Sesuai");' .
				'setTimeout(function(){ window.location.href = "'.base_url().'"; }, 1000);' .
				'</script>';
			}

			
		}else{
			// echo "Username Tidak Di Temukan Atau Akun Nonaktif ";
					echo '<script language="javascript">' .
			'alert("Gagal! Username Tidak Di Temukan Atau Akun Nonaktif");' .
			'setTimeout(function(){ window.location.href = "'.base_url().'"; }, 1000);' .
			'</script>';;

		}
		
	}

	function logout(){
		$dat = $this->session->userdata();
		$log =json_encode($dat);
		$_log = array(
			'log'=>$log,
			'state' => 'logout',
			'date'=> date('Y-m-d H:i:s')

		);
		$this->m_auth->insert('log',$_log);

		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}

	
		
}
