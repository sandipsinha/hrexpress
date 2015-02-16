<div id="header">
		<div id="logo">
<h2><?php echo $title ?></h2>
</div>
</div>
<div id='form-edit'

<?php echo form_open(); ?>
   <p>
    <label for="name" class='usr'>Enter a Name: </label> 
	<?php 	
	           $data = array(
              'name'        => 'name',
              'id'          => 'name',
              'class'       => 'fld',
               'id'          =>'name'  
            );
	echo form_input($data);
	?>	
	<input type="hidden" name="id" id="id" />
	<input type="hidden" name="empind" id="empind" />
	<input type="button" name="submit" id="lookup" value="Search" />
	</p>	
</form>

<script type="text/javascript">
	$(document).ready(function() {
	$(function() {
		$( "#name" ).autocomplete({
			source: function(request, response) {
				$.ajax({ url: "<?php echo site_url('temps/lookup'); ?>",
				data: { term: $("#name").val()},
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
            $('#id').val(ui.item.id);
            $('#empind').val(ui.item.data);
        },

		});
	});
	 
 $('#lookup').on('click',function(){
    window.location.href = "<?php echo site_url('temps/disp'); ?>"+'/'+$('#id').val()+'/'+$('#empind').val();
 });

});

 
</script>

 

