<?php

	require_once dirname(__FILE__) . '/../model/User.php';
	require_once dirname(__FILE__) . '/../msc/entity/UserEntity.php';

	class RegisterConroller
	{
		private $flag = true;
		private $message;
		private $user;
		private $userEntity;
		
		public function __construct()
		{
			$this->message = "";
			$this->user = new User();
			$this->userEntity = new UserEntity();
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
			$this->userEntity->getObject($this->user , array("userName" => $uName));

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
				if($this->flag != false)
				{
					if(strlen($this->user->getFirstName()) > 0)
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
					if(strlen($this->user->getFirstName()) > 0)
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
		
		public function rPassValidate($rPass , $pass)
		{
			if(!( $rPass == $pass))
			{
				$this->flag = false;
				$this->message = "The passwords you enterd are not match.";
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
		
		public function saveUser()
		{
			$this->userEntity->save($this->user);
		}
	
		public function validateCaptcha($captcha)
		{
			session_start();
			if (!empty($captcha)) 
			{
			    if (empty($_SESSION['captcha']) || trim(strtolower($captcha)) != $_SESSION['captcha']) 
			    {
			        $this->message = "Invalid captcha";
			        $this->flag = false;
			    } 
			    else 
			    {
			    	$this->flag = true;
			        $this->message = "";
			    }
			
			    $request_captcha = htmlspecialchars($captcha);	
			    
			    unset($_SESSION['captcha']);
			}
			else
			{
				$this->message = "Invalid captcha";
			    $this->flag = false;
			}
		}
	}
	
	
	
	$registerConroller = new RegisterConroller();
	
	function showError($registerConroller)
	{
		if(($registerConroller->getFlag() == false))
		{
			echo "<html><head><title>Registeration Error</title></head><body style=\"background-color:#ccc;\">";
			echo "<img src=\"../../../media/images/util/Error.png\" style=\"width:30px; height:30px;\">&nbsp You have got the following errors<hr>";
			echo "<div style=\"font-size: 20px; color:red;\" style=\"font-size: 20px; color:red;\" >";
			
			$registerConroller->fNameValidate($_POST['fName']);
			if(strlen($registerConroller->getMessage()) > 0)
			echo $registerConroller->getMessage() . "<hr>";
			$registerConroller->lNameValidate($_POST['lName']);
			if(strlen($registerConroller->getMessage()) > 0)
			echo $registerConroller->getMessage() . "<hr>";
			$registerConroller->uNameValidate($_POST['uName']);
			if(strlen($registerConroller->getMessage()) > 0)
			echo $registerConroller->getMessage() . "<hr>";
			$registerConroller->passValidate($_POST['pass']);
			if(strlen($registerConroller->getMessage()) > 0)
			echo $registerConroller->getMessage() . "<hr>";
			$registerConroller->rPassValidate($_POST['rPass'] , $_POST['pass']);
			if(strlen($registerConroller->getMessage()) > 0)
			echo $registerConroller->getMessage() . "<hr>";
			$registerConroller->pNumValidate($_POST['pNum']);
			if(strlen($registerConroller->getMessage()) > 0)
			echo $registerConroller->getMessage() . "<hr>";
			$registerConroller->eMailValidate($_POST['eMail']);
			if(strlen($registerConroller->getMessage()) > 0)
			echo $registerConroller->getMessage() . "<hr>";
			$registerConroller->validateCaptcha($_POST['captcha']);
			if(strlen($registerConroller->getMessage()) > 0)
			echo $registerConroller->getMessage() . "<hr>";
			
			
			echo "</div>";
			echo "<a href=\"../../../index.php\">go back...</a>";
			echo "</body></html>";
		}
	}

	
	if($_POST['command'] == 'register')
	{
		
		$registerConroller->fNameValidate($_POST['fName']);
		if($registerConroller->getFlag() == false)
		{
			showError($registerConroller);
			exit(0);
		}
		$registerConroller->lNameValidate($_POST['lName']);
		if($registerConroller->getFlag() == false)
		{
			showError($registerConroller);
			exit(0);
		}
		$registerConroller->uNameValidate($_POST['uName']);
		if($registerConroller->getFlag() == false)
		{
			showError($registerConroller);
			exit(0);
		}
		$registerConroller->passValidate($_POST['pass']);
		if($registerConroller->getFlag() == false)
		{
			showError($registerConroller);
			exit(0);
		}
		$registerConroller->rPassValidate($_POST['rPass'] , $_POST['pass']);
		if($registerConroller->getFlag() == false)
		{
			showError($registerConroller);
			exit(0);
		}
		$registerConroller->pNumValidate($_POST['pNum']);
		if($registerConroller->getFlag() == false)
		{
			showError($registerConroller);
			exit(0);
		}
		$registerConroller->eMailValidate($_POST['eMail']);
		if($registerConroller->getFlag() == false)
		{
			showError($registerConroller);
			exit(0);
		}
		$registerConroller->validateCaptcha($_POST['captcha']);
		if($registerConroller->getFlag() == false)
		{
			showError($registerConroller);
			exit(0);
		}
		

		if($registerConroller->getFlag() == true)
		{	
			echo "<html><head><title>Registeration Success</title></head>";
			echo "<body style=\"background-color:#ccc;\">";
			echo "<img src=\"../../../media/images/util/Successfull.jpg\" style=\"width:30px; height:30px;\">&nbsp <strong>You have successfully registered.</strong><hr>";
			echo "<div style=\"font-size: 16pxpx;\" >";
			echo "</div>";
			echo "<a href=\"../../../index.php\">go back...</a>";
			echo "</body></html>";
			
			$registerConroller->getUser()->setFirstName($_POST['fName']);
			$registerConroller->getUser()->setLastName($_POST['lName']);
			$registerConroller->getUser()->setPassword($_POST['pass']);
			$registerConroller->getUser()->setUserName($_POST['uName']);
			$registerConroller->getUser()->setEmail($_POST['eMail']);
			$registerConroller->saveUser();	
			
		}
	}
	else
	{
		if(isset($_POST['fName']))
		{
			$registerConroller->fNameValidate($_POST['fName']);
			echo $registerConroller->getMessage();
		}
		if(isset($_POST['lName']))
		{
			$registerConroller->lNameValidate($_POST['lName']);
			echo $registerConroller->getMessage();
		}
		if(isset($_POST['uName']))
		{
			$registerConroller->uNameValidate($_POST['uName']);
			echo $registerConroller->getMessage();
		}
		if(isset($_POST['hAdd']))
		{
			
		}			
		if(isset($_POST['pass']))
		{
			$registerConroller->passValidate($_POST['pass']);
			echo $registerConroller->getMessage();
		}
		if(isset($_POST['rPass']))
		{
			$registerConroller->rPassValidate($_POST['rPass'] , $_POST['pass']);
			echo $registerConroller->getMessage();
		}
		if(isset($_POST['pNum']))
		{
			$registerConroller->pNumValidate($_POST['pNum']);
			echo $registerConroller->getMessage();
		}
		if(isset($_POST['eMail']))
		{
			$registerConroller->eMailValidate($_POST['eMail']);
			echo $registerConroller->getMessage();
		}
	}
	

	
?>



