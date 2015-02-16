$().ready(function() {
      $("#tel").mask("(999) 999-9999");
    //This is the autocompleter script to populate the Department field
 /*$("#vendor").autocomplete("../lookup/get_vndr.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
    	$("#vendor").result(function(event, data, formatted){$("#vendor").val(data[0]);} );*/
        var change_ind = '';
        var change_num = 0;
	$('#vendor').change(function(){ 
    if (change_ind == 'Y') {
	   	insertstr = insertstr + ", Vendor_name = '"+ $('#vendor').val() + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "Vendor_name = '"+ $('#vendor').val() + "'";
	   }
       change_num +=1;
        
	})
    
    $('#Contact').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", Contact_name = '"+ $('#Contact').val() + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "Contact_name = '"+ $('#Contact').val() + "'";
	   }
       change_num +=1;
	})
    $('#Rate').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", Rate = "+ $('#Rate').val() ;
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "Rate = "+ $('#Rate').val() ;
	   }
       change_num +=1;
	})
    $('#tel').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", Contact_tel = '"+ $('#tel').val() + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "Contact_tel = '"+ $('#tel').val() + "'";
	   }
       change_num +=1;
	})
	
	$('#email').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", Contact_email = '"+ $('#email').val() + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "Contact_email = '"+ $('#email').val() + "'";
	   }
       change_num +=1;
	})
    
    // Effectibve date change funciton
    	$('#effdt').change(function(){ 
	   if (change_ind == 'Y') {
	   	insertstr = insertstr + ", effdt= '"+ $('#effdt').val() + "'";
	   }
	   else
	   {
	     change_ind = 'Y';
	     insertstr = "effdt= '"+ $('#effdt').val() + "'";
	   }
       change_num +=1;
	})
    
    //Now begins the edit function_exists
    $('form[name="vndr_form"]').submit(function(e) {
        e.preventDefault();
        var change_ind = 'N';
        var change_str = '';
     
    if ($("#vendor").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Vendor !</p>');
            $("#vendor").focus();
            return false;
        }
                // validate the 'Effective Date' field
        if ($("#effdt").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Effective Date !</p>');
            $("#effdt").focus();
            return false;
        }
            // validate the 'Contact' field
        if ($("#Contact").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Contact !</p>');
            $("#Contact").focus();
            return false;
        }

                    
            // validate the 'Rate' field
        if ($("#Rate").val() == "") {
            $("#errors").html('<p class="error">Enter a non zero Rate !</p>');
            $("#Rate").focus();
            return false;
        }
                    
        // validate the 'Legal Entity' field
        if ($("#tel").val() == "" && $("#email").val() == "" ) {
            $("#errors").html('<p class="error">Enter at least a phone # or a emailid for the contact !</p>');
            $("#tel").focus();
            return false;
        }  
        // validate the 'email' field
        if ($("#email").val().indexOf("@") == -1 && $("#email").val() != "") {
            $("#errors").html('<p class="error">Enter a valid email address!</p>');
            $("#wemail").focus();
            return false;
        }
         
    // validate the Effective Date field
        if ($("#effdt").val() == "") {
            $("#errors").html('<p class="error">Enter a Effective Date !</p>');
            $("#effdt").focus();
            return false;
        }
        
 
        var actionstr = 'upd';
       // validate the 'effective date' field
        
 
 
           if (change_num >= 4 )
            {
               insertstr = "(" + $("#tempid").val()+ ",'" +  $("#vendor").val() + "','" + $("#Contact").val() + "','" + $("#effdt").val() + "'," + $("#Rate").val() +",'" + $("#tel").val() + "','"+$("#email").val()+ "')";
               actionstr = 'add';
             }  
             
                  
        $.ajax({
            type: "POST",
            url: '../../srccd/dbrtn/vndrupdt.php',
            dataType:"json",
            data: ({insertdata: insertstr,action:actionstr}),
            error: function(msg) {
                $("#errors").html(msg.message);
                
            },
            success: function(msg) {
                // display the errors returned by server side validation (if any)
                 if(msg.success == true){
                $('#success').html('<h3>' + msg.message + '</h3>');
                $('#success').show();
                $('#errors').slideUp();
                }
                else {
                    $('#errors').html('<h3>' + msg.message + '</h3>');
                    $('#errors').show();
                    $('#success').slideUp();
                }
            }
        });
    });
$('#srch').click(function(){
     document.location = '../../srccd/dbrtn/read_ee.php';
         });
 $('#eeprofile').click(function(){
     document.location = '../../srccd/dbrtn/ee_info.php';
         });        
    })