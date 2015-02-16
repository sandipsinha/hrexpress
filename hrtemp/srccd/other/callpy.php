<!DOCTYPE html>  
<meta charset="UTF-8"><head>
<title>HR Temp Tool - Add Data</title>
<body>
<h4>HR Data Upload Automation</h4>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../template/jquery.autocomplete.css"  />
<script type="text/javascript">
$().ready(function() {
   
 var optSelect={
       "Stock":"Stock Data Upload",
       "Dsbns":"Discretionary Bonus",
       "Var":"Variable Pay Data"
       }
         $.each(optSelect,function(key,value){
            $('#dtype').append($('<option>',{value:key}).text(value));
            });
            })
</script>
</body>
</html>


<form enctype="multipart/form-data" action="upload_file.php" method="POST">
<label for ='dtype'> Indicate the Type of Upload: </label>
<select id='dtype' name='dtype'></select><br><br>
 Please choose a file: <input name="uploaded" type="file" /><br /><br /><br />
 <input type="submit" value="Upload" />
 </form> 



