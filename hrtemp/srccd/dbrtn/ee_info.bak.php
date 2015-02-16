<head>
<title>HR Temp Tool - Add Data</title>
<h3>HR Temp Tool - Maintain Data</h3>
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
<script type='text/javascript' src='../../scripts/CheckValidForm.js'></script>
<script type='text/javascript' src='../../scripts/ProcessInput.js'></script>
<script type='text/javascript' src='../../scripts/jquery.ddedit.js'></script>
<script type='text/javascript' src='../../scripts/TypeChange.js'></script>
<script type='text/javascript' src='../../scripts/jquery.adjstwdth.js'></script>
<link rel="stylesheet" type="text/css" href="../../template/jquery.autocomplete.css"  />
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
            minWidth:'390px',
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
             
       //$('#actopt').trigger('change');
       TypeChange();
 
       $('#actopt').change(function()
          {
           FieldChange();
          });
     
           
              //Go back to the search page
            $('#srch').click(function(){
                 document.location = '../../srccd/dbrtn/read_ee.php';
                     });  

                   
                //Go back to the add page
            $('#addnew').click(function(){
                 document.location = '../../srccd/dbrtn/ee_info.php';
                     });           
                     
                //Go to the Vendor Details Page
            $('#vndr').click(function(){
                 document.location = '../../srccd/dbrtn/updt_vndr.php';
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
        $('#sendmail').change(function(){
          if ($('#sendmail:checked').val() == 'Y'){
                
                $('#mailist').className = "";
                $('#mailist').show();
                mailsel = 'Y';
            }
            else
            {
                mailsel = 'N';
                $('#mailist').className = "conv";
                $('#mailist').slideUp();

            }
        }) 
              });
  
    /**************ENd Of field Change    */
        
  </script>     
</head>
<body>
<form>
<div id="popup" ></div>
<ul id="van-one" class="van"> 
<!--<style type="text/css">
   .van-one{color:white}
    </style>-->

<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/read_ee.php">Temp Lookup</a>
</li>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/eegrid.php">Temp Grid</a>
</li>
<li>
<a href="http://hrexpress.polycom.com">Home Page</a>
</li>
</ul>
<br clear="all" />
<hr>
 <br>
<?php
 session_start();
 
 require_once "../../dataconn/config.php";
 require_once "rolechk.php";

  $type=array("C"=>"Consultant/Vendors","F"=>"Fixed Term Contractors","T"=>"Temporary Contractor","W"=>"Temporary Worker" ,"O"=>"Other" );
  
   $empType=array("Short Term"=>"Short Term", "Structural"=>"Structural","Full Term"=>"Full Term", "Project"=>"Project","Interim"=>"Interim","Special"=>"Special", "Intermittent"=>"Interimittent");
   
   $rsnopt=array("LOA"=>"LOA","Short"=>"Short","Seasonal"=>"Seasonal", "Project"=>"Project","Replace"=>"Replace","Add"=>"Add","Other"=>"Other");
   
   $tempid = '';
   

   
   if (isset($_REQUEST['id']))
     {
        $tempid = $_REQUEST['id'];
     }
   else
    {
        $tempid = $_SESSION['id'];
      }
   
if ($tempid > ''){
$sql = "select a.Id, date_format(a.effdt,'%m/%d/%Y') effdt,a.action_type,a.reason,a.last_name,a.first_name,type,a.classification,a.req_num,a.business_title,a.location,a.dept,a.emplid,a.busn_email,
a.supervisor,x.name,date_format(a.it_end_date,'%m/%d/%Y') it_end_date ,finance,a.hr_contact,y.name hr_name,a.busn_phone,a.legal_entity,a.comments,a.financial_org from consultants a 
left join emp_current_vw x  on a.supervisor = x.emplid 
left join emp_current_vw y on  a.hr_contact = y.emplid where id = ". $tempid  ." and a.effdt=(select max(b.effdt) from consultants b where a.id = b.id) ";


//$sql = "select * from temp_360_vw  where id = ". $tempid ;

$rsq = mysql_query($sql);
if (!$rsq) {
    die("Query to show fields from table failed");
}
$row = mysql_fetch_assoc($rsq);



if (($row['action_type'] == 'hir') || ($row['action_type'] == 'reh')  || ($row['action_type'] == 'xfr') || ($row['action_type'] == 'xtn'))
{
 $actopt=array("upd"=>"update","xfr"=>"Transfer","ter"=>"terminate", "xtn"=>"Extension","cnv"=>"Convert to Regular");
 }
 elseif ($row['action_type'] == 'ter')
 {
   $actopt=array("reh"=>"Rehire","upd"=>"Update"); 
  }
  else
 {
   $actopt=array("upd"=>"Update"); 
  }
}
else
{
$actopt=array("hir"=>"Hire");
}
?>

<form name="user_form">
<fieldset>
 <label for ='actopt' > Indicate the Type Of Update: </label>
<select id='actopt'> &nbsp;&nbsp;&nbsp;<br>
<?php
    foreach ($actopt as $opt=>$data)
                 {   
                         if ($opt=='upd'){
                            echo '<option selected value='. $opt.'>' . $data .'</option>';}
                        else {
                            echo  '<option value='. $opt.'>' . $data .'</option>';
                            }
                    }
?>
</select>
&nbsp;&nbsp;&nbsp;
<label>Current Status: </label>
<span>
<?php switch ($row['action_type']){
            case 'hir':
              echo 'Hired  ' ;
              break;
            case 'reh':
              echo 'Rehired  ' ;
              break;
            case 'xfr':
              echo 'Job change  ' ;
              break;
           case 'xtn':
              echo 'Extension  ' ;
              break;
            case 'ter':
              echo 'Terminated  ' ;
              break;
            case 'cnv':
              echo 'Converted to Full Timer' ;
              break;
            }?>
</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
<label for='effdt' >Effective Date: </label>
<input type='date' placeholder='Start Date' id='effdt' required value="<?php echo (htmlspecialchars( $row['effdt'] ));?>"/>
&nbsp;&nbsp;&nbsp;

<br><br>
 <label for='rsntype'>Action Reason: </label>
<select id='rsntype'>  &nbsp;&nbsp;&nbsp;
<?php
foreach ($rsnopt as $opt=>$data)
                   {   
                        if ($opt==$row['classification']){
                            echo '<option selected value='. $opt.'>' . $data .'</option>';}
                        else {
                            echo  '<option value='. $opt.'>' . $data .'</option>';}
                    }
 ?> 
</select>&nbsp;&nbsp;&nbsp;
<label for ='classi'> Classification: </label><select id='classi'>
<?php
foreach ($empType as $opt=>$data)
                   {   
                        if ($opt==$row['classification']){
                            echo '<option selected value='. $opt.'>' . $data .'</option>';}
                        else {
                            echo  '<option value='. $opt.'>' . $data .'</option>';}
                    }
 ?>                       
</select>&nbsp;&nbsp;&nbsp;
<label for ='ttype' > Temp Type: </label>
<select id='ttype'> &nbsp;&nbsp;&nbsp;

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
</fieldset>
 <br><br>
<label for ='fname' >First Name:</label>
<input type = 'text' placeholder='Enter First Name' id='fname'  required value="<?php echo (htmlspecialchars($row['first_name'])); ?>"  /> &nbsp;&nbsp;&nbsp;
<label for ='lname'>Last Name: &nbsp;</label>
<input type = 'text' placeholder='Enter Last Name' id='lname' required value="<?php echo (htmlspecialchars($row['last_name'])); ?>" /> 
<br><br>
<br>
<fieldset class='contact'>
<label class='infohead'> Contact Details</label><br><br>
<br>

<label for='wphone'>Phone(Business): </label>
<input type='text' placeholder='Work Phone' id='wphone' required value="<?php echo (htmlspecialchars( $row['busn_phone'] )); ?>"/>
<input type='hidden' id='wphone_h' value="<?php echo (htmlspecialchars( $row['busn_phone'] )); ?>"/>

<label for='wemail'>Email(Business): </label>
<input type='email' placeholder='Work Email' id='wemail' required value="<?php echo (htmlspecialchars( $row['busn_email'] )); ?>"/>
<input type='hidden' id='wemail_h' value="<?php echo (htmlspecialchars( $row['busn_email'] )); ?>"/>
</fieldset>
<br><br>
<fieldset class='job'>
<label class='infohead'> Job Details</label>
<br><br><br>
<label for='btitle'>Business Title: </label><input type='text' placeholder='Business Title' id='btitle' value="<?php echo (htmlspecialchars( $row['business_title'] )); ?>"/>
<input type='hidden' id='btitle_h'  value="<?php echo (htmlspecialchars( $row['business_title'] )); ?>"/>
&nbsp;&nbsp;&nbsp;
<label for='manager'>Manager:</label><input type='text' required placeholder='Supervisor' id='manager' value="<?php echo (htmlspecialchars( $row['name'] )); ?>"/>
<img id="orglvl" src="../../images/org_level.jpg" alt="">
<input type='hidden' id='boss_h'   value="<?php echo (htmlspecialchars( $row['supervisor'] )); ?>"/>
<input type='hidden' id='bossid' value="<?php echo (htmlspecialchars( $row['supervisor'] )); ?>" /> &nbsp;&nbsp;&nbsp;
<br><br>
<label for='dept'>Department: </label>
<input type='text' placeholder='Department' id='dept' required value="<?php echo (htmlspecialchars( $row['dept'] )); ?>" /> 
<input type='hidden'  id='dept_h'   value="<?php echo (htmlspecialchars( $row['dept'] )); ?>" /> 
&nbsp;&nbsp;&nbsp;
<label for='legal'>Legal Entity: </label>
<input type='text' placeholder='Legal Entity' id='legal' required size='40'value="<?php echo (htmlspecialchars( $row['legal_entity'] )); ?>" />
<input type='hidden'  id='legal_h'   size='40'value="<?php echo (htmlspecialchars( $row['legal_entity'] )); ?>" />
<br><br>
<label for='location'>Location:</label>
<input type='text' placeholder='Work Place Location' id='location' required value="<?php echo (htmlspecialchars( $row['location'] )); ?>"/>
<br>
</fieldset>
<br><br>
<fieldset class='org'>
<label class='infohead'> Organization Details</label><br><br><br>
<!--<label for='vp'>EVP: </label>
<input type='text' placeholder='VP' id='vp' required value="<?php echo (htmlspecialchars( $row['VP_name'] )); ?>"/>
 &nbsp;&nbsp;&nbsp;-->

<label for='finance'>Finance: </label>
<input type='text' placeholder='Finance' id='finance'  value="<?php echo (htmlspecialchars( $row['finance'] )); ?>"/>
<input type='hidden'  id='finance_h'  value="<?php echo (htmlspecialchars( $row['finance'] )); ?>"/>&nbsp;&nbsp;&nbsp;
<label for='finorg'>Financial Org: </label>
<input type='text' placeholder='Enter a financial Org' id='finorg'  value="<?php echo (htmlspecialchars( $row['financial_org'] )); ?>"/>
<input type='hidden'  id='finorg_h'  value="<?php echo (htmlspecialchars( $row['financial_org'] )); ?>"/>
</fieldset>
<br><br>
<fieldset class='hr'>
<label class='infohead'>HR Details</label><br><br><br>
<label for='hr'>HR Contact: </label>
<input type='text' placeholder='HR Contact' id='hr' required value="<?php echo (htmlspecialchars( $row['hr_name'] )); ?>"/>
&nbsp;&nbsp;&nbsp;
<label for='reqnum'>Requisition Number:</label>
<input type='text' placeholder='Requsitin Number' id='reqnum' value="<?php echo (htmlspecialchars( $row['req_num'] )); ?>"/>
<input type='hidden'  id='reqnum_h' value="<?php echo (htmlspecialchars( $row['req_num'] )); ?>"/>

<input type='hidden'  id='hrid' value="<?php echo (htmlspecialchars( $row['hr_contact'] )); ?>" /> 
<input type='hidden'  id='hrid_h' value="<?php echo (htmlspecialchars( $row['hr_contact'] )); ?>" /> </fieldset>
<fieldset class='emplid'>
<br>
<label for='empid' >Employee Id : </label>
<input type='text' name='empid' id='empid' value="<?php echo (htmlspecialchars( $row['emplid'] )); ?>"/> 
<br><br>
</fieldset>
<br>
<label for='it_end_dt'>Planned Exit:</label>
<input type='date' placeholder='Enter a end date of the contract' id='it_end_dt' value="<?php echo (htmlspecialchars( $row['it_end_date'] )); ?>"/>
<input type='button'  id='vndr' value="Vendor Details"/>
<input type='hidden'  id='it_end_dt_h' value="<?php echo (htmlspecialchars( $row['it_end_date'] )); ?>"/>
</fieldset>
<br><br>
<label for='comments'>Comments: </label><textarea rows='3' cols='70' id='comments' ><?php echo ( $row['comments'] ); ?> </textarea> &nbsp;&nbsp;&nbsp;
<br><br> <br>
<!---All the hidden fields-->
<input type='hidden' id='type_h' value="<?php echo (htmlspecialchars( $row['type'])) ; ?>" />
<input type='hidden' id='ids' value="<?php echo $tempid  ; ?>" />
<input type='hidden' id='effdt_h'  value="<?php echo (htmlspecialchars( $row['effdt'] )); ?>"/>
<input type='hidden' id='classi_h'  value="<?php echo (htmlspecialchars( $row['classification'] )); ?>"/>	
<input type='hidden' id='vpid_h'  value="<?php echo (htmlspecialchars( $row['vp'] )); ?>"  />
<input type='hidden' id='vpid' value="<?php echo (htmlspecialchars( $row['vp'] )); ?>" />
<input type='hidden' id='actopt_h' value="<?php echo (htmlspecialchars( $row['action_type'])); ?>" />
<input type='hidden' id='location_h' value="<?php echo (htmlspecialchars( $row['location'] )); ?>"/>
<input type = 'hidden'  id='fname_h'  value="<?php echo (htmlspecialchars($row['first_name'])); ?>"  />  
<input type = 'hidden'   id='lname_h'  value="<?php echo (htmlspecialchars($row['last_name'])); ?>" />
<input type='hidden'  id='comments_h' value="<?php echo (htmlspecialchars( $row['comments'] )); ?>"/>
<input type='checkbox' id='sendmail' name='sendmail' value='Y'> Send Mail ?  &nbsp;&nbsp;&nbsp;

<?php
   mysql_free_result($rsq);
   $mailsql = "select mailid,Name from mailist";
   $result = mysql_query($mailsql);
   
   ?>
<select name="mailist" id="mailist" multiple="multiple" class="conv">
       	<?php while ($rows=mysql_fetch_assoc($result)){
       		echo  '<option value='. $rows['mailid'] .'>' . $rows['Name']  .'</option>'; 
    	  } ?>
</select>
<!--<span id='access'>
<input type='checkbox' id='jaccess' value='jaccess'> Jive Access ?  
</span>
&nbsp;&nbsp;&nbsp;-->

<br><br>
<br><input type='submit' id='updt' value='Save' align='center'/>  <input type="button" name="addbtn" class="button" id="srch" value="Back to Search" /> 
<br><input type="button" name="addnew" class="button" id="addnew" value="Add 1 more" /> 
			<input type="hidden" name="lookupid" id="lookupid" /><br>

<div id='msg'></div>
<div id='success'></div>
<div id='errors'></div>
 </form>


</body>
</html>


