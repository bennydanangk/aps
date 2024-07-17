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
		echo "Hi...<br> <hr>";
		echo "1.Config <br>";
		echo "2.Menu <br>";
	}

	function config() {
		$where = array(
			'id_set' => '1'
		);
	return	$data = $this->m_api->config('set_app',$where)->result();
		}

		function menu($id_role)  {
			// Get menu Parent
			$where = array(
				'state' => 'aktif',
				'role' => 'parent',
				'state_role' => 'aktif',
				'id_role' => $id_role

			);
			$menu_parent = $this->m_api->get_menu('menu',$where)->result();
		
		
			$menu ='';
		  foreach ($menu_parent as $k) {
			$menu .='<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon '.$k->icon.'"></i>
              <p>
                '.$k->nama_menu.'
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview"> ';

			$where = array(
				'state' => 'aktif',
				'role' => 'child',
				'id_menu_parent' => $k->id_menu,
				'id_role' => $id_role
			);
			$menu_child = $this->m_api->get_menu('menu',$where)->result();

		
			foreach ($menu_child as $i) {
				$menu .= '  <li class="nav-item">
                <a href="'.base_url($i->url).'" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>'.$i->nama_menu.'</p>
                </a>
              </li>';
			}
			

			$menu .='</ul>
          </li>';
		  }
		return $menu;

		}

		
function loop_menu() {
	
	$where = array(
		'state' => 'aktif',
	);

	$menu = $this->m_api->get_data('menu',$where)->result();
	foreach ($menu as $i) {
		$data = array(
			'id_menu' => $i->id_menu,
			'id_role'=> '2',
			'state' => 'aktif'
		);

$this->m_api->insert_data('menu_role',$data);
	}
	
}


	
}
