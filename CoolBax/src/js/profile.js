
var xmlhttp;
if(window.XMLHttpRequest)
{
	xmlhttp = new XMLHttpRequest();
}
else
{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

function profileEdit(key)
{
	var element = document.getElementById(key);
	
	xmlhttp.open("POST" , "../controller/ProfileEditController.php" , true);
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
	};
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.send( key + "=" + element.value);

}

function profileSave(key)
{

	var element = document.getElementById(key);
	
	xmlhttp.open("POST" , "../controller/ProfileEditController.php" , true);
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
	};
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	xmlhttp.send( "save=true" + "&" + element.id + "=" + $("[id='" + element.id + "']").val());
}



$(document).ready(function(){
	  $(".edit").click(function(){
		  	//create global variable, so if  user cancel editing, the input will contain previews value c#1
		    var id =  $(this).prev(".userInfo").attr('id');
		    id = id.replace(/ /gi, "_");
		  	var str = "window." + id + "='" + $(this).prev(".userInfo").val() + "';";
		  	eval(str);
		  	//end creating c#2
		  	
			$(this).fadeOut();
			$(this).next(".save").fadeIn();
			$(this).next(".save").next(".cancel").fadeIn();
			$(this).prev(".userInfo").attr('readonly', false);
			$(this).prev(".userInfo").css('background-color' , '#FFF0DE');
	  });
	});

$(document).ready(function(){
	  $(".save").click(function(){
			$(this).fadeOut();
			$(this).next(".cancel").fadeOut();
			$(this).prev(".edit").fadeIn();
			$(this).prev(".edit").prev(".userInfo").attr('readonly', true);
			$(this).prev(".edit").css('position' , 'absolute');
			$(this).prev(".edit").css('left' , '630px');
			$(this).prev(".edit").css('margin-top' , '-20px');
			$(this).prev(".edit").prev(".userInfo").css('background-color' , '#EDEDED');
	  });
	});

$(document).ready(function(){
	  $(".cancel").click(function(){
		    //retrive global variable of previes value c#3 (ref c#1)
		  	var id = $(this).prev(".save").prev(".edit").prev(".userInfo").attr('id');
		  	id = id.replace(/ /gi, "_");
		  	var str =  "window." + id;
		  	//end retriving c#4
		  	
		    $(this).prev(".save").prev(".edit").prev(".userInfo").val(eval(str));
			$(this).fadeOut();
			$(this).prev(".save").fadeOut();
			$(this).prev(".save").prev(".edit").fadeIn();
			$(this).prev(".save").prev(".edit").prev(".userInfo").attr('readonly', true);
			$(this).prev(".save").prev(".edit").css('position' , 'absolute');
			$(this).prev(".save").prev(".edit").css('left' , '630px');
			$(this).prev(".save").prev(".edit").css('margin-top' , '-20px');
			$(this).prev(".save").prev(".edit").prev(".userInfo").css('background-color' , '#EDEDED');
	  });
	});


$(document).ready(function(){	
	
	
	  $(".fileSubmit").click(function(){
		  
		  $("#loading")
			.ajaxStart(function(){
				$(this).show();
			})
			.ajaxComplete(function(){
				$(this).hide();
			});
			
			$.ajaxFileUpload
			(
				{
					url:'../controller/ImageUploadController.php', 
					secureuri:false,
					fileElementId:'profileImage',
					dataType: 'json',
					success: function (data, status)
					{
						if(typeof(data.error) != 'undefined')
						{
							if(data.error != '')
							{
								alert(data.error);
							}else
							{
								alert(data.msg);
							}
						}
					},
					error: function (data, status, e)
					{
						alert(e);
					}
				}
			);
			
			return false;
	  });
});

