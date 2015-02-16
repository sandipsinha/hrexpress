<?php
 /*
 if (array_key_exists('params_',$_POST))
  {
   echo  'yES IT WORKS' . $_POST['params_'];
   }
   else
   {
       echo 'No it does not work';
    }*/
  include_once("connect_hrprod.php"); 
  include_once("chk_sql_srv.php"); 
  $conno = open_orcl();
  $entity_name = $_POST['params_'];
   
  /*set_time_limit(0);*/
  $text1 = '';
  $text2 = '';
  $in_loop = false;
  /*echo '<br>'. ' The name is ' . $entity_name;*/
// echo '<br>'. ' The name is ' . $entity_name;

  $sql_st = Get_sql_routine($entity_name);
  /*echo "<br>"."This is ". $sql_st . ' And the name is ' .  $sql_st ;*/
  
   $stmt = oci_parse($conno, $sql_st);
   oci_execute($stmt);
 
  $nrows = oci_fetch_all($stmt, $results, null, null, OCI_NUM);
  $notfound = 0;
  $dptfnd = 0;
  $deptarr = array();
  $deptarr = flatten_array($results);
 
 
 Switch($entity_name)
  {
  case 'id':
  case 'il':
  case 'di':
  case 'ie':
      $in_loop = true;

     //var_dump($results);
  
     //var_dump($deptarr);
     //echo '<br>'.'The count is now ' . count($deptarr);
     $tablename = ($entity_name == 'id'?'Departments':($entity_name == 'di'?'Finance':($entity_name == 'ie'?'Employees':'Legal Entity')));
      //echo '<br>'.'The count is now ' . $tablename;
      
     $dptfnd = returncounts($tablename,$deptarr);
     /*echo '<br>'.var_dump($deptarr);*/
     /*
     echo "<table border='1'> 
     <tr> 
    <th>Results</th>  
    </tr>";
     
     if ($dptfnd > 0)
       { echo  "<tr><td> ". $nrows .' '. $tablename ." found in peoplesoft</td></tr>" ;
          echo "<tr><td>" .$dptfnd .' '. $tablename. " found in HRNotify  </td></tr>";
        }
     else 
        {echo  "<tr><td> ". $nrows . $tablename . " found in peoplesoft .</td></tr>" ;
         echo "<tr><td> Nothing found in the  HRNotify </td></tr>";
        }
     echo "</Table>";
 */
  /*$importantKeys = array($text1, $text2);
  return $importantKeys;*/
 break;
 case 'Dept_upd':
 case 'Div_upd':
 case 'Legal_upd':
      $in_loop = true;
     $tablename = ($entity_name == 'Dept_upd'?'Departments':($entity_name == 'Div_upd'?'Finance':'Legal Entity'));
     $dptfnd = chk_and_update($tablename,$deptarr);
     if ($dptfnd > 0)
        {$text1 =  ' Total '. $tablename .' found out of ' . $nrows  ;
         $text2 =   ' Total '. $tablename. ' departments updated '. $dptfnd ;
        }
     else
        {$text1 =   ' Total ' .$tablename .' read: '. $nrows  ;
         $text2 =  ' No '. $tablename . ' were updated ' ;
        }
 
 /*$importantKeys = array($text1, $text2);
 return $importantKeys;*/

 break;
 }
  if ($in_loop = true)
     {
      oci_free_statement($stmt);
      oci_close($conorcl);
     }



function flatten_array(array $values = array())
{
 $deptarr = array();
  foreach ($values as $col)
     {
      foreach ($col as $item)
        {
        $deptarr[] = $item;
        //echo '<br>'.' In chk_dept now ' . $item;
        }
       
     }

return $deptarr;
}
 

function Get_sql_routine($table_name)
{
  switch($table_name)
  {
   case 'id':
    $stmt = 'select deptid || \' - \' ||  descr from ps_dept_tbl A where A.setid = \'PLYCM\' AND A.EFFDT = (SELECT MAX(B.EFFDT) from ps_dept_tbl b where a.setid=b.setid and
      a.deptid = b.deptid) and a.eff_status = \'A\' AND EXISTS (SELECT \'X\' FROM PS_CURRENT_JOB C WHERE C.DEPTID = A.DEPTID AND C.EMPL_STATUS NOT IN (\'T\',\'U\')) and A.DEPTID like \'121%\'';
    break;
   case 'di':
    $stmt = 'select pol_fin_division || \' - \' ||  descr from ps_pol_fin_div_tbl A where  A.EFFDT = (SELECT MAX(B.EFFDT) from ps_pol_fin_div_tbl b where 
      a.pol_fin_division = b.pol_fin_division) and a.eff_status = \'A\'';
    break;
   case 'il':
    $stmt = 'select business_unit || \' - \' ||  descr from ps_pol_fin_bu_tbl A where A.business_unit like \'ILS%\'';
    /*$stmt = "select business_unit  from ps_pol_fin_bu_tbl A'';*/
    break;
   case 'ie':
    $stmt = 'select emplid  from ps_current_job A where A.empl_status not in (\'T\',\'U\') and a.emplid > \'009000\'';
    break;
   case 'Dept_upd':
    $stmt = 'select deptid || \' - \' ||  descr from ps_dept_tbl A where A.setid = \'PLYCM\' AND A.EFFDT = (SELECT MAX(B.EFFDT) from ps_dept_tbl b where a.setid=b.setid and
      a.deptid = b.deptid) and a.eff_status = \'A\' AND EXISTS (SELECT \'X\' FROM PS_CURRENT_JOB C WHERE C.DEPTID = A.DEPTID AND C.EMPL_STATUS NOT IN (\'T\',\'U\')) and A.DEPTID like \'1212%\'';
    break;
   case 'Div_upd':
    $stmt = 'select pol_fin_division || \' - \' ||  descr from ps_pol_fin_div_tbl A where  A.EFFDT = (SELECT MAX(B.EFFDT) from ps_pol_fin_div_tbl b where 
      a.pol_fin_division = b.pol_fin_division) and a.eff_status = \'A\'';
    break;
   case 'Legal_upd':
    $stmt = 'select business_unit || \' - \' ||  descr from ps_pol_fin_bu_tbl A where A.business_unit like \'ILS%\'';
    break;
   case 'Empl_upd':
    $stmt = 'select emplid from ps_job A where A.effdt = (select max(b.effdt) from ps_job b where a.emplid = b.emplid) and a.empl_status not in (\'T\',\'U\')';
    break;
  }
   return $stmt;
 }


  ?> 
  
