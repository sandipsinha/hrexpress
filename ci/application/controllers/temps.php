<?php
    class Temps extends CI_Controller {
    function __construct()
	   {
 		parent::__construct();
 		$this->load->library('form_validation');
 		}
 
	   public function index()
     {
     	$data['title'] = 'Lookup Temps/Regular';
		$data['main_content']= 'ee_inq';
		$this->load->view('includes/template',$data);
	 }
	 
public function lookup(){
	 $this->load->model('getname_model');
	 $term=$this->input->post('term');
	 if(strlen($term) < 2) break;
	 $rows = $this->getname_model->GetAutocomplete(array('keyword'=>$term));
	 $json_array = array();
	 
	 foreach($rows as $row){
	 	 //array_push($json_array, $rows);
		//array_push($json_array,$row->Name); 
	 	$row_array['label'] = $row->Name;
        $row_array['value'] = $row->Name;
        $row_array['data'] = $row->Emp_ind;
        $row_array['id'] = $row->id;
		
        
        array_push($json_array,$row_array);
	 }
	      
		echo json_encode($json_array);
		}
   public function disp($id,$empind){
   	   	if ($empind == 'N'){
        $this->db->select('concat(last_name,", ",first_name) Name ,action_type ,effdt, classification,location,dept,financial_org,id',FALSE); 
		$this->db->order_by("effdt", "desc");   	   		
   		$query=$this->db->get_where('consultants',array('id'=>$id));
		$data['records'] = $query->result_array();
		$data['title'] = 'Job Details Lookup';
		$data['main_content']= 'tempdisp';
	    $this->load->library('table');
	    $this->table->set_heading('Name','Action Type', 'Effective Date', 'Classification','Location','Department','Financial Org','Action');
		$this->load->view('includes/template',$data);
   	}
   }
	public function edit($id=FALSE){
		$this->load->library('form_validation');
		
 		if($id <> FALSE){
		$query = $this->db->get_where('temp_360_vw', array('id' => $id));
		$records['data'] = $query->row_array();
		$query1 = $this->db->get('mailist');
        if($query1->num_rows() > 0){
        	
			$records['maildata'] = $query1->result_array();
        }
		$records['title'] = 'Temp Edit Details Page';
		$records['mode'] = 'e';
		}
		else
		{
			$records['title'] = 'Add Temp Edit Details Page';
			$records['mode'] = 'a';
			$records['data'] = '';
		}
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$records['main_content']= 'tempedit';
		$this->load->view('includes/addtemplate',$records);
	}
	

		
	
 function ajax_check() {
 	if ($this->input->post("ajax") == 1){
 		 $this->form_validation->set_rules('fname', 'First Name', 'xss_clean|required');
		 $this->form_validation->set_rules('lname', 'Last name', 'xss_clean|required');
		 $this->form_validation->set_rules('wemail', 'Email', 'xss_clean|required|valid_email');
		 $this->form_validation->set_rules('manager', 'Manager', 'xss_clean|required');
	     $this->form_validation->set_rules('dept', 'Department', 'xss_clean|required');
		 $this->form_validation->set_rules('legal', 'Legal Entity', 'xss_clean|required');
		 $this->form_validation->set_rules('location', 'Location', 'xss_clean|required');
		 $this->form_validation->set_rules('finance', 'Finance', 'xss_clean|required');
		 $this->form_validation->set_rules('finorg', 'Financial Organization', 'xss_clean|required');
		 $this->form_validation->set_rules('empid', 'Employee ID', 'xss_clean|callback__check_emplid');
		 $this->form_validation->set_rules('hr', 'HR Contact', 'xss_clean|required');
		 $this->form_validation->set_rules('vndrid', 'Vendor Name', 'xss_clean|required');
		 if ($this->form_validation->run() == FALSE)
		 {
		 	// Set the status header so $.ajax() recognizes it as an error
    		$this->output->set_status_header(400);

    		// The error string will be available to the $.ajax() error
    		// function in the javascript below as data.responseText
    		echo validation_errors();

    	exit();		 	
 		}
		 else {
			 $data=array('reason'=>$this->input->post("rsntype"),
			 'last_name'=>$this->input->post("lname"),
			 'first_name'=>$this->input->post("fname"),
			 'type'=>$this->input->post("ttype"),
			 'classification'=>$this->input->post("classi"),
			 'req_num'=>$this->input->post("reqnum"),
			 'business_title'=>$this->input->post("btitle"),
			 'location'=>$this->input->post("location"),
              'dept'=>$this->input->post("dept"),
              'emplid'=>$this->input->post("empid"),
              'busn_email'=>$this->input->post("wemail"),
              'supervisor'=>$this->input->post("mgrid"),
              'it_end_date'=>$this->input->post("it_end_dt"),
              'finance'=>$this->input->post("finance"),
              'financial_org'=>$this->input->post("finorg"),
              'hr_contact'=>$this->input->post("hr"),
              'Vendor_id'=>$this->input->post("vndrid"),
              'busn_phone'=>$this->input->post("wphone"),
              'legal_entity'=>$this->input->post("legal"),
              'comments'=>$this->input->post("comments"));
			  if ($this->input->post("action")=='upd')
			    {
			  	$wherearray=array('id'=>$this->input->post("id"),
				                  'effdt'=>$this->input->post("effdt"),
				                  'action_type'=>$this->input->post("actopt"));
				$this->db->update('consultants', $data,$wherearray);	
				$result = '<p class=\'success\'>'.'The Consultant data has been updated'.'</p>';
			  	}
				else 
				{if ($this->input->post("action")=='hir')
			   		{
					$data['effdt'] = $this->input->post("effdt");
					$data['action_type'] = 'hir';
					$this->db->insert('consultants', $data);
					$result = '<p class=\'success\'>'.'The New Consultant data has been successfully added'.'</p>';
					}
				else {
					$data['effdt'] = $this->input->post("effdt");
					$data['action_type'] = $this->input->post("actopt");
					$data['id'] = $this->input->post("id");
					$this->db->insert('consultants', $data);	
					$result = '<p class=\'success\'>'.'The Consultant data has been updated'.'</p>';
					  }	
				}
				if ($this->input->post("mailsel") == 'Y'){
					$this->load->library('SendEmail');
					$mailrec = $this->input->post("items");
					if ($mailrec)
					   {
					   	$data['effdt'] = $this->input->post("effdt");
					   	$this->load->helper('mailformat');
						$msgbody = formatmsg($data);
						$mailarr = implode(",", $mailrec);
						$result = $this->sendemail->emailsnd($mailarr,$msgbody);
						}
					else
						{
				       $result = 'No recipients selected';
						}
				}
				echo $result;
          		$this->output->set_status_header(200);
   				$this->output->set_header('Content-type: application/json');
  				exit();	
			  
		 		}
	
	}
	}
function _check_email() {
   $emplid = $this->input->post("empid");
   $actopt = $this->input->post("actopt");
   if($actopt=='cnv' && $emplid=='' ) {
      $this->form_validation->set_message('_check_emplid', 'Please provide a valid Employee ID for this action');
      return FALSE;
   }
   return TRUE;
}

function _check_emplid() {
   $emplid = $this->input->post("empid");
   $actopt = $this->input->post("actopt");
   if($actopt=='cnv' && $emplid=='' ) {
      $this->form_validation->set_message('_check_emplid', 'Please provide a valid Employee ID for this action');
      return FALSE;
   }
   return TRUE;
}


public function delete(){
	    $id=$this->uri->segment(3);
		$effdt=$this->uri->segment(4);
		$delql = "delete from Consultants where id=".$id." And effdt = '".$effdt."'";
		$this->db->query($delql);
		redirect('/temps/disp'.'/'.$id.'/'.'N', 'refresh');
  }
	

	}


?>