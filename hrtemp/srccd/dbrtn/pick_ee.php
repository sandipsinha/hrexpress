<?php
require_once "../../dataconn/config.php";
 require_once "rolechk.php";
//ob_start();
//require_once "config.php";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

<title>POLYCOM TEMP TRACKING TOOL</title>
<!--<script type="text/javascript" src="../../scripts/jquery.js"></script>-->
<!--<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type='text/javascript' src='../../scripts/jquery.autocomplete.js'></script>-->
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../template/menu.style.css">
<link rel="stylesheet" type="text/css" href="../../template/newstyle.css"  />
<script type='text/javascript' src='../../scripts/ReadInput.js'></script>

<script type="text/javascript">
 
$().ready(function() {
          $('#getbtn').hover( function(){
           $('#getbtn').attr('value','Click here to select a Employee/Consultant ')
           },
        function(){
           $('#getbtn').attr('value','Search');
           }); 
   $('#named').show();
   var hdrtxt;
   var empind;
          //This is the autocompleter script to populate the Employee Id, Name field - Begin
        $("#name").autocomplete({
            source:"../lookup/get_name.php", 
            minLength:1,
            select: function(event, ui) {
                 var text_data = ui.item.id.split(';');

                  $('#wrkid').val(text_data[0]);
                  $('#wrktyp').val(text_data[1]);
                 }
           });  

      //This is the autocompleter script to populate the Employee Id field - End


   <!--$("#name").autocomplete({source:'../lookup/get_name.php',minLength:30}); --> 	
	



   
   //$('#addbtn').hover(function(){$('#addbtn').attr('value','Click here to add a new Contractor')},function(){$('#addbtn').attr('value','Add')});
   
        
    $("#addbtn").click(function(event){  
   event.preventDefault();
   $.ajax({type:"POST",
     url:"delvndr.php",
     success:function(response){
        document.location = 'ee_data_mail.php';
        
        }
   });})
    $('#hidem').addClass('reallyHide');
   })
        
</script>
</head>
<body>
<div class="container">


<div class="formarea">
<ul id="van-one" class="van">
<li>

 <a href="http://hrexpress.polycom.com/index.php">Home Page</a>

</li>
<li id="hidem">
<a href="http://hrexpress.polycom.com/srccd/dbrtn/read_ee.php">Temp/Reg Lookup</a>
</li>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/eegrid.php">Reports</a>
</li>

</ul>
<br>
<br>
<h2>Polycom HR Temp 
- Tracking Tool</h2>
<br>
<p id='headtext'>Enter a Temp/FTE name to search </p>
	<form autocomplete="off" id="target" action='ee_data_mail.php' method='POST'>
		<div class="subfieldsset">
        
            <div id='named'>
			<label for="name"> Enter a Name : </label>
			<input type="text" name="name" id="name" /> 
            <input type="hidden" name="id" id="wrkid" />
            <input type="hidden" name="ind" id="wrktyp" />
            <input type="submit" name="getbtn" class="button" id="getbtn" value="Look Up And Send Mail" />  
            <input type="button" name="addbtn" class="button" id="addbtn" value="Send Mail with New Data" />  
            <div>

		</div>
        <br>
        </div></div>
        <span id="results">

</span>
	 </form>


 <div id="content">  	
</div>
</div>
</div>
</body>
</html>
