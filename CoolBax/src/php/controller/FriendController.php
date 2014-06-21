<?php
	
	require_once dirname(__FILE__) . '/../model/User.php';
	require_once dirname(__FILE__) . '/../model/Friend.php';
	require_once dirname(__FILE__) . '/../msc/entity/UserEntity.php';
	require_once dirname(__FILE__) . '/../controller/SessionController.php';	

	class FriendController
	{
		private $user;
		private $friendList;
		private $friend;
		private $baseEntity;
		
		public function __construct($sessionController)
		{
			$this->friend = new Friend();
			$this->friendList = array(new Friend());
			$this->user = new User();
			$this->user = $sessionController->GetUserObject();
			$this->baseEntity = new BaseEntity();
		}
		
		public function getAllFriends()
		{
			$this->friendList = $this->baseEntity->getObject($this->friendList , array("userName" => $this->user->getUserName()));
			return $this->friendList;
		}
		
		public function getLimitedFriends($limit1 , $limit2)
		{
			$this->friendList = $this->baseEntity->getObject($this->friendList , array("userName" => $this->user->getUserName()) , $limit1 , $limit2);
			return $this->friendList;
		}
		
	}



?>