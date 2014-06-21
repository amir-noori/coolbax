<?php
	require_once dirname(__FILE__) . '/ChatObserverClass.php';
	
	$chatObserverController = new ChatObserverController($_POST['sender'] , $_POST['receiver']);
	$chatObserverController->update();
?>