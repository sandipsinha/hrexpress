<?php
session_start();
//ob_start();
//require_once "config.php";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

<title>POLYCOM TEMP TRACKING TOOL</title>

<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../template/jquery.autocomplete.css">
<link rel="stylesheet" type="text/css" href="../../template/menu.style.css">
<!--<script type='text/javascript' src="../../scripts/jquery.autocomplete.js"></script>
<script src="../../scripts/jquery.maskedinput.js" type="text/javascript"></script>-->
<script type='text/javascript' src='../../scripts/param.getinput.js'></script>
<script src="../../scripts/jquery.editinput.js" type="text/javascript"></script>-->
<!--<script src="../../scripts/menu.nav.js" type="text/javascript"></script>-->
<script type="text/javascript">

   $().ready(function() {
     var max = $("label[for='actopt']").width();
     var max1 = $("label[for='legal']").width();
     var max2 = $("label[for='dept']").width();
    $("label[for='ttype']").width(max);
    $("label[for='vp']").width(max1);
    $("label[for='manager']").width(max1);
    $("label[for='finance']").width(max2);
    $("label[for='location']").width(max2);
    
    
       })
  </script>
</head>
<body>
<h2 id="banner">Polycom HR Temp  Tracking Tool</h2>
<ul id="van-one" class="van">
<li>

<a href="http://hrexpress.polycom.com/srccd/dbrtn/read_ee.php">Temp Lookup</a>

</li>
<li>
<a href="http://hrexpress.polycom.com/index.php">Home Page</a>
</li>

</ul>
<br clear="all" />
<?php

   $type=array("C"=>"Consultant/Vendors","F"=>"Fixed Term Contractors","T"=>"Temporary Contractor","W"=>"Temporary Worker","all"=>"All");
  
   $empType=array("Short Term"=>"Short Term", "Structural"=>"Structural","Full Term"=>"Full Term", "Project"=>"Project","Interim"=>"Interim","Special"=>"Special", "Intermittent"=>"Interimittent","all"=>"All");
   
   $rsnopt=array("LOA"=>"LOA","Short"=>"Short","Seasonal"=>"Seasonal", "Project"=>"Project","Replace"=>"Replace","Add"=>"Add","Other"=>"Other","all"=>"All");
 
   $actopt=array("xfr"=>"Transfer","ter"=>"terminate", "xtn"=>"Extension","cnv"=>"Convert to a Full Time","hir"=>"Hire","reh"=>"Rehire","all"=>"All");
   
 
?>
<br>
<p id='headtext'>Enter one or many filter to get a report</p>
<form name="reportform">

<div id="content">


<label for ='actopt'> Indicate the Type Of Transaction to show: </label>
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

<br><br>

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


<br><br>
<br><br>
<label class='infohead'> Other filters</label><br><br>
<label for='legal'>Legal Entity: </label>
<input type='text' placeholder='Legal Entity' id='legal' size='40' />
&nbsp;&nbsp;&nbsp;
<label for='dept'>Department: </label>
<input type='text' placeholder='Department' id='dept' /> 


<br>
 
<br>
<label for='vp'>VP: </label>
<input type='text' placeholder='VP' id='vp' />
<input type='hidden' id='vpid' />  



<label for='finance'>Finance: </label>
<input type='text' placeholder='Finance' id='finance'  />



<br><br>
<fieldset class='hr'><br>
<!--
<label for='reqnum'>Requisition Number:</label>
<input type='text' placeholder='Requsitin Number' id='reqnum' />
-->
<label for='manager'>Manager:</label>
<input type='text' placeholder='Supervisor' id='manager' />
<input type='hidden' id='bossid'   /> &nbsp;&nbsp;&nbsp;
<label for='hr'>HR Contact: </label>
<input type='text' placeholder='HR Contact' id='hr' />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<label for='location'>Location:</label>

<input type='text' placeholder='Work Place Location' id='location' />
<input type='hidden'  id='hrid' /> 
<br><br><br>
<label class='infohead'> Select the Columns to display</label><br><br>
<br>
<!--<input type='checkbox' id='fname' value='first name'> First Name &nbsp;&nbsp;&nbsp;
<input type='checkbox' id='lname' value='last name'> Last Name &nbsp;&nbsp;&nbsp;-->
 <input type='checkbox' id='Legal_Entity' value='Legal_Entity'> Legal Entity &nbsp;&nbsp;&nbsp;
<input type='checkbox' id='dept' value='department'> Department &nbsp;&nbsp;&nbsp;
<input type='checkbox' id='location' value='location'> Location &nbsp;&nbsp;&nbsp;
<input type='checkbox' id='finance' value='finance'> Finance&nbsp;&nbsp;&nbsp;
<input type='checkbox' id='vp' value='VP'> VP &nbsp;&nbsp;&nbsp;
<input type='checkbox' id='btitle' value='business_title'> Business  Title &nbsp;&nbsp;&nbsp;
<br>
<input type='checkbox' id='hr_contact' value='Hr_Contact'> HR Contact &nbsp;&nbsp;&nbsp;
<input type='checkbox' id='supervisor' value='supervisor'> Supervisor &nbsp;&nbsp;&nbsp;
<input type='checkbox' id='business_phone' value='Business_Phone'> Work Phone &nbsp;&nbsp;&nbsp;
<input type='checkbox' id='financial_org' value='financial_org'> Financial Org&nbsp;&nbsp;&nbsp;
<input type='checkbox' id='req_num' value='Requisition_Number'> Requisition Number&nbsp;&nbsp;&nbsp;
<input type='checkbox' id='comments' value='comments'> Comments &nbsp;&nbsp;&nbsp;
<br>
<!--<input type='checkbox' id='type' value='type'> Type &nbsp;&nbsp;&nbsp;-->
<input type='checkbox' id='classification' value='classification'> Classification &nbsp;&nbsp;&nbsp;
<br>
<br><input type='submit' id='updt' value='Display' align='center'/>  

<input type="hidden" name="lookupid" id="lookupid" /><br>
</div>
<span id="results">

</span>

<div id='success'><input type="button" class="button" id="srch" value="Change Search" /> </div>
<div id='errors'></div>
</form>

</body>
</html>