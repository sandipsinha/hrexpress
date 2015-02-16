<?php
    function formatmsg($options = array()){
    	$msgbody = '<p color="red">'. 'Personal and Confidential' . '</p>';
		
    	$msgbody .= '<p color="red">'. $options['first_name'].', '.$options['last_name'].' will be joining Polycom 
    	as a Consultants/Vendors\. Here are the details you need to complete your responsibilities\.' . '</p>';
		$msgbody .= '<p><table border="4" bordercolor="#660000">';
		$msgbody .= '<tr><td>'.'Name:'.'</td><td>'.$options['first_name'].', '.$options['last_name'].'</td></tr>';
		$msgbody .= '<tr><td>'.'Requisition Number:'.'</td><td>'.$options['req_num'].'</td></tr>';
		$msgbody .= '<tr><td>'.'Start Date:'.'</td><td>'.$options['effdt'].'</td></tr>';
		$msgbody .= '<tr><td>'.'Projected End Date:'.'</td><td>'.$options['it_end_date'].'</td></tr>';
		$msgbody .= '<tr><td>'.'HR Contact:'.'</td><td>'.$options['hr_contact'].'</td></tr>';
		$msgbody .= '<tr><td>'.'Business Title:'.'</td><td>'.$options['business_title'].'</td></tr>';
		$msgbody .= '<tr><td>'.'Department:'.'</td><td>'.$options['dept'].'</td></tr>';
		$msgbody .= '<tr><td>'.'Location:'.'</td><td>'.$options['it_end_date'].'</td></tr>';
		$msgbody .= '<tr><td>'.'Financial Division:'.'</td><td>'.$options['finance'].'</td></tr>';
		$msgbody .= '<tr><td>'.'Legal Entity:'.'</td><td>'.$options['legal_entity'].'</td></tr>';
		$msgbody .= '<tr><td>'.'Manager:'.'</td><td>'.$options['supervisor'].'</td></tr>';
		$msgbody .= '<tr><td>'.'Comments:'.'</td><td>'.$options['comments'].'</td></tr>';
		$msgbody .= '</table><br><br><p>';
		$msgbody .= '<span color="red">*Manager</span> It is critical that you inform HR when the 
		consultant\/contractor no longer requires access to our systems\.Please have the new consultant complete
        and sign the Non-Disclosure Agreement on the first day (see link below)\. Please retain a copy for 
        your records and forward the original to the local HR department\.</p>';
		if (preg_match('/^USA/',$options['legal_entity'])){
			$msgbody += '<p>'.anchor('http://go.polycom.com', 'NDA Agreement On Planet Polycom').'</p>';
		}
		$msgbody .='<br> Thank You';
		
		return $msgbody ;
		
    }
