<?php

	class Gallery
	{
		private $imagePath;
		private $imageName;
		private $isProfile;
		private $userName;
		
		public $parameters = array("imagePath" , "imageName" , "isProfile" , "userName");
		
		public function __construct()
		{
			
		}
		
		
		public function setImagePath($imagePath)
		{
			$this->imagePath = $imagePath;
		}
		
		public function getImagePath()
		{
			return $this->imagePath;
		}
		
		public function setImageName($imageName)
		{
			$this->imageName = $imageName;
		}
		
		public function getImageName()
		{
			return $this->imageName;
		}
		
		public function setIsProfile($isProfile)
		{
			$this->isProfile = $isProfile;
		}
		
		public function getIsProfile()
		{
			return $this->isProfile;
		}
		
		public function setUserName($name)
		{
			$this->userName = $name;
		}
		
		public function getUserName()
		{
			return $this->userName;
		}
	}

?>