<?php

	class Share
	{
		private $whozPerspective;
		private $whoShared;
		//private $shareWith;
		private $imagePath;
		private $created;
		private $data;
		
		public $parameters = array("whozPerspective" , "whoShared" ,  "imagePath" , "created" , "data");
		
		public function setWhozPerspective($userName)
		{
			$this->whozPerspective = $userName;
		}
	
		public function getWhozPerspective()
		{
			return $this->whozPerspective;
		}
		
		public function setWhoShared($userName)
		{
			$this->whoShared = $userName;
		}
	
		public function getWhoShared()
		{
			return $this->whoShared;
		}
		
		/* implement it later, for now we share with everyone
		public function setShareWith($shareWith)
		{
			$this->shareWith = $shareWith;
		}
	
		public function getShareWith()
		{
			return $this->shareWith;
		}
		*/
		
		public function setImagePath($imagePath)
		{
			$this->imagePath = $imagePath;
		}
	
		public function getImagePath()
		{
			return $this->imagePath;
		}
		
		public function setCreated($created)
		{
			$this->created = $created;
		}
	
		public function getCreated()
		{
			return $this->created;
		}
		
		public function setData($data)
		{
			$this->data = $data;
		}
	
		public function getData()
		{
			return $this->data;
		}
	}

?>