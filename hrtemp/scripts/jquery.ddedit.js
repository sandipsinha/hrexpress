$().ready(function() {
 	      $('#effdt').datepicker({dateFormat:"yy-mm-dd",changeMonth:'true',changeYear:'true',showButtonPanel:'true'});
   	    $('#it_end_dt').datepicker({dateFormat:"yy-mm-dd",changeMonth:'true',changeYear:'true',showButtonPanel:'true'});
      	 $('#addnew').slideUp();
      	 
		  $.fn.extend( {
		limiter: function(limit, elem) {
		$(this).on("keyup focus", function() {
		setCount(this, elem);
		});
		function setCount(src, elem) {
		var chars = src.value.length;
		if (chars > limit) {
		src.value = src.value.substr(0, limit);
		chars = limit;
		}
		elem.html( limit - chars );
		}
		setCount($(this)[0], elem);
		}
		}); 
		var elem=$('#chars');
		$('#comments').limiter(255,elem); 	 
      	 
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
                  $("#r12company").val(mgr_data[6]);
                  $("#r12product").val(mgr_data[7]);
                  $("#service").val(mgr_data[8]);
                  $("#r12region").val(mgr_data[9]);
                  $("#inter").val(mgr_data[10]);
                  $("#finance").val(mgr_data[11]);
                  $("#finorg").val(mgr_data[12]);

                 }});
                 
       //Autocomplete for Vendor Name
          $("#vendor").autocomplete({
               source:"../lookup/get_vndr.php", 
                minLength:1,
              select: function(event, ui) {
                  $('#vndrid').val(ui.item.id);
                     }
              });     

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
              	       $("#hrid").val(hr_data[0]);
                     }
              });   
       //This is the autocomplete script to populate the R12 Company
              $("#r12company").autocomplete({
               source:"../lookup/get_r12company.php", 
                minLength:1,
              select: function(event, ui) {
              	       $("#r12company").val(ui.item.value);
                     }
              }); 
              
        //This is the autocomplete script to populate the R12 Region
              $("#r12region").autocomplete({
               source:"../lookup/get_pol_region.php", 
                minLength:1,
              select: function(event, ui) {
              	       $("#r12region").val(ui.item.value);
                     }
              }); 
              
                      
        //This is the autocomplete script to populate the R12 Product
              $("#r12product").autocomplete({
               source:"../lookup/get_r12product.php", 
                minLength:1,
              select: function(event, ui) {
              	       $("#r12product").val(ui.item.value);
                     }
              }); 


        //This is the autocomplete script to populate the R12 service
              $("#service").autocomplete({
               source:"../lookup/get_r12_service.php", 
                minLength:1,
              select: function(event, ui) {
              	       $("#service").val(ui.item.value);
                     }
              });        
             
       //This is the autocomplete script to populate the Pol Inter Company
              $("#inter").autocomplete({
               source:"../lookup/get_intercompany.php", 
                minLength:1,
              select: function(event, ui) {
              	       $("#inter").val(ui.item.value);
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
   })