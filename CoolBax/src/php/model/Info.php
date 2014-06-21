<?php

	class Info
	{
		private $userName;
		private $whozPerspective;
		
		public $parameters = array("userName" , "whozPerspective");
		public $pk = "userName";
		
		
		public function setUserName($name)
		{
			$this->userName = $name;
		}
		
		public function getUserName()
		{
			return $this->userName;
		}
		
		public function setWhozPerspective($userName)
		{
			$this->whozPerspective = $userName;
		}
		
		public function getWhozPerspective()
		{
			return $this->whozPerspective;
		}
	}


?>