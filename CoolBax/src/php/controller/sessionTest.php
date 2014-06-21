<?php

		require_once 'SessionController.php';

			 $sessionController = new SessionController();
			 $sessionController->Impress();
			 echo "<br> Current Session ID: " . $sessionController->GetSessionIdentifier() . "<hr>";
			 echo "<br> Logged In? "; echo ($sessionController->IsLoggedIn() == true ) ? "YES" : "NO";echo "<hr>";
			 echo "<br> Attempting to log in..."; $sessionController->Login("amir_noori" , "123"); echo "<hr>";
			 echo "<br> Logged In? "; echo($sessionController->IsLoggedIn() == true ) ? "YES" : "NO";echo "<hr>";
			 //echo "<br> Now logging out..."; $sessionController->Logout(); echo "<hr>";
			 echo "<br> Logged In? "; echo ($sessionController->IsLoggedIn() == true ) ? "YES" : "NO"  . "<hr>";

?>