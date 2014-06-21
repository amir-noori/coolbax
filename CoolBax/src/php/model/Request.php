<?php

	class Friend
	{
		private $request;
		private $fromUserName;
		private $toUserName;
		
		public $parameters = array("fromUserName" , "toUserName" , "request");
		
		public function setRequest($req)
		{
			$this->request = $req;
		}
		
		public function getRequest()
		{
			return $this->request;
		}
		
		public function setFromUserName($userName)
		{
			$this->fromUserName = $userName;
		}
		
		public function getFromUser()
		{
			return $this->fromUserName;
		}
		
		public function setToUser($userName)
		{
			$this->toUserName = $userName;
		}
		
		public function getToUser()
		{
			return $this->toUserName;
		}
		

	}
	
?>