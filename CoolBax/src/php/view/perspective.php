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
	require_once dirname(__FILE__) . '/../model/Info.php';
	require_once dirname(__FILE__) . '/../msc/entity/BaseEntity.php';
	
	$baseEntity = new BaseEntity();
	
	$info = new Info();
	$info->setUserName($sessionController->GetUserName());
	$info->setWhozPerspective($sessionController->GetUserName());
	
	$oldInfo = new Info();
	$oldInfo->setUserName($sessionController->GetUserName());
	
	$baseEntity->update($oldInfo , $info);
	
?>


<div id="childArticle">
	<textarea id="shareData" rows="10" cols="60"></textarea><br><br>
	<button id="shareButton" onclick="share()">Share</button>
</div>




<?php
	echo "	<div id=\"childArticle\">
			Info About Whats Happening Between You And Friends:\n
			    <ul>
				<li>Sharing Info</li>
				<li>Gossip</li>
				<li>Photos</li>
				<li>etc...</li>
			    </ul>
		</div>";  
?>



<script type="text/JavaScript" src="../../js/perspective.js"></script>
<link rel="Stylesheet" type="text/css" href="../../css/perspective.css" />