
<?php 
 
class M_api extends CI_Model{	
	function config($table,$where){		
        $this->db->limit(1);
		return $this->db->get_where($table,$where);
	}	

	function get_data($table,$where) {
		return $this->db->get_where($table,$where);
	}

	function insert_data($tabel,$data)  {
		return $this->db->insert($tabel,$data);
	}

	function get_menu($table,$where) {
		$this->db->join('menu_role', 'menu_role.id_menu=.menu.id_menu', 'left');
				return $this->db->get_where($table,$where);
	}



}