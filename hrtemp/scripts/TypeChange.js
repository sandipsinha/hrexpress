function TypeChange(){
        $('#errors').slideUp();
        
        if ($('#actopt_h').val() != '')
           {
        		  $("#effdt").attr("disabled",true);
        	  }
        	  if ( $('#actopt_h').val() != 'cnv' && $('#actopt_h').val() != 'cnv'){
        	  	      $('label[for="empid"]').slideUp();
                  $('#empid').slideUp();
        	  }	  

                    //Begin of Change of Option
        if ( $('#actopt_h').val() == 'cnv' || $('#actopt_h').val() == 'ter' || $('#actopt').val() == 'ter' || $('#actopt').val() == 'cnv')
           { 
             $("#fname").attr("disabled",true);
             $("#lname").attr("disabled",true);
             $("#wemail").attr("disabled",true);
             $("#wphone").attr("disabled",true);
             $("#it_end_date").attr("disabled",true);
             $("#it_end_date").val('') ;
             $('label[for="btitle"]').slideUp();           

             //$('label[for="hr"]').slideUp();
             $('label[for="reqnum"]').slideUp();
             $('label[for="dept"]').slideUp();
             $('label[for="legal"]').slideUp();
             $('label[for="location"]').slideUp();
             $('label[for="remote"]').slideUp();
             $('label[for="classi"]').slideUp();
             $('label[for="rsntype"]').slideUp();
             $('label[for="ttype"]').slideUp();
             $('label[for="manager"]').slideUp();
             $('label[for="finance"]').slideUp();
             $('label[for="finorg"]').slideUp();
             $('label[for="vendor"]').slideUp();
             $('#vendor').slideUp();
             $('#classi').slideUp();
             $('#dept').slideUp();
             $('#legal').slideUp();
             $('#orglvl').slideUp();
             $('#location').slideUp();
				$('#remote').slideUp();
				$('#job').slideUp();             
             $('#ttype').slideUp();
             $('#rsntype').slideUp();
             $('#manager').slideUp();
             $('#finance').slideUp();
             $('#finorg').slideUp();
             $('#btitle').slideUp();
             $('#org').slideUp();             
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
              if ($('#actopt_h').val() == 'cnv' || $('#actopt').val() == 'cnv')
                {
                 $('#empid').show();
                 $('label[for="empid"]').show();
                }
                else
                {
                  $('label[for="empid"]').slideUp();
                  $('#empid').slideUp();
                }	
           }
          else
          {
             $("#fname").attr("disabled",false);
             $("#lname").attr("disabled",false);
             $("#wemail").attr("disabled",false);
             $("#wphone").attr("disabled",false);
 				 $('label[for="dept"]').show();
             $('label[for="legal"]').show();
             $('label[for="location"]').show();
             $('label[for="manager"]').show();
             $('label[for="btitle"]').show();
             $('label[for="hr"]').show();
             $("#hr").show();
             $('label[for="reqnum"]').show();
             $('label[for="classi"]').show();
             $('label[for="rsntype"]').show();
             $('label[for="ttype"]').show();
             $('label[for="remote"]').show();
             $('label[for="finance"]').show();
             $('label[for="finorg"]').show();
             $('label[for="vendor"]').show();
             $('#vendor').show();
             $('#dept').show();
             $('#remote').show();
             $('#legal').show();
             $('#orglvl').show();
             $('#location').show();
             $('#ttype').show();
             $('#classi').show();
             $('#rsntype').show();
             $('#btitle').show();
             $('#reqnum').show();
             $('#manager').show();
             $('#job').show();
             $('#org').show(); 
             $('#finance').show();
             $('#finorg').show();
             $('#effdt').val($('#effdt_h').val());
             
         } 
         return true;
}

function FieldChange(){
        $('#errors').slideUp();
        $("#effdt").attr("disabled",false);
                    //Begin of Change of Option
         
         return true;
}