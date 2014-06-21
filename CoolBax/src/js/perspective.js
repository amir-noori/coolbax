//the following element is for jquery ui button element 
$(function() {
    $( "button" )
      .button()
      .click(function( event ) {
        event.preventDefault();
      });
  });



//this function is for sharing data when user click share
function share()
{
	var xmlhttp;
	if(window.XMLHttpRequest)
	{
		xmlhttp = new XMLHttpRequest();
	}
	else
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	var data = $('#shareData');
	var whoShared = window.user;
	
	xmlhttp.open("POST" , "../controller/ShareController.php" , true);
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
	xmlhttp.send( "data" + "=" + data.val());
	
}