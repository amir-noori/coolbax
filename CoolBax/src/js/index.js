//begin Ajax register
var xmlhttp;
if(window.XMLHttpRequest)
{
	xmlhttp = new XMLHttpRequest();
}
else
{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

function AjaxValidator(data)
{
	var element = document.getElementById(data);
	
	xmlhttp.open("POST" , "./src/php/controller/RegisterController.php" , true);
	xmlhttp.onreadystatechange = function()
	{
		 if (xmlhttp.readyState == 4)
		 {
		     if(xmlhttp.status == 200) 
		     {
		       document.getElementById("errors").innerHTML=xmlhttp.responseText;
		     }
		     else 
		     {
		        alert("Error during AJAX call. Please try again");
		     }
		 }
	}
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	
	if(data == 'pass' || data == 'rPass')
	{
		element1 = document.getElementById('pass');
		element2 = document.getElementById('rPass');
		xmlhttp.send( "pass=" + element1.value + "&rPass=" + element2.value);
	}
	else
	{
		xmlhttp.send( data + "=" + element.value);
	}
    
}
//end Ajax register


$(function() {
    $( "input[type=submit], button" )
        .button();
});