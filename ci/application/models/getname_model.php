<?php
class Getname_model extends CI_Model
{
    function GetAutocomplete($options = array())
    {
	    $this->db->select('Name,id,Emp_ind');
	    $this->db->like('Name', $options['keyword'], 'both');
   		$query = $this->db->get('get_name_vw');
		return $query->result();
		//return $query->row_array();
    }
}

?>