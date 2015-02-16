<?php
class Vendor_model extends CI_Model {
	 function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	
	function get_vndr($id = FALSE,$skip,$limit)
{
	if ($id === FALSE)
	{
		//$query = $this->db->get('temp_agency');
	$sql = "select a.id,a.name,a.effdt,a.comments,count(b.id) Count from
	vendor a join consultants b on a.id = b.vendor_id group by a.name,a.comments,a.effdt limit ?,?";
	$query = $this->db->query($sql,array(10,$limit));
	return $query->result_array();
	}
	$sql = "select a.id,a.name,a.effdt,a.comments,count(b.id) Count from
	vendor a join consultants b on a.id = b.vendor_id where a.id=? group by a.name,a.comments,a.effdt limit ?,?";
	$query = $this->db->query($sql, array($id,10,$limit));
	return $query->row_array();
}

 function get_count(){
	$sql = "select count(distinct a.name) counts from vendor a join consultants b on a.id = b.vendor_id where a.id is not null";
	$query = $this->db->query($sql);
	$row= $query->row();
	return $row->counts;
}
}
	