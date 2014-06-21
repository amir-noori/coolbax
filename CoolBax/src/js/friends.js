
var xmlhttp;
if(window.XMLHttpRequest)
{
	xmlhttp = new XMLHttpRequest();
}
else
{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

$('.showFriendInfoBallon').mouseover(function() {
	var THIS = $(this);
	xmlhttp.open("POST" , "../controller/ShowUserInfoInDialogController.php" , true);
	xmlhttp.onreadystatechange = function()
	{
		 if (xmlhttp.readyState == 4)
		 {
		     if(xmlhttp.status == 200) 
		     {
		    	 THIS.balloon({ contents: xmlhttp.responseText });
		     }
		     else 
		     {
		        alert("Error during AJAX call. Please try again");
		     }
		 }
	};
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.send( "friendName" + "=" + this.id);
});