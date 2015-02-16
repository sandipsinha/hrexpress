<!DOCTYPE html>  
<meta charset="UTF-8"><head>
<title>HR Temp Tool - Add Data</title>

<h4>HR Temp Tool - Add Data</h4>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../template/jquery.autocomplete.css"  />
<script type='text/javascript' src="../../scripts/jquery.autocomplete.js"></script>
<script src="../../scripts/jquery.maskedinput.js" type="text/javascript"></script>

<script type="text/javascript">

$().ready(function() {
 $('#addnew').addClass('reallyHide');
  $('#effdt').mask("99/99/9999");
  $("#it_end_dt").mask("99/99/9999");
   $("#wphone").mask("(999) 999-9999");

$('#addnew').click(function(){
     var pathname=window.location.pathname;
     var cmpltpath = 'http://hrexpress/srccd/dbrtn/' + 'addtemp.php';
     alert(cmpltpath);
    });
    
$('#search').click(function(){
     document.location = 'read_ee.php';
         });

 var optSelect={
       "C":"Consultant/Vendors",
       "F":"Fixed Term Contractors",
       "T":"Temporary Contractor",
       "W":"Temporary Worker"
       }
 var optType={
       "Short Term":"Short Term",
       "Structural":"Structural",
       "Full Term":"Full Term",
       "Project":"Project",
       "Interim":"Interim",
        "Special":"Special",
       "Intermittent":"Interimittent"
       }
var hirType={
       "HIR":"Hire",
       "REH":"Rehire"
       }
var rsnopt={
       "Loa":"LOA",
       "Short":"Short",
        "Seasonal":"Seasonal",
       "Project":"Project",
        "Replace":"Replace",
       "Add":"Add",
       "Other":"Other"
       }
       $.each(optSelect,function(key,value){
            $('#ttype').append($('<option>',{value:key}).text(value));
            });
       $.each(optType,function(key,value){
            $('#classi').append($('<option>',{value:key}).text(value));
            });
        $.each(hirType,function(key,value){
            $('#htype').append($('<option>',{value:key}).text(value));
            });
        $.each(rsnopt,function(key,value){
            $('#rsntype').append($('<option>',{value:key}).text(value));
            });
            

 //This is the autocompleter script to populate the Department field
 $("#dept").autocomplete("../lookup/get_dept.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#dept").result(function(event, data, formatted){$("#dept").val(data[0]);} );
    
 //This is the autocompleter script to populate the legal Entity Field
 
 $("#legal").autocomplete("../lookup/get_legal.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//miple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#legal").result(function(event, data, formatted){$("#legal").val(data[0]);} );
   
    //This is the autocompleter script to populate the Fin Field
     $("#finance").autocomplete("../lookup/get_fin.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
     
	$("#finance").result(function(event, data, formatted){$("#finance").val(data[0]);} );
    
    	 //This is the autocompleter script to populate the VP Field
    
         $("#vp").autocomplete("../lookup/get_vp.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#vp").result(function(event, data, formatted){$("#vpid").val(data[0]);} );
    
        	 //This is the autocompleter script to populate the HR Field
    
         $("#hr").autocomplete("../lookup/get_hr.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#hr").result(function(event, data, formatted){$("#hrid").val(data[1]);} );
    	 //This is the autocompleter script to populate the Location Field
    
         $("#location").autocomplete("../lookup/get_loc.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#location").result(function(event, data, formatted){$("#location").val(data[0]);} );
    
  //This is the autocompleter script to populate the Supervisor Field
    
         $("#manager").autocomplete("../lookup/get_manager.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#manager").result(function(event, data, formatted){$("#bossid").val(data[1]);$("#manager").val(data[0]);$("#dept").val(data[2]);$("#location").val(data[3]);$("#legal").val(data[4]);$("#vp").val(data[6]);$("#vpid").val(data[5]);} );
    
        $("#wemail").change(function(){
           var email = $("#wemail").val();
         $.ajax(
         {type:"POST",
           dataType:'json',
          url:"../lookup/checkemail.php",
         data:({datastring:email,action:$("#htype").val()}),
         success:function(x){
        if (x.response == 'success') {
        $("#errors").removeclass("error"); 
       $("#errors").hide(); 
        if ($("#htype").val() == 'REH'){
            $.ajax({
                        type:"post",
                        dataType:"json",
                        url: "../dbrtn/findrehire.php",
                        data:({emailid:$("#wemail").val()}),
                        success:function(msg){
                         if(data.success == true){
                             $("#fname").val(msg.fname);
                               $("#lname").val(msg.lname);
                               $("#finance").val(msg.finance);
                               $("#location").val(msg.location);
                              $("#dept").val(msg.dept);
                               $("#vp").val(msg.vp);
                               $("#empid").val(msg.id);
                              $("#bossid").val(msg.boss);
                               $("#vpid").val(msg.vp);
                               $("#legal").val(msg.legal);
                               $("#btitle").val(msg.btitle);
                              $("#hrid").val(msg.hrid);
                                $("#errors").removeClass('error'); 
                              $("#errors").addClass('reallyHide'); 
                               $("#errors").hide(); 
                               $("#errors").removeClass('error'); 
                               $("#errors").hide(); 
                             }
                         else
                             {
                               $("#errors").html(data.message); 
                               $("#errors").addClass('error'); 
                             }
                         }
                             });
                             
            }
        }
        else
        { 
        $("#errors").html(x.response);      
        $("#errors").addClass('error');  
        
        }
        
   }}); 
 
        });
    
   $("#htype").change(function(){
           var email = $("#wemail").val();
           if (email > '') {
         $.ajax(
         {type:"POST",
           dataType:'json',
          url:"../lookup/checkemail.php",
         data:({datastring:email,action:$("#htype").val()}),
         success:function(x){
        if (x.response == 'success') {
           if ($("#htype").val() == 'REH'){
            $.ajax({
                        type:"post",
                        dataType:"json",
                        url: "../dbrtn/findrehire.php",
                        data:({emailid:$("#wemail").val()}),
                        success:function(msg){
                         if(msg.success == true){

                               $("#fname").val(msg.fname);
                               $("#lname").val(msg.lname);
                               $("#finance").val(msg.finance);
                               $("#location").val(msg.location);
                              $("#dept").val(msg.dept);
                               $("#vp").val(msg.vp);
                               $("#empid").val(msg.id);
                              $("#bossid").val(msg.boss);
                               $("#vpid").val(msg.vp);
                               $("#legal").val(msg.legal);
                               $("#btitle").val(msg.btitle);
                              $("#hrid").val(msg.hrid);
                                $("#errors").removeClass('error'); 
                              $("#errors").addClass('reallyHide'); 
                               $("#errors").hide(); 
                             }
                         else
                             {
                               $("#errors").html(data.message); 
                               $("#errors").addClass('error'); 
                             }
                         }
                             });
                             
            }
        }
        else
        { 
        $("#errors").html(x.response);      
        $("#errors").addClass('error');  
        
        }
        
   }}); 
  }
        });
    
    $('#rsntype').change(function(){
        var selectVal = $('#rsntype:selected').val();
        });
  $('form').submit(function(e) {
              e.preventDefault();
        // validate the 'First Name' field
        if ($("#fname").val() == "") {
            $("#errors").html('<p class="error">Enter a valid first name !</p>');
            $("#fname").focus();
            return false;
        }
                // validate the 'Last Name' field
        if ($("#lname").val() == "") {
            $("#errors").html('<p class="error">Enter a valid last name !</p>');
            $("#lname").focus();
            return false;
        }
            // validate the 'business title' field
        if ($("#btitle").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Business Title !</p>');
            $("#btitle").focus();
            return false;
        }
        // validate the 'email' field
        if ($("#wemail").val().indexOf("@") == -1) {
            $("#errors").html('<p class="error">Enter a valid email address!</p>');
            $("#wemail").focus();
            return false;
        }
        // validate the 'Manager' field
        if ($("#manager").val() == "") {
            $("#errors").html('<p class="error">A manager is required !</p>');
            $("#manager").focus();
            return false;
        }
        // validate the 'Phone' field
        if ($("#wphone").val()== "") {
            $("#errors").html('<p class="error">Enter a valid Phone Number!</p>');
            $("#wphone").focus();
            return false;
        }
        // validate the 'Location' field
        if ($("#location").val() == "") {
            $("#errors").html('<p class="error">Enter a valid location !</p>');
            $("#location").focus();
            return false;
        }
            // validate the 'business title' field
        if ($("#legal").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Legal Entity !</p>');
            $("#legal").focus();
            return false;
        }               
        // validate the 'VP' field
        if ($("#vp").val() == "") {
            $("#errors").html('<p class="error">Enter a valid VP !</p>');
            $("#vp").focus();
            return false;
        }
            // validate the 'finance' field
        if ($("#finance").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Finance !</p>');
            $("#finance").focus();
            return false;
        }    
        
    // validate the Effective Date field
        if ($("#effdt").val() == "") {
            $("#errors").html('<p class="error">Enter a Effective Date !</p>');
            $("#effdt").focus();
            return false;
        }   
        
       // validate the 'It End Date' field
        if ($("#it_end_dt").val() == "") {
            $("#it_end_dt").html('<p class="error">A planned exiit date is required!</p>');
            $("#it_end_dt").focus();
            return false;
        }
        
 

        $.ajax({
            type: "POST",
            url: "../dbrtn/processform.php",
            dataType:"json",
            data: ({fname:$("#fname").val(), lname:$("#lname").val(),wemail:$("#wemail").val(),wphone:$("#wphone").val(),ttype:$("#ttype").val(),classi:$("#classi").val(),btitle:$("#btitle").val(),effdt:$("#effdt").val(),hrid:$("#hrid").val(),vpid:$("#vpid").val(),legal:$("#legal").val(),loc:$("#location").val(),depid:$("#dept").val(),fin:$("#finance").val(),rsntype:$("#rsntype").val(),htype:$("#htype").val(),comments:$("#comments").val(),it_end_dt:$("#it_end_dt").val()}),
            error: function(msg) {
                $("#errors").html(msg);
            },
            success: function(msg) {
                // display the errors returned by server side validation (if any)
                 if(msg.success == true){
                $('#success').html('<h3>' + msg.message + '</h3>');
                $('#error').hide();
                $('#addnew').show(slow);
                }
                else {
                    $('#error').html('<h3>' + msg.message + '</h3>');
                    $('#success').hide();
                    $('#addnew').hide();
                }
            }
        });
    });


  
  })


           
           
</script>
</head>
<body>
<div class='inputtag'>
<!--<fieldset>  -->
<?php 
//echo "<legend> Consultant details</legend>";
echo "<form>";
echo "<p><br>";
echo "<label for ='fname'>First Name: </label><input type = 'text' placeholder='First Name' id='fname'/> &nbsp;&nbsp;&nbsp;"; 
echo "<label for ='lname'>Last Name: </label><input type = 'text' id='lname'/> &nbsp;&nbsp;&nbsp;" ;
echo "<label for ='ttype'> Temp Type: </label><select id='ttype'></select> &nbsp;&nbsp;&nbsp;";
echo "<label for ='classi'> Classification: </label><select id='classi'></select> ";
echo "<br>  </p><p>";
//echo "</fieldset></p><fieldset><legend> Contact details</legend>";
echo "<label for='btitle'>Business Title: </label><input type='text' placeholder='Business Title' id='btitle' />&nbsp;&nbsp;&nbsp";
echo "<label for='effdt'>Date Of Hire: </label><input type='text' placeholder='Start Date' id='effdt' /> &nbsp;&nbsp;&nbsp;";
echo "<label for='wphone'>Phone(Business): </label><input type='text' placeholder='Work Phone' id='wphone' /> &nbsp;&nbsp;&nbsp;"; 
echo "<label for='wemail'>Email(Business): </label><input type='email' placeholder='Work Email' id='wemail' /> &nbsp;&nbsp;&nbsp; "; 
echo "<input type='hidden' name='empid' id='empid' /> ";
echo "<span id='emailerr'></span>&nbsp;&nbsp;&nbsp;";
echo "</p><p>";
//echo "</fieldset></p><fieldset><legend> Contact details</legend>";
echo "<label for='reqnum'>Requisition Number:</label><input type='text' placeholder='Requsition Number' id='reqnum' /> &nbsp;&nbsp;&nbsp;";
echo "<label for='manager'>Manager:</label><input type='text' placeholder='Supervisor' id='manager' /> &nbsp;&nbsp;&nbsp;";
echo "<input type='hidden' id='bossid' /> &nbsp;&nbsp;&nbsp;";
echo "<label for='location'>Location:</label><input type='text' placeholder='Work Place Location' id='location' /> &nbsp;&nbsp;&nbsp;"; 
echo "<label for='it_end_dt'>Planned Exit:</label><input type='date' placeholder='Enter a end date of the contract' id='it_end_dt' /> &nbsp;&nbsp;&nbsp;"; 
echo "</p><p>";
echo "<label for='dept'>Department: </label><input type='text' placeholder='Department' id='dept' size = '38' /> &nbsp;&nbsp;&nbsp;"; 
echo "<label for='legal'>Legal Entity: </label><input type='text' placeholder='Legal Entity' id='legal' size='40'/> &nbsp;&nbsp;&nbsp; ";
echo "<label for='vp'>VP: </label><input type='text' placeholder='VP' id='vp' /> &nbsp;&nbsp;&nbsp;";
echo "<input type='hidden' id='vpid' /> &nbsp;&nbsp;&nbsp;";
echo "</p><p>";
echo "<label for='finance'>Finance: </label><input type='text' placeholder='Finance' id='finance' size='38' /> &nbsp;&nbsp;&nbsp;";
echo "<label for='hr'>HR Contact: </label><input type='text' placeholder='HR Contact' id='hr' /> &nbsp;&nbsp;&nbsp;";
echo "<input type='hidden' name='hrid' id='hrid' /> ";
echo "<label for='htype'>Type Of Hire: </label><select id='htype'></select> &nbsp;&nbsp;&nbsp;";
echo "</p><p>";
echo "<label for='rsntype'>Reason Of Hire: </label><select id='rsntype'></select> &nbsp;&nbsp;&nbsp;";
echo "<span id='rsninfo'></span>&nbsp;&nbsp;&nbsp;";
echo "<label for='comments'>Comments: </label><textarea rows='3' cols='40' id='comments'> Your comments here</textarea> &nbsp;&nbsp;&nbsp;";
echo "<div id='msg'></div>";
echo "</p><br>";
echo "<input type='submit' id='add' value='Add' align='center'/>&nbsp;&nbsp;&nbsp; <input type='button' id='search' value='Search HR Temp Data' align='center'/>";

echo "<br><input type='button' id='addnew' value='Add 1 more' align='center'/><br>";
echo "<div id='success'></div>";
echo "<div id='errors'></div>";
echo "</form>";
?>  

</div>

</body>
</html>