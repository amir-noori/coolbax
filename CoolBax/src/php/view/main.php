<?php 
		require_once dirname(__FILE__) . '/../controller/SessionController.php';
		$sessionController = new SessionController();
		$sessionController->Impress();
		if($sessionController->IsLoggedIn() == false )
		{
			header( 'Location: ../../../index.php' ); 
		}	
?>

<html>
<head>
<title></title>

<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<script type="text/JavaScript" src="../../../lib/js/jquery.balloon.js"></script>
<script type="text/JavaScript" src="../../../lib/js/ajaxfileupload/ajaxfileupload.js"></script>
<script type="text/JavaScript" src="../../js/main.js"></script>
<link rel="Stylesheet" type="text/css" href="../../../lib/js/jquery-ui/css/ui-darkness/jquery-ui-1.8.22.custom.css" />
<link rel="Stylesheet" type="text/css" href="../../../lib/js/ajaxfileupload/ajaxfileupload.css" />
<link rel="Stylesheet" type="text/css" href="../../css/main.css" />
   
</head>

<body>
	
	<h1>COOLBAX</h1>
	<h4>
			<a href="../controller/BaseController.php?command=logout">LogOut</a>
	</h4>

	
	<div id="mainTabsBackGround">
		<div id="mainTabs">
			<ul id="mainTabsList">
				<li><a id="mainPageLink" href="mainPage.php">Main Page</a></li>
				<li><a id="perspectiveLink" href="perspective.php">Perspective</a></li>
				<li><a id="profileLink" href="profile.php">Profile</a></li>
				<li><a id="photosAndVideosLink" href="a">Photos & Videos</a></li>
				<li><a id="messagesLink" href="a">Messages</a></li>
				<li><a id="friendsLink" href="Friends.php">Friends</a></li>
				<li><a id="settingLink" href="a">Setting</a></li>
			</ul>
		</div>
	</div>
	

	


	
	<div id="article">

		
	</div>
	
	<div id="sideTabs">
		<ul>
			<li><a href="a">Perspective</a></li>
			<li><a href="a">Profile</a></li>
			<li><a href="a">Photos & Videos</a></li>
			<li><a href="a">Messages</a></li>
		</ul>
	</div>

			
	<div id="accordion">
		<h3>Latest News</h3>
		<div>
			<p>content1</p>
		</div>
		
		<h3>Stories</h3>
		<div>
			<p>content2</p>
		</div>
		
		<h3>Who Is Online</h3>
		
		<div id="whoIsOnline">
			<ul id="whoIsOnlineList">
				<?php 
					require_once dirname(__FILE__) . '/../controller/FriendController.php';
					require_once dirname(__FILE__) . '/../msc/entity/BaseEntity.php';
					require_once dirname(__FILE__) . '/../model/HTTP_Session.php';

					
					$http_session = array(new HTTP_Session());
					$friendController = new FriendController($sessionController);
					$friends = $friendController->getAllFriends();
					$baseEntity = new BaseEntity();

					$index = 0;
					foreach($friends as $friend)
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
				?>
			</ul>
		</div>
	</div>
	
	<!-- chat dialog begin -->

	<!-- chat dialog end -->


	<input type="hidden" id="thisUser" value="<?php echo $sessionController->GetUserName(); ?>">
		
</body>

</html>
