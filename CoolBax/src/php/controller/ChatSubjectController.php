<?php

	if(isset($_POST['receiver']))
	{
		require_once dirname(__FILE__) . '/ChatSubjectClass.php';
		require_once dirname(__FILE__) . '/ChatObserverClass.php';
	
		$chatSubjectController = new ChatSubjectController();
		$chatSubjectController->sendMessageToDB($_POST['message'] , $_POST['sender'] , $_POST['receiver']);
	}
	
?>