<?php 
		require_once dirname(__FILE__) . '/src/php/controller/SessionController.php';
		$sessionController = new SessionController();
		$sessionController->Impress();
		
		if($sessionController->IsLoggedIn() == true )
		{
			header( 'Location: ./src/php/view/main.php' ); 
		}	
		//session_start();
?>

<html>
<head>
<title>CoolBax Private Social Network</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/JavaScript" src="./lib/js/jquery-ui/js/jquery-1.7.2.js"></script>
<script type="text/JavaScript" src="./lib/js/jquery-ui/js/jquery-ui-1.8.22.custom.min.js"></script>
<script type="text/JavaScript" src="./lib/js/cloud-carousel.1.0.5.js"></script>
<script type="text/JavaScript" src="./src/js/index.js"></script>
<link rel="Stylesheet" type="text/css" href="./src/css/frontPage.css" />
<link rel="Stylesheet" type="text/css" href="./lib/js/jquery-ui/css/ui-darkness/jquery-ui-1.8.22.custom.css" />


</head>

<body>
	
	<div id="header">
		<h1 style="color: silver;">WELCOME TO COOLBAX</h1>
	</div>
	
	<div id="footer">
		<div id="sideNote"> 
			<div id="sideNoteText">
				Register below:
			</div>

			<div id="register">
			<form  method="POST" action="./src/php/controller/RegisterController.php">
				First Name: 	 <br><input id="fName" name="fName" type="text" onchange="AjaxValidator('fName')"><br><br>
				Last Name: 		 <br><input id="lName" name="lName" type="text" onchange="AjaxValidator('lName')"><br><br>
				User Name: 		 <br><input id="uName" name="uName" type="text" onchange="AjaxValidator('uName')"><br><br>
				Email Address:   <br><input id="eMail" name="eMail" type="text" onchange="AjaxValidator('eMail')"><br><br>
				Phone Number: 	 <br><input id="pNum" name="pNum" type="text" onchange="AjaxValidator('pNum')"><br><br>
				Home Address:	 <br><input id="hAdd" name="hAdd" type="text" onchange="AjaxValidator('hAdd')"><br><br>
				Password: 		 <br><input id="pass" name="pass" type="password" onchange="AjaxValidator('pass')"><br><br>
				Retype Password: <br><input id="rPass" name="rPass" type="password" onchange="AjaxValidator('rPass')"><br><br>
				Sex: 		 	 &nbsp &nbsp Male<input checked="true" id="male" type="radio" name="sex" value="male" style="postion:relative; width:7%;">
								 &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Female<input id="female" type="radio" name="sex" value="female" style="postion:relative; width:7%;" ><br><br>
								 <input type="hidden" name="command" value="register">
								<hr>
								<img src="./lib/php/capticha/captcha.php" id="captcha" /><br/>
								<!-- CHANGE TEXT LINK -->
								<a href="#" onclick="
								    document.getElementById('captcha').src='./lib/php/capticha/captcha.php?'+Math.random();
								    document.getElementById('captcha-form').focus();"
								    id="change-image">Not readable? Change text.</a><br/><br/>
								<input type="text" name="captcha" id="captcha-form" autocomplete="off" /><br/><br/>
								 <hr>
								 <input  id="registerSubmit" type="submit" value="register">
			</form>
			</div>
			
			<div id="errors">
			
			</div>
				
		</div>
	
		<div>
			<iframe id="frame" src="frame1.php" ></iframe>
		</div>
	</div>
	



</body>

</html>
