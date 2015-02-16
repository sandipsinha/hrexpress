<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><head>
<title>HR Temp Tool - Add Data</title>
<h3>HR Temp Tool - Maintain Vendors</h3>
<!--<script type="text/javascript" src="../../scripts/jquery.js"></script>
<script type='text/javascript' src='../../scripts/jquery.autocomplete.js'></script>
<script type="text/javascript" src='../../scripts/jquery.maskedinput.js' ></script>-->
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../template/jquery.autocomplete.css"  />
<link rel="stylesheet" type="text/css" href="../../template/menu.style.css">
<!--
-->
<!--<link rel="stylesheet" type="text/css" href="gldatepicker/css/default.css">
<link rel="stylesheet" type="text/css" href="../../template/jquery.autocomplete.css"  />
<script src="../../scripts/gldatepicker/js/glDatePicker.js" type="text/javascript"></script>
<script type="text/javascript" src="../../scripts/jquery.vndreditinput.js"></script>-->

<script type="text/javascript">
$().ready(function() {
      //$("#tel").mask("(999) 999-9999");
      //$('#effdt').mask('mm-dd-yyyy');
      
      //$('#effdt').glDatePicker({cssname:"default",allowOld:true}); 
      $('#effdt').datepicker();
            //This is the autocomplete script to populate the Finance Org field - Begin

              
      var sqlenddt ;
            
            
    //This is the autocompleter script to populate the Department field
        var change_ind = '';
        var change_num = 0;

       
       var max1 = $("label[for='tel']").width();

      $("label[for='vendor']").width(max1);
        $("label[for='tel']").width(max1);
        $("label[for='brate']").width(max1);
        $("label[for='hrate']").width(max1);
        $("label[for='effdt']").width(max1);
        $("label[for='Contact']").width(max1);
        $("label[for='email']").width(max1);
        
	$('#vendor').change(function(){ 
    if (change_ind == 'Y') {
	   	insertstr = insertstr + ", Vendor_name = '"+ $('#vendor').val() + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "Vendor_name = '"+ $('#vendor').val() + "'";
	   }
       change_num +=1;
        
	})
    
    $('#Contact').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", Contact_name = '"+ $('#Contact').val() + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "Contact_name = '"+ $('#Contact').val() + "'";
	   }
       change_num +=1;
	})
    $('#brate').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", Bill_Rate = "+ $('#brate').val() ;
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "Bill_Rate = "+ $('#brate').val() ;
	   }
       change_num +=1;
	})
    $('#hrate').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", Hourly_Rate = "+ $('#hrate').val() ;
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "Hourly_Rate = "+ $('#hrate').val() ;
	   }
       change_num +=1;
	})
    $('#tel').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", Contact_tel = '"+ $('#tel').val() + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "Contact_tel = '"+ $('#tel').val() + "'";
	   }
       change_num +=1;
	})
	
	$('#email').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", Contact_email = '"+ $('#email').val() + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "Contact_email = '"+ $('#email').val() + "'";
	   }
       change_num +=1;
	})
    
    // Effectibve date change funciton
  $('#effdt').change(function(){ 
      sqlenddt =  "DATE(STR_TO_DATE('" + $("#effdt").val() + "','%m/%d/%Y'))";
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", effdt= " +  sqlenddt  ;
	   }
	   else
	   {
	     change_ind = 'Y';
	     //insertstr = "effdt= '"+ $('#effdt').val() + "'";
         insertstr = "effdt= " + sqlenddt  ;
	   }
       change_num +=1;
	})
    
    //Now begins the edit function_exists
    $('form[name="vndr_form"]').submit(function(e) {
        e.preventDefault();
        var change_ind = 'N';
        var change_str = '';
     
    if ($("#vendor").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Vendor !</p>');
            $("#vendor").focus();
            $("#errors").show();
            return false;
        }
                // validate the 'Effective Date' field
        if ($("#effdt").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Effective Date !</p>');
            //$("#effdt").focus();
            $("#errors").show();
            return false;
        }
            // validate the 'Contact' field
        if ($("#Contact").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Contact !</p>');
            $("#Contact").focus();
            $("#errors").show();
            return false;
        }

    // validate the 'Bill Rate' field
        if ($("#brate").val() == 0) {
            $("#errors").html('<p class="error">Enter a non zero Rate !</p>');
            $("#brate").focus();
            $("#errors").show();
            return false;
        }
                    
            // validate the 'Hourly Rate' field
        if ($("#hrate").val() == 0) {
            $("#errors").html('<p class="error">Enter a non zero Rate !</p>');
            $("#hrate").focus();
            $("#errors").show();
            return false;
        }
                    
        // validate the 'Legal Entity' field
        if ($("#tel").val() == "" && $("#email").val() == "" ) {
            $("#errors").html('<p class="error">Enter at least a phone # or a emailid for the contact !</p>');
            $("#tel").focus();
            $("#errors").show();
            return false;
        }  
        // validate the 'email' field
        if ($("#email").val().indexOf("@") == -1 && $("#email").val() != "") {
            $("#errors").html('<p class="error">Enter a valid email address!</p>');
            $("#wemail").focus();
            $("#errors").show();
            return false;
        }
         

        
 
        var actionstr = 'upd';
       // validate the 'effective date' field
        
            
 
           if (change_num >= 4 && )
            {
               insertstr = "(" + $("#tempid").val()+ ",'" +  $("#vendor").val() + "','" + $("#Contact").val() + "','" + sqlenddt + "'," + $("#brate").val() + $("#hrate").val()+",'" + $("#tel").val() + "','"+$("#email").val()+ "')";
               actionstr = 'add';
             }  
             
        alert('the value is ' + insertstr + 'Action ' + actionstr );
        $.ajax({
            type: "POST",
            url: '../../srccd/dbrtn/vndrupdt.php',
            dataType:"json",
            data: ({insertdata: insertstr,action:actionstr}),
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
$('#srch').click(function(){
     document.location = '../../srccd/dbrtn/read_ee.php';
         });
 $('#eeprofile').click(function(){
     document.location = '../../srccd/dbrtn/ee_info.php';
         });        
    })
</script>
<?php
 session_start();
 $tempid = $_SESSION['id'];
  require_once "../../dataconn/config.php";
 $sql_temp = "select concat(a.first_name, '  ',a.last_name)  Name  from consultants a where a.id = ". $tempid  ." and a.effdt=(select max(b.effdt) from consultants b
where a.id = b.id)";
 $rsq_t = mysql_query($sql_temp);
if (!$rsq_t) {
    die("Query to show fields from the table failed");
    exit();
}
$row_t = mysql_fetch_assoc($rsq_t);
?>
<h3><?php echo 'Maintain Vendor Details for '. $row_t['Name'] ;   ?></h3>

</head>
<body>
<?php


   
if ($tempid > ' '){
$sql = "select a.Vendor_name Vendor, a.Contact_name Contact, date_format(a.effdt,'%m/%d/%Y') effdt,a.Hourly_Rate,a.Bill_Rate,a.Contact_tel tel,  a.Contact_email email from temp_agency a where a.id = ". $tempid .
" and a.effdt=(select max(b.effdt) from temp_agency b where a.id = b.id)";

 $rsq = mysql_query($sql);
if (!$rsq) {
    die("Query to show fields from table failed");
}
$row = mysql_fetch_assoc($rsq);

}
?>


<ul id="van-one" class="van">
<li>

<a href="read_ee.php">HR Temp Tracking Area</a>
</li>
<li>
<a href="http://hrexpress/srccd/dbrtn/eegrid.php">Online Display and Grid</a>
</li>
<li>

<a href="http://hrexpress/index.php">Home Page</a>
</li>

</ul>

<br clear="all" />


<form name='vndr_form'>
<p>
<label for='vendor' >Vendor : </label>
<input type='text' placeholder='Enter a Vendor' id='vendor' required value="<?php echo (($tempid > ' ')? htmlspecialchars( $row['Vendor'] ): ''); ?>"/>

<br>
<br>
<label for ='effdt' > Effective Date: </label>
<!--<input type='date' placeholder='Enter a Effecive Date' id='effdt' required value="<?php echo (($row['effdt'] > ' ')? htmlspecialchars( $row['effdt'] ): ''); ?>"/>-->
<input type='date' placeholder='Enter a Effecive Date' id='effdt' value="<?php echo (($row['effdt'] > ' ')? htmlspecialchars( $row['effdt'] ): ''); ?>"/> 
<input type='hidden' id='effdt_h' value="<?php echo (($tempid > ' ')? htmlspecialchars( $rsq['effdt'] ): ''); ?>"/>
<input type='text' id='tempid' value="<?php echo $tempid; ?>"/>
<br>
<br>
<label for ='Contact' > Contact Name: </label>
<input type='text' placeholder='Enter a Vendor Contact' id='Contact' required value="<?php echo (($tempid > ' ')? htmlspecialchars( $row['Contact'] ): ''); ?>"/>
<br>
<br>
<label for ='brate' > Bill Rate: </label>
<input type='text' placeholder='Enter the Bill Rate' id='brate' required value="<?php echo (($tempid > ' ')? htmlspecialchars( $row['Bill_Rate'] ): '');  ?>"/>
<br>
<br>
<label for ='hrate' > Hourly Rate: </label>
<input type='text' placeholder='Enter the Hourly Rate' id='hrate' required value="<?php echo (($tempid > ' ')? htmlspecialchars( $row['Hourly_Rate'] ): '');  ?>"/>
<br>
<br>
<label for ='tel' > Telephone Number: </label>
<input type='text' placeholder='Enter the Contact telephone number' id='tel'   value="<?php echo (($tempid > ' ')? htmlspecialchars( $row['tel'] ): '');   ?>"/>
<br>
<br>
<label for ='email' > Email Id: </label>
<input type='text' placeholder='Enter the Contact email' id='email'   value="<?php echo (($tempid > ' ')? htmlspecialchars( $row['email'] ): '');  ?>"/>
<br>
<br><input type='submit' id='updt' value='Save' align='center'/>  <input type="button" name="addbtn" class="button" id="srch" value="Back to Search" /> 
<input type="button" name="eeprofile" class="button" id="eeprofile" value="Back To Temp Profile" /> 
			<br>
</p>
<div id='msg'></div>
<div id='success'></div>
<div id='errors'></div>

</form>

</body>
</html>


