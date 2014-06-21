$(function() {
    $( "#mainTabs" ).tabs({
        beforeLoad: function( event, ui ) {
            ui.jqXHR.error(function() {
                ui.panel.html(
                    "Couldn't load this tab. We'll try to fix this as soon as possible. " +
                    "If this wouldn't be a demo." );
            });
        }
    });
});

$(function() {
    $( "#sideTabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    $( "#sideTabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
});

$(function() {
    $( "#accordion" ).accordion({
        collapsible: true
    });
});

function mainTabClick(event)
{
    event = event || window.event;
    var target = event.target || event.srcElement;
    var id = target.id;
    
    var div = document.createElement("div");
    div.innerHTML = 'Main Stuff Goes Here<br>' +
			    '<ul>' +
				'<li>News</li>' +
				'<li>Stories</li>' +
				'<li>Photos</li>' +
				'<li>etc...</li>' +
			    '</ul>';
    div.id = "nextArticle";
    document.getElementById('article').appendChild(div);
    
}

//ballon begin
/*
note: I changed the defaults in lib/js/jquery.balloon.js, cause applying the followng css does'nt take effect
*/
$(document).ready(function(){	
	$('.showFriendInfoBallon').balloon({
		  tipSize: 24,
		  css: {
		    border: 'solid 4px #5baec0',
		    padding: '10px',
		    fontSize: '150%',
		    fontWeight: 'bold',
		    lineHeight: '3',
		    backgroundColor: '#666',
		    color: '#fff'
		  }
		});
	});

//ballon end

//jquery ui tooltip begin

$(function() {
    $( document ).tooltip({
        position: {
            my: "center bottom-20",
            at: "center top",
            using: function( position, feedback ) {
                $( this ).css( position );
                $( "<div>" )
                    .addClass( "arrow" )
                    .addClass( feedback.vertical )
                    .addClass( feedback.horizontal )
                    .appendTo( this );
            }
        }
    });
});

//jquery ui tooltip end


//chat begin

function chat(firendName)
{	
	var x = '#' + firendName + 'ChatDialog';
	if(x.indexOf('.') > 0)
	{
		x = x.replace('.', '\\.');
	}
	var THIS = $(x);
	$(function() {		
		THIS.dialog({
	    	stack: false
	    });
	});

}


function chatController(event , friendName , userName)
{
	var xmlhttpSubject;
	if(window.XMLHttpRequest)
	{
		xmlhttpSubject = new XMLHttpRequest();
	}
	else
	{
		xmlhttpSubject = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttpSubject.open("POST" , "../controller/ChatSubjectController.php" , true);
	
	var chatInput = document.getElementById(friendName + 'ChatInput');
	var message = chatInput.value;
	var responseArea = document.getElementById( friendName + 'ChatArea');
	
	var keycode;
    if(window.event) 
    {
        keycode = window.event.keyCode;
    }
    else
    {
        keycode = event.which;
    }
    
    
    if(keycode == 13)
    {   
    	if(message.length < 1)
    	{
    		//do nothing
    	}
    	else
    	{
    		chatInput.value = '';
	    	responseArea.innerHTML += "You: " + message + "<hr>";
	    	xmlhttpSubject.onreadystatechange = function()
	    	{
	    		 if (xmlhttpSubject.readyState == 4)
	    		 {
	    		     if(xmlhttpSubject.status == 200) 
	    		     {
	    		    	 responseArea.innerHTML += xmlhttpSubject.response;
	    		     }
	    		     else 
	    		     {
	    		        //alert("Error during AJAX call. Please try again #001");
	    		     }
	    		 }
	    	};
	    	xmlhttpSubject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	    	xmlhttpSubject.send("sender=" + userName + "&receiver=" + friendName + "&message=" + message);
    	}
    }
    else
    {
    	/*
    	xmlhttpObserver.onreadystatechange = function()
    	{
    		 if (xmlhttpObserver.readyState == 4)
    		 {
    		     if(xmlhttpObserver.status == 200) 
    		     {
    		       
    		     }
    		     else 
    		     {
    		        alert("Error during AJAX call. Please try again");
    		     }
    		 }
    	};
    	xmlhttpObserver.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    	xmlhttpObserver.send();
    	
    	
    	xmlhttpSubject.onreadystatechange = function()
    	{
    		 if (xmlhttpSubject.readyState == 4)
    		 {
    		     if(xmlhttpSubject.status == 200) 
    		     {
    		       
    		     }
    		     else 
    		     {
    		        alert("Error during AJAX call. Please try again");
    		     }
    		 }
    	};
    	xmlhttpSubject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    	xmlhttpSubject.send();
    	 */
    }
    
    setInterval(function(){
    	
    	var xmlhttpObserver;
    	if(window.XMLHttpRequest)
    	{
    		xmlhttpObserver = new XMLHttpRequest();
    	}
    	else
    	{
    		xmlhttpObserver = new ActiveXObject("Microsoft.XMLHTTP");
    	}
    	
    	xmlhttpObserver.open("POST" , "../controller/ChatObserverController.php" , true);
      
    	xmlhttpObserver.onreadystatechange = function()
    	{
    		 if (xmlhttpObserver.readyState == 4)
    		 {
    		     if(xmlhttpObserver.status == 200) 
    		     {
    		    	 if((xmlhttpObserver.response).length > 4)
    		    	 {
    		    		 responseArea.innerHTML += friendName + ": " + xmlhttpObserver.response;
    		    	 }
    		     }
    		     else 
    		     {
    		        //alert("Error during AJAX call. Please try again #002");
    		     }
    		 }
    	};
    	xmlhttpObserver.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    	xmlhttpObserver.send("sender=" + friendName + "&receiver=" + userName);
    	
    } ,6000);

}


//setting some global variables
$(document).ready(function(){
	window.user = document.getElementById('thisUser').value;
	window.onlineArea = $("#whoIsOnlineList");
	window.onlineAreaList = $("#whoIsOnlineList li");
	window.firendListToSend = "count=";
});


if(window.XMLHttpRequest)
{
	xmlhttp = new XMLHttpRequest();
}
else
{
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}

//notify user if someone has or had send a message
setInterval(function(){
	
	xmlhttp.open("POST" , "../controller/ChatNotifyController.php" , true);
  
	xmlhttp.onreadystatechange = function()
	{
		 if (xmlhttp.readyState == 4)
		 {
		     if(xmlhttp.status == 200) 
		     {
		    	 if((xmlhttp.response).length > 4)
		    	 {
		    		 	var friendName = (xmlhttp.response).replace(/^\s*$[\n\r]{1,}/gm, '');
		    		 	var responseArea = document.getElementById( friendName + 'ChatArea');
		    		 	
		    			var x = friendName ;
		    			
		    			if(x.indexOf('.') > 0)
		    			{
		    				x = x.replace('.', '\\.');
		    			}
		    		 	
		    		 	var link = $('#' + x);
		    		 	var input = $('#' + x + 'ChatInput');
		    		 	var e = jQuery.Event("keydown");
		    		 	e.which = 13;
		    		 	
		    		 	if(link.length > 0)
		    		 	{
		    		 		link.click();
		    		 		input.trigger(e);
		    		 	}
		    		 	else
		    		 	{			    		 	
			    		 	var html = "<li><a class=\"onlineUserLink\" id=\"" + friendName + "\" onclick=\"chat(" + "'" + friendName + "'"  + ")\" >" + friendName + "</a></li>";	 
			    		 	html += "<div class=\"chatDialog\" title=\"'" + friendName + "\"' id=\"'" +  friendName + 'ChatDialog' + "'\">";
			    		 	html += "<div class=\"chatArea\"" +  " id=\"'" +  friendName + "ChatArea" + "'\">" + "</div>";				       				        
			    		 	html += "<input class=\"chatInput\"" + " id=\"'" +  friendName + 'ChatInput' + "'\" size=\"21\"  onkeydown=\"chatController(event , '" +  friendName + "' , '" +  window.user + "')>" + "</div>";
					
			    		 	window.onlineArea.innerHTML += html;

			    			var THIS = $('#' + x  + 'ChatDialog');
			    			$(function() {		
			    				THIS.dialog({
			    			    	stack: false
			    			    });
			    			});
			    			
			    			link.click();
			    			input.trigger(e);
		    		 	}
		    	 }
		     }
		     else 
		     {
		        //alert("Error during AJAX call. Please try again #003");
		     }
		 }
	};
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.send("user=" + window.user);
	
} ,5000);


//notify user if someone is online
setInterval(function(){
	
	var len = window.onlineArea.children("li").length;
	window.firendListToSend += len + "&";
	for(var i = 0 ; i < len ; i++)
	{
		window.firendListToSend += i + "=" + window.onlineArea.children("li:eq(" + i + ")").text() + "&";
	}


	xmlhttp.open("POST" , "../controller/RefreshWhoIsOnlineController.php" , true);
	  
	xmlhttp.onreadystatechange = function()
	{
		 if (xmlhttp.readyState == 4)
		 {
		     if(xmlhttp.status == 200) 
		     {
		    	 if(xmlhttp.response.indexOf("*") !== -1)
		    	 {
		    		 $("#whoIsOnlineList li").each(function() {
		    			 var splitedResponse = xmlhttp.response.split(" ");
		    			 for(var i = 0 ; i < splitedResponse.length ; i++)
		    			 {
		    				 var friendName =  splitedResponse[i].substring(splitedResponse[i].indexOf("*") + 1 , splitedResponse[i].indexOf("#"));
		    				 
	    					 if(friendName.indexOf('.') > 0)
	    					 {
	    						 friendName = friendName.replace('.', '\\.');
	    					 }
	    					 $("#" + friendName).parent("li").remove();
	    					 if(!($("#" + friendName + "ChatDialog").css('display') == "block"))
	    					 {	 
	    					 	$("#" + friendName + "ChatDialog").remove();
	    					 }
		    			 }
		    		}); 
		    	 }
		    	 else
		    	 {
		    		 window.onlineArea.append(xmlhttp.response);
		    	 }
		     }
		     else 
		     {
		        //alert("Error during AJAX call. Please try again #004");
		     }
		 }
	};
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	xmlhttp.send(window.firendListToSend);
	window.firendListToSend = "count=";
	
} ,4000);

//chat end
