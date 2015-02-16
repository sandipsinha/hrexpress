<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Welcome to HREXPRESS!</title>
<link rel="stylesheet" type="text/css" href="/template/view.css" media="all">
<link rel="stylesheet" type="text/css" href="/template/main.menu.css">
<!--<link rel="stylesheet" type="text/css" href="/template/jquery.autocomplete.css">-->

<?php 
$name_arr = explode(',',$_SERVER ['AUTHENTICATE_DISPLAYNAME'] );
$welcome_name = 'Welcome ' .$_SERVER ['AUTHENTICATE_DISPLAYNAME']. '!';
echo '<h3>'. $welcome_name . '</h3>';
require_once 'dataconn/config.php';
session_start();
require_once "Mail.php";
if ($_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'] > ' '){
$_SESSION['emplid'] = $_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'];
$sql = "select a.dept,x.hr,x.manager,x.hris,a.busn_phone,a.busn_email from employees a left join profile x on a.emplid = x.emplid where a.emplid = '". $_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'] .
"'  and a.effdt=(select max(b.effdt) from employees b where a.emplid = b.emplid) and a.effseq =(select max(b.effseq) from employees b where a.emplid = b.emplid and a.effdt = b.effdt)  ";

}
else
{
$sql = "select a.dept,a.busn_phone,a.busn_email  from consultants a where a.busn_email = '". $_SERVER ['AUTHENTICATE_MAIL']  ."' and a.effdt=(select max(b.effdt) from consultants b
where a.id = b.id)";
}

$temp_tag = 'ssinha.polycom.com/Person.aspx?accountname='. $_SERVER ['PHP_AUTH_USER'];


$rsq = mysql_query($sql);
$_SESSION['hr'] = $row['hr'];
    $row_ind = '';
if (mysql_numrows($rsq) == 0){
    $row_ind = 'N';
    $from = 'HR Notify <hrnotify@polycom.com>';
    $to = 'sandip.sinha@polycom.com';

    $host = "mailrelay.polycom.com";
    $username = 'Austin\hrnotify';
    $password = 'P0lyc0m1';
    $subject = "Unsuccessfull login attempt";
    $msg = 'Registered email: '. $_SERVER ['AUTHENTICATE_MAIL'] . ' And  Registered Login: ' .  $_SERVER ['PHP_AUTH_USER'];
    $reply = "hrnotify@polycom.com";
    $content = "text/html;charset=ISO-8859-1\r\n";
    $headers = array ('From' => $from, 'To' => $to,'Subject' => $subject,'Reply-To'=>$reply,'Content-Type'=>$content);
    $smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => true, 'username' => $username,'password' => $password));
    $mail = $smtp->send($to, $headers, $msg);
    }
   else 
 {   

if (!$rsq) {
    die(mysql_error());
}

$row = mysql_fetch_assoc($rsq);
if (!$row) {
    die(mysql_error());
}
else
{
    $row_ind = 'Y';
  }  
}
?>
<script type="text/javascript" src="/scripts/view.js"></script>
<script src="/scripts/menu.nav.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
<link rel="stylesheet" type="text/css" href="/template/menu.style.css">
<script type="text/javascript">
 
$().ready(function() {
      $("#eeid").attr("disabled",true);
      if ($("#eeid").val() == '')
       {
        $("#li_1").slideUp();
        $("#li_5").slideUp();
        $("#navMain").slideUp();
        $("#tel").attr("disabled",false);
         $("#email").attr("disabled",true);
         $("#dept").attr("disabled",true);
         /*$("#van-one").slideUp(); */
        }
    else
       {   
        $("#buttons").slideUp();
         $("#tel").attr("disabled",true);
         $("#email").attr("disabled",true);
         $("#pend").attr("disabled",true);
         $("#dept").attr("disabled",true);
         }

    //alert('The value is ' + $("#hr").val());

      //If the user is not from HR hide the manu    
     if  ($("#hr").val() != 'Y')   
        {         
          $("#navMain").slideUp(); 
          }
          //If the user is not from HRIS hide the file Upload Menu
     if  ($("#hris").val() != 'Y')   
        {         
          $("#flupld").slideUp(); 
          }
         //If the user is not a Manager hide the Pending items manu         
         if  ($("#mgr").val() != 'Y')   
        {     
          $("#li_5").slideUp(); 
          }
      
     if ($("#row_ind").val()  == 'Y')
        {         
          $("#exception").slideUp(); 
          }
         else 
         {         
          $("#eedtl").slideUp(); 
          }
        
  var change_str = ''; 
  var change_ind = '';
  var change_num = 0;
  $('#tel').change(function(){ 
	   if (change_ind == 'Y') {
	    	change_str= change_str + ", busn_phone= '"+ $('#tel').val() + "'" ;
	   }
	   else
	   {
	     change_ind = 'Y';
	     change_str = " busn_phone= '"+ $('#tel').val() + "'" ;
	   }
       change_num +=1;
	});
    
    /*$('#email').change(function(){ 
	   if (change_ind == 'Y') {
	    	change_str= change_str + ", busn_email= "+ $('#email').val() ;
	   }
	   else
	   {
	     change_ind = 'Y';
	     change_str = "busn_email= "+ $('#email').val() ;
	   }
       change_num +=1;
	})*/
  //*****************
      $('form').submit(function(e) {
         e.preventDefault();
        var change_ind = 'N';
        change_num =0;

        $.ajax({
            type: "POST",
            url: '/srccd/dbrtn/tempupdt.php',
            dataType:"json",
            data: ({insertdata: change_str,tempid:$("#email_h").val()}),
            error: function(msg) {
                $("#errors").html(msg.message);
                
            },
            success: function(msg) {
                // display the errors returned by server side validation (if any)
                 if(msg.success == true){
                $('#success').html('<h3>' + msg.message + '</h3>');
                $('#success').show();
                $('#errors').slideUp();
                }
                else {
                    $('#errors').html('<h3>' + msg.message + '</h3>');
                    $('#errors').show();
                    $('#success').slideUp();
                }
            }
        });
        });
  //*************
    
})         
        
  </script>  

</head>

<body id="main_body" >
<h2><a>Welcome to HR Express!</a></h2>
<div  class="wrapper_div">
<div class="cell_div">
<div id='navMain'>
<!--<ul id="van-one" class="van">-->
<ul>
<h4> HR Temp Space</h4>
<img src='/images/line.png'/ alt=”line” class=”navMainLine”>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/read_ee.php" style="text-decoration:none">Home Page</a>
</li>
<br><br>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/eegrid.php" style="text-decoration:none">Data Grid</a>
</li>
<br>
<br>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/ee_info.php" style="text-decoration:none">Hire </a>
</li>
<br>
<br>
<li id='flupld'>
<a href="http://hrexpress.polycom.com/srccd/other/file_upload.php" style="text-decoration:none">File Upload</a>
</li>
</ul>
	</div>
 </div>   

<div class="cell_div">
	<div  id="form_container">
	<!--<img id="top" src="/images/bottom.png" width="10px" alt="">-->
    <hr width = "100%">
	
	
		
          <p id='exception'>
    		<?php echo 'Hello '. $name_arr[1].'. Unfortunately we could not find the right entry for you in Active Directory. A mail has been sent to HR. You will receive a email from them soon notifying you about the correction';?> 
          </p> 
		<form id="eedtl" class="appnitro"  method="post" action="">
					<div class="form_description">
			<h2>Your details are as below</h2>
			
 					
			<ul >
			
					
	 
		<p>
			<?php echo 'Hello '. $name_arr[1].'. Listed below are your job details. Please review and let HR know if any of them are outdated or not showing the right information'; 
                     ?>
		</p> 
       <!--<img src="http://mysite.polycom.com/Person.aspx?accountname=ssinha" alt='Error' />-->
        <input type="hidden" id="email_h" value="<?php echo $_SERVER ['AUTHENTICATE_MAIL']  ;?>"/>
        <!--<input type="hidden" id="email_h" value="<?php echo 'vikram.padisala@polycom.com' ;?>"/>-->
		<li id="li_1" >
    		<label  for="eeid">Employee id</label>
        <div>            
			<input id="eeid" name="eeid" id="eeid" class="element text medium" type="text"  value="<?php echo $_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'] ;?>"/> 
            <!--<input id="eeid" name="eeid" id="eeid" class="element text medium" type="text"  />-->
		</div> 
		</li>		<li id="li_2" >
		<label  for="dept">Department </label>
		<div>
			<input id="dept" name="dept" id="dept" class="element text medium" type="text"  value="<?php echo $row['dept'] ;?>"  /> 
		</div> 
		</li>		<li id="li_3" >
        		<label  for="email">Business Email </label>
		<div>
			<input id="email" name="email"  class="element text medium" type="text"  value="<?php echo $_SERVER ['AUTHENTICATE_MAIL'] ;?>"  /> 
            <!--<input id="email" name="email"  class="element text medium" type="text" value="<?php echo 'vikram.padisala@polycom.com' ;?>"  />-->
		</div>
		
		</li>	<li id="li_4" >
        		<label  for="tel">Business Telephone </label>
		<div>
			<input id="tel"  class="element text medium" type="text" value="<?php echo $row['busn_phone'] ;?>"   /> 
		</div>
		
		</li>
        
        <li id="li_5" ><label   for="pend">Pending items for approval </label>
		<div>
			<input name="pend" id="pend" class="element text medium" type="text"  /> 
		</div> 
 
		</li>
			
				<li id="buttons">
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		<div id="footer">
	</div>		
	<!--<img id="bottom" src="./images/bottom.png" alt="">-->
    <hr width = "100%">
    <input type="hidden" id="row_ind" value="<?php echo $row_ind  ;?>"/>
    <input type="hidden" id="hr" value="<?php echo $row['hr']  ;?>"/>
    <input type="hidden" id="hris" value="<?php echo $row['hris']  ;?>"/>
    <input type="hidden" id="mgr" value="<?php echo $row['manager']  ;?>"/>
    <div id='msg'></div>
<div id='success'></div>
</form>
<div id='errors'></div>
</div>
</div>
</body>
</html>