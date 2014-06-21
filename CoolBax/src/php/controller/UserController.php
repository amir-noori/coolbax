<?php

	require_once dirname(__FILE__) . '/../model/User.php';
	require_once dirname(__FILE__) . '/../msc/entity/UserEntity.php';
	
	
	
	class UserController
	{
		private $user;
		private $userEntity;
		private $uName;
		private $pass;
		private $sessionController;
		
		public function __construct()
		{
			$this->sessionController = new SessionController();
			$this->sessionController->Impress();
			$this->user = new User();
			$this->userEntity = new UserEntity();
		}
		
		public function setUName($name)
		{
			$this->uName = $name;
		}
		
		public function setPass($pass)
		{
			$this->pass = $pass;
		}
		
		public function uesrExist($name , $pass)
		{
			$this->userEntity->getObject($this->user , array('userName' => $name , 'password' => $pass));
			if(($this->user->getUserName() == $name) && ($this->user->getPassword() == $pass))
			{
				return true;
			}
			else 
			{
				return false;
			}
		}
	
		public function obeyCommand($com)
		{
			if($com == 'login')
			{
				if(isset($this->uName) && $this->uName != '' && isset($this->pass) && $this->pass != '')
				{
					if($this->uesrExist($this->uName , $this->pass))
					{
						$this->sessionController->Login($this->uName , $this->pass);
						header( 'Location: ../view/main.php' );
						
						require_once dirname(__FILE__) . '/../model/Info.php';
						require_once dirname(__FILE__) . '/../msc/entity/BaseEntity.php';
						
						$baseEntity = new BaseEntity();
				
						$info = new Info();
						$baseEntity->getObject($info , array("userName" => $this->sessionController->GetUserName()));
						if($info->getUserName() == "")
						{
							$info->setUserName($this->sessionController->GetUserName());
							$info->setWhozPerspective($this->sessionController->GetUserName());
							$baseEntity->save($info);
						}
					}
					else
					{
						header( 'Location: ../../../index.php?login_failed' );
					}
				}
				else
				{
					header( 'Location: ../../../index.php?empty_filed' ) ;
				}
			}
		}
	
	}

?>