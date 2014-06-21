<?php

	require_once 'SessionController.php';

	$postCommand = $_POST['command'];
	$getCommand = $_GET['command'];
	
	if($postCommand == 'login')
	{
		require_once 'UserController.php';
		
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		
		$userController = new UserController();
		$userController->setUName($userName);
		$userController->setPass($password);
		$userController->obeyCommand($postCommand);
		/*
		require_once dirname(__FILE__) . '/../model/Info.php';
		require_once dirname(__FILE__) . '/../msc/entity/BaseEntity.php';
		
		$baseEntity = new BaseEntity();

		$info = new Info();
		$baseEntity->getObject($info , array("userName" => $sessionController->GetUserName()));
		if($info->getUserName() == "")
		{
			$info->setUserName($sessionController->GetUserName());
			$info->setWhozPerspective($sessionController->GetUserName());
			$baseEntity->save($info);
		}*/
	}
	
	if($getCommand =='login')
	{
		require_once 'UserController.php';
		
		$userName = $_GET['userName'];
		$password = $_GET['password'];
		
		$userController = new UserController();
		$userController->setUName($userName);
		$userController->setPass($password);
		$userController->obeyCommand($getCommand);
	}
	
	if($getCommand == 'logout')
	{
		$sessionController = new SessionController();
		$sessionController->Impress();
		$sessionController->LogOut();
		header( 'Location: ../../../index.php' );
	}
	
	
	
?>