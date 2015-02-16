<head>
<title>HR Temp Tool - Add Data</title>
 
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js" type="text/javascript"></script>
<script type='text/javascript' src='../../scripts/CheckValidForm.js'></script>
<script type='text/javascript' src='../../scripts/ProcessInput.js'></script>
<script type='text/javascript' src='../../scripts/jquery.ddedit.js'></script>
<script type='text/javascript' src='../../scripts/TypeChange.js'></script>

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
             
       //$('#actopt').trigger('change');
       TypeChange();
          
       
       if ($('#rmt').val() == 'Y'){
           $('#remote').prop('checked',true);
                //$('#location').className = "conv";
                //$('#location').slideUp();
                //$('label[for="location"]').slideUp();
           }
        
       $('#actopt').change(function()
          {
           TypeChange(); 
           FieldChange();
           var now = new Date();
           var curr_date=now.getDate();
           var curr_month=now.getMonth();
           curr_month++;
           var curr_year=now.getFullYear();
        
           if  ($('#actopt').val() != 'upd')
           {
        	 document.getElementById('effdt').value = curr_year+"/"+curr_month+"/"+curr_date;
           }
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
                 document.location = '../../srccd/dbrtn/updt_cntc.php';
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
                //$('#location').className = "conv";
                //$('#location').slideUp();
                //$('label[for="location"]').slideUp();
            }
            else
            {
                remote = 'N';
                $('#rmt').val('N');
                //$('#location').className = "";
                //$('#location').show();
                //$('label[for="location"]').show();
             }
        }) 
        //End of Remote functionality
        $('#sendmail').change(function(){
          if ($('#sendmail:checked').val() == 'Y'){
                
                $('#mailist').className = "";
                $('#mailcomm').className = "";
                $('#mailist').show();
                $('#mailcomm').show();
                mailsel = 'Y';
            }
            else
            {
                mailsel = 'N';
                $('#mailist').className = "conv";
                $('#mailcomm').className = "conv";
                $('#mailist').hide();
                $('#mailcomm').hide();

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
<a href="http://hrexpress.polycom.com/srccd/dbrtn/read_vndr.php">Manage Vendors</a>
</li>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/pick_ee.php">AdHoc Mail</a>
</li>
<li>
<a href="http://hrexpress.polycom.com/srccd/dbrtn/eegrid.php">Reports</a>
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
$sql = "select a.Id, date_format(a.effdt,'%Y/%m/%d') effdt,a.vendor_id,a.action_type,a.reason,a.last_name,a.first_name,type,a.classification,a.req_num,a.business_title,a.location,a.dept,a.emplid,a.busn_email,
a.supervisor,x.name,date_format(a.it_end_date,'%Y/%m/%d') it_end_date ,remote,a.finance,a.hr_contact,y.name hr_name,a.busn_phone,a.legal_entity,a.comments,a.financial_org,
d.name vndrnm, a.bill_rate,a.hourly_rate,a.r12_company,a.r12_product,a.r12_pol_service,a.r12_pol_region,a.pol_inter_company
from consultants a 
left join emp_current_vw x  on a.supervisor = x.emplid
left join vendor d on a.vendor_id = d.id  
left join emp_current_vw y on  a.hr_contact = y.emplid where a.id = ". $tempid  ." and a.effdt=(select max(b.effdt) from consultants b where a.id = b.id) ";


//$sql = "select * from temp_360_vw  where id = ". $tempid ;

$rsq = mysql_query($sql);
if (!$rsq) {
    die("Query to show fields from table failed");
}
$row = mysql_fetch_assoc($rsq);



if (($row['action_type'] == 'hir') || ($row['action_type'] == 'reh')  || ($row['action_type'] == 'xfr') || ($row['action_type'] == 'xtn') || ($row['action_type'] == 'dta'))
{
 $actopt=array("upd"=>"update","xfr"=>"Transfer","ter"=>"Terminate", "xtn"=>"Extension","cnv"=>"Convert to Regular","dta"=>"Data Change");
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
<div>
<form name="user_form">
<div class="subfieldsset">
<div>
 <label for ='actopt' > Type Of Update: </label>
<select id='actopt'> 
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

<label>Current Status: 

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
            case 'dta':
              echo 'Data change  ' ;
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
</label>
            
<label for='effdt' ><img src="../../images/star.png" alt="">Effective Date: </label>
<input type='date' placeholder='Start Date' id='effdt' required value="<?php echo (htmlspecialchars( $row['effdt'] ));?>"/>
 
</div>
<br><div><br>
 <label for='rsntype'><img src="../../images/star.png" alt="">Action Reason: </label>
<select id='rsntype' name='rsntype'>   
<?php
foreach ($rsnopt as $opt=>$data)
                   {   
                        if ($opt==$row['reason']){
                            echo '<option selected value='. $opt.'>' . $data .'</option>';}
                        else {
                            echo  '<option value='. $opt.'>' . $data .'</option>';}
                    }
 ?> 
</select> 
<label for ='classi'> <img src="../../images/star.png" alt=""> Classification: </label><select id='classi' name= 'classi'>
<?php
foreach ($empType as $opt=>$data)
                   {   
                        if ($opt==$row['classification']){
                            echo '<option selected value='. $opt.'>' . $data .'</option>';}
                        else {
                            echo  '<option value='. $opt.'>' . $data .'</option>';}
                    }
 ?>                       
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
</div>
 <br>
 <div>
 <br>
<label for ='fname' ><img src="../../images/star.png" alt="">First Name:</label>
<input type = 'text' placeholder='Enter First Name' id='fname'  required value="<?php echo (htmlspecialchars($row['first_name'])); ?>"  />  
<label for ='lname'><img src="../../images/star.png" alt="">Last Name:  </label>
<input type = 'text' placeholder='Enter Last Name' id='lname' required value="<?php echo (htmlspecialchars($row['last_name'])); ?>" /> 
</div> 
<br>
 <span class='note'> Contact Details</span>
<div id='contact_grp'>
 
 <label for='wphone'>Phone(Business): </label>
<input type='text' placeholder='Work Phone' id='wphone' required value="<?php echo (htmlspecialchars( $row['busn_phone'] )); ?>"/>
<input type='hidden' id='wphone_h' value="<?php echo (htmlspecialchars( $row['busn_phone'] )); ?>"/>

<label for='wemail'>Email(Business): </label>
<input type='email' placeholder='Work Email' id='wemail' size='40' required value="<?php echo (htmlspecialchars( $row['busn_email'] )); ?>"/>
<input type='hidden' id='wemail_h' value="<?php echo (htmlspecialchars( $row['busn_email'] )); ?>"/>
</div>
<br>
 <span class='note' id='job'> Job Details</span>
<div>


<label for='btitle'>Business Title: </label><input type='text' placeholder='Business Title' id='btitle' value="<?php echo (htmlspecialchars( $row['business_title'] )); ?>"/>
<input type='hidden' id='btitle_h'  value="<?php echo (htmlspecialchars( $row['business_title'] )); ?>"/>

<label for='manager'><img src="../../images/star.png" alt="">Manager:</label><input type='text' required placeholder='Supervisor' id='manager' value="<?php echo (htmlspecialchars( $row['name'] )); ?>"/>
<?php if (isset($_REQUEST['id'])){?>

<img id="orglvl" src="../../images/org_level.jpg" alt="">
<div id="popup" ></div>
<?php } ?>
<input type='hidden' id='boss_h'   value="<?php echo (htmlspecialchars( $row['supervisor'] )); ?>"/>
<input type='hidden' id='bossid' value="<?php echo (htmlspecialchars( $row['supervisor'] )); ?>" /> 
<br>

<label for='legal'><img src="../../images/star.png" alt="">Legal Entity: </label>
<input type='text' placeholder='Legal Entity' id='legal' required  value="<?php echo (htmlspecialchars( $row['legal_entity'] )); ?>" />
<input type='hidden'  id='legal_h'   size='40'value="<?php echo (htmlspecialchars( $row['legal_entity'] )); ?>" />

<label for='location'><img src="../../images/star.png" alt="">Location:</label>
<input type='text' placeholder='Work Place Location' id='location' required value="<?php echo (htmlspecialchars( $row['location'] )); ?>"/> 
<label for='remote'>Remote ? :</label>
<input type='checkbox' id='remote' name='remote' value='Y'> 
</div>
 
<div id='org'>
<span class='note' id='org'> Organization Details</span>
<br>
<label for='dept'><img src="../../images/star.png" alt="">Department: </label>
<input type='text' placeholder='Department' id='dept' required value="<?php echo (htmlspecialchars( $row['dept'] )); ?>" /> 
<input type='hidden'  id='dept_h'   value="<?php echo (htmlspecialchars( $row['dept'] )); ?>" /> 
 <label for='finance'><img src="../../images/star.png" alt="">Finance Division: </label>
<input type='text' placeholder='Finance' id='finance'  value="<?php echo (htmlspecialchars( $row['finance'] )); ?>"/>
<input type='hidden'  id='finance_h'  value="<?php echo (htmlspecialchars( $row['finance'] )); ?>"/> 
<label for='finorg'><img src="../../images/star.png" alt="">Financial Org: </label>
<input type='text' placeholder='Enter a financial Org' id='finorg'  value="<?php echo (htmlspecialchars( $row['financial_org'] )); ?>"/>
<input type='hidden'  id='finorg_h'  value="<?php echo (htmlspecialchars( $row['financial_org'] )); ?>"/>
</div>
 
<div id='hris'>
<span class='note'>HR Details</span><br>
<label for='hr'><img src="../../images/star.png" alt="">HR Contact: </label>
<input type='text' placeholder='HR Contact' id='hr' required value="<?php echo (htmlspecialchars( $row['hr_name'] )); ?>"/>
 
<label for='reqnum'>Requisition Number:</label>
<input type='text' placeholder='Requsitin Number' id='reqnum' value="<?php echo (htmlspecialchars( $row['req_num'] )); ?>"/>
<input type='hidden'  id='reqnum_h' value="<?php echo (htmlspecialchars( $row['req_num'] )); ?>"/>
<label for='it_end_dt'><img src="../../images/star.png" alt="">Planned Exit:</label>
<input type='date' placeholder='Enter a end date of the contract' id='it_end_dt' value="<?php echo (htmlspecialchars( $row['it_end_date'] )); ?>"/>
<input type='hidden'  id='hrid' value="<?php echo (htmlspecialchars( $row['hr_contact'] )); ?>" /> 
<input type='hidden'  id='hrid_h' value="<?php echo (htmlspecialchars( $row['hr_contact'] )); ?>" /> 
<input type='hidden'  id='rsntype_h' value="<?php echo (htmlspecialchars( $row['reason'] )); ?>" /> 

</div>
<div id='emplid'>

<label for='empid' >Employee Id : </label>
<input type='text' name='empid' id='empid' value="<?php echo (htmlspecialchars( $row['emplid'] )); ?>"/> 
 
</div>

<div>

<label for ='vendor'> Vendor</label>
<input type='text'  id='vendor' value="<?php echo (htmlspecialchars( $row['vndrnm'] )); ?>" /> 
<!--<input type='button'  id='vndr' value="Vendor Details"/>-->
<label for ='brate' > Bill Rate: </label>
<input type='text' placeholder='Bill Rate' id='brate'   value="<?php echo (($row['bill_rate']> ' ')? htmlspecialchars( $row['bill_rate'] ): '');  ?>"/>

 <label for ='hrate' > Hourly Rate: </label>
<input type='text' placeholder='Enter the Hourly Rate' id='hrate'  value="<?php echo (($row['hourly_rate'] > ' ')? htmlspecialchars( $row['hourly_rate'] ): '');  ?>"/>


<input type='hidden'  id='it_end_dt_h' value="<?php echo (htmlspecialchars( $row['it_end_date'] )); ?>"/>
<input type='hidden'  id='vndrid' value="<?php echo (htmlspecialchars( $row['vendor_id'] )); ?>" /> 
<input type='hidden'  id='vndrid_h' value="<?php echo (htmlspecialchars( $row['vendor_id'] )); ?>" />
</div>
<div>
<label for ='r12company'> <img src="../../images/star.png" alt="">R12 Company</label>
<input type='text'  id='r12company' value="<?php echo (htmlspecialchars( $row['r12_company'] )); ?>" /> 
<!--<input type='button'  id='vndr' value="Vendor Details"/>-->
<label for ='r12product,' ><img src="../../images/star.png" alt=""> Product: </label>
<input type='text' placeholder='R12 Product' id='r12product'   value="<?php echo (($row['r12_product']> ' ')? htmlspecialchars( $row['r12_product'] ): '');  ?>"/>

 <label for ='service' ><img src="../../images/star.png" alt=""> Service: </label>
<input type='text' placeholder='R12_Pol_service' id='service'  value="<?php echo (($row['r12_pol_service'] > ' ')? htmlspecialchars( $row['r12_pol_service'] ): '');  ?>"/>

</div>
<div>
<label for ='r12region'> <img src="../../images/star.png" alt="">R12 Region</label>
<input type='text'  id='r12region' value="<?php echo (htmlspecialchars( $row['r12_pol_region'] )); ?>" /> 
<!--<input type='button'  id='vndr' value="Vendor Details"/>-->
<label for ='inter,' > <img src="../../images/star.png" alt="">InterCompany: </label>
<input type='text' placeholder='inter' id='inter'   value="<?php echo (($row['pol_inter_company']> ' ')? htmlspecialchars( $row['pol_inter_company'] ): '');  ?>"/>

<div>
<br>
<label for='comments'>Comments: </label><textarea rows='3' cols='70' id='comments' ><?php echo ( $row['comments'] ); ?> </textarea>  
<div>
  <label >Characters Left: </label><span id='chars'></span>
</div>


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
<input type = 'hidden'   id='rmt'  value="<?php echo (htmlspecialchars($row['remote'])); ?>" />
<input type='hidden'  id='comments_h' value="<?php echo (htmlspecialchars( $row['comments'] )); ?>"/>
<input type = 'hidden'  id='brate_h'  value="<?php echo (htmlspecialchars($row['bill_rate'])); ?>"  />  
<input type = 'hidden'   id='hrate_h'  value="<?php echo (htmlspecialchars($row['hourly_rate'])); ?>" />
 <!------All the new hidden files--->
 <input type = 'hidden'   id='r12region_h'  value="<?php echo (htmlspecialchars($row['r12_pol_region'])); ?>" />
<input type = 'hidden'   id='service_h'  value="<?php echo (htmlspecialchars($row['r12_pol_service'])); ?>" />
<input type='hidden'  id='inter_h' value="<?php echo (htmlspecialchars( $row['inter'] )); ?>"/>
<input type = 'hidden'  id='r12product_h'  value="<?php echo (htmlspecialchars($row['r12_product'])); ?>"  />  
<input type = 'hidden'   id='r12company_h'  value="<?php echo (htmlspecialchars($row['r12_company'])); ?>" />
 
 <!--- Enf of changes--->
<br><br><label></label>
<input type='checkbox' id='sendmail' name='sendmail' value='Y'> Send Mail ? 


<?php
   mysql_free_result($rsq);
   $mailsql = "select mailid,Name from mailist";
   $result = mysql_query($mailsql);
   
   ?>
<select name="mailist" id="mailist" multiple="multiple" class="conv">
       	<?php while ($rows=mysql_fetch_assoc($result)){
       		echo  '<option value='. $rows['mailid'] .'>' . $rows['Name']  .'</option>'; 
    	  } ?>
</select><br>
<p  align='center' id="mailcomm" class="conv">Choose multiple recipients by using Ctrl-Click </p>
</div>
<!--<span id='access'>
<input type='checkbox' id='jaccess' value='jaccess'> Jive Access ?  
</span>
&nbsp;&nbsp;&nbsp;-->

<br><br>
<br><input type='submit' id='updt' value='Save' align='center'/>  <input type="button" name="addbtn" class="button" id="srch" value="Back to Search" /> 
<br><input type="button" name="addnew" class="button" id="addnew" value="Add 1 more" /> 
			<input type="hidden" name="lookupid" id="lookupid" /><br>

<div id='msg'></div>

</div>
 </form>
 <div>
<div id='success'></div>
<div class='errors' id='errors'></div>
 </div>



</body>
</html>


