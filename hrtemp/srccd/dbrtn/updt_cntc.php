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
      var brate = 0;
      var hrate = 0;
    //This is the autocompleter script to populate the Department field
        var change_ind = '';
        var change_num = 0;
    
       
       var max1 = $("label[for='tel']").width();


        
	$('#vendor').change(function(){ 
    if (change_ind == 'Y') {
	   	insertstr = insertstr + ", id = '"+ $('#vndrid').val() + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "id= '"+ $('#vndrid').val() + "'";
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
       //change_num +=1;
       brate = $('#brate').val() ;
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
    
    //Now begins the edit function_exists
    //$('form[name="vndr_form"]').submit(function(e) {
     $('#updt').click(function(){   
        var change_ind = 'N';
        var change_str = '';
        $('#errors').slideUp();
        $('#success').slideUp();
     
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

        // validate the Hourly Rate field
        if ($("#hrate").val() == "") 
        {
            hrate = 0;
        }
        else
            {
            hrate = $('#hrate').val() ;
            }  
                    
        // validate the Billing Rate field
        if ($("#brate").val() == "") 
        {
            brate = 0;
        }
        else
            {
            brate = $('#brate').val() ;
            }  

         

        
 
        var actionstr = 'upd';
       // validate the 'effective date' field
           updatestr = " Bill_Rate = "+ brate+" , Hourly_Rate= "+ hrate ;
           updatestr += ", id= "+ $("#vndrid").val()  + " , Effdt = '" + $("#effdt").val()  + "' where tempid = " +  $("#tempid").val();
 
           if ($('#agencyid').val() == '' )
            {
               insertstr = "('" +  $("#effdt").val()  +  "'," + brate +"," + hrate+",'" + $("#vndrid").val() +", "+ $("#tempid").val() + ")";
               actionstr = 'add';
             }  
        $.ajax({
            type: "POST",
            url: '../../srccd/dbrtn/cntupdt.php',
            dataType:"json",
            data: ({insertdata: insertstr,action:actionstr,updatecond:updatestr}),
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
 $sql_temp = "select concat(a.first_name, '  ',a.last_name)  Name,vendor_id  from consultants a where a.id = ". $tempid  ." and a.effdt=(select max(b.effdt) from consultants b
where a.id = b.id)";

 $rsq_t = mysql_query($sql_temp);
if (!$rsq_t) {
    die("Query to show fields from the table failed");
    exit();
}
$row_t = mysql_fetch_assoc($rsq_t);
?>


</head>
<body>
<?php


   
if ($row_t['vendor_id'] > ' '){
$sql = "select a.name Vendor,b.id id, a.contact_name Contact, date_format(a.effdt,'%Y/%m/%d') effdt,b.Hourly_Rate,b.Bill_Rate,a.contact_tel tel,  a.contact_email email from 
vendor a left join vendor_contact b on a.id = b.id where a.id = ". $row_t['vendor_id']  ." and (b.tempid=".$tempid." or b.tempid is null) "." and (b.effdt=(select max(c.effdt) from vendor_contact c where b.id = c.id) or b.effdt is null)";

 $rsq = mysql_query($sql);
if (!$rsq) {
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
<h2><?php echo 'Maintain Vendor Details for '. $row_t['Name'] ;   ?></h2>
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
<input type='hidden' id='effdt_h' value="<?php echo (($row_t['vendor_id']> ' ')? htmlspecialchars( $rsq['effdt'] ): ''); ?>"/>
<input type='hidden' id='vndrid' value="<?php echo $row_t['vendor_id']; ?>"/>
<input type='hidden' id='tempid' value="<?php echo $tempid; ?>"/>
<input type='hidden' id='agencyid' value="<?php echo $row['id']; ?>"/>
</div>
<br>
<div>
<br>
<label for ='brate' > Bill Rate: </label>
<input type='text' placeholder='Enter the Rate' id='brate'   value="<?php echo (($row_t['vendor_id']> ' ')? htmlspecialchars( $row['Bill_Rate'] ): '');  ?>"/>
</div>
<br>
<div>
<br>
<label for ='hrate' > Hourly Rate: </label>
<input type='text' placeholder='Enter the Hourly Rate' id='hrate'  value="<?php echo (($row_t['vendor_id'] > ' ')? htmlspecialchars( $row['Hourly_Rate'] ): '');  ?>"/>
</div>
<br>
</form>
<br><input type='button' id='updt' value='Save' align='center'/>  <input type="button" name="addbtn" class="button" id="srch" value="Back to Search" /> 
<input type="button" name="eeprofile" class="button" id="eeprofile" value="Back To Temp Profile" /> 
			

<div id='msg'></div>
<div id='success' class='success'></div>
<div id='errors' class='error'></div>

</div>
</body>
</html>


