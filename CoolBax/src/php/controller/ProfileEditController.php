<?php

	require_once dirname(__FILE__) . '/ProfileController.php';
	require_once dirname(__FILE__) . '/../msc/entity/UserEntity.php';
	require_once dirname(__FILE__) . '/../model/Profile.php';

	class ProfileEditController 
	{
		
		private $flag;
		private $message;
		private $user;
		private $baseEntity;
		private $sessionController;
		private $profile;
		
		public function __construct()
		{
			$this->flag = true;
			$this->message = "";
			$this->user = new User();
			$this->profile = new Profile();
			$this->sessionController = new SessionController();
			$this->user = $this->sessionController->GetUserObject();
			$this->baseEntity = new BaseEntity();
			$this->baseEntity->getObject($this->profile , array("userName" => $this->sessionController->GetUserName()));
		}
		
		public function getFlag()
		{
			return $this->flag;
		}
		
		public function getMessage()
		{
			return $this->message;
		}
		
		public function getUser()
		{
			return $this->user;
		}
		
		public function fNameValidate($fName)
		{
			if ($fName == '')
			{
				$this->flag = false;
				$this->message = "First name is required.";
			}
			else if ( !(preg_match("/^[a-z]/i", strtolower($fName))))
			{
				$this->flag = false;
				$this->message = "Please Enter a valid name.";
			}
			else
			{
				$this->flag = true;
				$this->message = "";
			}
		}
		
		public function lNameValidate($lName)
		{
			if ($lName == '')
			{
				$this->flag = false;
				$this->message = "Last name is required..";
			}
			else if ( !(preg_match("/^[a-z]/i", strtolower($lName))))
			{
				$this->flag = false;
				$this->message = "Please Enter a valid name.";
			}
			else 
			{
				$this->flag = true;
				$this->message = "";
			}
			

		}
		
		public function uNameValidate($uName)
		{
			$testUser = new User();
			$this->baseEntity->getObject($testUser , array("userName" => $uName));
			
			if(!isset($uName) || $uName == '')
			{
				$this->flag = false;
				$this->message = "User name is required!";
			}
			else if(preg_match('/_/',$uName))
			{
				$pieces = explode("_", $uName);
				foreach($pieces as $piece)
				{
					if(!(ctype_alnum($piece)) || ($piece == ''))
					{
						$this->flag = false;
						$this->message = "This user name can only contain letters, numbers and \" _ or . \"";
					}
				}
				if($this->flag == true)
				{
					if( $this->sessionController->GetUserName() == $uName)
					{
						$this->flag = true;
						$this->message = "";
					}
					else if(strlen($testUser->getFirstName()) > 0)
					{
						$this->flag = false;
						$this->message = "This user name exist.";
					}
					else if(strlen($uName) < 4)
					{
						$this->flag = false;
						$this->message = "This user name is too short.";
					}
					else
					{
						$this->flag = true;
						$this->message = "";
					}
				}
			}
			else if(preg_match('/./',$uName))
			{
				$pieces = explode(".", $uName);
				foreach($pieces as $piece)
				{
					if(!(ctype_alnum($piece)) || ($piece == ''))
					{
						$this->flag = false;
						$this->message = "This user name can only contain letters, numbers and \" _ or . \"";
					}
				}
				if($this->flag != false)
				{
					if( $this->sessionController->GetUserName() == $uName)
					{
						$this->flag = true;
						$this->message = "";
					}
					else if(strlen($testUser->getFirstName()) > 0)
					{
						$this->flag = false;
						$this->message = "This user name exist.";
					}
					else if(strlen($uName) < 4)
					{
						$this->flag = false;
						$this->message = "This user name is too short.";
					}
					else
					{
						$this->flag = true;
						$this->message = "";
					}
				}
			}

		}
		
		public function hAddValidate($hAdd)
		{
			
		}
		
		public function passValidate($pass)
		{
			if(strlen($pass) < 8)
			{
				$this->flag = false;
				$this->message = "Your password must at least be 8 charecters.";
			}
			else if($pass == '')
			{
				$this->flag = false;
				$this->message = "Please enter your password.";
			}
			else
			{
				$this->flag = true;
				$this->message = "";
			}
		}
		
		public function pNumValidate($pNum)
		{
			if(!($pNum == ''))
			{
				if(!(is_numeric($pNum)))
				{
					$this->flag = false;
					$this->message = "Phone number must be Integers.";
				}
				else if(!($pNum > 999))
				{
					$this->flag = false;
					$this->message = "Please enter a valid phone number.";
				}
				else
				{
					$this->flag = true;	
					$this->message = "";
				}
			}
			else
			{
				$this->flag = true;
				$this->message = "";
			}
		}
		
		public function eMailValidate($eMail)
		{
			if($eMail == '')
			{
				$this->flag = false;
				$this->message = "Please Enter your Email.";
			}
			else if(!(filter_var($eMail, FILTER_VALIDATE_EMAIL)))
			{
				$this->flag = false;
				$this->message = "Please Enter a valid Email.";
			}
			else
			{
				$this->flag = true;
				$this->message = "";
			}
		}
		
		public function updateUser($newUser)
		{
			$this->baseEntity->update($this->user , $newUser);
		}
		
		public function updateProfile($newProfile)
		{
			$this->baseEntity->update($this->profile , $newProfile);
		}
	
	}

	
	$profileEditController = new ProfileEditController();
	
	if(isset($_POST['save']))
	{
		if(isset($_POST['First_Name']))
		{
			$profileEditController->fNameValidate($_POST['First_Name']);
			echo $profileEditController->getMessage();
			if($profileEditController->getFlag() == true)
			{
				$newUser = new User();
				$newProfile = new Profile();
				$newUser->setFirstName($_POST['First_Name']);
				$newProfile->setFirstName($_POST['First_Name']);
				$profileEditController->updateProfile($newProfile);
				$profileEditController->updateUser($newUser);
			}
		}
		if(isset($_POST['Last_Name']))
		{
			$profileEditController->lNameValidate($_POST['Last_Name']);
			echo $profileEditController->getMessage();
			if($profileEditController->getFlag() == true)
			{
				$newUser = new User();
				$newProfile = new Profile();
				$newUser->setLastName($_POST['Last_Name']);
				$newProfile->setLastName($_POST['Last_Name']);
				$profileEditController->updateProfile($newProfile);
				$profileEditController->updateUser($newUser);
			}
		}
		if(isset($_POST['User_Name']))
		{
			$profileEditController->uNameValidate($_POST['User_Name']);
			echo $profileEditController->getMessage();
			if($profileEditController->getFlag() == true)
			{
				$newUser = new User();
				$newProfile = new Profile();
				$newUser->setUserName($_POST['User_Name']);
				$newProfile->setUserName($_POST['User_Name']);
				$profileEditController->updateProfile($newProfile);
				$profileEditController->updateUser($newUser);
			}
		}
		if(isset($_POST['Home_Address']))
		{
			$profileEditController->pNumValidate($_POST['Phone_Number']);
			echo $profileEditController->getMessage();
			if($profileEditController->getFlag() == true)
			{
				$newProfile = new Profile();
				$newProfile->setHomeAddress($_POST['Home_Address']);
				$profileEditController->updateProfile($newProfile);
			}
		}			
		if(isset($_POST['Password']))
		{
			$profileEditController->passValidate($_POST['Password']);
			echo $profileEditController->getMessage();
			if($profileEditController->getFlag() == true)
			{
				$newUser = new User();
				$newUser->setUserName($_POST['Password']);
				$profileEditController->updateUser($newUser);
			}
		}
		if(isset($_POST['Phone_Number']))
		{
			$profileEditController->pNumValidate($_POST['Phone_Number']);
			echo $profileEditController->getMessage();
			if($profileEditController->getFlag() == true)
			{
				$newProfile = new Profile();
				$newProfile->setPhoneNumber($_POST['Phone_Number']);
				$profileEditController->updateProfile($newProfile);
			}
		}
		if(isset($_POST['Email']))
		{
			$profileEditController->eMailValidate($_POST['Email']);
			echo $profileEditController->getMessage();
			if($profileEditController->getFlag() == true)
			{
				$newUser = new User();
				$newProfile = new Profile();
				$newUser->setEmail($_POST['Email']);
				$newProfile->setEmail($_POST['Email']);
				$profileEditController->updateProfile($newProfile);
				$profileEditController->updateUser($newUser);
			}
		}
		if(isset($_POST['About']))
		{
			if($profileEditController->getFlag() == true)
			{
				$newProfile = new Profile();
				$newProfile->setAbout($_POST['About']);
				$profileEditController->updateProfile($newProfile);
			}
		}
	}
	else 
	{
		if(isset($_POST['First_Name']))
		{
			$profileEditController->fNameValidate($_POST['First_Name']);
			echo $profileEditController->getMessage();
		}
		if(isset($_POST['Last_Name']))
		{
			$profileEditController->lNameValidate($_POST['Last_Name']);
			echo $profileEditController->getMessage();
		}
		if(isset($_POST['User_Name']))
		{
			$profileEditController->uNameValidate($_POST['User_Name']);
			echo $profileEditController->getMessage();
		}
		if(isset($_POST['Home_Address']))
		{
			
		}			
		if(isset($_POST['Password']))
		{
			$profileEditController->passValidate($_POST['Password']);
			echo $profileEditController->getMessage();
		}
		if(isset($_POST['Phone_Number']))
		{
			$profileEditController->pNumValidate($_POST['Phone_Number']);
			echo $profileEditController->getMessage();
		}
		if(isset($_POST['Email']))
		{
			$profileEditController->eMailValidate($_POST['Email']);
			echo $profileEditController->getMessage();
		}
	}
	
?>