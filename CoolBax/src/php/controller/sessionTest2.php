<?php

		require_once 'SessionController.php';

			 $sessionController = new SessionController();
			 $sessionController->Impress();
			 echo "<br> Current Session ID: " . $sessionController->GetSessionIdentifier() . "<hr>";
			 echo "<br> Logged In? "; echo ($sessionController->IsLoggedIn() == true ) ? "YES" : "NO"  . "<hr>";

?>