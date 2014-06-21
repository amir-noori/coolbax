<?php
	
	require_once dirname(__FILE__) . '/../db/PDOFactory.php';
	require_once dirname(__FILE__) . '/../../model/Profile.php';
	require_once dirname(__FILE__) . '/../../model/Friend.php';
	require_once dirname(__FILE__) . '/../../controller/FriendController.php';

	class BaseEntity
	{
		
		private $PDOF;
		
		public function BaseEntity()
		{
			try 
			{
				$this->PDOF = PDOFactory::getPDO('mysql:host=localhost;port=3306;dbname=coolbax;charset=UTF-8' , 'root' , '55705968' , array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
		
			}
			catch(PDOException $e)
			{
				$e->getMessage();
			}
		}
		
		public function save($obj)
		{
			$query = "INSERT INTO " . get_class($obj) . " (";
			foreach($obj->parameters as $param)
			{
				$query .= $param . " ,";
			}
			$query = substr_replace($query ,"",-1);
			$query .= ") VALUES (";
			
			foreach($obj->parameters as $param)
			{
				$param = ucfirst($param);
				$getter = "get";
				$getter .= $param;
				$var = call_user_func(array($obj , $getter));
				
				if($var == null)
				{
					$query .= "NULL ,";
				}
				else if($var == "")
				{
					$query .= "'' ,";
				}
				else
				{
					$query .= "'" . $var . "' ,";
				}
				
			}
			$query = substr_replace($query ,"",-1);
			$query .= ")";

			try 
			{
				$stmt = $this->PDOF->prepare($query);
				$stmt->execute() or die(print_r($stmt->errorInfo()));
			}
			catch(PDOException $e)
			{
				$e->getMessage();
			}		
		}
		
		public function delete($obj)
		{
			$query = "DELETE FROM " . get_class($obj) . " WHERE ";
			$primaryKey = call_user_func(array($obj , "get" . ucfirst($obj->pk)));
			
			if(isset($primaryKey) && $primaryKey != "")
			{
				$query .= $obj->pk . " =  '" . $primaryKey . "'";
			}
			else
			{
				foreach($obj->parameters as $param)
				{
					$param = ucfirst($param);
					
					
					$getter = "get";
					$getter .= $param;
					$var = call_user_func(array($obj , $getter));
					if(isset($var) && $var != "")
					{
						$query .= $param . " = '" . $var . "' and ";
					}
				}
				$query = substr_replace($query ,"", -4 , -1);
			}
					
			try 
			{
				$stmt = $this->PDOF->prepare($query);
				$stmt->execute() or die(print_r($stmt->errorInfo()));
			}
			catch(PDOException $e)
			{
				$e->getMessage();
			}

		}
	
	public function update($oldObj , $newObj)
		{
			$query = "UPDATE " . get_class($newObj) . " SET ";
			
			foreach($newObj->parameters as $param)
			{
				$param = ucfirst($param);
				$getter = "get";
				$getter .= $param;
				$varNew = call_user_func(array($newObj , $getter));
				$varOld = call_user_func(array($oldObj , $getter));
				if(isset($varNew))
				{
					$query .= $param . " = '" . $varNew . "' , ";
				}
				elseif(isset($varOld) || $varOld == "")
				{
					$query .= $param . " = '" . $varOld . "' , ";
				}
				else if ($varOld == null)
				{
					$query .= $param . " = NULL , ";
				}
			}
			$query = substr_replace($query ,"", -2 , -1);
			$query .= " WHERE ";
			$primaryKey = call_user_func(array($oldObj , "get" . ucfirst($oldObj->pk)));
			
			if(isset($primaryKey) && $primaryKey != "")
			{
				$query .= $oldObj->pk . " =  '" . $primaryKey . "'";
			}
			else
			{
				foreach($oldObj->parameters as $param)
				{
					$param = ucfirst($param);
					
					
					$getter = "get";
					$getter .= $param;
					$var = call_user_func(array($oldObj , $getter));
					if(isset($var) && $var != "")
					{
						$query .= $param . " = '" . $var . "' and ";
					}
				}
				$query = substr_replace($query ,"", -4 , -1);
			}

			try 
			{
				$stmt = $this->PDOF->prepare($query);
				$stmt->execute() or die(print_r($stmt->errorInfo()));
			}
			catch(PDOException $e)
			{
				$e->getMessage();
			}
			
		}
		
		public function getObject($obj , array $parameters , $limit1 , $limit2)
		{
			if(is_array($obj))
			{
				$x=get_class($obj[0]);
				$query = "SELECT * FROM " . get_class($obj[0]) . " WHERE ";
				foreach($parameters as $key => $value)
				{
					$query .= $key . " = '" . $value . "' and ";
				}
				$query = substr_replace($query ,"", -4 , -1);
				if((isset($limit1) && isset($limit1)) )
				{
					$query .= " LIMIT " . $limit1 . ", " . $limit2; 
				}
				//echo "<hr>" . $query ."<hr>";
				$index = 0;	
				try 
				{
					$stmt = $this->PDOF->prepare($query);
					$stmt->execute() or die(print_r($stmt->errorInfo()));
					
					$result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($obj[0]));
					foreach($result as $object)
					{
						$tempObj = new $x();
	    				foreach($obj[0]->parameters as $param)
						{ 
							$param = ucfirst($param);
							$setter = "set";
							$setter .= $param;
							call_user_func(array($tempObj , $setter) , call_user_func(array($object , 'get' . $param)));
							
						}
						array_push($obj , $tempObj);
						$index++;
					}
				}	
				catch(PDOException $e)
				{
					$e->getMessage();
				}
				
				return $obj;
			}
			else
			{
				$query = "SELECT * FROM " . get_class($obj) . " WHERE ";
				foreach($parameters as $key => $value)
				{
					$query .= $key . " = '" . $value . "' and ";
				}
				$query = substr_replace($query ,"", -4 , -1);
	
				try 
				{
					$stmt = $this->PDOF->prepare($query);
					$stmt->execute() or die(print_r($stmt->errorInfo()));
					
					$result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($obj));
					foreach($result as $object)
					{
	    				foreach($obj->parameters as $param)
						{
							$param = ucfirst($param);
							$setter = "set";
							$setter .= $param;
							call_user_func(array($obj , $setter) , call_user_func(array($object , 'get' . $param)));
						}
					
					}
				}	
				catch(PDOException $e)
				{
					$e->getMessage();
				}
				
				return $obj;
			}
			
			
		}
		
	}
	
	

?>


