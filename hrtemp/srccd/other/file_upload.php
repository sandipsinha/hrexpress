<head>
<title>HR Temp Tool - Upload Data</title>
 
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../template/menu.style.css">
<link rel="stylesheet" type="text/css" href="../../template/newstyle.css"  />
<script type="text/javascript">
$().ready(function() {
		 
        
     
        
  </script>
</head>
<body>
<ul id="van-one" class="van"> 
<!--<style type="text/css">
   .van-one{color:white}
    </style>-->

<li>
<a href="http://hrexpress.polycom.com">Home Page</a>
</li>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/read_ee.php">Temp\Reg Lookup</a>
</li>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/eegrid.php">Reports</a>
</li>
</ul>
<br clear="all" />
<hr>
 <br>
 
 <div class="formarea">    
<form enctype="multipart/form-data" action="../misc/upload_file.php" method="POST" name="user_form">
<br>
 <h2>HR Temp Tool - Upload Data</h2>
<div class="subfieldsset">
<div>
<!--form id="myform" enctype="multipart/form-data" autocomplete="off">
<form id="myform"  enctype="multipart/form-data" action="" method="POST">-->

<label for ='dtype' > Type Of Upload: </label>
 <select name="dtype">
<option value="dbns">Discretionary Bonus</option>
<option value="vbns">Variable Bonus</option>
<option value="depup">Department Upload</option>
<option value="tmass">Mass Terms</option>
<option value="Stock">Stock Upload</option>
<option value="rvwu">Performance Review</option>
<option value="focal">Annual Focal Merrit</option>
<option value="cjcu">Custom Job Code , Salary Plan, Grade Upload</option>
</select>
 
</div>
<br>
<div>
<label for ='file' >  Please choose a file:  </label>
<input id="file" type="file" name="file" /><br />
</div>
<br><div>
<input type="submit" name="upldbtn" class="button" id="upldbtn" value="Upload" />
</div><br>
 <div id="results">
<?php if (isset($_REQUEST['msg'])) {
    echo $_REQUEST['msg'];
    }
    ?>
</div>
</div>
 </form> 
 </div>
 </body>
