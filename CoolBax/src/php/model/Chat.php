<?php

	class Chat
	{
		private $sender;	
		private $receiver;
		private $message;
		private $readed;
		
		public $parameters = array("sender" , "receiver" , "message" , "readed");
		
		public function setSender($sender)
		{
			$this->sender = $sender;
		}
		
		public function getSender()
		{
			return $this->sender;
		}
		
		public function setReceiver($receiver)
		{
			$this->receiver = $receiver;
		}
		
		public function getReceiver()
		{
			return $this->receiver;
		}
		
		public function setMessage($message)
		{
			$this->message = $message;
		}
		
		public function getMessage()
		{
			return $this->message;
		}
		
		public function setReaded($readed)
		{
			$this->readed = $readed;
		}
		
		public function getReaded()
		{
			return $this->readed;
		}
	}

?>