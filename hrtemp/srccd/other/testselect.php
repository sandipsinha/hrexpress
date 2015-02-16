<!DOCTYPE html>  
<meta charset="UTF-8"><head>
<title>HR Temp Tool - Add Data</title>

<h4>HR Temp Tool - Add Data</h4>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../template/jquery.autocomplete.css"  />
<script type='text/javascript' src="../../scripts/jquery.autocomplete.js"></script>
<script type="text/javascript">
$().ready(function() {
       var rsnopt={
       "loa":"LOA",
       "Short":"Short",
        "Seasonal":"Seasonal",
       "Project":"Project",
        "Replace":"Replace",
        "Add":"Add",
       "Other:"Other"
       }
       $.each(rsnopt,function(key,value){
            $('#rsntype').append($('<option>',{value:key}).text(value));
            });
            
        })


           
           
</script>

</head>
<body>
<?php
echo "<label for='rsntype'>Reason Of Hire: </label><select id='rsntype'></select> &nbsp;&nbsp;&nbsp;";

?>
</body>
</html>