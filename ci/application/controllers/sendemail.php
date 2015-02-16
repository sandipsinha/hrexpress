<?php
class Sendemail extends CI_Controller {
 function ajax_check() {
 		$config=array(
		'protocol'=>'smtp',
		 'smtp_host'=>'mailrelay.polycom.com',
		 'mailtype' =>'html',
		 'smtp_user' =>'austin\hrnotify',
		 'smtp_pass' =>'Sandip',
		 'validate'=>TRUE 
		 );
		 $this->load->library('email');
		 $this->email->initialize($config);
		 $this->email->set_newline("\r\n"); 
		 $this->email->from('hrnotify@polycom.com');
		 $this->email->to('sandip.sinha@polycom.com');
		 $this->email->subject('Just ignore');
		 $this->email->message('Test Email');
		 if ($this->email->send()){
		 	echo 'Mail was sent successfully';
		 }
		 else
		 	{
		 	echo 'Mail could not be sent';
		 	}
			  
          		 

	}
}