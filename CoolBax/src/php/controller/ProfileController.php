<?php

	require_once dirname(__FILE__) . '/../controller/SessionController.php';
	require_once dirname(__FILE__) . '/../msc/entity/ProfileEntity.php';
	require_once dirname(__FILE__) . '/../model/Profile.php';
	require_once dirname(__FILE__) . '/../model/User.php';

	class ProfileController
	{
		private $user;
		private $profile;
		private $profileEntity;
		
		public function __construct($sessionController)
		{		
			$this->user = new User();
			$this->user = $sessionController->GetUserObject();
			
			$this->profileEntity = new ProfileEntity();
			$this->profile = new Profile();
			$this->profileEntity->getObject($this->profile , array("userName" => $this->user->getUserName()));
		}
		
		public function getInfo()
		{
			$info = array();
			$info["User Name"] = $this->profile->getUserName();
			$info["First Name"] = $this->profile->getFirstName();
			$info["Last Name"] = $this->profile->getLastName();
			$info["Email"] = $this->profile->getEmail();
			$info["Password"] = $this->user->getPassword();
			$info["Home Address"] = $this->profile->getHomeAddress();
			$info["Phone Number"] = $this->profile->getPhoneNumber();
			$info["About"] = $this->profile->getAbout();
			return $info;
		}
	}

?>