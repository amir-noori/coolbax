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

	require_once dirname(__FILE__) . '/../model/User.php';
	require_once dirname(__FILE__) . '/../msc/entity/UserEntity.php';
	
	if(isset($_POST['friendName']) && $_POST['friendName'] != '')
	{
		$friend = new User();
		$userEntity = new UserEntity();
		$userEntity->getObject($friend ,array("userName" => $_POST['friendName']));
		
		echo "<div style=\"color: #85E9FF;\">";
		echo "First Name: " . $friend->getFirstName() . "<br>";
		echo "Last Name: " . $friend->getLastName() . "<br>";
		echo "E-Mail: " . $friend->getEmail();
		echo "</div>";
	}

?>