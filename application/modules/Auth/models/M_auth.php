
<?php 
 
class M_auth extends CI_Model{	
	function get_data($table,$where){		
     	return $this->db->get_where($table,$where);
	}	
	function insert($table,$data)  {
		return $this->db->insert($table,$data);
	}
}