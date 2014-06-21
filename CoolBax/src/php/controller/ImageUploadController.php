<?php

 	require_once dirname(__FILE__) . '/SessionController.php';
 	require_once dirname(__FILE__) . '/../model/Gallery.php';
 	require_once dirname(__FILE__) . '/../msc/entity/BaseEntity.php';

 	class ImageUploadController
 	{

 		private $error;
		private	$msg;
		private $fileElementName;
		private $sessionController;
		private $gallery;
		private $baseEntity;

 		public function __construct($fileElementName)
 		{
 			$this->error = "";
 			$this->message = "";
 			$this->fileElementName = $fileElementName;
 			$this->gallery = new Gallery();
 			$this->baseEntity = new BaseEntity();
			$this->sessionController = new SessionController();
 		}


 		public function uploadImage($isP)
 		{
 			if($isP == true)
 			{
 				$this->baseEntity->getObject($this->gallery , array("userName" => $this->sessionController->GetUserName() , "isProfile" => true));
	 			if(!empty($_FILES[$this->fileElementName]['error']))
	 			{
					switch($_FILES[$this->fileElementName]['error'])
					{

						case '1':
							$this->this->this->this->this->this->this->this->error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
							break;
						case '2':
							$this->this->this->this->this->this->this->error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
							break;
						case '3':
							$this->this->this->this->this->this->error = 'The uploaded file was only partially uploaded';
							break;
						case '4':
							$this->this->this->this->this->error = 'No file was uploaded.';
							break;
						case '6':
							$this->this->this->this->error = 'Missing a temporary folder';
							break;
						case '7':
							$this->this->this->error = 'Failed to write file to disk';
							break;
						case '8':
							$this->this->error = 'File upload stopped by extension';
							break;
						case '999':
						default:
							$this->error = 'No error code avaiable';
					}
	 			}
				else if(empty($_FILES[$this->fileElementName]['tmp_name']) || $_FILES[$this->fileElementName]['tmp_name'] == 'none')
				{
					$this->error = 'No file was uploaded..';
				}
				else if(($this->gallery->getUserName() != '') && ($this->gallery->getUserName()))
				{
						$name = rand(10,100000000);
						$name = $name . "." . pathinfo($_FILES[$this->fileElementName]['name'], PATHINFO_EXTENSION);
						$path = "F:/Program Files/xampp/CoolBax_Images/" . $this->sessionController->GetUserName();
						
						$newGallery = new Gallery();
						$newGallery->setUserName($this->sessionController->GetUserName());
						$newGallery->setImageName($_FILES[$this->fileElementName]["name"]);
						$newGallery->setImagePath("F:/Program Files/xampp/CoolBax_Images/" . $this->sessionController->GetUserName() . "/" . $name);
						$newGallery->setIsProfile(true);
						$this->baseEntity->delete($this->gallery);
						$this->baseEntity->save($newGallery);
						$this->gallery = $newGallery;
						
						if(!is_dir($path))	
						{
							mkdir($path);
						}
						move_uploaded_file($_FILES[$this->fileElementName]["tmp_name"] , $path . "/" . $name);
			      		
			      		echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
						$this->msg .= " File Name: " . $_FILES[$this->fileElementName]['name'] . ", ";
						$this->msg .= " File Size: " . @filesize($_FILES[$this->fileElementName]['tmp_name']);
						//for security reason, we force to remove all uploaded file
						@unlink($_FILES[$this->fileElementName]);
				}
				else
				{
					$name = rand(10,100000000);
					$name = $name . "." . pathinfo($_FILES[$this->fileElementName]['name'], PATHINFO_EXTENSION);
					$path = "F:/Program Files/xampp/CoolBax_Images/" . $this->sessionController->GetUserName();
					
					$newGallery = new Gallery();
					$newGallery->setUserName($this->sessionController->GetUserName());
					$newGallery->setImageName($_FILES[$this->fileElementName]["name"]);
					$newGallery->setImagePath("F:/Program Files/xampp/CoolBax_Images/" . $this->sessionController->GetUserName() . "/" . $name);
					$newGallery->setIsProfile(true);
					$this->baseEntity->save($newGallery);
					$this->gallery = $newGallery;

					if(!is_dir($path))	
					{
						mkdir($path);
					}
					move_uploaded_file($_FILES[$this->fileElementName]["tmp_name"] , $path . "/" . $name);
		      		
		      		echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
					$this->msg .= " File Name: " . $_FILES[$this->fileElementName]['name'] . ", ";
					$this->msg .= " File Size: " . @filesize($_FILES[$this->fileElementName]['tmp_name']);
					//for security reason, we force to remove all uploaded file
					@unlink($_FILES[$this->fileElementName]);
				}
 			}
 			else
 			{
					$name = rand(10,100000000);
					$name = $name . "." . pathinfo($_FILES[$this->fileElementName]['name'], PATHINFO_EXTENSION);
					$path = "F:/Program Files/xampp/CoolBax_Images/" . $this->sessionController->GetUserName();
					
					$newGallery = new Gallery();
					$newGallery->setUserName($this->sessionController->GetUserName());
					$newGallery->setImageName($_FILES[$this->fileElementName]["name"]);
					$newGallery->setImagePath("F:/Program Files/xampp/CoolBax_Images/" . $this->sessionController->GetUserName() . "/" . $name);
					$newGallery->setIsProfile(false);
					$this->baseEntity->save($newGallery);
					$this->gallery = $newGallery;
					
					if(!is_dir($path))	
					{
						mkdir($path);
					}
					move_uploaded_file($_FILES[$this->fileElementName]["tmp_name"] , $path . "/" . $name);
		      		
		      		echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
					$this->msg .= " File Name: " . $_FILES[$this->fileElementName]['name'] . ", ";
					$this->msg .= " File Size: " . @filesize($_FILES[$this->fileElementName]['tmp_name']);
					//for security reason, we force to remove all uploaded file
					@unlink($_FILES[$this->fileElementName]);
 			}
 		}
 	}
 	
 	
 	
	$imageUploadController = new ImageUploadController('profileImage');
	$imageUploadController->uploadImage(true);


?>