
<?php 
 
class M_api extends CI_Model{	
	function config($table,$where){		
        $this->db->limit(10);
		return $this->db->get_where($table,$where);
	}	
}