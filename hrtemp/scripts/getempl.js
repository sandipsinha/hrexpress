function lookup(inputString) {
	alert("the staring is"+inputString);
	 if (inputString.length ==0){
	 	$('#suggestions').hide();
	 	} else {
	 		$.post("/srccd/getname.php",{queryString:""+inputString+""}, function(data){
	 			  if (data.length > 0){
	 			  	$('#suggestions').show();
	 			  	$('#autoSuggestionsList').html(data);
	 			  }
	 		});
	 	} //LoopUp

function fill(thisvalue){
	$('#inputString').val(thisvalue);
	setTimeout("$('#suggestions').hide();",200);
}

	 	
