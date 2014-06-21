<?php

	class Friend
	{
		private $userName;
		private $friendName;
		
		public $parameters = array("userName" , "friendName");
		
		public function setUserName($name)
		{
			$this->userName = $name;
		}
		
		public function getUserName()
		{
			return $this->userName;
		}
		
		public function setFriendName($name)
		{
			$this->friendName = $name;
		}
		
		public function getFriendName()
		{
			return $this->friendName;
		}
	}

?>