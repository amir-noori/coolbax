<?php

	class HTTP_Session
	{
		
		private $ascii_session_id;
		private $logged_in;
		private $last_impression;
		private $user_name;
		private $created;
		private $user_agent;
		
		public $parameters = array("ascii_session_id" , "logged_in" , "last_impression" , "user_name" , "created" , "user_agent");
		
		public function setAscii_session_id($ascii_session_id)
		{
			$this->ascii_session_id = $ascii_session_id;
		}
		
		public function getAscii_session_id()
		{
			return $this->ascii_session_id;
		}
		
		public function setLogged_in($logged_in)
		{
			$this->logged_in = $logged_in;
		}
		
		public function getLogged_in()
		{
			return $this->logged_in;
		}
		
		public function setLast_impression($last_impression)
		{
			$this->last_impression = $last_impression;
		}
		
		public function getLast_impression()
		{
			return $this->last_impression;
		}
		
		public function setUser_name($user_name)
		{
			$this->user_name = $user_name;
		}
		
		public function geUser_name()
		{
			return $this->user_name;
		}
		
		public function setCreated($created)
		{
			$this->created = $created;
		}
		
		public function getCreated()
		{
			return $this->created;
		}
		
		public function setUser_agent($user_agent)
		{
			$this->user_agent = $user_agent;
		}
		
		public function getUser_agent()
		{
			return $this->user_agent;
		}
	}


?>