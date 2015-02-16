function CheckValidForm() {
	
    if ($("#fname").val() == "") {
            $("#errors").html('<p class="error">Enter a valid first name !</p>');
            $("#fname").focus();
            return false;
        }
        
     // validate the 'Last Name' field
        if ($("#lname").val() == "") {
            $("#errors").html('<p class="error">Enter a valid last name !</p>');
            $("#lname").focus();
            return false;
        }
            // validate the 'business title' field
        /*if ($("#btitle").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Business Title !</p>');
            $("#btitle").focus();
            return false;
        }*/
                    
        // validate the 'Legal Entity' field
        if ($("#legal").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Legal Entity !</p>');
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
 //Begin Change for the New COA fields
            // validate the 'R12' field
        if ($("#r12company").val() == "") {
              $("#errors").html('<p class="error">Enter a valid R12 Company !</p>');
            $("#r12company").focus();
            return false;
        } 
 
 // validate the 'R12' field
        if ($("#r12product").val() == "") {
              $("#errors").html('<p class="error">Enter a valid R12 Product!</p>');
            $("#r12product").focus();
            return false;
        } 
 
             // validate the 'R12' Region
        if ($("#r12region").val() == "") {
              $("#errors").html('<p class="error">Enter a valid R12 Region !</p>');
            $("#r12region").focus();
            return false;
        } 
 
 // validate the 'service' field
        if ($("#service").val() == "") {
              $("#errors").html('<p class="error">Enter a valid R12 Service!</p>');
            $("#service").focus();
            return false;
        } 
        
 // validate the 'Inter Company ' field
        if ($("#inter").val() == "") {
              $("#inter").html('<p class="error">Enter a valid R12 Inter Company!</p>');
            $("#inter").focus();
            return false;
        } 
         
 
 //End Change for COA by Sandip on 02-11-15       
                 
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
        if ($("#it_end_dt").val() !=$("#it_end_dt_h").val() && $('#it_end_dt').val() == '') {
            $("#errors").html('<p class="error">A planned exit date is required!</p>');
            $("#it_end_dt").focus();
            return false;
        }
        
        // Validate the employee id field
        if ($('#actopt').val() == 'cnv'){
        if(($("#empid").val().length < 6) || $("#empid").val() == '' )
        		{
                  $("#errors").html('<p class="error">Employee Id must be specified if the consultant is converting!</p>');
            		$("#empid").focus();
            		return false;
            }
         }
         if(($("#effdt").val()== $("#effdt_h").val()) && ($('#actopt_h').val() != $('#actopt').val()) && $('#actopt').val() != 'upd' )
         	{
                  $("#errors").html('<p class="error">A new effective date is required if there is a data change!</p>');
            		$("#effdt").focus();
            		return false;
            }   
          
         
        // validate the 'finance' field
        if ($("#finance").val() == "") 
        	{
            $("#errors").html('<p class="error">Enter a valid Finance !</p>');
            $("#finance").focus();
            return false;
        	} 
        
        return true;
   }