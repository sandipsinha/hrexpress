<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HR Temp Tool - Add Data</title>


<link rel="stylesheet" type="text/css" href="../../template/newstyle.css" media="screen"  />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js" type="text/javascript"></script>
<script type='text/javascript' src='../../scripts/CheckValidForm.js'></script>
<script type='text/javascript' src='../../scripts/ProcessInput.js'></script>
<script type='text/javascript' src='../../scripts/jquery.ddedit.js'></script>
<script type='text/javascript' src='../../scripts/TypeChange.js'></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css">
<script type="text/javascript">

$().ready(function() {
       $('#effdt').datepicker({dateFormat:"yy-mm-dd"});
       $('#it_end_dt').datepicker({dateFormat:"yy-mm-dd"});
       $('#addnew').slideUp();
              
       $('#orglvl').hover( function(){
           $('#orglvl').append('<p>Click here to see the Organization hierarchy</p>');
           },
        function(){
           $('#orglvl').find("p:last").remove();
           });
           
              
           
       //This is the autocompleter script to populate the Department field - Begin
        $("#dept").autocomplete({
            source:"../lookup/get_dept.php", 
            minLength:1,
            select: function(event, ui) {
                  $('#dept').val(ui.item.value);
                 }
           });
             //This is the autocompleter script to populate the Department field - End
      //This is the autocompleter script to populate the Manager field - Begin
        $("#manager").autocomplete({
                source:"../lookup/get_manager.php", 
                minLength:1,
                select: function(event, ui) {
                  var mgr_data = ui.item.id.split(';');
                  $("#bossid").val(mgr_data[0]);
                  $("#dept").val(mgr_data[1]);
                  $("#location").val(mgr_data[2]);
                  $("#legal").val(mgr_data[3]);
                  $("#mgr_h").val(mgr_data[4]);
                 }});
            

      //This is the autocompleter script to populate the Manager field - End
      
            //This is the autocompleter script to populate the Legal Entity field - Begin
          $("#legal").autocomplete({
               source:"../lookup/get_legal.php", 
                minLength:1,
              select: function(event, ui) {
                      $('#legal').val(ui.item.value);
                     }
              });
            

      //This is the autocompleter script to populate the Legal Entity field - End
      
            
            //This is the autocompleter script to populate the Location field - Begin
          $("#location").autocomplete({
               source:"../lookup/get_loc.php", 
                minLength:1,
              select: function(event, ui) {
                      $('#location').val(ui.item.value);
                     }
              });
            

      //This is the autocomplete script to populate the Location field - End
      
     //This is the autocomplete script to populate the Finance field - Begin
          $("#finance").autocomplete({
               source:"../lookup/get_fin.php", 
                minLength:1,
              select: function(event, ui) {
                      $('#finance').val(ui.item.value);
                     }
              });
      //This is the autocomplete script to populate the Finance field - End
                  
      //This is the autocomplete script to populate the Finance Org field - Begin
          $("#finorg").autocomplete({
               source:"../lookup/get_finorg.php", 
                minLength:1,
              select: function(event, ui) {
                      $('#finorg').val(ui.item.value);
                     }
              });
      //This is the autocomplete script to populate the Finance Org field - End
                        
      //This is the autocomplete script to populate the HR field - Begin
          $("#hr").autocomplete({
               source:"../lookup/get_hr.php", 
                minLength:1,
              select: function(event, ui) {
                      $('#hrid').val(ui.item.id);
                     }
              });
      //This is the autocomplete script to populate the Finance Org field - End
      //This is the autocomplete script to populate the HR field - Begin
          $("#empid").autocomplete({
               source:"../lookup/get_regular.php", 
                minLength:1,
              select: function(event, ui) {
                      //$('#hrid').val(ui.item.id);
                     }
              });
      //This is the autocomplete script to populate the Finance Org field - End

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
                
              });
        
  </script>     

</head>
<body>

<div id="menu_wrapper">
<div id="menu">
<ul>
        <li class="current_page_item">
        <a href="http://hrexpress.polycom.com/srccd/dbrtn/read_ee.php">Temp Lookup</a>
        </li>
        <li>
        <a href="#">Temp Grid</a>
        </li>
        <li>
        <a href="http://hrexpress.polycom.com">Home Page</a>
        </li>
</ul>
</div>
</div>

<br clear="all" />
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
a.supervisor,x.name,date_format(a.it_end_date,'%m/%d/%Y') it_end_date ,finance,a.vp,a.hr_contact,y.name hr_name,a.busn_phone,a.legal_entity,a.comments,a.financial_org, z.name VP_name from consultants a 
left join emp_current_vw x  on a.supervisor = x.emplid left join emp_current_vw z on a.vp = z.emplid
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
<div class='formarea'>
<h2>HR Temp Tool - Maintain Data</h2>
<form name="user_form">
<div class='subfieldsset'>

<div>
 <label for ='actopt' >Update Type: </label>
<select id='actopt'>  <br>
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

            
<label for='effdt' >Effective Date: </label>
<input type='date' placeholder='Start Date' id='effdt' required value="<?php echo (htmlspecialchars( $row['effdt'] ));?>"/>
</div>

<br><br>
<div>
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
</select>
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
</select>
<label for ='ttype' > Temp Type: </label>
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


 <br> <br>

<label for ='fname' >First Name:</label>
<input type = 'text' placeholder='Enter First Name' id='fname'  required value="<?php echo (htmlspecialchars($row['first_name'])); ?>"  />  
<label for ='lname'>Last Name: </label>
<input type = 'text' placeholder='Enter Last Name' id='lname' required value="<?php echo (htmlspecialchars($row['last_name'])); ?>" />
<br><br>
</div>
<hr>
 <br>
<div>
<label for='wphone'>Phone(Business): </label>
<input type='text' placeholder='Work Phone' id='wphone' required value="<?php echo (htmlspecialchars( $row['busn_phone'] )); ?>"/>
<input type='hidden' id='wphone_h' value="<?php echo (htmlspecialchars( $row['busn_phone'] )); ?>"/>

<label for='wemail'>Email(Business): </label>
<input type='email' placeholder='Work Email' id='wemail' required value="<?php echo (htmlspecialchars( $row['busn_email'] )); ?>"/>
<input type='hidden' id='wemail_h' value="<?php echo (htmlspecialchars( $row['busn_email'] )); ?>"/>
</div>
<br>
<div>
<br>
<br>
<label for='btitle'>Business Title: </label><input type='text' placeholder='Business Title' id='btitle' value="<?php echo (htmlspecialchars( $row['business_title'] )); ?>"/>
<input type='hidden' id='btitle_h'  value="<?php echo (htmlspecialchars( $row['business_title'] )); ?>"/>

<label for='manager'>Manager:</label><input type='text' required placeholder='Supervisor' id='manager' value="<?php echo (htmlspecialchars( $row['name'] )); ?>"/>
<img id='orglvl' src="../../images/org_level.jpg" alt="Organization Level"/>
<input type='hidden' id='boss_h'   value="<?php echo (htmlspecialchars( $row['supervisor'] )); ?>"/>
<input type='hidden' id='bossid' value="<?php echo (htmlspecialchars( $row['supervisor'] )); ?>" />  
</div>
<br>
<div>
<br>
<label for='dept'>Department: </label>
<input type='text' placeholder='Department' id='dept' required value="<?php echo (htmlspecialchars( $row['dept'] )); ?>" /> 
<input type='hidden'  id='dept_h'   value="<?php echo (htmlspecialchars( $row['dept'] )); ?>" /> 
 
<label for='legal'>Legal Entity: </label>
<input type='text' placeholder='Legal Entity' id='legal' required size='40'value="<?php echo (htmlspecialchars( $row['legal_entity'] )); ?>" />
<input type='hidden'  id='legal_h'   size='40'value="<?php echo (htmlspecialchars( $row['legal_entity'] )); ?>" />
<br>

<label for='location'>Location:</label>
<input type='text' placeholder='Work Place Location' id='location' required value="<?php echo (htmlspecialchars( $row['location'] )); ?>"/>
</div>
 
<br>
<hr>
<div><br>

<label for='finance'>Finance: </label>
<input type='text' placeholder='Finance' id='finance'  value="<?php echo (htmlspecialchars( $row['finance'] )); ?>"/>
<input type='hidden'  id='finance_h'  value="<?php echo (htmlspecialchars( $row['finance'] )); ?>"/> 
<label for='finorg'>Financial Org: </label>
<input type='text' placeholder='Enter a financial Org' id='finorg'  value="<?php echo (htmlspecialchars( $row['financial_org'] )); ?>"/>
<input type='hidden'  id='finorg_h'  value="<?php echo (htmlspecialchars( $row['financial_org'] )); ?>"/>
</div>
<br>
<div>
<label for='hr'>HR Contact: </label>
<input type='text' placeholder='HR Contact' id='hr' required value="<?php echo (htmlspecialchars( $row['hr_name'] )); ?>"/>
 
<label for='reqnum'>Requisition Number:</label>
<input type='text' placeholder='Requsitin Number' id='reqnum' value="<?php echo (htmlspecialchars( $row['req_num'] )); ?>"/>
<input type='hidden'  id='reqnum_h' value="<?php echo (htmlspecialchars( $row['req_num'] )); ?>"/>

<input type='hidden'  id='hrid' value="<?php echo (htmlspecialchars( $row['hr_contact'] )); ?>" /> 
<input type='hidden'  id='hrid_h' value="<?php echo (htmlspecialchars( $row['hr_contact'] )); ?>" /> 
</div>
<br>
<div>
<label for='empid' >Employee Id : </label>
<input type='text' name='empid' id='empid' value="<?php echo (htmlspecialchars( $row['emplid'] )); ?>"/> 
<label for='it_end_dt'>Planned Exit:</label>
<input type='date' placeholder='Enter a end date of the contract' id='it_end_dt' value="<?php echo (htmlspecialchars( $row['it_end_date'] )); ?>"/>
<input type='button'  id='vndr' value="Vendor Details"/>
<input type='hidden'  id='it_end_dt_h' value="<?php echo (htmlspecialchars( $row['it_end_date'] )); ?>"/>
</div>
<br>
<div>
<label for='comments'>Comments: </label><textarea rows='3' cols='90' id='comments' ><?php echo ( $row['comments'] ); ?> </textarea> &nbsp;&nbsp;&nbsp;
</div>
<br>
<input type='checkbox' id='sendmail' value='mailind'> Send Mail ?  &nbsp;&nbsp;&nbsp;


<input type='hidden'  id='comments_h' value="<?php echo (htmlspecialchars( $row['comments'] )); ?>"/>
<br><input type='submit' id='updt' value='Save' align='center'/>  <input type="button" name="addbtn" class="button" id="srch" value="Back to Search" /> 
<br><input type="button" name="addnew" class="button" id="addnew" value="Add 1 more" /> 
			<input type="hidden" name="lookupid" id="lookupid" /><br>
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
<div id='msg'></div>
<div id='success'></div>
<div id='errors'></div>
</div>
 </form>
</div>

</body>
</html>


