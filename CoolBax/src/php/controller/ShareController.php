<?php 
		require_once dirname(__FILE__) . '/SessionController.php';
		$sessionController = new SessionController();
		$sessionController->Impress();
		if($sessionController->IsLoggedIn() == false )
		{
			exit(0); 
		}	
?>


<?php
	require_once dirname(__FILE__) . '/ShareControllerClass.php';	

	$shareControllerClass = new ShareControllerClass($_POST["data"] , $sessionController->GetUserName());
	$shareControllerClass->share();

?>