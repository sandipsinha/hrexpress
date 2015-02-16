<head>
<title>HR Temp Tool - Add Data</title>
 
<!--<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">-->
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
<script type='text/javascript' src='../../scripts/CheckValidForm_mail.js'></script>
<script type='text/javascript' src='../../scripts/prepare_mail.js'></script>
<script type='text/javascript' src='../../scripts/mail_edit.js'></script>


<link rel="stylesheet" type="text/css" href="../../template/newstyle.css"  />
<link rel="stylesheet" type="text/css" href="../../template/menu.style.css">
<script type="text/javascript">

$().ready(function() {
      
       $('#orglvl').hover( function(){
           $('#orglvl').append('<p>Click here to see the Organization hierarchy</p>');
           },
        function(){
           $('#orglvl').find("p:last").remove();
           });
       var orgstr = 'Organization Hierarchy for ' + $('#fname').val();
       //$('#orglvl').hover(function(){$('#orglvl').attr('value','Click here to see the Org Chart')},function(){$('#addbtn').attr('value','Add')});
       $('#popup').dialog({autoOpen:false,modal:true,modal:true,
            minHeight:'300px',
            minWidth:'500px',
            title:orgstr});
       $('#orglvl').click(function(e){
                   $.ajax({
                url:"../lookup/get_org.php",
                type:"GET",
                data:({emplid:$('#bossid').val()}),
                success: function(data)
                 {
                    $('#popup').html(data);
                    $('#popup').dialog('open');
                 }
            });
           })
             
           
              //Go back to the search page
            $('#srch').click(function(){
                 document.location = '../../srccd/dbrtn/pick_ee.php';
                     });  

                   
                //Go back to the add page
            $('#addnew').click(function(){
                 document.location = '../../srccd/dbrtn/ee_data_mail.php';
                     });           
                     
                     
            $('#updt').click(function(e){
                e.preventDefault();
                if (CheckValidForm())
                {  
                    if (ProcessInput())
                       {
                        
                        $('#success').show();
                        $("#errors").slideUp();
                        }
                    else
                      {
                          
                        $("#errors").show();
                       }
                }
                else
                        {
                           $("#errors").show();
                        }
                
                });
        //**field change events
        //Start of Remote checkbox
        var remote = $('#rmt').val();
        $('#remote').change(function(){
          if ($('#remote:checked').val() == 'Y'){
                 $('#rmt').val('Y');
                
            }
            else
            {
                remote = 'N';
                $('#rmt').val('N');
                
             }
        }) 
 
         
              });
  
    /**************ENd Of field Change    */
        
  </script>     
</head>
<body>
<img src='/images/logo.png'/ alt=”Logo” width="190" height="100">
<div class="formarea">
<div id='container'>
<form>

<ul id="van-one" class="van"> 
<!--<style type="text/css">
   .van-one{color:white}
    </style>-->

<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/read_ee.php">Temp/Reg Lookup</a>
</li>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/eegrid.php">Reports</a>
</li>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/read_vndr.php">Manage Vendors</a>
</li>
<li>
<a href="http://hrexpress.polycom.com">Home Page</a>
</li>
</ul>
<br clear="all" />
<hr>
 <br>
 <h2>HR Temp Tool - Maintain Data </h2>
<?php
 session_start();
 
 require_once "../../dataconn/config.php";
 require_once "rolechk.php";

  
   $tempid = '';
   
     $type=array("C"=>"Consultant/Vendors","F"=>"Fixed Term Contractors","T"=>"Temporary Contractor","W"=>"Temporary Worker" ,"O"=>"Other" );
  
   $empType=array("Short Term"=>"Short Term", "Structural"=>"Structural","Full Term"=>"Full Term", "Project"=>"Project","Interim"=>"Interim","Special"=>"Special", "Intermittent"=>"Interimittent");
   
   $rsnopt=array("LOA"=>"LOA","Short"=>"Short","Seasonal"=>"Seasonal", "Project"=>"Project","Replace"=>"Replace","Add"=>"Add","Other"=>"Other");

   
   if (isset($_POST['id']))
     {
        $tempid = $_POST['id'];
    
     if ($_REQUEST['ind'] != 'Y')
          {
           $sql = "select a.id id, a.Effective_Date effdt,concat(a.Last_Name,' ,',a.First_Name) name,a.Work_Email busn_email,a.Requisition_Number req_num,
           a.Business_Title bus_title,a.location,a.Department dept,a.supervisor,a.It_End_Date it_end_date ,a.finance,a.hr_contact,a.hr_id,
           a.Business_Phone busn_phone,a.legal_entity legal,a.comments,a.mgr_email,a.financial_org finorg,a.action_type,a.action_descr,a.hr_email from temp_360_vw a where a.id = ". $tempid  ;
            }
  else  
            {
            $sql = "select a.emplid id, a.effdt,a.name,a.bus_title, a.location,a.dept,a.emplid,a.busn_email, a.supervisor mgr_id,a.mgr_name supervisor,a.mgr_email,a.legal_entity legal, a.busn_phone,
            a.req_num,a.action action_type,a.financial_org finorg,a.division finance from emp_current_vw a where a.emplid = '". $tempid."'" ;
            }
//$sql = "select * from temp_360_vw  where id = ". $tempid ;

$rsq = mysql_query($sql);
if (!$rsq) {
    die("Query to show fields from table failed");
}
$row = mysql_fetch_assoc($rsq);
 }
?>
<div>
<form name="user_form">
<div class="subfieldsset">
<div>
 <label>Employee ?</label>
<input type='checkbox' id='empind' name='empind' value='Y'>  
<?php if ($_REQUEST['wrktyp'] != 'Y')  {?>
<label for ='actopt'>Current Action: </label>
<select id='actopt'> 
<?php  $dat = '';
            if ($_REQUEST['ind'] == 'Y'){
             switch($row['action_type'] ){
                 case "HIR":
                      $dat = 'hir';
                      break;
                case "XFR":
                      $dat = 'xfr';
                      break; 
                 case 'hir':
                 case 'reh':
                 case 'xfr':
                 case 'xtn':
                 case 'ter':
                 case 'cnv':
                      $dat = $row['action_type'] ;
                 default:     
                      $dat = 'dta';
                      break;
                      }
                      };
             
             $actopt=array("hir"=>"Hire","xfr"=>"Transfer","ter"=>"Terminate", "xtn"=>"Extension","cnv"=>"Convert to Regular","dta"=>"Data Change");
             foreach ($actopt as $opt=>$data)
                 {   
                         if ($opt==$dat ){
                            echo '<option selected value='. $opt.'>' . $data .'</option>';}
                        else {
                            echo  '<option value='. $opt.'>' . $data .'</option>';
                            }
                   }
                    

 } ?>

</select>
<label for ='ttype' ><img src="../../images/star.png" alt=""> Temp Type: </label>
<select id='ttype'>  

<?php
foreach ($type as $opt=>$data)
                   {   
                         if ($opt==$row['type']){
                            echo '<option selected value='. $opt.'>' . $data .'</option>';}
                        else {
                            echo  '<option value='. $opt.'>' . $data .'</option>';}
                    }
 ?>                   
</select>
<br>
 <div>
 
 <br>
 <label for ='name' ><img src="../../images/star.png" alt="">Name:</label>
<input type = 'text' placeholder='Enter Name' id='name'  required value="<?php echo (htmlspecialchars($row['name'])); ?>"  />  
<label for='effdt' id='leffdt'><img src="../../images/star.png" alt="">Effective Date: </label>
<input type='date' placeholder='Start Date' id='effdt' required value="<?php echo (htmlspecialchars( $row['effdt'] ));?>"/><br>
 <label> </label><span id='names'>Name format: Last, First Name</span>
</div>
<br>
 <span class='note'> Contact Details</span>
<div id='contact_grp'>
 
 <label for='wphone'>Phone(Business): </label>
<input type='text' placeholder='Work Phone' id='wphone' required value="<?php echo (htmlspecialchars( $row['busn_phone'] )); ?>"/>


<label for='wemail'>Email(Business): </label>
<input type='email' placeholder='Work Email' id='wemail' size='40' required value="<?php echo (htmlspecialchars( $row['busn_email'] )); ?>"/>

</div>
<br>
 <span class='note' id='job'> Job Details</span>
<div>


<label for='btitle'>Business Title: </label><input type='text' placeholder='Business Title' id='btitle' value="<?php echo (htmlspecialchars( $row['bus_title'] )); ?>"/>


<label for='manager'><img src="../../images/star.png" alt="">Manager:</label>
<input type='text' required placeholder='Supervisor' id='mgr' value="<?php echo (htmlspecialchars( $row['supervisor'] )); ?>"/>
<input type='hidden'  id='mgr_mail'   value="<?php echo (htmlspecialchars( $row['mgr_email'] )); ?>" />
<?php if (isset($_REQUEST['id'])){?>

<img id="orglvl" src="../../images/org_level.jpg" alt="">
<div id="popup" ></div>
<?php } ?>
<br>

<label for='legal'><img src="../../images/star.png" alt="">Legal Entity: </label>
<input type='text' placeholder='Legal Entity' id='legal' required  value="<?php echo (htmlspecialchars( $row['legal'] )); ?>" />
<input type='hidden'  id='act_type'   size='40'value="<?php echo (htmlspecialchars( $row['action_type'] )); ?>" />
<input type='hidden'  id='act_descr'   size='40'value="<?php echo (htmlspecialchars( $row['action_descr'] )); ?>" />

<label for='location'><img src="../../images/star.png" alt="">Location:</label>
<input type='text' placeholder='Work Place Location' id='location' required value="<?php echo (htmlspecialchars( $row['location'] )); ?>"/> 
<?php if ($_REQUEST['ind'] != 'Y') { ?>
<label for='remote'>Remote ? :</label>
<input type='checkbox' id='remote' name='remote' value='Y'> 
<?php } ?>
</div>
 
<div id='org'>
<span class='note' id='org'> Organization Details</span>
<br>
<label for='dept'><img src="../../images/star.png" alt="">Department: </label>
<input type='text' placeholder='Department' id='dept' required value="<?php echo (htmlspecialchars( $row['dept'] )); ?>" /> 
<input type='hidden'  id='dept_h'   value="<?php echo (htmlspecialchars( $row['dept'] )); ?>" /> 
 <label for='finance'><img src="../../images/star.png" alt="">Finance Division: </label>
<input type='text' placeholder='Finance' id='finance'  value="<?php echo (htmlspecialchars( $row['finance'] )); ?>"/>
 <label for='finorg'><img src="../../images/star.png" alt="">Financial Org: </label>
<input type='text' placeholder='Financial Org' id='finorg'  value="<?php echo (htmlspecialchars( $row['finorg'] )); ?>"/>
</div>
 
<div id='hris'>
<span class='note'>HR Details</span><br>

<label for='hr'><img src="../../images/star.png" alt="">HR Contact: </label>
<input type='text' placeholder='HR Contact' id='hr' required value="<?php echo (htmlspecialchars( $row['hr_contact'] )); ?>"/>
<input type='hidden'  id='hrmail' required value="<?php echo (htmlspecialchars( $row['hr_email'] )); ?>"/>

<label for='reqnum'>Requisition Number:</label>
<input type='text' placeholder='Requsitin Number' id='reqnum' value="<?php echo (htmlspecialchars( $row['req_num'] )); ?>"/>
 
<label for='it_end_dt' id='end_dt'><img src="../../images/star.png" alt="" id='star'>IT End Date:</label>
<input type='date' placeholder='Enter a end date of the contract' id='it_end_dt' value="<?php echo (htmlspecialchars( $row['it_end_date'] )); ?>"/>
  


</div>

<div id='emplid'>

<label for='empid' >Employee Id : </label>
<input type='text' name='empid' id='empid' value="<?php echo (htmlspecialchars( $row['id'] )); ?>"/> 
 <input type='hidden' name='emptyp' id='emptyp' value="<?php echo $_REQUEST['ind'] ; ?>"/>
</div>
 
<div>


<br>
<div>
<label for='comments'>Comments: </label><textarea rows='3' cols='70' id='comments' ><?php echo ( $row['comments'] ); ?> </textarea>  

 
<br><br><label>Select Mail Recipients: </label>

<?php
   mysql_free_result($rsq);
   $mailsql = "select mailid,Name from mailist";
   $result = mysql_query($mailsql);
   
   ?>
<select name="mailist" id="mailist" multiple="multiple"  >
       	<?php while ($rows=mysql_fetch_assoc($result)){
       		echo  '<option value='. $rows['mailid'] .'>' . $rows['Name']  .'</option>'; 
    	  } ?>
</select>
</div>

<br><br>
<br><input type='submit' id='updt' value='Send Mail' align='center'/>  
<input type="button" name="addbtn" class="button" id="srch" value="Back to Search" /> 
<br> 
			<input type="hidden" name="lookupid" id="lookupid" /><br>

<div id='msg'></div>
</div>
 </form>
 <div>
<div id='success'></div>
<div class='error' id='errors'></div>
 </div>



</body>
</html>


