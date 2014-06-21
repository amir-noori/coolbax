<?php 
		require_once dirname(__FILE__) . '/../controller/SessionController.php';
		$sessionController = new SessionController();
		$sessionController->Impress();
		if($sessionController->IsLoggedIn() == false )
		{
			header( 'Location: ../../../index.php' ); 
		}	
?>

<?php 
	require_once dirname(__FILE__) . '/../controller/FriendController.php';
	$friendController = new FriendController($sessionController);

?>


		<div id="childArticle">
			Your Friends:<br><br><hr>
			<?php 
				$baseEntity = new BaseEntity();
				require_once dirname(__FILE__) . '/../model/Gallery.php';
				$gallery = new Gallery();
	
				foreach($friendController->getLimitedFriends(0 , 2) as $friend)
				{
					$friendName = $friend->getFriendName();
					if(isset($friendName))
					{
						echo "<div class=\"friendPhoto\" id=\"" . $friend->getFriendName() . "\" >";
						$baseEntity->getObject($gallery , array("userName" => $friend->getFriendName() , "isProfile" => true));
						$file = $gallery->getImagePath();
						
					    if (file_exists($file))
					    {  						    		        
							$contents = file_get_contents($file);
							$base64   = base64_encode($contents); 
							echo "<img class=\"friendProfileImageArea\" src=" .  'data:' . "image/jpg" . ';base64,' . $base64 . " />";								
					    }
						echo "</div>";
						echo "<a class=\"friendLink showFriendInfoBallon\" id=\"" . $friend->getFriendName() . "\"  >" . $friend->getFriendName() . "</a>";
						echo "<input class=\"endFriendship\" type=\"button\" value=\"End Friedship\">";
						echo "<input class=\"friendSetting\" type=\"button\" value=\"Setting\">";
						echo "<br><br><br><br><br><br><br>";
					}
				}
			?>
			<br><br><br><br><br><br><hr>
		</div> 
		
		
		
<?php echo "<script type=\"text/JavaScript\" src=\"../../js/friends.js\"></script>" ?>
