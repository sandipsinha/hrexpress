<?php
    class Lookup extends CI_Controller {
    
	function manager() {
	   $term=$this->input->post('term');
	   $this->load->model('getmgr_model');
	   if(strlen($term) < 2) break;
	      $rows = $this->getmgr_model->GetManager(array('keyword'=>$term));
	 	  $json_array = array();
	 
	 	foreach($rows as $row){
	 	 //array_push($json_array, $rows);
		//array_push($json_array,$row->Name); 
	 		$row_array['label'] = $row->name;
        	$row_array['value'] = $row->emplid;
        	$row_array['data'] = $row->legal;
        	$row_array['id'] = $row->location. ';'. $row->dept. ';'. $row->finance. ';'. $row->emplid;
        	array_push($json_array,$row_array);
	 	}
			echo json_encode($json_array);
		}
	
    function department() {
	   $term=$this->input->post('term');
	   $this->db->select('dept');
		$this->db->distinct();
    	$this->db->like('dept', $term, 'both'); 
		$query=$this->db->get('employees');
		$rows= $query->result();
	 	  $json_array = array();
	 
	 	foreach($rows as $row){
	 	 //array_push($json_array, $rows);
		//array_push($json_array,$row->Name); 
	 		$row_array['label'] = $row->dept;
        	$row_array['value'] = $row->dept;
        	array_push($json_array,$row_array);
	 	}
			echo json_encode($json_array);
		}
	
	function location() {
	   $term=$this->input->post('term');
	   $this->db->select('location');
		$this->db->distinct();
    	$this->db->like('location', $term, 'both'); 
		$query=$this->db->get('employees');
		$rows= $query->result();
	 	  $json_array = array();
	 
	 	foreach($rows as $row){
	 	 //array_push($json_array, $rows);
		//array_push($json_array,$row->Name); 
	 		$row_array['label'] = $row->location;
        	$row_array['value'] = $row->location;
        	array_push($json_array,$row_array);
	 	}
			echo json_encode($json_array);
		}
	
   function legal() {
	   $term=$this->input->post('term');
	   $this->db->select('legal_entity');
		$this->db->distinct();
    	$this->db->like('legal_entity', $term, 'both'); 
		$query=$this->db->get('employees');
		$rows= $query->result();
	 	  $json_array = array();
	 
	 	foreach($rows as $row){
	 	 //array_push($json_array, $rows);
		//array_push($json_array,$row->Name); 
	 		$row_array['label'] = $row->legal_entity;
			$row_array['value'] = $row->legal_entity;
        	array_push($json_array,$row_array);
			
	 	}
			echo json_encode($json_array);
		}
	//Get Financial Information
	function finance() {
	   $term=$this->input->post('term');
	   $this->db->select('fin_desc');
		$this->db->distinct();
    	$this->db->like('fin_desc', $term, 'both'); 
		$query=$this->db->get('finance');
		$rows= $query->result();
	 	  $json_array = array();
	 
	 	foreach($rows as $row){
	 		$row_array['label'] = $row->fin_desc;
			$row_array['value'] = $row->fin_desc;
        	array_push($json_array,$row_array);
			
	 	}
			echo json_encode($json_array);
		}
	
//Get Financial Organization
	function finorg() {
	   $term=$this->input->post('term');
	   $this->db->select('fin_org');
		$this->db->distinct();
    	$this->db->like('fin_org', $term, 'both'); 
		$query=$this->db->get('finance_org');
		$rows= $query->result();
	 	  $json_array = array();
	 
	 	foreach($rows as $row){
	 		$row_array['label'] = $row->fin_org;
			$row_array['value'] = $row->fin_org;
        	array_push($json_array,$row_array);
			
	 	}
			echo json_encode($json_array);
		}
	
	//Get Vendor Data
	function vendor() {
	   $term=$this->input->post('term');
	   $this->db->select('id,name');
		$this->db->distinct();
    	$this->db->like('name', $term, 'both'); 
		$query=$this->db->get('vendor');
		$rows= $query->result();
	 	  $json_array = array();
	 
	 	foreach($rows as $row){
	 		$row_array['label'] = $row->name;
			$row_array['value'] = $row->id;
			array_push($json_array,$row_array);
	 	}
			echo json_encode($json_array);
		}
	
	//Get HR Data
	function gethr() {
	   $term=$this->input->post('term');
	   $this->db->select('emplid,name');
		$this->db->distinct();
    	$this->db->like('name', $term, 'both'); 
		$query=$this->db->get('emp_current_vw');
		$rows= $query->result();
	 	  $json_array = array();
	 
	 	foreach($rows as $row){
	 		$row_array['label'] = $row->name;
			$row_array['value'] = $row->emplid;
			array_push($json_array,$row_array);
	 	}
			echo json_encode($json_array);
		}
	
	}
	
?>