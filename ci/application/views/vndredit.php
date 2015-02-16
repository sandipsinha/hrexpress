	<div id="header">
		<div id="logo">
<h2><?php echo $title ?></h2>
</div>
</div>
<div id='form-edit'

<?php echo form_open('vendor/update'); ?>
   <p>
    <label for="name" class='usr'>Name: </label> 
	<?php   	 
	$data = array(
              'name'        => 'name',
              'id'          => 'name',
              'value'       => $records['name'],
              'maxlength'   => '100',
              'class'       => 'fld',
               'id'          =>'name'  
            );
	echo form_input($data);		
	?>
</p>
<p>
	<label for="effdt" class='usr'>Effective Date</label>
	<?php   	 
	$data = array(
              'name'        => 'effdt',
              'id'          => 'effdt',
              'value'       => $records['effdt'],
              'maxlength'   => '10',
              'class'       => 'fld',
               'id'          =>'effdt'  
            );
	echo form_input($data);		
	?>
	</p>
	<p>
	<label for="comments" class='usr'>Comments</label>
	<textarea name='comments' cols="20" rows="10" id='comments' class='fld'>
<?php echo $records['comments'];?> 
	</textarea>
	</p>
	<p>
	<input type="submit" name="submit" id="submit" value="Update Vendor" />
	</p>
	<div='success' id="mesg"/></div>
<?php  
 echo validation_errors('<p class="error">'); 
 echo form_close(); ?>	
</form>
	  
</div>
<script type="text/javascript">

$().ready(function() {
	
	   $('#effdt').datepicker({ dateFormat: "yy-mm-dd" });
	   
		$('#submit').click(function(e){
		e.preventDefault();
        var form_data={
		name:$('#name').val(),
		effdt:$("#effdt").val(),
		comments:$('#comments').val(),
		id:<?php echo $records['id'];?>
	    };
		$.ajax({
		url:"<?php echo site_url('vendor/update')?>",
		type:'POST',
		data:form_data,
		success:function(msg){
			$('#mesg').html(msg);
			$('#mesg').show();
			}
			});
			return false;	
	});
});
</script>
