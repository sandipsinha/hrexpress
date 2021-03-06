$().ready(function() {
 	      $('#effdt').datepicker({dateFormat:"yy-mm-dd",changeMonth:'true',changeYear:'true',showButtonPanel:'true'});
   	    $('#it_end_dt').datepicker({dateFormat:"yy-mm-dd",changeMonth:'true',changeYear:'true',showButtonPanel:'true'});
   	    $("#errors").slideUp();
   	    
   	    if ($('#emptyp').val() == 'Y'){
           $('#empind').prop('checked',true);
           $('#empind').trigger("change");
           }
      	  
       
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
        $("#mgr").autocomplete({
                source:"../lookup/get_manager.php", 
                minLength:1,
                select: function(event, ui) {
                  var mgr_data = ui.item.id.split(';');
                  $("#dept").val(mgr_data[1]);
                  $("#location").val(mgr_data[2]);
                  $("#legal").val(mgr_data[3]);
                  $("#mgr_mail").val(mgr_data[5]);
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
              $("#hr").autocomplete({
               source:"../lookup/get_hr.php", 
                minLength:1,
              select: function(event, ui) {
              	       var hr_data = ui.item.id.split(';');
              	       $("#hrmail").val(hr_data[1]);
                      
                     }
              });           
      //This is the autocomplete script to populate the HR field - Begin

       //This is the autocomplete script to populate the HR field - End
      //This is the autocomplete script to populate the HR field - Begin
          $("#empid").autocomplete({
               source:"../lookup/get_regular.php", 
                minLength:1,
              select: function(event, ui) {
                      //$('#hrid').val(ui.item.id);
                     }
              });
      //This is the autocomplete script to populate the Finance Org field - End
      $('#empind').change(function(){
          if ($('#empind:checked').val() == 'Y'){
          	   $('#ttype').slideUp();
               $('label[for="ttype"]').slideUp();
					if ($('#actopt').val() != 'ter'){
                		$('#it_end_dt').slideUp();
                		$('label[for="it_end_dt"]').slideUp();
                		document.getElementById('leffdt').innerText = 'Effective Date';
             		 }
             		 else
             		 {
             		 	document.getElementById('leffdt').innerText = 'Term Date';
             		 	document.getElementById('end_dt').innerText = 'Last Working Date';
             		 }
                $('label[for="empid"]').show();
                $('#empid').show();
                
            }
            else
            {
            	$('#ttype').show();
               $('label[for="ttype"]').show();
            	$('label[for="empid"]').slideUp();
                $('#empid').slideUp();
                $('#it_end_dt').show();
                $('#star').show();
                document.getElementById('end_dt').innerText = 'IT End Date';
                document.getElementById('leffdt').innerText = 'Effective Date';
                $('label[for="it_end_dt"]').show();

            }
        })

       if ($('#empind:checked').val() == 'Y'){
       	     $('#ttype').slideUp();
              $('label[for="ttype"]').slideUp();
       	     if ($('#actopt').val() != 'ter'){
                		$('#it_end_dt').slideUp();
                		$('#star').slideUp();
                		$('label[for="it_end_dt"]').slideUp();
             		}
                $('label[for="empid"]').show();
                $('#empid').show();
                
            }
            else
            { 
                $('#ttype').show();
                $('label[for="ttype"]').show();
            	 $('label[for="empid"]').slideUp();
                $('#empid').slideUp();
                $('#it_end_dt').show();
                $('#star').show();
                $('label[for="it_end_dt"]').show();
                document.getElementById('leffdt').innerText = 'Effective Date';

            }
                   
        $('#actopt').change(function(){
        	
        	   if ($('#actopt').val() == 'ter'){
        	   	 $('#it_end_dt').show();
        	   	  $('label[for="it_end_dt"]').show();
        	   	 if ($('#empind:checked').val() == 'Y'){
                		document.getElementById('end_dt').innerText = 'Last Working Date';
                		document.getElementById('leffdt').innerText = 'Term Date';
                	}
                	else
                	  {
                		document.getElementById('end_dt').innerText = 'IT End Date';
                		document.getElementById('leffdt').innerText = 'Effective Date';
                		}
                $('#end_dt').show();
        	   }
        	   else
        	     {
        	   	  		document.getElementById('leffdt').innerText = 'Effective Date';
        	   	} 
        	   if ($('#empind:checked').val() == 'Y' && $('#actopt').val() != 'ter'){
        	   	 
        	   	 $('#it_end_dt').slideUp();
                $('label[for="it_end_dt"]').slideUp();
        	   }
        })
         
      
   })