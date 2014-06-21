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
	require_once dirname(__FILE__) . '/../controller/ProfileController.php';
	$profileController = new ProfileController($sessionController);
	require_once dirname(__FILE__) . '/../model/Gallery.php';
	$gallery = new Gallery();
	$baseEntity = new BaseEntity();
	
?>
	
		<div id="childArticle">
			Your Profile:<br><br><hr>
			
			<div id="profilePhoto">

			<?php
				$baseEntity->getObject($gallery , array("userName" => $sessionController->GetUserName() , "isProfile" => true));
				
				$file = $gallery->getImagePath();
			
			    if (file_exists($file))
			    {			        
			        function data_uri($file, $mime) 
					{  
					  $contents = file_get_contents($file);
					  $base64   = base64_encode($contents); 
					  return ('data:' . $mime . ';base64,' . $base64);
					}

					echo "<img class=\"profileImageArea\" src=" . data_uri($file,'image/jpg') . " />";			        
			    }		
			?>

			</div>
			<div class="inputWrapper">
				choose photo
   				 <input class="fileInput" id="profileImage" name="profileImage" type="file" name="file1" value="choose photo" />
			</div>
			<input class="fileSubmit" type="button" name="file1" value="upload" />
			<br><br><br><br><br><br><br><br><br>
			
			<?php 
				foreach ($profileController->getInfo() as $key => $value) 
				{
					if($key == 'About')
					{
						echo "</strong>" . $key . "</strong>" . " : <textarea class=\"userInfo\" id=\"" . $key . "\" cols=\"50\" rows=\"7\" readonly=\"readonly\" onchange=\"profileEdit('" . $key . "')\" >" . $value . "</textarea>";
						echo "<input class=\"edit\" type=\"button\" value=\"Edit\" >";
						echo "<input class=\"save\" name=\"save\" type=\"button\" value=\"Save\" onclick=\"profileSave('" . $key . "')\">";
						echo "<input class=\"cancel\" type=\"button\" value=\"Cancel\" >";
						echo "<br><br>";
					}
					else if($key == 'Password')
					{
						echo $key . " : <input class=\"userInfo\" id=\"" . $key . "\" type=\"password\" size=\"40\" readonly=\"readonly\" onchange=\"profileEdit('" . $key . "')\" value=\"" . $value . "\">";
						echo "<input class=\"edit\" type=\"button\" value=\"Edit\" >";
						echo "<input class=\"save\" name=\"save\" type=\"button\" value=\"Save\" onclick=\"profileSave('" . $key . "')\">";
						echo "<input class=\"cancel\" type=\"button\" value=\"Cancel\" >";
						echo "<br><br>";
					}
					else
					{
						echo $key . " : <input class=\"userInfo\" id=\"" . $key . "\" size=\"40\" readonly=\"readonly\" onchange=\"profileEdit('" . $key . "')\" value=\"" . $value . "\">";
						echo "<input class=\"edit\" type=\"button\" value=\"Edit\" >";
						echo "<input class=\"save\" name=\"save\" type=\"button\" value=\"Save\" onclick=\"profileSave('" . $key . "')\">";
						echo "<input class=\"cancel\" type=\"button\" value=\"Cancel\" >";
						echo "<br><br>";
					}
				}
			?>
			<br><br><br><br><br><br><br><br>
			<hr>
			<div id="errors">
			
			</div>
		</div>  

<?php echo "<script type=\"text/JavaScript\" src=\"../../js/profile.js\"></script>" ?>
