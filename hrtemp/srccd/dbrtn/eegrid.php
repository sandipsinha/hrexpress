<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>POLYCOM TEMP TRACKING TOOL</title>

<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../template/menu.style.css">
<link rel="stylesheet" type="text/css" href="../../template/newstyle.css"  />
<!--<script type='text/javascript' src="../../scripts/jquery.autocomplete.js"></script>
<script src="../../scripts/jquery.maskedinput.js" type="text/javascript"></script>-->
<script type='text/javascript' src='../../scripts/param.getinput.js'></script>
<script src="../../scripts/jquery.editinput.js" type="text/javascript"></script> 
<!--<script src="../../scripts/menu.nav.js" type="text/javascript"></script>-->
<script type="text/javascript">

   $().ready(function() {
     
    
       })
  </script>
</head>
<body>
<img src='/images/logo.png'/ alt=”Logo” width="190" height="100">
<div class="formarea">

<ul id="van-one" class="van">
<li>

<a href="http://hrexpress.polycom.com/srccd/dbrtn/read_ee.php">Temp/Reg Lookup</a>

</li>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/pick_ee.php">AdHoc Mail</a>
</li>
<li>
<a href="http://hrexpress.polycom.com/index.php">Home Page</a>
</li>


</ul><br>

<br clear="all" />
<h2 id="banner">Polycom HR Temp  Tracking Tool</h2>

<?php

   $type=array("C"=>"Consultant/Vendors","F"=>"Fixed Term Contractors","T"=>"Temporary Contractor","W"=>"Temporary Worker","all"=>"All");
  
   $empType=array("Short Term"=>"Short Term", "Structural"=>"Structural","Full Term"=>"Full Term", "Project"=>"Project","Interim"=>"Interim","Special"=>"Special", "Intermittent"=>"Interimittent","all"=>"All");
   
   $rsnopt=array("LOA"=>"LOA","Short"=>"Short","Seasonal"=>"Seasonal", "Project"=>"Project","Replace"=>"Replace","Add"=>"Add","Other"=>"Other","all"=>"All");
 
   $actopt=array("xfr"=>"Transfer","ter"=>"terminate", "xtn"=>"Extension","cnv"=>"Convert to a Regular","hir"=>"Hire","reh"=>"Rehire","all"=>"All");
   
   $region=array("EMEA"=>"EMEA","Americas"=>"Americas", "APAC"=>"APAC","CALA"=>"CALA","all"=>"All");
   
 
?>
<br>
<p id='headtext'>Enter one or many filter to get a report</p>
<form name="reportform">
<div class="subfieldsset" id='content'>
<div>

 


<label for ='actopt'> Type Of Transaction: </label>
<select id='actopt'> 
<?php
    foreach ($actopt as $opt=>$data)
                 {   
                            if ($opt=='all'){
                            echo '<option selected value='. $opt.'>' . $data .'</option>';}
                        else {
                            echo  '<option value='. $opt.'>' . $data .'</option>';}
                    }
?>
</select>
<br>
</div>
<div>

<label for ='ttype'> Temp Type: </label>
<select id='ttype'>  

<?php
foreach ($type as $opt=>$data)
                   {   
                            if ($opt=='all'){
                            echo '<option selected value='. $opt.'>' . $data .'</option>';}
                        else {
                            echo  '<option value='. $opt.'>' . $data .'</option>';}
                    }
 ?>                   
</select>

<input type='hidden' id='ids' />

<!--<label for='effdt'>Effective Date: </label>
<input type='date' placeholder='Start Date' id='effdt' />-->
<label for ='classi'> Classification: </label>
<select id='classi'> 
<?php
foreach ($empType as $opt=>$data)
                   {   
                        if ($opt=='all'){
                            echo '<option selected value='. $opt.'>' . $data .'</option>';}
                        else {
                            echo  '<option value='. $opt.'>' . $data .'</option>';}
                    }
 ?>                       
</select> 
<label for='rsntype'>Action Reason: </label>
<select id='rsntype'>   
<?php
foreach ($rsnopt as $opt=>$data)
                   {   
                        if ($opt=='all'){
                            echo '<option selected value='. $opt.'>' . $data .'</option>';}
                        else {
                            echo  '<option value='. $opt.'>' . $data .'</option>';}
                    }
 ?> 
</select> 


<br>
</div>

 <span class='note'> Contact Details</span>
<div>

<label for='legal'>Legal Entity: </label>
<input type='text' placeholder='Legal Entity' id='legal' size='auto' />

<label for='dept'>Department: </label>
<input type='text' placeholder='Department' id='dept' /> 


<br>
 </div>
<!--
<label for='empid'>Employee id: </label>
<input type='text' name='empid' id='empid' /> 
<br><br>-->

<div>
<label for='vp'>VP: </label>
<input type='text' placeholder='VP' id='vp' />
<input type='hidden' id='vpid' /> 
<label for='finance'>Finance: </label>
<input type='text' placeholder='Finance' id='finance'  />



</div>
<div>
<!--
<label for='reqnum'>Requisition Number:</label>
<input type='text' placeholder='Requsitin Number' id='reqnum' />
-->
<label for='hr'>HR Contact: </label>
<input type='text' placeholder='HR Contact' id='hr' />
<label for='location'>Location:</label>

<input type='text' placeholder='Work Place Location' id='location' />
<input type='hidden'  id='hrid' /> 
<label for='region'>Region:</label>
<select id='region'>   
<?php
foreach ($region as $opt=>$data)
                   {   
                        if ($opt=='all'){
                            echo '<option selected value='. $opt.'>' . $data .'</option>';}
                        else {
                            echo  '<option value='. $opt.'>' . $data .'</option>';}
                    }
 ?> 
</select> 
</div>
<br>
 <span class='note'> Date Filter</span>
<div>

<label for='start_date'>Start Date: </label>
<input type='text' placeholder='Enter a Start Date' id='start_date' size='auto' />

<label for='end_date'>End Date: </label>
<input type='text' placeholder='Enter a Start Date' id='end_date' /> 


<br>
 </div>
<br><hr>
<span class='note'> Select the Columns to display</span> 
<div>
 <label></label>
<table><tr><td> <input type='checkbox' id='dept' value='department' id='dept' > Department </td>
<td> <input type='checkbox' id='location' value='location' class='checkbox' > Location  </td>
<td> <input type='checkbox' id='classification' value='classification'> Classification </td>
<td> </label><input type='checkbox' id='vp' value='VP'>  VP </td>
<td> </label><input type='checkbox' id='btitle' value='business_title'>  Business  Title</td>
<td> <input type='checkbox' id='finance' value='finance'>  Finance</td> 
<td> <input type='checkbox' id='brate' value='Bill_Rate'>  Bill Rate</td>
<td> <input type='checkbox' id='hrate' value='Hourly_Rate'>  Hourly Rate</td>
</tr>
</table>
</div>
<br>
<div>
<label></label>
<table><tr><td>
 <input type='checkbox' id='hr_contact' value='Hr_Contact'> HR Contact </td>
<td><input type='checkbox' id='supervisor' value='supervisor'> Supervisor</td>
<td><input type='checkbox' id='business_phone' value='Business_Phone'> Work Phone </td>
<td><input type='checkbox' id='financial_org' value='financial_org'> Financial Org</td>
<td><input type='checkbox' id='req_num' value='Requisition_Number'> Requisition Number </td>
<td><input type='checkbox' id='comments' value='comments'> Comments </td>
<td><input type='checkbox' id='vendor' value='Vendor_Name'> Vendor </td>
<td><input type='checkbox' id='remote' value='remote'> Remote </td>
</tr>
</table>
</div>
<br>
<!--<input type='checkbox' id='type' value='type'> Type &nbsp;&nbsp;&nbsp;-->

<br>
<br><input type='submit' id='updt' value='Display' align='center'/>  

<input type="hidden" name="lookupid" id="lookupid" /><br>

</div>
<div id="results">

</div>
<div id='success'><input type="button" class="button" id="srch" value="Change Search" /> 
</div>
<div id='errors'></div>
</form>


</body>
</html>