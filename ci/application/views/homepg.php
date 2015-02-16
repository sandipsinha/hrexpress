<div class="formarea">
<div class="requiredfld"><span class="required">*</span> Required</div>
<?php echo form_open(); ?>
<div class="subfieldsset">
  <div id='errinfo' class="error"></div>
  <div id='success' class="information">Fill in the form complately to avoid regular errors.</div>
  <p>Hello <?php echo $results['name'].'$homepg_msg';  ?> </p> 
  	<?php 
    	if ($this->session->userdata('empind') == 'Y'){?>
    <div>
        <label >Employee ID: </label>
        <input type = 'text' id='empid' size="auto" value="<?php echo $this->session->userdata('emplid'); ?>"  />
     </div>
     <?php } ?>
     <div>   
      <label>Department: </label>
      <input type = 'text' id='deptid' size="auto" value="<?php echo $results['dept']; ?>"  />	
      </div>
       <div>
        <label >Business Email: </label>
        <input type = 'text' id='email' size="auto" value="<?php echo $this->session->userdata('email'); ?>"  />
     </div>
     <div>   
      <label>Business Telephone: </label>
      <input type = 'text' id='wphone' size="auto" value="<?php echo $results['busn_phone']; ?>"  />
      </div>
 </div>
 <br /> 
 <?php  if ($this->session->userdata('empind') == 'N'){
 	 $this->session->set_userdata($results['id'],'N'); ?>    
    <div class="buttonsarea">
    <input type="submit" value="Save" id='submit' name="submit_form"/>
    </div><br />
 <?php } ?>     
    </div>
    <input type = 'hidden' id='empind'  value="<?php echo $this->session->userdata('empind'); ?>"  />  
  <?php
     echo form_close("\n")?>

</body>
<script type="application/javascript">
 $(document).ready(function() {
 	$("#empid").attr("disabled",false);
 	$("#deptid").attr("disabled",false);
 	$("#email").attr("disabled",false);
 	if ($('#empind').val() == 'Y')
 	   {
 		$("#busn_phone").attr("disabled",false);
 		}
 	else
 		{
 		$("#busn_phone").attr("disabled",true);
 		}
 
  $('#submit').click(function() {  
var form_data = {
 wphone : $('#wphone').val(),
 ajax : '1'
 };
 $.ajax({
 url: "<?php echo site_url('home/tempss'); ?>",
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

 