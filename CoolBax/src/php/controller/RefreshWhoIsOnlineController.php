<?php 
	require_once dirname(__FILE__) . '/FriendController.php';
	require_once dirname(__FILE__) . '/../msc/entity/BaseEntity.php';
	require_once dirname(__FILE__) . '/../model/HTTP_Session.php';

	$friendList = array();
	for($i = 0 ; $i < $_POST["count"] ; $i++)
	{
		$friendList[$i] = $_POST[$i];
	}
	
	$http_session = array(new HTTP_Session());
	$sessionController = new SessionController();
	$friendController = new FriendController($sessionController);
	$friends = $friendController->getAllFriends();
	$baseEntity = new BaseEntity();

	$index = 0;
	foreach($friends as $friend)
	{
		if(!in_array($friend->getFriendName() , $friendList))
		{
			$http_session = $baseEntity->getObject($http_session , array("user_name" => $friend->getFriendName() , "logged_in" => true));
			foreach($http_session as $http_s)
			{
				if((strtotime(date( 'Y-m-d H:i:s')) - strtotime($http_s->getLast_impression())) < 3600 )
				{
					$r = (integer)(strtotime(date( 'Y-m-d H:i:s')));
					$x =  (integer)(strtotime($http_s->getLast_impression()));
					echo "<li><a class=\"onlineUserLink\" id=\"" . $friend->getFriendName() . "\" onclick=\"chat(" . "'" . $friend->getFriendName() . "'"  . ")\" >" . $friend->getFriendName() . "</a></li>";
				
				echo '
					<div class="chatDialog" title="' . $friend->getFriendName() . '" id="' .  $friend->getFriendName() . 'ChatDialog' . '">

				        <div class="chatArea" id="' .  $friend->getFriendName() . 'ChatArea' . '">
				        </div>
				        
				        <input class="chatInput" id="' .  $friend->getFriendName() . 'ChatInput' . '" size="21"  onkeydown="chatController(event , \'' .  $friend->getFriendName() . '\' , \'' .  $friend->getUserName() . '\')">
				
					</div>
					';
				
				}
			}	
		}
		else
		{
			$count = 0;
			
			$http_session = $baseEntity->getObject($http_session , array("user_name" => $friend->getFriendName() , "logged_in" => true));
			if(empty($http_session))
			{
				echo "*" . $friend->getFriendName() . "# ";
			}
			else 
			{
				foreach($http_session as $http_s)
				{
					if((strtotime(date( 'Y-m-d H:i:s')) - strtotime($http_s->getLast_impression())) < 3600 )
					{
						$count++;					
					}
				}
				
				if($count == 0)
				{
					echo "*" . $friend->getFriendName() . "# ";
				}

			}
		}						
	}
?>