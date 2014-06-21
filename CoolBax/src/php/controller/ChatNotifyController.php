<?php

	if(isset($_POST['user']))
	{
		require_once dirname(__FILE__) . '/../msc/entity/BaseEntity.php';
		require_once dirname(__FILE__) . '/../model/Chat.php';
		
		$chat = array(new Chat());
		$baseEntity = new BaseEntity();
		$chat = $baseEntity->getObject($chat , array("receiver" => $_POST['user'] , "readed" => "0"));
			
			
			$x = "";
			foreach($chat as $ch)
			{
				$x = $ch->getSender();
				if(isset($x))
				{
					echo $x;
					break;
				}
			}
	}

?>