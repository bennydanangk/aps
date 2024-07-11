<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends MY_Controller {


	function __construct(){
		parent::__construct();	
		$this->load->library('App');	
		$this->load->model('../../Api/models/m_api');
	}

	public function index()
	{
		echo "Hi...";
	}
	function config() {
		$where = array(
			'id_set' => '1'
		);
	return	$data = $this->m_api->config('set_app',$where)->result();
		
	

	}





	
}
