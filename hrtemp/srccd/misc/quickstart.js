function getXMLHttp()
{
  var xmlHttp

  try
  {
    //Firefox, Opera 8.0+, Safari
    xmlHttp = new XMLHttpRequest();
  }
  catch(e)
  {
    //Internet Explorer
    try
    {
      xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e)
    {
      try
      {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e)
      {
        alert("Your browser does not support AJAX!")
        return false;
      }
    }
  }
  return xmlHttp;
}

function MakeRequest(para)
{
  /*alert($_POST("Inquire"));*/	 
  var xmlHttp = getXMLHttp();
 
  xmlHttp.onreadystatechange = function()
  {
    if(xmlHttp.readyState == 4)
    {
      HandleResponse(xmlHttp.responseText);
      
    }
    
  }
  var params = 'id';
    xmlHttp.open("POST", "readtable.php", true);
  xmlHttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlHttp.setRequestHeader("Content-length",params.length);
  xmlHttp.setRequestHeader("Connection","close");
  xmlHttp.send("params ="+ para);

}

function HandleResponse(response)
{
  document.getElementById('DivMsg').innerHTML = response;
}
