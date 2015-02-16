function disablefields(){
        $('#errors').slideUp();
        $("#effdt").attr("disabled",false);
                    //Begin of Change of Option
        if ($('#actopt').val()=='ter' || $('#actopt').val()=='cnv'){
         	 $("#effdt").val('');   
             $("#fname").attr("disabled",true);
             $("#lname").attr("disabled",true);
             $("#wemail").attr("disabled",true);
             $("#wphone").attr("disabled",true);
             $("#effdt").attr("disabled",false);
             $('label[for="hr"]').slideUp();
             $('label[for="reqnum"]').slideUp();
             $('label[for="btitle"]').slideUp();
             $('label[for="classi"]').slideUp();
             $('label[for="rsntype"]').slideUp();
             $('label[for="ttype"]').slideUp();
             $('label[for="location"]').slideUp();
             $('label[for="dept"]').slideUp();
             $('label[for="finance"]').slideUp();
             $('label[for="finorg"]').slideUp();
             $('label[for="legal"]').slideUp();
             $('label[for="wemail"]').slideUp();
             $('label[for="wphone"]').slideUp();
             $('#hr').slideUp();
             $('#classi').slideUp();
             $('#ttype').slideUp();
             $('#location').slideUp();
             $('#dept').slideUp();
             $('#finance').slideUp();
             $('#finorg').slideUp();
             $('#rsntype').slideUp();
             $('#btitle').slideUp(); 
             $('#legal').slideUp();
             $("#wemail").slideUp();
             $("#wphone").slideUp();
              $('#reqnum').hide();
              if ($('#actopt').val() == 'cnv') 
                {
                 $('#empid').show();
                 $('label[for="empid"]').show();
                }
              else
                {
                 $('#empid').slideUp();
                 $('label[for="empid"]').slideUp();
                }
             }
           	else if ($('#actopt').val()=='xfr' || $('#actopt').val()=='xtn' || $('#actopt').val()=='upd'){
         	 $("#effdt").val('');   
             $("#fname").attr("disabled",true);
             $("#lname").attr("disabled",true);
             $("#wemail").attr("disabled",false);
             $("#wphone").attr("disabled",false);
             $("#effdt").attr("disabled",false);
             $('label[for="hr"]').show();
             $('label[for="reqnum"]').show();
             $('label[for="btitle"]').show();
             $('label[for="classi"]').show();
             $('label[for="rsntype"]').show();
             $('label[for="ttype"]').show();
             $('label[for="location"]').show();
             $('label[for="dept"]').show();
             $('label[for="finance"]').show();
             $('label[for="finorg"]').show();
             $('label[for="legal"]').show();
             $('label[for="wemail"]').show();
             $('label[for="wphone"]').show();
             $('#hr').show();
             $('#classi').show();
             $('#ttype').show();
             $('#location').show();
             $('#dept').show();
             $('#finance').show();
             $('#finorg').show();
             $('#rsntype').show();
             $('#btitle').show(); 
             $('#legal').show();
             $("#wemail").show();
             $("#wphone").show();
             $('#reqnum').show();
             $('#empid').slideUp();
             $('label[for="empid"]').slideUp();
             if ($('#actopt').val() != 'upd') 
                {
				$("#effdt").val('');
                }
                else
                {
                	$("#effdt").val($("#effdth").val());
                }
             }
             
                 
         return true;
}