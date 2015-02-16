$("#login_form").submit(function()
{
        //remove all the class add the messagebox classes and start fading
        $("#msgbox").removeClass().addClass('messagebox').text('Validating....').fadeIn(1000);
        //check the username exists or not from ajax
        $.post("ajax_login.php",{ user_name:$('#username').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
        {
          if(data=='yes') //if correct login detail
          {
                $("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
                {
                  //add message and change the class of the box and start fading
                  $(this).html('Logging in.....').addClass('messageboxok').fadeTo(900,1,
                  function()
                  {
                     //redirect to secure page
                     document.location='secure.php';
                  });
                });
          }
          else
          {
                $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
                {
                  //add message and change the class of the box and start fading
                  $(this).html('Your login detail sucks...').addClass('messageboxerror').fadeTo(900,1);
                });
          }
       });
       return false;//not to post the  form physically
});