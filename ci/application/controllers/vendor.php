<?php
    class Vendor extends CI_Controller {
    
	   public function index()
     {
	  $data['main_content']= 'vendor';
	  $this->load->model('vendor_model');	  
	  $this->load->library('pagination');
	   $this->load->library('pagination');
	  $this->load->library('table');
	  $config['base_url'] = 'http://localhost/ci/index.php/vendor/index';
	  //$config['total_rows'] = $this->db->get('temp_agency')->num_rows();
	  $config['per_page'] = 10;
	  $config['num_links'] = 15;
	  $config['total_rows'] = $this->vendor_model->get_count();
	  
	  $this->table->set_heading('Name', 'Effective Date', 'Comments','No Of Consultants on Site', 'Action');
	   

	  
	  $this->pagination->initialize($config);
	  //$data['records'] = $this->db->get('temp_agency',$config['per_page'],$this->uri->segment(3));
	  $data['records'] = $this->vendor_model->get_vndr(FALSE,$this->uri->segment(3),$config['per_page']);
	  $this->load->view('includes/template',$data);
	  
      }
		
	public function edit($id){
		$query=$this->db->get_where('vendor',array('id'=>$id));
		$data['records'] = $query->row_array();
		$data['title'] = 'Vendor Edit Details';
		$data['main_content']= 'vndredit';
		$this->load->view('includes/template',$data);

	}
	
	public function update(){
		$name=$this->input->post('name');
		$effdt=$this->input->post('effdt');
		$comments = $this->input->post('comments');
		$id=$this->input->post('id');
		$data=array(
		'name'=>$name,
		'effdt'=>$effdt,
		'comments'=>$comments
		);
		$this->db->where('id',$id);
		$this->db->update('vendor',$data);
		$data['main_content'] = 'Updt_Success';
		$data['msg'] = 'The data has been updated';
		$this->load->view($data['main_content'],$data);
	}

public function delete(){
	    $id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$this->db->delete('vendor');
		$data['msg'] = '<h3>The Vendor has been deleted</h3>'.'\n'.	anchor('vendor/index/','Back to Listing');
		$data['main_content'] = 'Updt_Success';
//		$this->load->view($data['main_content'],$data);
	    $this->load->view('includes/template',$data);
  }
	}
	
?>