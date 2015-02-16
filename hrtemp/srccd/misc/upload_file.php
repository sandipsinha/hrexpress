<?php
$upload_dir = "/home/sandip/phpproj/hrtemp/upload"; // Directory for file storing
                                            // filesystem path


$web_upload_dir = "/upload";

$tf = $upload_dir.'/'.md5(rand()).".test";
$f = @fopen($tf, "w");
if ($f == false) 
    die("Fatal error! {$upload_dir} is not writable. Set 'chmod 777 {$upload_dir}'
        or something like this");
fclose($f);
unlink($tf);

if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
  echo "Type: " . $_FILES["file"]["type"] . "<br />";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
  echo "Stored in: " . $_FILES["file"]["tmp_name"]."<br />";
  if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES['file']['tmp_name'],
      $upload_dir.'/' . $_FILES["file"]["name"]);
      //echo "Stored in: " . $upload_dir.'/'  . $_FILES["file"]["name"];
      $result = 1;
      }
  }
   $fdtl = $upload_dir.'/' . $_FILES["file"]["name"];
switch($_POST["dtype"]){
      case 'Stock':
          $stmt = 'python /home/sandip/python_code/upld_stk.py '. $fdtl;
          break;
      case 'vbns':
          $stmt = 'python /home/sandip/python_code/upld_pol_var_pymnt.py '. $fdtl;
          break;
      case 'depup':
          $stmt = 'python /home/sandip/python_code/upld_dept.py '. $fdtl;
          break;
       case 'tmass':
          $stmt = 'python /home/sandip/python_code/term_upld.py '. $fdtl;
          break;
      case 'cjcu':
          $stmt = 'python /home/sandip/python_code/custom_jc.py '. $fdtl;
          break;
       case 'focal':
          $stmt = 'python /home/sandip/python_code/upld_foc.py '. $fdtl;
          break;
          }
      exec($stmt,$retval);
  foreach($retval as $key=>$value)
  {
  	$message= $value;
  	}  
header('Location: ../other/file_upload.php?msg='.$message);
 /*$command .= " $param1  2>&1";
 
 
echo "<body><pre>";
while( !feof( $pid ) )
{
 echo fread($pid, 256);
 flush();
 ob_flush();
 echo "<script>window.scrollTo(0,99999);</script>";
 usleep(100000);
}
pclose($pid);
 
echo "</pre><script>window.scrollTo(0,99999);</script>";
echo "<br /><br />Script finalizado<br /><br />";
  */
?>
<script language="javascript" type="text/javascript" src="./scripts/jsUpload.js"> stopUpload()(<?php echo $result; ?>);</script> 
