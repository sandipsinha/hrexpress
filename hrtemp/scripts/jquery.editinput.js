 $().ready(function() {
  //$('#addnew').addClass('reallyHide');
  $('#actopt').trigger('change');
  $('#errors').slideUp();
  
  $('#access').hide();
    
  $('#addnew').slideUp();
  $('#start_date').datepicker({dateFormat:"yy-mm-dd",changeMonth:'true',changeYear:'true',showButtonPanel:'true'});
  $('#end_date').datepicker({dateFormat:"yy-mm-dd",changeMonth:'true',changeYear:'true',showButtonPanel:'true'});
  //$('#effdt').DatePicker();

   $("#wphone").mask("(999) 999-9999");
//   $('#it_end_date').mask('mm-dd-yyyy');

   if ($('#ids').val() != ''){
   	$("#vndr").show();
   }
   else
   {  
   	$("#vndr").hide();
   }
//$("#popup").dialog();
			
$('#mgr').click(function(e){
	$.ajax({
		url:'../lookup/get_org.php',
		type:"POST",
		data:({emplid:$('#bossid').val()}),
		success: function(data){
			$('#popup').html(data);
			$('#popup').dialog('open');
		}
	});
});
  	
 
   
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
      
   
 var optSelect={
       "ter":"Terminate",
       "cnv":"Convert to a full type",
       "ext":"Extension",
       "xfr":"Transfer"
       }
       $.each(optSelect,function(key,value){
            $('#type').append($('<option>',{value:key}).text(value));
            });
            
            $("#state").autocomplete({
                source: "../lookup/get_data.php",
                minLength: 1,
                select: function(event, ui) {
                    $('#state_id').val(ui.item.label);
                }
            });            
            
//This is the autocompleter script to populate the Department field
 $("#dept").autocomplete({
 	   Source:"../lookup/get_dept.php", 
		minLength:1,
      select: function(event, ui) {
              $('#dept').val(ui.item.label);
             }
      });
    
 //This is the autocompleter script to populate the legal Entity Field

      //This is the autocompleter script to populate the Fin Field    
 $("#finance").autocomplete({
 	   Source:"../lookup/get_fin.php", 
		minLength:1,
      select: function(event, ui) {
              $('#finance').val(ui.item.label);
             }
      });
         
    
   //This is the autocompleter script to populate the VP Field
     $("#vp").autocomplete({
 	   Source:"../lookup/get_vp.php", 
		minLength:1,
      select: function(event, ui) {
              $('#vp').val(ui.item.label);
             }
      });
      	     
    
    //This is the autocompleter script to populate the HR Field
     $("#hr").autocomplete({
 	   Source:"../lookup/get_hr.php", 
		minLength:1,
      select: function(event, ui) {
              $('#hr').val(ui.item.label);
             }
      });

    
    //This is the autocompleter script to populate the fin org Field
      $("#finorg").autocomplete({
 	   Source:"../lookup/get_finorg.php", 
		minLength:1,
      select: function(event, ui) {
              $('#finorg').val(ui.item.label);
             }
      });
    
    //This is the autocompleter script to populate the Location Field
      $("#location").autocomplete({
 	   Source:"../lookup/get_loc.php", 
		minLength:1,
      select: function(event, ui) {
              $('#location').val(ui.item.label);
             }
      });
    

//This is the autocompleter script to populate the Supervisor Field
      $("#manager").autocomplete({
 	   Source:"../lookup/get_manager.php", 
		minLength:1,
      select: function(event, ui) {
              $('#manager').val(ui.item.label);
             }
      });
    
         
	
	//$("#manager").result(function(event, data, formatted){$("#bossid").val(data[1]);$("#manager").val(data[0]);$("#dept").val(data[2]);$("#location").val(data[3]);$("#legal").val(data[4]);$("#vp").val(data[6]);$("#vpid").val(data[5]);$("#finance").val(data[7]);} );
    
  

  $('form[name="user_form"]').submit(function(e) {
              e.preventDefault();
		        var change_ind = 'N';
      		  var change_str = '';
      		  //alert('The value is ' + $("#empid").val().length);
    //$("#errors").html('');
    //$("#errors").slideUp();
    if ($("#fname").val() == "") {
            $("#errors").html('<p class="error">Enter a valid first name !</p>');
            $("#fname").focus();
            $("#errors").show();
            return false;
        }
                // validate the 'Last Name' field
        if ($("#lname").val() == "") {
            $("#errors").html('<p class="error">Enter a valid last name !</p>');
            $("#errors").show();
            $("#lname").focus();
            return false;
        }
            // validate the 'business title' field
        if ($("#btitle").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Business Title !</p>');
            $("#errors").show();
            $("#btitle").focus();
            return false;
        }
  if ($('#actopt').val() !='ter'){
        if ($("#btitle").val() !=$("#btitle_h").val() )
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
                   
            // validate the 'Department' field
        if ($("#dept").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Department !</p>');
            $("#errors").show();
            $("#dept").focus();
            return false;
        }

        if ($("#dept").val() !=$("#dept_h").val() )
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
                    
        // validate the 'Legal Entity' field
        if ($("#legal").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Legal Entity !</p>');
            $("#errors").show();
            $("#legal").focus();
            return false;
        }  
         if ($("#legal").val() !=$("#legal_h").val() )
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
        // validate the 'VP' field
        if ($("#vp").val() == "") {
            $("#errors").html('<p class="error">Enter a valid VP !</p>');
            $("#vp").focus();
            $("#errors").show();
            return false;
        }

// validate the 'VP'  field
         if ($("#vpid").val() !=$("#vpid_h").val() )
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
        // validate the 'email' field
        if ($("#wemail").val().indexOf("@") == -1) {
            $("#errors").html('<p class="error">Enter a valid email address!</p>');
            $("#wemail").focus();
            $("#errors").show();
            return false;
        }
                 if ($("#wemail").val() !=$("#wemail_h").val() )
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

        // validate the 'Manager' field
        if ($("#manager").val() == "") {
            $("#errors").html('<p class="error">A manager is required !</p>');
            $("#manager").focus();
            $("#errors").show();
            return false;
        }
                 if ($("#bossid").val() !=$("#boss_h").val() )
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

        // validate the 'Phone' field
        if ($("#wphone").val()== "") {
        	   $("#wphone").focus();
            $("#errors").html('<p class="error">Enter a valid Phone Number!</p>');
            $('#errors').show();
            return false;
        }
         if ($("#wphone").val() !=$("#wphone_h").val() )
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
        if ($("#location").val() == "") {
            $("#errors").html('<p class="error">Enter a valid location !</p>');
            $("#location").focus();
            $('#errors').show();
            return false;
        }
         if ($("#location").val() !=$("#location_h").val() )
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
            
// validate the 'HR' field
        if ($("#hrid").val() == "") {
            $("#errors").html('<p class="error">Enter a valid HR Contact !</p>');
            $("#errors").show();
            $("#hr").focus();
            return false;
        }
// validate the 'HR'  field
         if ($("#hrid").val() !=$("#hrid_h").val() )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",HR_id='"+ $("#hrid").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " HR_id='"+ $("#hrid").val() + "'";
                }
            } 
            
            // validate the 'finance' field
        if ($("#finance").val() == "") {
            $("#errors").html('<p class="error">Enter a valid Finance !</p>');
            $("#errors").show();
            $("#finance").focus();
            return false;
        }    
// validate the 'Finance'  field
         if ($("#finance").val() !=$("#finance_h").val() )
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
        if ($("#effdt").val() == "") {
            $("#errors").html('<p class="error">Enter a Effective Date !</p>');
            $("#effdt").focus();
            $("#errors").show();
            return false;
        }
        else
        {if($('#actopt').val() != 'upd' && $("#effdt").val() ==$("#effdt_h").val()){
                $("#errors").html('<p class="error">Effective date has to be different for anything other than Update !</p>');
               $("#effdt").focus();
               $("#errors").show();
               return false;
            }
            
           } 
 
        // Validate the employee id field
        if ($('#actopt').val() == 'cnv'){
        if(($("#empid").val().length < 6) || $("#empid").val() == '' ){
                  $("#errors").html('<p class="error">Employee Id must be specified if the consultant is converting!</p>');
            		$("#effdt").focus();
            		$("#errors").show();
            		return false;
            }
         }
         
         // Validate the Fin Org field
            /* validate the 'finance' field
        if ($("#finorg").val() == "") {
              $("#errors").html('<p class="error">Enter a valid Financial Org !</p>');
            $("#finorg").focus();
            $("#errors").show();
            return false;
        } */   
        
         // validate the 'effective date' field
       var sqleffdt = '';
         if ($("#effdt").val() !=$("#effdt_h").val() )
        {  sqleffdt = "DATE(STR_TO_DATE('" + $("#effdt").val() + "','%m/%d/%y'))";
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",effdt="+ sqleffdt;
                }
            else
            {
                change_ind = 'Y';
                change_str =  " effdt="+ sqleffdt ;
                }
            } 
 
     // validate the 'Type' field
         if ($("#ttype").val() !=$("#type_h").val() )
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
         if ($("#classi").val() !=$("#classi_h").val() )
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
           
       // validate the 'It End Date' field
        if ($("#it_end_dt").val() == "") {
            $("#errors").html('<p class="error">A planned exit date is required!</p>');
            $("#it_end_dt").focus();
            $("#errors").show();
            return false;
        }
        var sqlenddt = '';
// validate the IT End Date  field
         if ($("#it_end_dt").val() !=$("#it_end_dt_h").val() )
        {   sqlenddt =  "DATE(STR_TO_DATE('" + $("#it_end_dt").val() + "','%m/%d/%Y'))";
        
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",it_end_date="+ sqlenddt ;
                }
            else
            {
                change_ind = 'Y';
                change_str =  " it_end_date="+ sqlenddt  ;
                }
            }
            
         // validate the COMMENT  field
         if ($("#comments").val() !=$("#comments_h").val() )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",comments='"+ $("#comments").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " comments='"+ $("#comments").val() + "'";
                }
            }
           
        // validate the requisition  field
         if ($("#reqnum").val() !=$("#reqnum_h").val() )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",req_num='"+ $("#reqnum").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " req_num='"+ $("#reqnum").val() + "'";
                }
            } 

           
        // validate the Financial Org  field
         if ($("#finorg").val() !=$("#finorg_h").val() )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",financial_org='"+ $("#finorg").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " financial_org='"+ $("#finorg").val() + "'";
                }
            } 
            
           if (change_ind != 'Y')
           {
                $("#errors").html('<p class="error">Nothing to Update!</p>');
                return false;
            }
 
            /*var insertstr = '';   

                 if ($('#actopt').val() == 'hir')
                 {
                 insertstr = "('"  + $("#fname").val() + "','" + $("#lname").val() + "'," + "DATE(STR_TO_DATE('" + $("#effdt").val() + "','%m/%d/%Y'))" + ",'" + $("#ttype").val() +"','" + $("#actopt").val() + "','"+$("#rsntype").val()  + "','"+ $("#classi").val() + "','" + $("#reqnum").val() + "','" + $("#btitle").val() + "','" + $("#location").val() + "','" + $("#dept").val() + "','" + $("#finance").val() + "','"+$("#finorg").val()+ "','" + $("#vpid").val() + "','" +  $("#wemail").val() + "','" + $("#bossid").val() + "'," + "DATE(STR_TO_DATE('" + $("#it_end_dt").val() + "','%m/%d/%Y'))"  + ",'" + $("#hrid").val() +  "','" + $("#wphone").val() + "','" + $("#legal").val() + "','" + $("#comments").val() + "')";
                 }
                 else
                 {
                  insertstr = "(" + $("#ids").val() + ",'" + $("#fname").val() + "','" + $("#lname").val() + "'," +  "DATE(STR_TO_DATE('" + $("#effdt").val() + "','%m/%d/%Y'))"+ ",'" + $("#ttype").val() +"','" + $("#actopt").val() + "','"+$("#rsntype").val()  + "','"+ $("#classi").val() + "','" + $("#reqnum").val() + "','" + $("#btitle").val() + "','" + $("#location").val() + "','" + $("#dept").val() + "','" + $("#finance").val() + "','" +$("#finorg").val()+ "','" + $("#vpid").val() + "','" +  $("#wemail").val() + "','" + $("#bossid").val() + "'," + "DATE(STR_TO_DATE('" + $("#it_end_dt").val() + "','%m/%d/%Y'))"  + ",'" + $("#hrid").val() +  "','" + $("#wphone").val() + "','" + $("#legal").val() + "','" + $("#comments").val()+ "','" + $("#empid").val() + "')";
                 }       */        

       // validate the Emplid  field
         if ($("#empid").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + ",emplid='"+ $("#empid").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " emplid='"+ $("#empid").val() + "'";
                }
            }       
       var mailind = 'N'; 
       var urlvariable = $("#ids").val();             
       if ($('#sendmail').is(':checked')){
            mailind = 'Y';
            	 } 
       var updtkey = '';
         if ($("#actopt").val() == 'upd'){
        updtkey = ' where id='+ $("#ids").val()+ " and effdt = '" + $("#effdt").val() + "' and action_type = '"+ $("#actopt_h").val() + "'";
              if (confirm('The update will overwrite the present data. If you want to retain history, please click No and change the action to Transfer') == false)
               {
                  return false;
               }
                }
           else
            {
        updtkey = ' where id='+ $("#ids").val()+ " and effdt = '" + $("#effdt").val() + "' and action_type = '"+ $("#actopt").val() + "'";
                }
        $.ajax({
            type: "POST",
            url: '../../srccd/dbrtn/updateform.php',
            dataType:"json",
            data: ({insertdata: insertstr,action:$("#actopt").val(),updtstr:change_str,id:$("#ids").val(),mail:mailind,update:updtkey}),
            error: function(msg) {
                $("#errors").html(msg.message);
                $('#errors').show();
               // alert('I am in error' + msg.message);
                },
            success: function(msg) {
                // display the errors returned by server side validation (if any)
                 if(msg.success == true){
                $('#success').html('<h4>' + msg.message + '</h4>');
                $('#success').show();
                $('#errors').slideUp();
                if ($("#actopt").val() == 'hir')
                {
                	$('#addnew').show();
                	$('#updt').slideUp();
                }
                }
                else {
                    $('#errors').html('<h3>' + msg.message + '</h3>');
                    $('#errors').show();
                    $('#success').slideUp();
                     } 
                 }                  
       });
           });
    //Go back to the search page
$('#srch').click(function(){
     document.location = '../../srccd/dbrtn/read_ee.php';
         });  

       
    //Go back to the add page
$('#addnew').click(function(){
     document.location = '../../srccd/dbrtn/ee_info.php';
         });           
         
    //Go to the Vendor Details Page
$('#vndr').click(function(){
     document.location = '../../srccd/dbrtn/updt_vndr.php';
         }); 
   })