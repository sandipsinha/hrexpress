function CheckValidForm() {
	 
    if ($("#name").val() == "") {
            $("#errors").html('<p class="error">Enter a valid name !</p>');
            $("#errors").show();
            $("#name").focus();
            return false;
        }
        
      
                    
        // validate the 'Legal Entity' field
        if ($("#legal").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Legal Entity !</p>');
            $("#errors").show();
            $("#legal").focus();
            return false;
        } 

			// validate the 'HR' field
        if ($("#hrid").val() == "") {
            $("#errors").html('<p class="error">Enter a valid HR Contact !</p>');
            $("#hr").focus();
            return false;
        }
        
        // validate the 'Department' field
        if ($("#dept").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Department !</p>');
            $("#dept").focus();
            return false;
        }
        // validate the 'Location' field && $("#rmt").val()==""
        if ($("#location").val() == "") {
            $("#errors").html('<p class="error">Enter a valid location !</p>');
            $("#location").focus();
            return false;
        }
        
        // validate the 'Phone' field
       /* if ($("#wphone").val()== "") {
        	   $("#wphone").focus();
            $("#errors").html('<p class="error">Enter a valid Phone Number!</p>');
            return false;
        }*/
       // validate the 'Manager' field
        if ($("#manager").val() == "") {
            $("#errors").html('<p class="error">A manager is required !</p>');
            $("#manager").focus();
            return false;
        }
        
                 
         // Validate the Fin Org field
            // validate the 'finance' field
        if ($("#finorg").val() == "") {
              $("#errors").html('<p class="error">Enter a valid Financial Org !</p>');
            $("#finorg").focus();
            return false;
        } 
                
        /* validate the 'email' field
        if ($("#wemail").val() == "") {
            $("#errors").html('<p class="error">Enter a valid email address!</p>');
            $("#wemail").focus();
            return false;
        }*/
        
        // validate the 'email' field
        if ($("#wemail").val().indexOf("@") == -1 && $("#wemail").val() != "") {
            $("#errors").html('<p class="error">Enter a valid email address!</p>');
            $("#wemail").focus();
            return false;
        }

 
        
			 // validate the Effective Date field
        if ($("#effdt").val() == "" || $("#effdt").val() == "0000-00-00") {
            $("#errors").html('<p class="error">Enter a Effective Date !</p>');
            $("#effdt").focus();
            return false;
        }
        else
        {if($('#actopt').val() != 'upd' && $("#effdt").val() ==$("#effdt_h").val()){
                $("#errors").html('<p class="error">Effective date has to be different for anything other than Update !</p>');
               $("#effdt").focus();
               $("#errors").show();
            }
            
           } 
           
       // validate the 'It End Date' field
        if ($('#empind:checked').val() != 'Y' && $('#it_end_dt').val() == '') {
            $("#errors").html('<p class="error">A planned exit date is required!</p>');
            $("#it_end_dt").focus();
            $("#errors").show();
            return false;
        }
         
        if (($('#actopt').val() == 'cnv' || $('#actopt').val() == 'xtn') && $('#empind:checked').val() == 'Y'){
   	    $("#errors").html('<p class="error">Invalid Action choice for Employee !</p>');
      	 $("#actopt").focus();
      	 $("#errors").show();
      	 return false;
   		} 
   		
   		if ($('#empind:checked').val() == 'Y' && $('#empid').val().length < 6){
   	    $("#errors").html('<p class="error">Employee ID is required when Type is Employee !</p>');
      	 $("#empid").focus();
      	 $("#errors").show();
      	 return false;
			} 
   		
        
        //No mail recipient selected
       var mailind = 'N'; 
       //var urlvariable = $("#ids").val();             
            if ($('#mailist').val()){
            	mailind = 'Y';
            	//alert('the mailing list is ' + $('#mailist').val());
            	//return false;
            }
            else
            {
             alert('No recipients were selected');	
             return false;
             }
        
        return true;
   }