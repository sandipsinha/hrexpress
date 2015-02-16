function ProcessInput() {
	
	var change_ind = 'N';
   var change_str = '';
   var msg1="<p style='color:red' id='content'>Personal and Confidential<br><br>";
   var msgs = '';
   var subject = '';
   var actdesc = '';
   var footmsg='';
   var tempdesc = '';
   switch ($('#actopt').val()){
            case 'hir':
              actdesc = 'Hired  ' ;
              break;
            case 'reh':
              actdesc = 'Rehired  ' ;
              break;
            case 'xfr':
              actdesc =  'Job change  ' ;
              break;
           case 'xtn':
              actdesc = 'Extension  ' ;
              break;
          case 'ter':
              actdesc = 'Terminated  ' ;
              break;
          case 'cnv':
              actdesc = 'Converted to Full Timer' ;
              break;
            }

   switch ($('#ttype').val()){
            case 'C':
              tempdesc = 'Consultant/Vendors' ;
              break;
            case 'F':
              tempdesc = 'Fixed Term Contractors' ;
              break;
            case 'T':
              tempdesc =  'Temporary Contractor' ;
              break;
           case 'W':
              tempdesc = 'Temporary Worker' ;
              break;
          case 'O':
              tempdesc = 'Other' ;
              break;
            }            
            
switch($('#actopt').val())
   	{
   	
		case 'hir':
		    if ($('#empind:checked').val() == 'Y'){
               msgs = msg1+ ' '+$('#name').val()+ ' will be joining Polycom as a Regular Employee.<br>Here are the details you will need to complete your responsibiities.</p>'; 
        			subject = 'New Regular Employee ' + $('#name').val() + ' Start Date: '+ $('#effdt').val();  
        			footmsg = "<span style='color:red' id='content'>*Manager</span> - Please call HR with any questions regarding your new hire. You will need to contact the IT Helpdesk to coordinate the setup and delivery of IT resources for your new hire 5 days prior to their arrival. You can reach the Helpdesk staff at (888)488-9438/International: +1(916)5153169, or dial 4357(H-E-L-P) from an IP telephone during normal business house to assist you with your IT requirements.";
        			          		      	
		      }
		      else
		      { 
        			msgs = msg1+ ' '+$('#name').val()+ ' will be joining Polycom as a Consultant.<br>Here are the details you will need to complete your responsibiities.</p>'; 
        			subject = 'HR Temp Update :'+ $('#name').val() +' -Hire';  
        			footmsg = "<span style='color:red' id='content'>*Manager</span> - It is critical that you inform HR when the consultant-contractor no longer requires access to our systems.                             Please have the new consultant complete and sign the Non-Disclosure Agreement on the first day(see link below).Please retain a copy for your records and forward the original to the local HR department.";
        	   }
        		break;
      case 'ter':
             footmsg = "<span style='color:red' id='content'>*Manager</span> - Please take necessary actions effective COB on the termination date(i.e., voicemail, access to the network, unescorted access to the building, etc.) to ensure terminated employees do not have access to the network, building or company assets.";
             if ($('#empind:checked').val() == 'Y'){
	        			msgs = "<p style='color:red' id='content'>Personal and Confidential</p><br><br>Please be advised that "+ $('#name').val() +"'s employment with Polycom will end on "+$('#it_end_dt').val() +".";
   	     			subject = 'HR Update :'+ $('#name').val() +' -Termination';
   	     	}
   	     	else
   	     	{
   	     			msgs = "<p style='color:red' id='content'>Personal and Confidential</p><br><br>Please be advised that "+ $('#name').val() +"'s employment with Polycom will end on "+$('#it_end_dt').val() +".";
   	     			subject = 'HR Temp Update :'+ $('#name').val() +' -Termination';
   	     	}  
        		break; 
		 default:
		      if ($('#empind:checked').val() == 'Y'){
        				msgs = "<p style='color:red' id='content'>Personal and Confidential<br><br>HR Update For: - "+  $('#name').val() + '</p>';
        				subject = 'HR Update :'+  $('#name').val() +' -Data Change';
        		}
        		else
        			{
        			   msgs = "<p style='color:red' id='content'>Personal and Confidential<br><br>HR Temp Update For: - "+  $('#name').val() + '</p>';
        				subject = 'HR Temp Update :'+  $('#name').val() +' -Data Change';
        			}  
        		break;
		      

      }   
       msgs = msgs +  "<table border='5px' style='border:1px solid green;color:blue;'>";
     msgs = msgs + 'Name :</td><td>' + $('#name').val() + "</td></tr><tr><td>";
     //msgs = msgs + 'Requisition #:</td><td>'+$('#reqnum').val();


    if ($('#actopt').val() == 'hir')
    {
     msgs = msgs +"</td></tr><tr><td>";   
     msgs = msgs +"Start Date:</td><td>"+ $('#effdt').val();
     msgs = msgs +"</td></tr><tr><td>";
     if ($('#empind:checked').val() != 'Y'){
     	msgs = msgs +"End Date:</td><td>"+ $('#it_end_dt').val() +"</td></tr>";
     	//msgs = msgs +"</td></tr><tr><td>";
     }
     else
        {
      	msgs = msgs +"Employee ID:</td><td>"+ $('#empid').val();
     	   msgs = msgs +"</td></tr><tr><td>";
      	}
    }
    else if ($('#actopt').val() == 'ter')
      {
    	//msgs = msgs +"</td></tr><tr><td>";   
     	//msgs = msgs +"Term Date:</td><td>"+ $('#effdt').val();
     	//msgs = msgs +"</td></tr><tr><td>";
     	if ($('#empind:checked').val() != 'Y'){
     		   msgs = msgs+"</td></tr><tr><td>" +"End Date:</td><td>"+ $('#it_end_dt').val() +"</td></tr>";
     		   //msgs = msgs +"</td></tr><tr><td>";
      	}
      	else
      	{  
      	   
      	   msgs = msgs +"</td></tr><tr><td>";   
     	   	msgs = msgs +"End Date:</td><td>"+ $('#effdt').val() +"</td></tr><tr><td>";
      	   msgs = msgs +"Last Working Date:</td><td>"+ $('#it_end_dt').val();
     		 	msgs = msgs +"</td></tr>";
     		 	msgs = msgs +"<tr><td>" + "Employee ID:</td><td>"+ $('#empid').val();
     	   	msgs = msgs +"</td></tr><tr><td>";	
      	}
    	}    
    else
    {
    	msgs = msgs +"</td></tr><tr><td>";   
     	msgs = msgs +"Effective Date: </td><td>"+ $('#effdt').val();
     	msgs = msgs +"</td></tr><tr><td>";
     	if ($('#empind:checked').val() != 'Y'){
     		msgs = msgs +"End Date:</td><td>"+ $('#it_end_dt').val();
     		msgs = msgs +"</td></tr><tr><td>";;
      }
      else
         {
      	msgs = msgs +"</td></tr><tr><td>" +"Employee ID:</td><td>"+ $('#empid').val();
     	   msgs = msgs +"</td></tr><tr><td>";
      	}
    	}
    	if ($('#empind:checked').val() != 'Y'){	
    	    msgs = msgs + "<tr><td> Temp Type: </td><td>"+  tempdesc + "</td></tr><tr><td>";
    	 }
  		if ($('#hr').val() > ' ')
	    {
			msgs = msgs +"<tr><td>"+"HR Contact</td><td>" +  $('#hr').val();
			msgs = msgs +"</td></tr><tr><td>HR Email:</td><td>"+  $('#hrmail').val();
			msgs = msgs +"</td></tr>";
	 	  }
    	if ($('#actopt').val() != 'hir' && $('#actopt').val() != 'ter')
    	  { 
	     	msgs = msgs +"Action Description:</td><td> <span style='color:red'>"+ actdesc +"</span>";
			msgs = msgs +"</td></tr>";
 			}    	

 
    
	 msgs = msgs +"<tr><td>" + 'Business Title:</td><td>'+ $('#btitle').val();
	 msgs = msgs +"</td></tr><tr><td>";
	 msgs = msgs +'Department:</td><td>'+ $('#dept').val();
	 msgs = msgs +"</td></tr><tr><td>";
	 msgs = msgs +'Location:</td><td>'+$('#location').val();
	 msgs = msgs +"</td></tr><tr><td>";
	 msgs = msgs +'Financial Division:</td><td>'+ $('#finance').val();
    msgs = msgs +"</td></tr><tr><td>";
    msgs = msgs +'Legal Entity:</td><td>'+ $('#legal').val();
    msgs = msgs +"</td></tr><tr><td>";
    msgs = msgs +'Manager:</td><td>'+ $('#mgr').val();;
    msgs = msgs +"</td></tr><tr><td>";
    msgs = msgs +'Comments:</td><td>'+ $('#comments').val();
    msgs = msgs +"</td></tr></table>";
//$msg = $msg.'</div>';
    msgs = msgs+'<br><br>'+footmsg;
    var nda=' ';    
    var mgr_hr_mail = $('#mgrmail').val()+','+ $('#hrmail').val();
    var ndanote = ' ';
    if ($('#actopt').val() == 'hir' && $('#empind:checked').val() != 'Y' ) { 
        switch($('#legal').val().substring(0,5))
                  {
            case 'USAOP':
                    nda = 'http://planetpolycom/sites/hr/Documents/North%20America/Documents%20and%20Forms/FORM%20Mutual%20NDA%206.7.12.pdf';
                      break;
             case 'INDSG':
                    nda = 'http://planetpolycom/sites/hr/Documents/APAC/APAC%20Unilateral%20NDA%20-%20210809.doc';
                      break;
              default:
                    nda = 'n';
                      break;
                    }
             }       
  else
            {
                nda = 'n';
            }
            
            
    if (nda != 'n')
    {
	    ndanote = '<a href='+nda+'> NDA Agreement on Planet Polycom. </a>';
   	 msgs = msgs+'<br><br>'+ndanote;
    }
    
     msgs = msgs+'<br><br>'+"<div style='color:blue' id='content' ><strong>Thank you</strong><br><br>The HR Team</div>" ; 

    $.ajax({
            type: "POST",
            url: '../../srccd/dbrtn/adhocmail.php',
            dataType:"json",
            data: ({mail_data: msgs, hrmgrmail:mgr_hr_mail,mailarr:$('#mailist').val(),subject:subject }),
            error: function(msg) {
                $("#errors").html(msg.message);
                $('#errors').show();
                return false;
               
                },
            success: function(msg) {
                // display the errors returned by server side validation (if any)
                 if(msg.success == true){
                $('#success').html('<h4>' + msg.message + '</h4>');
                $('#success').show();
                $('#errors').slideUp();
                return true;
                }
                else {
                    $('#errors').html('<h3>' + msg.message + '</h3>');
                    $('#errors').show();
                    $('#success').slideUp();
                    return false;
                     } 
                 }                  
       });

     return true;
     
   }