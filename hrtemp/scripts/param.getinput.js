 $().ready(function() {
  //$('#addnew').addClass('reallyHide');
    $('#success').hide();

               
//This is the autocompleter script to populate the Department field
       //This is the autocompleter script to populate the Department field - Begin
        $("#dept").autocomplete({
            source:"../lookup/get_tempdept.php", 
            minLength:1,
            select: function(event, ui) {
                  $('#dept').val(ui.item.value);
                 }
           });
	
	
 
            //This is the autocompleter script to populate the Legal Entity field - Begin
          $("#legal").autocomplete({
               source:"../lookup/get_templegal.php", 
                minLength:1,
              select: function(event, ui) {
                      $('#legal').val(ui.item.value);
                     }
              });
	
	
   
    //This is the autocompleter script to populate the Fin Field
          $("#finance").autocomplete({
               source:"../lookup/get_tempfin.php", 
                minLength:1,
              select: function(event, ui) {
                      $('#finance').val(ui.item.value);
                     }
              });
     
	   
    	 //This is the autocompleter script to populate the VP Field
    
          
    
        	 //This is the autocompleter script to populate the HR Field
             $("#hr").autocomplete({
               source:"../lookup/get_temphr.php", 
                minLength:1,
              select: function(event, ui) {
                      $('#hrid').val(ui.item.id);
                     }
              }); 
          
       //This is the autocompleter script to populate the Location field - Begin
          $("#location").autocomplete({
               source:"../lookup/get_temploc.php", 
                minLength:1,
              select: function(event, ui) {
                      $('#location').val(ui.item.value);
                     }
              });
//This is the autocompleter script to populate the VP Field
        $("#vp").autocomplete({
                source:"../lookup/get_tempvp.php", 
                minLength:1,
                select: function(event, ui) {
                  $("#vpid").val(ui.item.value);
                 }});    

  

  $('#srch').click(function(){
  	             document.location = '../../srccd/dbrtn/eegrid.php';  
  	             $('#content').show();
                $("#results").hide();  
                $('#success').hide();

         });  
         
$('form[name="reportform"]').submit(function(e) {
	     
        e.preventDefault();
        var change_ind = 'N';
        var change_str = '';
        
if ($("#actopt").val() !='all' )
           {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND Action_type='"+ $("#actopt").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " Action_type= '" + $("#actopt").val() + "'";
                }
            }
            
        if ($("#dept").val() !='' )
           {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND department='"+ $("#dept").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " department= '" + $("#dept").val() + "'";
                }
            }

		if ($("#legal").val() !='' )
           {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND legal_entity ='" + $("#legal").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  "legal_entity='" +   $("#legal").val() + "'";
                }
            }
     // validate the 'Classification' field  
      if ($("#classi").val() !='' && $("#classi").val() !='all' ) 
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND classification='"+ $("#classi").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " classification='"+ $("#classi").val() + "'";
                }
            }


     // validate the 'Type' field  
      if ($("#ttype").val() !='' && $("#ttype").val() !='all' ) 
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND type='"+ $("#ttype").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " type='"+ $("#ttype").val() + "'";
                }
            }
// validate the 'Action Reason' field 
      if ($("#rsntype").val() !='' && $("#rsntype").val() !='all' ) 
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND reason='"+ $("#rsntype").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " reason='"+ $("#rsntype").val() + "'";
                }
            }            
            
// validate the 'VP'  field
         if ($("#vpid").val() !='' )
          {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND VP_Id='"+ $("#vpid").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " VP_Id='"+ $("#vpid").val() + "'";
                }
            }  
            
  /*     

        
            }*/
        // validate the 'Location' field
     if ($("#location").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND Location='"+ $("#location").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " Location='"+ $("#location").val() + "'";
                }
            }
// validate the 'HR' field
     if ($("#hrid").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND HR_id='"+ $("#hrid").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " HR_id='"+ $("#hrid").val() + "'";
                }
            }
            
            // validate the 'finance' field
         if ($("#finance").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND finance='"+ $("#finance").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " finance='"+ $("#finance").val() + "'";
                }
            } 
            
         // Include the Start Date
         if ($("#start_date").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND start_date >='"+ $("#start_date").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " start_date >='"+ $("#start_date").val() + "'";
                }
            } 

			// Include the End Date
         if ($("#end_date").val() !='' )
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND end_date <='"+ $("#end_date").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " end_date <='"+ $("#end_date").val() + "'";
                }
            }         
        
   // validate the 'Region' field  
      if ($("#region").val() !='' && $("#region").val() !='all' ) 
        {
            if (change_ind == 'Y')
              {
                  change_str = change_str + " AND region='"+ $("#region").val() + "'";
                }
            else
            {
                change_ind = 'Y';
                change_str =  " region='"+ $("#region").val() + "'";
                }
            }       

            
            if (change_ind != 'Y')
             {
             	change_str =  "none";
             }	
           var  selectstr = 'Select id,first_name,last_name,reason,Action_Descr,Type_Descr,Start_date,End_date,Region'; 
       $(':checkbox:checked').each(function(i){
       	   
       	selectstr  += ', ' + $(this).val();       	      
       	      
       	 }); 
       	  
       selectstr = selectstr + ' from temp_360_vw';    

            
        $.ajax({
            type: "POST",
            url: '../../srccd/dbrtn/displaygrid.php',
            data: ({updtstr:change_str,select:selectstr}),
            error: function(response) {
                $("#errors").html(response);
                $("#results").slideUp();  
                $('#success').slideUp();
            },
            success: function(response) {
                // display the errors returned by server side validation (if any)
                $('#content').slideUp();
                $("#results").html(response);  
                $('#success').show();
                }
              
        });
    });
                  
   })
