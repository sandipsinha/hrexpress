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
<link rel="stylesheet" type="text/css" href="../../template/newstyle.css"  />
<link rel="stylesheet" type="text/css" href="../../template/menu.style.css">
<!--
-->
<!--<link rel="stylesheet" type="text/css" href="gldatepicker/css/default.css">
<link rel="stylesheet" type="text/css" href="../../template/jquery.autocomplete.css"  />
<script src="../../scripts/gldatepicker/js/glDatePicker.js" type="text/javascript"></script>
<script type="text/javascript" src="../../scripts/jquery.vndreditinput.js"></script>-->

<script type="text/javascript">
$().ready(function() {

      
      //$('#effdt').glDatePicker({cssname:"default",allowOld:true}); 
      $('#effdt').datepicker({dateFormat:"yy-mm-dd"});
      //This is the autocomplete script to populate the Vendor Name
          $("#vendor").autocomplete({
               source:"../lookup/get_vndr.php", 
                minLength:1,
              select: function(event, ui) {
                  $('#tempid').val(ui.item.id);
                     }
              });
      var sqlenddt ;
      var updatestr;

    //This is the autocompleter script to populate the Department field
        var change_ind = '';
        var change_num = 0;
    
       
       var max1 = $("label[for='tel']").width();


        
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

    $('#tel').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", Contact_tel = '"+ $('#tel').val() + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "Contact_tel = '"+ $('#tel').val() + "'";
	   }
       //change_num +=1;
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
       //change_num +=1;
	})
     
    // Effectibve date change funciton
  $('#effdt').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", effdt= '" +  $("#effdt").val()   + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     //insertstr = "effdt= '"+ $('#effdt').val() + "'";
         insertstr = "effdt= '" +  $("#effdt").val()   + "'";
	   }
       change_num +=1;
	})
    //Comments change funciton
  $('#comments').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", comments= '" +  $("#comments").val()   + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     //insertstr = "effdt= '"+ $('#effdt').val() + "'";
         insertstr = "comments= '" +  $("#comments").val()   + "'";
	   }
       change_num +=1;
	})
    
    //Now begins the edit function_exists
    //$('form[name="vndr_form"]').submit(function(e) {
     $('#updt').click(function(){   
        var change_ind = 'N';
        var change_str = '';
        $('#errors').slideUp();
        $('#success').slideUp();
         //alert('i came till here'); 
     
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
      /*  if ($("#Contact").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Contact !</p>');
            $("#Contact").focus();
            $("#errors").show();
            return false;
        }*/
        // validate the Hourly Rate field

                  

 
                    
        // validate the 'Telephone' field
        if (($("#tel").val() == "" && $("#email").val() == "") && $("#contact").val() != "" ) {
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
           updatestr = " comments = '"+ $('#comments').val() + "' ,contact_tel = '" + $('#tel').val() + "' , contact_email = '" + $('#email').val() + "'";
           updatestr += ", name = '"+ $("#vendor").val() +"' , contact_name = '"+ $("#contact").val() + "' , effdt = '" +  $("#effdt").val() + "' where id = " + $("#vndrid").val() ;
 
           if ($('#vndrid').val() == '' )
            {
               insertstr = "('" +   $("#vendor").val() + "','" + $("#contact").val() + "','" + $("#effdt").val()  +  "','"  + $("#tel").val() + "','"+$("#email").val()+"', '"+  $("#comments").val() + "')";
               actionstr = 'add';
             }  
             
        $.ajax({
            type: "POST",
            url: '../../srccd/dbrtn/vndrupdt.php',
            dataType:"json",
            data: ({insertdata: insertstr,action:actionstr,updatecond:updatestr}),
            error: function(msg) {
                $("#errors").html(msg.message);
                $('#success').slideUp();
                
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
     document.location = '../../srccd/dbrtn/read_vndr.php';
         });
 $('#eeprofile').click(function(){
     document.location = '../../srccd/dbrtn/ee_info.php';
         });        
    })
</script>
<?php
require_once "../../dataconn/config.php";
 session_start();
 if (isset($_REQUEST['id']))
      {
        $tempid = $_SESSION['id'];
        $sql_temp = "select concat(a.first_name, '  ',a.last_name)  Name,vendor_id  from consultants a where a.id = ". $tempid  ." and a.effdt=(select max(b.effdt) from consultants b
        where a.id = b.id)";
        $rsq_t = mysql_query($sql_temp);
        if (!$rsq_t) 
            {
                die("Query to show fields from the table failed");
                exit();
            }
        $row_t = mysql_fetch_assoc($rsq_t);
        $sql = "select a.name Vendor,a.id id, a.contact_name contact, date_format(a.effdt,'%Y/%m/%d') effdt,a.contact_tel tel,  a.contact_email email ,a.comments from 
        vendor a where a.id = ". $row_t['vendor_id'] ;
     }
   else
      {
        $tempid = $_SESSION['vendorid'];
        $sql = "select a.name Vendor,a.id id, a.contact_name contact, date_format(a.effdt,'%Y/%m/%d') effdt,a.contact_tel tel,  a.contact_email email ,a.comments from 
        vendor a where a.id = ". $tempid;
       }
 
?>


</head>
<body>
<?php


   
if ($tempid > ' ')
     {
         $rsq = mysql_query($sql);
         if (!$rsq) 
            {
                die("Query to show fields from table failed");
            }
         $row = mysql_fetch_assoc($rsq);
     }
?>
<div class="formarea">

<ul id="van-one" class="van">
<li>

<a href="read_ee.php">HR Temp Tracking Area</a>
</li>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/eegrid.php">Online Display and Grid</a>
</li>
<li>

<a href="http://hrexpress.polycom.com">Home Page</a>
</li>

</ul>

<br clear="all" />

 
<form name='vndr_form'><br>
<?php if ($tempid > ' '){
        if (isset($_REQUEST['id'])){ ?>
<h2><?php echo 'Maintain Vendor Details for '. $row_t['Name'] ;   ?></h2>
<?php } else { ?>
<h2><?php echo 'Maintain Details for '. $row['Vendor'] ;   ?></h2>
<?php }
}
else {
    echo 'Add Vendor Details ' ; 
    }
    ?>
<div class="subfieldsset">
<div>
<label for='vendor' >Vendor : </label>
<input type='text' placeholder='Enter a Vendor' id='vendor' size=50 required value="<?php echo (($tempid > ' ')? htmlspecialchars( $row['Vendor'] ): ''); ?>"/>
</div>
<br>
 <div>
<label for ='effdt' > Effective Date: </label>
<!--<input type='date' placeholder='Enter a Effecive Date' id='effdt' required value="<?php echo (($row['effdt'] > ' ')? htmlspecialchars( $row['effdt'] ): ''); ?>"/>-->
<input type='date' placeholder='Enter a Effecive Date' id='effdt' value="<?php echo (($row['effdt'] > ' ')? htmlspecialchars( $row['effdt'] ): ''); ?>"/> 

</div>

<div>
<label for ='Contact' > Contact Name: </label>
<input type='text' placeholder='Enter a Vendor Contact' id='contact' size=50  value="<?php echo (($tempid > ' ')? htmlspecialchars( $row['contact'] ): ''); ?>"/>
</div>

<div>
<label for ='tel' > Telephone Number: </label>
<input type='text' placeholder='Enter the Contact telephone number' id='tel'   value="<?php echo (($tempid > ' ')? htmlspecialchars( $row['tel'] ): '');   ?>"/>
</div>

<div>
<label for ='email' > Email Id: </label>
<input type='text' placeholder='Enter the Contact email' id='email'   value="<?php echo (($tempid  > ' ')? htmlspecialchars( $row['email'] ): '');  ?>"/>
</div>

<div>

<label for ='comments' > Comments: </label>
 <textarea rows='3' cols='70' id='comments' > <?php echo (($tempid > ' ')? htmlspecialchars( $row['comments'] ): '');  ?> </textarea>
 </div>
 <div><label></label></div>
</div>
</form>
<br><input type='button' id='updt' value='Save' align='center'/>  <input type="button" name="addbtn" class="button" id="srch" value="Back to Search" /> 
<br><br>
<div id='msg'></div>
<div id='success' class='success'></div>
<div id='errors'></div> 

<input type='hidden' id='effdt_h' value="<?php echo (($row['id']> ' ')? htmlspecialchars( $rsq['effdt'] ): ''); ?>"/>
<input type='hidden' id='vndrid' value="<?php echo (($tempid > ' ')?   htmlspecialchars( $row['id']):''); ?>"/>			


 
 
</body>
</html>


