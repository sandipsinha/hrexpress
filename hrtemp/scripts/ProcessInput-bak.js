function ProcessInput() {
	alert('At the start vpidis');
	var change_ind = 'N';
   var change_str = '';
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
            
      alert('just before vpidis ');
      
// validate the 'VP'  field
/*
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
            
         } */          

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
            
 
// validate the 'HR'  field
         if ($("#hrid").val() !=$("#hrid_h").val() )
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
 
           var insertstr = '';   

                 if ($('#actopt').val() == 'hir')
                 {
                 //insertstr = "('"  + $("#fname").val() + "','" + $("#lname").val() + "'," + "DATE(STR_TO_DATE('" + $("#effdt").val() + "','%m/%d/%Y'))" + ",'" + $("#ttype").val() +"','" + $("#actopt").val() + "','"+$("#rsntype").val()  + "','"+ $("#classi").val() + "','" + $("#reqnum").val() + "','" + $("#btitle").val() + "','" + $("#location").val() + "','" + $("#dept").val() + "','" + $("#finance").val() + "','"+$("#finorg").val()+ "','" + $("#vpid").val() + "','" +  $("#wemail").val() + "','" + $("#bossid").val() + "'," + "DATE(STR_TO_DATE('" + $("#it_end_dt").val() + "','%m/%d/%Y'))"  + ",'" + $("#hrid").val() +  "','" + $("#wphone").val() + "','" + $("#legal").val() + "','" + $("#comments").val() + "')";
                 insertstr = "('"  + $("#fname").val() + "','" + $("#lname").val() + "'," + "DATE(STR_TO_DATE('" + $("#effdt").val() + "','%m/%d/%Y'))" + ",'" + $("#ttype").val() +"','" + $("#actopt").val() + "','"+$("#rsntype").val()  + "','"+ $("#classi").val() + "','" + $("#reqnum").val() + "','" + $("#btitle").val() + "','" + $("#location").val() + "','" + $("#dept").val() + "','" + $("#finance").val() + "','"+$("#finorg").val()+ "','"  +  $("#wemail").val() + "','" + $("#bossid").val() + "'," + "DATE(STR_TO_DATE('" + $("#it_end_dt").val() + "','%m/%d/%Y'))"  + ",'" + $("#hrid").val() +  "','" + $("#wphone").val() + "','" + $("#legal").val() + "','" + $("#comments").val() + "')";
                 }
                 else
                 {
                  //insertstr = "(" + $("#ids").val() + ",'" + $("#fname").val() + "','" + $("#lname").val() + "'," +  "DATE(STR_TO_DATE('" + $("#effdt").val() + "','%m/%d/%Y'))"+ ",'" + $("#ttype").val() +"','" + $("#actopt").val() + "','"+$("#rsntype").val()  + "','"+ $("#classi").val() + "','" + $("#reqnum").val() + "','" + $("#btitle").val() + "','" + $("#location").val() + "','" + $("#dept").val() + "','" + $("#finance").val() + "','" +$("#finorg").val()+ "','" + $("#vpid").val() + "','" +  $("#wemail").val() + "','" + $("#bossid").val() + "'," + "DATE(STR_TO_DATE('" + $("#it_end_dt").val() + "','%m/%d/%Y'))"  + ",'" + $("#hrid").val() +  "','" + $("#wphone").val() + "','" + $("#legal").val() + "','" + $("#comments").val()+ "','" + $("#empid").val() + "')";
                   insertstr = "(" + $("#ids").val() + ",'" + $("#fname").val() + "','" + $("#lname").val() + "'," +  "DATE(STR_TO_DATE('" + $("#effdt").val() + "','%m/%d/%Y'))"+ ",'" + $("#ttype").val() +"','" + $("#actopt").val() + "','"+$("#rsntype").val()  + "','"+ $("#classi").val() + "','" + $("#reqnum").val() + "','" + $("#btitle").val() + "','" + $("#location").val() + "','" + $("#dept").val() + "','" + $("#finance").val() + "','" +$("#finorg").val()+ "','" +  $("#wemail").val() + "','" + $("#bossid").val() + "'," + "DATE(STR_TO_DATE('" + $("#it_end_dt").val() + "','%m/%d/%Y'))"  + ",'" + $("#hrid").val() +  "','" + $("#wphone").val() + "','" + $("#legal").val() + "','" + $("#comments").val()+ "','" + $("#empid").val() + "')";
                 }                 

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
                return false;
               // alert('I am in error' + msg.message);
                },
            success: function(msg) {
                // display the errors returned by server side validation (if any)
                 if(msg.success == true){
                $('#success').html('<h4>' + msg.message + '</h4>');
//                $('#success').show();
                $('#errors').slideUp();
                if ($("#actopt").val() == 'hir')
                {
                	$('#addnew').show();
                	$('#updt').slideUp();
                }
                return true;
                }
                else {
                    $('#errors').html('<h3>' + msg.message + '</h3>');
                    //$('#errors').show();
                    $('#success').slideUp();
                    return false;
                     } 
                 }                  
       });
             return true;
           
     
   }