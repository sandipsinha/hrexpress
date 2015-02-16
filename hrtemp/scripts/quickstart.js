var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject()
  {
    var xmlHttp;
    if (window.ActiveXObject)
      {
       try {
          xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
        catch (e){
           xmlHttp = false;
                 }
     else
      {             
         try {
          xmlHttp = new XMLHttpRequest();
            }
        catch (e){
           xmlHttp = false;
                 }  
       }
      if (!xmlHttp)
         alert("Error creating the xmlHttpRequest object.");
      else
          return xmlHttp;
        }
        
   function process()
   {
     if (xmlHttp)
        {
        	try
        	{
        	 //try to connect to the server
          xmlHTTP.open("POST","readtable.php",true);
          xmlHttp.onreadystatechange = handleRequestStateChange;
          xmlHttp.send($_POST['Inquire']);
          document.body.style.cursor = "wait";
         }
        //display errors if there's a failure
        catch(e)
         {
        	alert("Can't connect to server:\n" +e.toString());
        	document.body.style.cursor = ""default";
        	}
        	}
        	}
      
      function handleRequestStatechange()
      {
      	mydiv = document.getElementById("divMessage");
      	if (xmlHttp.readyState == 1)
      	{
      	 mydiv.innerHTML += "Request Status: 1(Loading) <br/>";
         }
         else if (xmlHttp.readyState == 2)
         {
      	 mydiv.innerHTML += "Request Status: 2(Loaded) <br/>";
      	}
      	else if (xmlHttp.readyState == 3)
         {
      	 mydiv.innerHTML += "Request Status: 3(Interactive) <br/>";
      	}
else  if (xmlHttp.readyState == 4)
         {
      	 document.body.style.cursor ="default";
      	 if (xmlHttp.status == 200)
      	 {
      	 	try
      	 	{
      	 		handleServerResponse();
      	 	}
      	 	catch(e)
      	 	{
      	 	alert("error reading the response :"+e.toString());
      	 }
      }
      else
      {
      	   alert("There was a problem retrieving the data:\n"+ xmlHttp.statusText);
      	   document.body.style.cursor = "default";
      	}
      }
   }
      	}      
      	
     function handleServerResponse()
     {
     	 var xmlResponse = xmlHttp.responseXML;
     	 xmlRoot = xmlRespone.documentElement;
     	 col1 = xmlRoot.getElementByTagName("col1");
     	 col2 = xmlRoot.getElementByTagName("col2");
     	 var html = "";
     	 for (var i = 0;i<col1.length;i++)
     	     html += col1.item(i).firstChild.data + ", "+ col2.item(i).firstChild.data+"<br/>";
     	 myDiv = document.getElementById("divMessage");
     	 myDiv.innerHTML = html;
     }
      	 
        	      