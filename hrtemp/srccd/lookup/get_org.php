 
<?php

  // require_once "../../includes/html_table.class.php";
 require_once "../../dataconn/config.php";
  if(isset($_GET['emplid'])){
    //build the query, do your mysql stuff
    $sql = "SELECT ceo CEO,evp EVP,level3,level4,level5,level6,level7,level8,level9,level10 FROM hr_mgmt_lvl WHERE emplid = '". $_GET['emplid'] ."'";
    // $sql = "SELECT ceo,evp,level3,level4,level5,level6,level7,level8,level9,level10 FROM hr_mgmt_lvl WHERE emplid = '003333'";
    //$query=mysql_query(sprintf("SELECT ceo,evp,level3,level4,level5,level6,level7,level8,level9,level10 FROM hr_mgmt_lvl WHERE emplid = %d", $_POST['emplid'] ."'";
   $rsq = mysql_query($sql);

if (!$rsq) {
    die("Query to show fields from table failed");
}
?>
<form><style>form{font-family:Verdana,Arial;font-size:x-small;}</style>
     <?php

    while($rs = mysql_fetch_array($rsq,MYSQL_ASSOC)) {
        foreach ($rs as $key=>$value){
            if ($value >' '){
            echo $key . '-->'. $value."\n"."<br>" ;
            echo "<br>";
            }
    }
}
    ?>
</form>
    <?php 
       mysql_close($conn);
    }
 ?>


    
                    
    