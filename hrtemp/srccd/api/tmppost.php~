<?php

             $data = $_POST['content'];
  $fname = $data['fname'];
  $fname = $data['lname'];
  require_once "../../dataconn/config.php";
  $stmt_sql = "insert into consultants(first_name,last_name) values (\"". $fname ."\",\"".$fname."\")" ;
  $result = mysql_query($stmt_sql);
  $temp_id = mysql_insert_id(); 
  if(mysql_num_rows($result)){
      
      header('201 Created',true,201);
      header('Location: http://hrexpress.polycom.com');
      return $fname;
      }
      else
      {
             header('Not Found',true,404);
             header('Location: http://hrexpress.polycom.com');
             return $fname;
          }

  ?>