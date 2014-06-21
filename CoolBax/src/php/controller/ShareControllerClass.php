<?php
	require_once dirname(__FILE__) . '/../model/Share.php';	
	require_once dirname(__FILE__) . '/../model/Info.php';
	require_once dirname(__FILE__) . '/../msc/entity/BaseEntity.php';

	class ShareControllerClass
	{
		private $data;
		private $baseEntity;
		private $share;
		private $info;
		
		public function ShareControllerClass($data , $userName)
		{
			$this->data = $data;
			$this->baseEntity = new BaseEntity();
			$this->share = new Share();
			$this->info = new Info();
			$this->baseEntity->getObject($this->info , array("userName" => $userName));
		}
		
		
		public function share()
		{
			$this->share->setData($this->data);
			$this->share->setCreated(date( 'Y-m-d H:i:s'));
			$this->share->setWhoShared($this->info->getUserName());
			$this->share->setWhozPerspective($this->info->getWhozPerspective());
			
			$this->baseEntity->save($this->share);
		}
	}

?>