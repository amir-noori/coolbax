
//for cloud
$(document).ready(function(){
						   
	// This initialises carousels on the container elements specified, in this case, carousel1.
	$("#cloudPhoto").CloudCarousel(		
		{	
			xPos: 187,
			yPos: 70,
			buttonLeft: $("#left-but"),
			buttonRight: $("#right-but"),
			altBox: $("#alt-text"),
			titleBox: $("#title-text"),
			bringToFront: true
		}
	);
});
//end cloud

//tabs
$(function() {
        $( "#login" ).tabs();
});

$(function() {
        $( "input[type=submit], button" )
            .button();
});
//end tabs

//message
function showMessage()
{
	var form = $('#loginForm');
	var userName = $('#userName');
	var password = $('#password');
	form.submit(function() {
			if((userName.val() == '') || (password.val() == ''))
			{
				$(function() {
				    $( "#dialog-message2" ).dialog({
				        modal: true,
				        buttons: {
				            Ok: function() {
				                $( this ).dialog( "close" );
				            }
				        }
				    });
				});
				return false;
			}
			else
			{
				return true;
			}
		});
}

var url = window.top.location.href;
if(url.indexOf("?login_failed") !=-1)
{
	$(function() {
	    $( "#dialog-message1" ).dialog({
	        modal: true,
	        buttons: {
	            Ok: function() {
	                $( this ).dialog( "close" );
	            }
	        }
	    });
	});
}
//end message