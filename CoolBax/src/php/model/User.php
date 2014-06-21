<?php 

	class User
	{
		private $userName;
		private $password;
		private $firstName;
		private $lastName;
		private $email;
		
		public $parameters = array("userName" , "password" , "firstName" , "lastName" , "email"); 
		public $pk = "userName";
		
		public function setUserName($name)
		{
			$this->userName = $name;
		}
		
		public function getUserName()
		{
			return $this->userName;
		}
		
		public function setPassword($pass)
		{
			$this->password = $pass;
		}
		
		public function getPassword()
		{
			return $this->password;
		}
		
		public function setFirstName($fname)
		{
			$this->firstName = $fname;
		}
		
		public function getFirstName()
		{
			return $this->firstName;
		}
		
		public function setLastName($lname)
		{
			$this->lastName = $lname;
		}
		
		public function getLastName()
		{
			return $this->lastName;
		}
		
		public function setEmail($mail)
		{
			$this->email = $mail;
		}
		
		public function getEmail()
		{
			return $this->email;
		}
	
		
		public function User()
		{
			
		}
	
	}
	
?>