<?php
      class Home extends CI_Controller {
    
	   public function index()
     {
     	//$this->load->library('session');
		$this->session->set_userdata('adname',$_SERVER ['AUTHENTICATE_DISPLAYNAME']);
		if ($_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'] > ' '){
			$this->session->set_userdata('emplid', $_SERVER ['AUTHENTICATE_EMPLOYEENUMBER']);
			$this->session->set_userdata('email', $_SERVER ['AUTHENTICATE_MAIL']);
       $homesql = "select a.dept,x.hr,x.manager,x.hris,a.busn_phone,a.busn_email from employees a 
                    left join profile x on a.emplid = x.emplid where 
                     a.emplid = '". $_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'] .
					"'  and a.effdt=(select max(b.effdt) from employees b where a.emplid = b.emplid) 
					and a.effseq =(select max(b.effseq) from employees b where a.emplid = b.emplid 
					and a.effdt = b.effdt)  ";
	    $this->session->set_userdata('empind','Y');
		}
		else {
			$homesql = "select a.id,a.dept,a.Busn_Phone,a.Work_Email,'N' hr,'N' hris  from temp_360_vw a where 
			a.busn_email = '". $_SERVER ['AUTHENTICATE_MAIL']  ."'";
			$this->session->set_userdata('email', $_SERVER ['AUTHENTICATE_MAIL']);
			$this->session->set_userdata('empind','N');
		}
		$query=$this->db->query($homesql);
		$data['$homepg_msg'] = 'Listed below are your job details. Please review and let HR know if any of them are 
		 outdated or not showing the right information.'; 
		if ($query->num_rows() > 0 && $this->session->userdata('empind') == 'N')
		{
			$data['$homepg_msg'] = 'Unfortunately we could not locate your profile in the database\.A mail has 
			been sent to HR \and you should expect to hear from them soon'; 
		}
			
		$data['title'] = 'Welcome ' .$_SERVER ['AUTHENTICATE_DISPLAYNAME']. '!';
		$row = $query->row();
		$data['records'] = $query->row();
		$this->session->set_userdata('hr',$row->hr);
		$data['main_content']= 'homepg';
		$this->load->view('includes/template',$data);
	 }

function tempss() {
 	if($this->input->post('ajax') == '1') {
		$this->form_validation->set_rules('wphone', 'Phone Number', 'trim|required|xss_clean');
	
 	if($this->form_validation->run() == FALSE) {
 		$this->output->set_status_header(400);
		echo validation_errors();
     	exit();

 		} 
 	else 
 	    {
 	    $data=array(
			'busn_phone'=>$this->input->post('wphone')
			);

		$wherestr=array('id'=>$this->session->userdata('id'));
		$this->db->update('consultants', $data, $wherestr);
		$result = '<p class=\'success\'>The data has been successfully updated</p>';

		
		$this->output->set_status_header(200);
    	$this->output->set_header('Content-type: application/json');
		echo $result;
  		  exit();
		}
		}	 
	 
	  }
}
     	