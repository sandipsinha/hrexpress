<?php
  //require_once "../../dataconn/config.php";
  session_start();
  if (isset($_SESSION['emplid'])) {
      //exit();
      /*if ($_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'] == $_SESSION['emplid']){
         if (isset($_SESSION['hr'])){
             //exit();
             }
          else
            { 
             $_SESSION['emplid'] = $_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'];
            $sql = "select a.dept,x.hr,x.manager,a.busn_phone,a.busn_email from employees a left join profile x on a.emplid = x.emplid where a.emplid = '". $_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'] .
            "'  and a.effdt=(select max(b.effdt) from employees b where a.emplid = b.emplid) and a.effseq =(select max(b.effseq) from employees b where a.emplid = b.emplid and a.effdt = b.effdt)  ";
            $rsq = mysql_query($sql);
            $row = mysql_fetch_assoc($rsq);
            if ($row['hr'] == 'Y'){ 
                $_SESSION['hr'] = 'Y';
                }
            else
            {
               $_SESSION['hr'] = 'N';
              header('Location: ../../index.php');
            } 
            }
            }
            else
            {
                $_SESSION['emplid'] = $_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'];
            $sql = "select a.dept,x.hr,x.manager,a.busn_phone,a.busn_email from employees a left join profile x on a.emplid = x.emplid where a.emplid = '". $_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'] .
            "'  and a.effdt=(select max(b.effdt) from employees b where a.emplid = b.emplid) and a.effseq =(select max(b.effseq) from employees b where a.emplid = b.emplid and a.effdt = b.effdt)  ";
            $rsq = mysql_query($sql);
            $row = mysql_fetch_assoc($rsq);
            if ($row['hr'] == 'Y'){ 
                $_SESSION['hr'] = 'Y';
                //exit();
                }
            else
            {
               $_SESSION['hr'] = 'N';
              // echo 'Should be mobing back 3 last';
               header('Location: ../../index.php');
            } 
              }
            */
     }
            else
            {
            $_SESSION['emplid'] = $_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'];
            $sql = "select a.dept,x.hr,x.manager,a.busn_phone,a.busn_email from employees a left join profile x on a.emplid = x.emplid where a.emplid = '". $_SERVER ['AUTHENTICATE_EMPLOYEENUMBER'] .
            "'  and a.effdt=(select max(b.effdt) from employees b where a.emplid = b.emplid) and a.effseq =(select max(b.effseq) from employees b where a.emplid = b.emplid and a.effdt = b.effdt)  ";
            $rsq = mysql_query($sql);
            $row = mysql_fetch_assoc($rsq);
            if ($row['hr'] == 'Y'){ 
                $_SESSION['hr'] = 'Y';
                //exit();
                }
            else
            {
               $_SESSION['hr'] = 'N';
               header('Location: ../../index.php');
            }  
              }  
              