<?php 
		require_once dirname(__FILE__) . '/src/php/controller/SessionController.php';
		$sessionController = new SessionController();
		$sessionController->Impress();
		
		if($sessionController->IsLoggedIn() == true )
		{
			header( 'Location: ./src/php/view/main.php' );  
		}	
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="Stylesheet" type="text/css" href="./src/css/frontPage.css" />
<link rel="Stylesheet" type="text/css" href="./lib/js/jquery-ui/css/ui-darkness/jquery-ui-1.8.22.custom.css" />

</head>

<body style="background-color:black">

	<div id="dialog-message1" title="Login Faild">
	    <p>
	        <span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0; display: none;"></span>
	        User Name and/or Password you enterd was invalid.
	    </p>
	</div>
	<div id="dialog-message2" title="Empty Fields">
	    <p>
	        <span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0; display: none;"></span>
	        Fields are empty, please fill the fields.
	    </p>
	</div>
	
	<div id="news">
		<p>
			This is Amir Noori's private social Network<br>
			Unauthorized access id not allowed.<br>
			Have fun!
		</p>
	</div>
	<hr>
	<!-- This is the container for the carousel. -->
    <div id = "cloudPhoto">            
    	<!-- All images with class of "cloudcarousel" will be turned into carousel items -->
    	<!-- You can place links around these images -->
   		<img class = "cloudcarousel" src="./media/images/img1.jpg" alt="Flag 1 Description" title="img1"/>
    	<img class = "cloudcarousel" src="./media/images/img2.jpg" alt="Flag 2 Description" title="img2"/>
    	<img class = "cloudcarousel" src="./media/images/img3.jpg" alt="Flag 3 Description" title="img3"/>
   </div>
        	
	<div id = "login">
	<ul>
        <li><a href="#tabs-1">Login</a></li>
        <li><a href="#tabs-2">Forgot your password?</a></li>
    </ul>
    <div id="tabs-1">
    	<form id="loginForm" method="post" target="_top" action="./src/php/controller/BaseController.php">
			User Name&nbsp: <input id="userName" name="userName" type="text"><br><br>
			Password&nbsp&nbsp&nbsp:  <input id="password" name="password" type="password">
			<input type="hidden" name="command" value="login"><br><br>
			<input type="submit" value="sign in" onclick="showMessage()">
		</form>
    </div>
    <div id="tabs-2">
		<br>
		<form>
			Please enter your email:  <input type="text" size="30"><br>
			<hr>
			<img src="./lib/php/capticha/captcha.php" id="captcha" /><br/>
			<!-- CHANGE TEXT LINK -->
			<a href="#" onclick="
			    document.getElementById('captcha').src='./lib/php/capticha/captcha.php?'+Math.random();
			    document.getElementById('captcha-form').focus();"
			    id="change-image">Not readable? Change text.</a><br/><br/>
			<input type="text" name="captcha" id="captcha-form" autocomplete="off" /><br/>
			<hr>
			<input type="submit" value="send">
		</form>
    </div>

	
	</div>
	
	

</body>

<script type="text/JavaScript" src="./lib/js/jquery-ui/js/jquery-1.7.2.js"></script>
<script type="text/JavaScript" src="./lib/js/jquery-ui/js/jquery-ui-1.8.22.custom.min.js"></script>
<script type="text/JavaScript" src="./lib/js/cloud-carousel.1.0.5.js"></script>
<script type="text/JavaScript" src="./src/js/frame1.js"></script>

</html>
