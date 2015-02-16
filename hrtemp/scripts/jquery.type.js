<script type="text/javascript">
  alert("I reached here also");
     $('#actopt').change(function(){ 
    $('#errors').slideUp();
 if ( $('#actopt').val() == 'cnv' || $('#actopt').val() == 'ter')
	 {   
        $("#fname").attr("disabled",true);
        $("#lname").attr("disabled",true);
        $("#wemail").attr("disabled",true);
        $("#wphone").attr("disabled",true);
        $("#it_end_date").attr("disabled",true);
        $("#it_end_date").val('') ;
        $("#effdt").attr("disabled",false);
        $('fieldset.org').slideUp();
        $('fieldset.job').slideUp();
        $('label[for="hr"]').slideUp();
        $('label[for="reqnum"]').slideUp();
        $('label[for="classi"]').slideUp();
        $('label[for="rsntype"]').slideUp();
        $('label[for="ttype"]').slideUp();
        $('#hr').slideUp();
        $('#classi').slideUp();
        $('#ttype').slideUp();
        $('#rsntype').slideUp();
        if ($('#wphone').val() != '' && $('#wemail').val() != '')
            {
                $('fieldset.contact').hide();
            }
         else
            {
              $("#wemail").attr("disabled",false);
              $("#wphone").attr("disabled",false); 
             }   
                $('#reqnum').hide();
                if ($('#actopt').val() == 'cnv')
                   {
                    $('fieldset.emplid').show();
                    }
                    else
    			             {
            				    $('fieldset.emplid').slideUp();
                         }   
            
    }
    else
    {
            $("#fname").attr("disabled",false);
            $("#lname").attr("disabled",false);
            $("#wemail").attr("disabled",false);
            $("#wphone").attr("disabled",false);
            $("#effdt").attr("disabled",false);
            $('fieldset.org').show();
            $('fieldset.job').show();
           	$('label[for="hr"]').show();
           	$('#hr').show();
        		$('label[for="reqnum"]').show();
        		$('label[for="classi"]').show();
        		$('label[for="rsntype"]').show();
        		$('label[for="ttype"]').show();
            $('fieldset.hr').show();
            $('fieldset.contact').show();
            $('#ttype').show();
            $('#classi').show();
        		$('#rsntype').show();
            $('#reqnum').show();
            $('fieldset.emplid').slideUp();
            if ( $('#actopt').val() == 'upd') 
            {  $("#effdt").attr("disabled",true);

            }
            else
            {  $("#effdt").attr("disabled",false);
               
            }
     }
});
</script>
      
   