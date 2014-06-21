<?php

	require_once dirname(__FILE__) . '/../msc/entity/BaseEntity.php';
	require_once dirname(__FILE__) . '/../model/Chat.php';
	require_once dirname(__FILE__) . '/ChatSubjectClass.php';


	class ChatObserverController// implements SplObserver
	{
		private $baseEntity;
		private $chat;
		private $newChat;
		private $chatSubjectController;
		private $sender;
		private $receiver;
		
		
		public function __construct($sender , $receiver)
		{
			$this->sender = $sender;
			$this->receiver = $receiver;
			$this->baseEntity = new BaseEntity();
			$this->chat = new Chat();
			$this->newChat = new Chat();
		}
		
		public function update()
		{
			$this->chat = $this->baseEntity->getObject($this->chat , array("sender" => $this->sender , "receiver" => $this->receiver , "readed" => false));
			$message = $this->chat->getMessage();
			if(isset($message) || $message != '')
			{
				echo $this->chat->getMessage() . "<hr>";
				$this->newChat->setMessage($this->chat->getMessage());
				$this->newChat->setSender($this->sender);
				$this->newChat->setReceiver($this->receiver);
				$this->newChat->setReaded(true);
				$this->baseEntity->update($this->chat , $this->newChat);
			}
		}
		
	}

?>