<?php


	class Profile
	{
		private $userName;
		private $firstName;
		private $lastName;
		private $email;
		private $homeAddress;
		private $phoneNumber;
		private $about;
		
		public $parameters = array("userName" , "firstName" , "lastName" , "email" , "homeAddress" , "phoneNumber" , "about");
		
		public function setUserName($userName)
		{
			$this->userName = $userName;
		}
		
		public function getUserName()
		{
			return $this->userName;
		}
		
		public function setFirstName($firstName)
		{
			$this->firstName = $firstName;
		}
		
		public function getFirstName()
		{
			return $this->firstName;
		}
		
		public function setLastName($lastName)
		{
			$this->lastName = $lastName;
		}
		
		public function getLastName()
		{
			return $this->lastName;
		}
		
		public function setEmail($email)
		{
			$this->email = $email;
		}
		
		public function getEmail()
		{
			return $this->email;
		}
		
		public function setHomeAddress($homeAddress)
		{
			$this->homeAddress = $homeAddress;
		}
		
		public function getHomeAddress()
		{
			return $this->homeAddress;
		}
		
		public function setPhoneNumber($phoneNumber)
		{
			$this->phoneNumber = $phoneNumber;
		}
		
		public function getPhoneNumber()
		{
			return $this->phoneNumber;
		}
		
		public function setAbout($about)
		{
			$this->about = $about;
		}
		
		public function getAbout()
		{
			return $this->about;
		}
	}

?>