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

<script type="text/javascript">
 
$().ready(function() {
          $('#getbtn').hover( function(){
           $('#getbtn').attr('value','Click here to search, update,correct or terminate a contractor ')
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

                  $('#id').val(text_data[0]);
                  empind=text_data[1];
                 }
           });  

      //This is the autocompleter script to populate the Employee Id field - End


   <!--$("#name").autocomplete({source:'../lookup/get_name.php',minLength:30}); --> 	
	


$("#getbtn").click(function(event){  
  if (empind == 'N'){
      hdrtxt = 'Click on the button to edit the Contractor Details';
      }
      else
      {
        hdrtxt = 'This person is a regular / full time Employee, so no edits will be allowed';   
        }  
   event.preventDefault();
    var strid = $("#id").val();
   $.ajax({type:"POST",
    url:"ee_dtls.php",
    data:({datastring:strid,namestr:$("#name").val(),emptemp:empind}),
    success:function(response){
        $('#named').addClass('conv');
        $('#hidem').removeClass();
        $("#results").html(response);  
        $("#headtext").text(hdrtxt);
        }
   });})
   
   //$('#addbtn').hover(function(){$('#addbtn').attr('value','Click here to add a new Contractor')},function(){$('#addbtn').attr('value','Add')});
   
        
    $("#addbtn").click(function(event){  
   event.preventDefault();
    var strid = $("#id").val();
   $.ajax({type:"POST",
     url:"delsession.php",
     success:function(response){
        document.location = 'ee_info.php';
        
        }
   });})
    $('#hidem').addClass('reallyHide');
   })
        
</script>
</head>
<body>
<img src='/images/logo.png'/ alt=”Logo” width="190" height="100">
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
<a href="http://hrexpress.polycom.com/srccd/dbrtn/pick_ee.php">AdHoc Mail</a>
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
<p id='headtext'>Enter a name to search or click on Add to hire somebody</p>
	<form autocomplete="off" id="target">
		<div class="subfieldsset">
        
            <div id='named'>
			<label for="name"> Enter a Name : </label>
			<input type="text" name="name" id="name" />  		
            <input type="button" name="getbtn" class="button" id="getbtn" value="Search" />  
            <div>
			<input type="hidden" name="id" id="id" />
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
