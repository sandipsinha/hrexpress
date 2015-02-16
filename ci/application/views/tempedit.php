<?php 
   $type=array("C"=>"Consultant/Vendors","F"=>"Fixed Term Contractors","T"=>"Temporary Contractor","W"=>"Temporary Worker" ,"O"=>"Other" );
  
   $empType=array("Short Term"=>"Short Term", "Structural"=>"Structural","Full Term"=>"Full Term", "Project"=>"Project","Interim"=>"Interim","Special"=>"Special", "Intermittent"=>"Interimittent");
   
   $rsnopt=array("LOA"=>"LOA","Short"=>"Short","Seasonal"=>"Seasonal", "Project"=>"Project","Replace"=>"Replace","Add"=>"Add","Other"=>"Other");
   
   $actopt=array("upd"=>"update","xfr"=>"Transfer","ter"=>"terminate", "xtn"=>"Extension","cnv"=>"Convert to Regular");
   
   $actopt1=array("hir"=>"Hire");
  
?>
<div class="formarea">
<div class="requiredfld"><span class="required">*</span> Required</div>
<?php echo form_open(); ?>
<?php if ($mode == 'e'){  ?>
  <h2>Consultant Edit Details Page</h2>
  <p><?php echo $data['First_Name']. ' has a '.$data['Action_Descr']. ' on '. $data['Effective_Date'].' as the latest transaction';?> </p>
  <h3><?php echo $data['Last_Name'].', '.$data['First_Name'];?></h3>
  <div class="subfieldsset">
  <div id='errinfo' class="error"></div>
  <div id='success' class="information">Fill in the form complately to avoid regular errors.</div>
        
    <div>
      <label for ='actopt' ><span class="required">*</span> Update Type: </label>
      <?php
        $js="id='actopt'";	
      echo form_dropdown('actopt',  $actopt, 'upd',$js);?>
    
      <label for='rsntype'><span class="required">*</span>Action Reason: </label>
      <?php $js="id='rsntype'";		
      
       echo form_dropdown('rsntype', $rsnopt,$data['reason'] ,$js);?>
      
      <label for ='classi'><span class="required">*</span> Classification: </label>
      <?php $js="id='classi'";	
	    echo form_dropdown('classi', $empType, $data['classification'],$js);?>
    </div>
    <div>
      <label for='ttype'><span class="required">*</span>Temp Type:</label>
      <?php  $js="id='ttype'";	
        echo form_dropdown('ttype',  $empType, $data['type'],$js);?>  
      <label for='effdt'><span class="required">*</span>Effective Date:</label>
	  <input type = 'text' id='effdt' size="10" required value="<?php echo $data['Effective_Date']; ?>"  />
      <br />
      <hr>
      <label for ='fname' ><span class="required">*</span>First Name:</label>
      <input type = 'text' id='fname' name='fname'  required value="<?php echo $data['First_Name']; ?>"  />
      <label for ='lname'><span class="required">*</span> Last Name:</label>
      <input type = 'text' id='lname'  required value="<?php echo $data['Last_Name']; ?>"  />
      </div>
       <div>
      	<label for='wphone'>Phone(Business): </label>
      	<input type = 'text' id='wphone' value="<?php echo $data['Business_Phone']; ?>"  />
      	<label for='wemail'><span class="required" >*</span>Email(Business): </label>
      	<input type = 'text' id='wemail' size="40" value="<?php echo $data['Work_Email']; ?>"  />
      </div>
      <br />
      <hr>   
    <div>
      <label for='btitle'>Business Title: </label>
      <input type='text' placeholder='Business Title' id='btitle' size="41" value="<?php echo $data['Business_Title']; ?>"  />
      <label for='manager'><span class="required">*</span>Manager:</label>
      <input type='text' required placeholder='Supervisor' id='manager'size="auto" value="<?php echo $data['Supervisor']; ?>"  />
    </div>
    <div>
       <label for='dept'><span class="required">*</span>Department: </label>
    	 <input type = 'text' id='dept' size="41" value="<?php echo $data['Department']; ?>"  />
    	 <label for='legal'><span class="required">*</span>Legal Entity: </label>
    	 <input type = 'text' id='legal' size="auto" value="<?php echo $data['Legal_Entity']; ?>"  />
    </div>
      <br />
      <hr>
    <div>
    	<label for='location'><span class="required">*</span>Location:</label>
    	<input type = 'text' id='location' size="41" value="<?php echo $data['Location']; ?>"  />
    	<label for='finance'><span class="required">*</span>Finance: </label>
    	<input type = 'text' id='finance' size="41" value="<?php echo $data['Finance']; ?>"  />
    </div>
    <div>
    	<label for='finorg'><span class="required">*</span>Financial Org: </label>
    	<input type = 'text' id='finorg' size="auto" value="<?php echo $data['Financial_Org']; ?>"  />
    </div>
    <div>
    <hr>
    	<label for='hr'><span class="required">*</span>HR Contact: </label>
    	<input type = 'text' id='hr' size="auto" value="<?php echo $data['HR_Contact']; ?>"  />
    	<label for='reqnum'>Requisition Number:</label>
    	<input type = 'text' id='reqnum' size="auto" value="<?php echo $data['Requisition_Number']; ?>"  />
    	<label for='empid' class="conv"><span class="required">*</span>Employee Id : </label>
    	<input type = 'text' class="conv" id='empid' size="auto" value="<?php echo $data['Supervisor_id']; ?>"  />

     </div>
    <div>
    	<label for='it_end_dt'><span class="required">*</span>Planned Exit:</label>
    	<input type = 'text' id='it_end_dt' size="auto" value="<?php echo $data['IT_End_Date']; ?>"  />
    	<label for='vendor'><span class="required">*</span>Vendor:</label>
    	<input type = 'text' id='vendor' size="auto" value="<?php echo $data['Vendor_Name']; ?>"  />
    </div>

    <br />
     <hr>
     <div>
     	<label for='comments'>Comments:</label>
     	<textarea rows="5" cols="100" id='comments'></textarea>
      </div>
      <br/>
      <hr>
      <div>
       <label for='emailind'>Send Email?:</label>	
	   <?php $js='id="emailind" checked="FALSE"';
	      $chkarr = array(
    		'name'        => 'emailind',
    		'id'          => 'emailind',
    		'value'       => 'Y',
    		'checked'     => FALSE,
   	 		'style'       => 'margin:10px',
   			 );
		echo form_checkbox($chkarr);
		?>
       <select name="mailist" id="mailist" multiple="multiple" class="conv">
       	<?php foreach ( $maildata as $row ): ?>
       		<option value="<?php echo $row['mailid'];?>">
       		<?php echo $row['mailid']; ?>
    		</option>
    	<?php endforeach; ?>
    </select>	
     <br />
  	 </div>
	 </div>
  <input type = 'hidden' id='mgrid'  value="<?php echo $data['Supervisor_id']; ?>"  />
  <input type = 'hidden' id='id'  value="<?php echo $data['id']; ?>"  />
  <input type = 'hidden' id='vndrid'  value="<?php echo $data['Vendor_id']; ?>"  />
  <input type = 'hidden' id='actopth'  value="<?php echo $data['Action_type']; ?>"  />
  <input type = 'hidden' id='effdth'  value="<?php echo $data['Effective_Date']; ?>"  />
  <input type = 'hidden' id='hrid'   value="<?php echo $data['HR_id']; ?>"  />
  <?php } 
  else 
  {?>
  <h2>New Consultant Add Details Page</h2>
  <p>Please ensure that a Vendor exists before adding a contractor </p>
  <div class="subfieldsset">
  <div id='errinfo' class="error"></div>
  <div id='success' class="information">Fill in the form complately to avoid regular errors.</div>
    <div>
      <label for ='actopt' ><span class="required">*</span> Update Type: </label>
      <?php
        $js="id='actopt'";	
      echo form_dropdown('actopt',  $actopt1, 'hir',$js);?>
    
      <label for='rsntype'><span class="required">*</span>Action Reason: </label>
      <?php $js="id='rsntype'";		
      
       echo form_dropdown('rsntype', $rsnopt,'LOA' ,$js);?>
      
      <label for ='classi'><span class="required">*</span> Classification: </label>
      <?php $js="id='classi'";	
	    echo form_dropdown('classi', $empType, 'Short Term',$js);?>
    </div>
    <div>
      <label for='ttype'><span class="required">*</span>Temp Type:</label>
      <?php  $js="id='ttype'";	
        echo form_dropdown('ttype',  $empType, 'C',$js);?>  
      <label for='effdt'><span class="required">*</span>Effective Date:</label>
	  <input type = 'text' id='effdt' size="10" required placeholder="Effective Date"   />
      <br />
      <hr>
      <label for ='fname' ><span class="required">*</span>First Name:</label>
      <input type = 'text' id='fname'  required placeholder="First Date"   />
      <label for ='lname'><span class="required">*</span> Last Name:</label>
      <input type = 'text' id='lname'  required placeholder="Last Name"  />
      </div>
      <div>
      	<label for='wphone'>Phone(Business): </label>
      	<input type = 'text' id='wphone' placeholder="Work Phone"  />
      	<label for='wemail'><span class="required">*</span>Email(Business): </label>
      	<input type = 'text' id='wemail' size="auto" placeholder="Work Email"  />
      </div>
      <br />
      <hr>   
    <div>
      <label for='btitle'>Business Title: </label>
      <input type='text' placeholder='Business Title' id='btitle' size="41" placeholder="Business Title"  />
      <label for='manager'><span class="required">*</span>Manager:</label>
      <input type='text' required placeholder='Supervisor' id='manager'size="auto" placeholder="Manager"  />
    </div>
    <div>
       <label for='dept'><span class="required">*</span>Department: </label>
    	 <input type = 'text' id='dept' size="41" placeholder="Department"  />
    	 <label for='legal'><span class="required">*</span>Legal Entity: </label>
    	 <input type = 'text' id='legal' size="auto" placeholder="Legal Entity"  />
    </div>
      <br />
      <hr>
    <div>
    	<label for='location'><span class="required">*</span>Location:</label>
    	<input type = 'text' id='location' size="41" placeholder="Location"  />
    	<label for='finance'><span class="required">*</span>Finance: </label>
    	<input type = 'text' id='finance' size="41" placeholder="Finance"  />
    </div>
    <div>
    	<label for='finorg'><span class="required">*</span>Financial Org: </label>
    	<input type = 'text' id='finorg' size="auto" placeholder="Financial Org" />
    </div>
    <div>
    <hr>
    	<label for='hr'><span class="required">*</span>HR Contact: </label>
    	<input type = 'text' id='hr' size="auto" placeholder="HR Contact"  />
    	<label for='reqnum'>Requisition Number:</label>
    	<input type = 'text' id='reqnum' size="auto" placeholder="Requisition Num"  />
    	<label for='empid' class="conv"><span class="required">*</span>Employee Id : </label>
    	<input type = 'text' class="conv" id='empid' size="auto" placeholder="Employee ID"  />

     </div>
    <div>
    	<label for='it_end_dt'><span class="required">*</span>Planned Exit:</label>
    	<input type = 'text' id='it_end_dt' size="auto" placeholder="Exit Date"   />
    	<label for='vendor'><span class="required">*</span>Vendor:</label>
    	<input type = 'text' id='vendor' size="auto" placeholder="Vendor Name"   />
    </div>

<br />
  <input type = 'hidden' id='mgrid'   />
  <input type = 'hidden' id='id' value='new'   />
  <input type = 'hidden' id='vndrid'    />
  <input type = 'hidden' id='hrid'    />
  <input type = 'hidden' id='actopth'  value='hir'  />
       </div>
  <hr>
     <div>
     	<label for='comments'>Comments:</label>
     	<textarea rows="5" cols="100" id='comments'></textarea>
     </div>
     <br />
  <?php } ?>
     
     
    <br /> 
    
    <div class="buttonsarea">
    <input type="submit" value="Save" id='submit' name="submit_form"/>
    </div><br />
 

</div>  
  <?php
   echo form_close("\n")?>


</body>
<script type="application/javascript">
 $(document).ready(function() {
 	
 $('label[for="empid"]').slideUp();
 	             
 $('#effdt').datepicker({ dateFormat: "yy-mm-dd" });	
 $('#it_end_dt').datepicker({ dateFormat: "yy-mm-dd" });
 var mailsel = 'N';
 $('#submit').click(function() {
 
 if ($('#actopt').val() == 'upd'){
 	var actopt = $('#actopth').val();
 	var action='upd';
 }
 else
 {
 	actopt = $('#actopt').val();
 	action='oth';
 }
	
 var form_data = {
 fname : $('#fname').val(),
 lname : $('#lname').val(),
 wphone: $('#wphone').val(),
 wemail: $('#wemail').val(),
 hr: $('#hrid').val(),
 legal: $('#legal').val(),
 location: $('#location').val(),
 dept: $('#dept').val(),
 manager: $('#manager').val(),
 reqnum: $('#reqnum').val(),
 it_end_dt: $('#it_end_dt').val(),
 finance: $('#finance').val(),
 finorg: $('#finorg').val(),
 btitle: $('#btitle').val(),
 id:$('#id').val(),
 mgrid:$('#mgrid').val(),
 effdt:$('#effdt').val(),
 vndrid:$('#vndrid').val(),
 actopt:actopt,
 rsntype:$('#rsntype').val(),
 classi:$('#classi').val(),
 ttype:$('#ttype').val(),
 empid:$('#empid').val(),
 comments:$('#comments').val(),
 action:action,
 items:$('#mailist').val(),
 mailsel:mailsel,
 ajax : '1'
 };
 $.ajax({
 url: "<?php echo site_url('temps/ajax_check'); ?>",
 type: 'POST',
 async : false,
 dataType: "json",
 data: form_data,
 success: function(msg) {
 	$('#errinfo').fadeout();
 	$('#success').html(msg.responseText);
 },
 error:function(msg) {
 	$('#errinfo').html(msg.responseText);
 }
 });
 return false;
 });
 
//Autocomplete function for Manager  
		$( "#manager" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('lookup/manager'); ?>",
				data: { term: $("#manager").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);				 
				}
			});
		},
		minLength: 2,
		 select: function (event, ui) {
            event.preventDefault();
            this.value = ui.item.label;
            var mgr_data = ui.item.id.split(';');
            $('#mgrid').val(ui.item.value);
            $('#legal').val(ui.item.data);
            $("#location").val(mgr_data[0]);
            $("#dept").val(mgr_data[1]);
            $("#finance").val(mgr_data[2]);
            $("#mgrid").val(mgr_data[3]);
        },
		});

//Autocomplete function for Department  
		$( "#dept" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('lookup/department'); ?>",
				data: { term: $("#dept").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);				 
				}
			});
		},
		minLength: 2,
		 select: function (event, ui) {
            event.preventDefault();
           this.value = ui.item.label;
        },
		});		
		

//Autocomplete function for Location 
		$( "#location" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('lookup/location'); ?>",
				data: { term: $("#location").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);				 
				}
			});
		},
		minLength: 2,
		 select: function (event, ui) {
            event.preventDefault();
           this.value = ui.item.label;
        },
		});	
		
//Autocomplete function for Legal Entity 
		$( "#legal" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('lookup/legal'); ?>",
				data: { term: $("#legal").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);				 
				}
			});
		},
		minLength: 2,
		 select: function (event, ui) {
            event.preventDefault();
           this.value = ui.item.label;
        },
		});	
		
//Autocomplete function for Finance 
		$( "#finance" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('lookup/finance'); ?>",
				data: { term: $("#finance").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);				 
				}
			});
		},
		minLength: 2,
		 select: function (event, ui) {
            event.preventDefault();
           this.value = ui.item.label;
        },
		});		
		
		
//Autocomplete function for Financial Organization 
		$( "#finorg" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('lookup/finorg'); ?>",
				data: { term: $("#finorg").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);				 
				}
			});
		},
		minLength: 2,
		 select: function (event, ui) {
            event.preventDefault();
           this.value = ui.item.label;
        },
		});
		
//Autocomplete function for Vendor  
		$( "#vendor" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('lookup/vendor'); ?>",
				data: { term: $("#vendor").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);				 
				}
			});
		},
		minLength: 2,
		 select: function (event, ui) {
            event.preventDefault();
           this.value = ui.item.label;
          $('#vndrid').val(ui.item.value);
        },
		});		 

//Autocomplete function for HR 
		$( "#hr" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('lookup/gethr'); ?>",
				data: { term: $("#hr").val()},
				dataType: "json",
				type: "POST",
				success: function(data){
					response(data);				 
				}
			});
		},
		minLength: 2,
		 select: function (event, ui) {
            event.preventDefault();
           this.value = ui.item.label;
           $('#hrid').val(ui.item.value);
        },
		});	


 //**field change events
$('#actopt').change(function(){
	disablefields();
})

 //**field change events
$('#emailind').change(function(){
  if ($('#emailind:checked').val() == 'Y'){
  	    
		$('#emailind').className = "";
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
 </script>




