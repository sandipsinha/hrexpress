<?php
class Getmgr_model extends CI_Model
{
    function GetManager($options = array())
    {
	    $this->db->select('name,emplid,vp,dept,location,legal_entity legal,division finance');
	    $this->db->like('name', $options['keyword'], 'both');
   		$query = $this->db->get('emp_current_vw');
		return $query->result();
		//return $query->row_array();
    }
}

?>