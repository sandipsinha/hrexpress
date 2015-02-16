 $().ready(function() {
  //$('#addnew').addClass('reallyHide');
  

   $("#wphone").mask("(999) 999-9999");

            
//This is the autocompleter script to populate the Department field
 $("#dept").autocomplete("../lookup/get_dept.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#dept").result(function(event, data, formatted){$("#dept").val(data[1]);} );
    
 //This is the autocompleter script to populate the legal Entity Field
 
 $("#legal").autocomplete("../lookup/get_legal.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//miple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#legal").result(function(event, data, formatted){$("#legal").val(data[0]);} );
   
    //This is the autocompleter script to populate the Fin Field
     $("#finance").autocomplete("../lookup/get_fin.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
     
	$("#finance").result(function(event, data, formatted){$("#finance").val(data[0]);} );
    
    	 //This is the autocompleter script to populate the VP Field
    
         $("#vp").autocomplete("../lookup/get_vp.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#vp").result(function(event, data, formatted){$("#vpid").val(data[1]);} );
    
        	 //This is the autocompleter script to populate the HR Field
    
         $("#hr").autocomplete("../lookup/get_hr.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
    $("#hr").result(function(event, data, formatted){$("#hrid").val(data[1]);} );
    
     $("#location").autocomplete("../lookup/get_loc.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#location").result(function(event, data, formatted){$("#location").val(data[0]);} );
//This is the autocompleter script to populate the Supervisor Field
    
     $("#manager").autocomplete("../lookup/get_manager.php", {
		width: 260,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	
	$("#manager").result(function(event, data, formatted){$("#bossid").val(data[1]);$("#manager").val(data[0]);$("#dept").val(data[2]);$("#location").val(data[3]);$("#legal").val(data[4]);$("#vp").val(data[6]);$("#vpid").val(data[5]);} );
    
  

  $('form[name="user_form"]').submit(function(e) {
        e.preventDefault();
        var change_ind = 'N';
        var change_str = '';

                // validate the 'Last Name' field
       if ($("#btitle").val() !='' )
           {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",business_title='"+ $("#btitle").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " business_title='"+ $("#btitle").val() + "'";
                }
            }

        if ($("#dept").val() !='' )
           {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",dept='"+ $("#dept").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " dept='"+ $("#dept").val() + "'";
                }
            }
 
         if ($("#legal").val() !='' )
           {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",legal_entity='"+ $("#legal").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " legal_entity='"+ $("#legal").val() + "'";
                }
            }
        
// validate the 'VP'  field
         if ($("#vpid").val() !='' )
          {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",vp='"+ $("#vpid").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " vp='"+ $("#vpid").val() + "'";
                }
            } 
            
         }           
       if ($("#wemail").val() !='' )
          {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",busn_email='"+ $("#wemail").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " busn_email='"+ $("#wemail").val() + "'";
                }
            }

        if ($("#bossid").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",supervisor='"+ $("#bossid").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " supervisor='"+ $("#bossid").val() + "'";
                }
            }

     if ($("#wphone").val() !='')
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",busn_phone='"+ $("#wphone").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " busn_phone='"+ $("#wphone").val() + "'";
                }
            }
        // validate the 'Location' field
     if ($("#location").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",location='"+ $("#location").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " location='"+ $("#location").val() + "'";
                }
            }

// validate the 'HR'  field
         if ($("#hrid").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",hr_contact='"+ $("#hrid").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " hr_contact='"+ $("#hrid").val() + "'";
                }
            } 
            
            // validate the 'finance' field
         if ($("#finance").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",finance='"+ $("#finance").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " finance='"+ $("#finance").val() + "'";
                }
            } 
    // validate the Effective Date field
 

       // validate the 'effective date' field
         if ($("#effdt").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",effdt='"+ $("#effdt").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " effdt='"+ $("#effdt").val() + "'";
                }
            } 
 
     // validate the 'Type' field
         if ($("#ttype").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",type='"+ $("#ttype").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " type='"+ $("#ttype").val() + "'";
                }
            } 
    
     // validate the 'Classification' field
         if ($("#classi").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",classification='"+ $("#classi").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " classification='"+ $("#classi").val() + "'";
                }
            } 
           
// validate the IT End Date  field
         if ($("#it_end_dt").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",it_end_date='"+ $("#it_end_dt").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " it_end_date='"+ $("#it_end_dt").val() + "'";
                }
            }
         
                  
        $.ajax({
            type: "POST",
            url: '../../srccd/dbrtn/displaygrid.php',
            dataType:"json",
            data: ({updtstr:change_str}),
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
   })
