<?php
	
	require_once dirname(__FILE__) . '/../model/Chat.php';
	require_once dirname(__FILE__) . '/ChatObserverClass.php';
	require_once dirname(__FILE__) . '/../msc/entity/BaseEntity.php';

	class ChatSubjectController// implements SplSubject 
	{
		private $observers;
		private $chat;
		private $baseEntity;
		
		public function __construct()
		{	
			//$this->observers = new SplObjectStorage();
			$this->chat = new Chat();
			$this->baseEntity = new BaseEntity();
		}
	
		public function attach(SplObserver $observer)
		{
			//$this->observers->attach($observer);
		}
		
		public function detach(SplObserver $observer)
		{
			//$this->observers->detach($observer);
		}
		
		public function notify()
		{
			//foreach($this->observers as $observer)
			//{
				//$observer->update($this);
			//}
		}
		
		public function sendMessageToDB($message , $sender , $receiver)
		{
			$this->chat->setMessage($message);
			$this->chat->setSender($sender);
			$this->chat->setReceiver($receiver);
			$this->chat->setReaded('0');
			$this->baseEntity->save($this->chat);
			$this->notify();
		}
	}

?>