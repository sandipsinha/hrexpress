<?php
 $target  = "/home/sandip/phpproj/hrtemp/upload/"; // Directory for file storing
                                            // filesystem path


$web_upload_dir = "/upload";

$tf =  $target.'/'.md5(rand()).".test";
$f = @fopen($tf, "w");
if ($f == false) {
    echo "Fatal error! {$upload_dir} is not writable. Set 'chmod 777 {$upload_dir}'
        or something like this";
      die(); } 
fclose($f);
unlink($tf);
$fname= $_FILES['uploaded']['name'];
echo 'The uploaded file is ' . $fname;
exit();
//$fdtl = $target.$fname.'  '.$_POST['dtype'] ;
$fdtl = $target.$fname;
 $target = $target .basename( $_FILES['uploaded']['name']) ; 
 $ok=1; 
 if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) 
 {
  switch($_POST["datastring"]){
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
        case 'rvwu':
          $stmt = 'python /home/sandip/python_code/perf_upld.py '. $fdtl;
          break;  
        case 'focal':
          $stmt = 'python /home/sandip/python_code/upld_foc.py '. $fdtl;
          break; 
          }
      exec($stmt,$retval);
  echo 'The program returned ' . $retval;
 } 
 else {
 echo "Sorry, there was a problem uploading your file.";
 }

/*$stmt = 'python ../pythcd/upld_stk.py '. $fdtl;
echo exec($stmt);*/
 ?> 