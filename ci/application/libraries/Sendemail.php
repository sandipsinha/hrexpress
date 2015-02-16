<?php
class Sendemail{
	var $CI;
	function Sendemail(){
		$this->CI =& get_instance();
	}
	
	function emailsnd(){
		$config=array(
		'protocol'=>'smtp',
		 'smtp_host'=>'mailrelay.polycom.com',
		 'mailtype' =>'html',
		 'smtp_user' =>'austin\hrnotify',
		 'smtp_pass' =>'Sandip',
		 'validate'=>TRUE 
		 );
		 $this->CI->load->library('email');
		 $this->CI->email->initialize($config);
		 $this->CI->email->set_newline("\r\n"); 
		 $this->CI->email->from('hrnotify@polycom.com');
		 $this->CI->email->to('sandip.sinha@polycom.com');
		 $this->CI->email->subject('Just ignore');
		 $this->CI->email->message('Test Email');
		 if ($this->CI->email->send()){
		 	return 'Mail was sent successfully';
		 }
		 else
		 	{
		 	return 'Mail could not be sent';
		 	}
	}
}
