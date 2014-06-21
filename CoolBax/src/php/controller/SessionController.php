<?php
	
  	require_once dirname(__FILE__) . '/../model/User.php';
	require_once dirname(__FILE__) . '/../msc/entity/UserEntity.php';

	  class SessionController 
	  {
	    private $php_session_id;
	    private $native_session_id;
	    private $PDOF;
	    private $user;
		private $userEntity;
	    private $logged_in;
	    private $user_name;
	    private $session_timeout = 3600;      # 10 minute inactivity timeout
	    private $session_lifespan = 3600;    # 1 hour session duration
	
	    public function __construct() 
	    {
	      # Get UserEntity and Connect to database
	      $this->PDOF = PDOFactory::getPDO('mysql:host=localhost;port=3306;dbname=coolbax;charset=UTF-8' , 'root' , '55705968' , array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	      $this->userEntity = new UserEntity();
	      # Set up the handler
	      session_set_save_handler
	      (
	          array(&$this, '_session_open_method'),
	          array(&$this, '_session_close_method'),
	          array(&$this, '_session_read_method'),
	          array(&$this, '_session_write_method'),
	          array(&$this, '_session_destroy_method'),
	          array(&$this, '_session_gc_method')
	      );
	      # Check the cookie passed - if one is - if it looks wrong we'll 
	      # scrub it right away
	      $strUserAgent = $_SERVER["HTTP_USER_AGENT"];
	      if ($_COOKIE["PHPSESSID"]) 
	      {
	       # Security and age check
	       $this->php_session_id = $_COOKIE["PHPSESSID"];
	       $stmt = "select id from http_session where ascii_session_id = '" . $this->php_session_id . "' AND ((time(now())- time(created)) < ' "  . $this->session_lifespan . " second') AND user_agent='" .$strUserAgent ."' AND ((time(now()) - time(last_impression)) <= '".$this->session_timeout." second' OR last_impression IS NULL)";
	       $result = $this->PDOF->prepare($stmt);
	       $result->execute() or die(print_r($result->errorInfo()));
	       if ($result->rowCount() == 0) 
	       {
	         # Set failed flag
	         $failed = 1;
	         # Delete from database - we do garbage cleanup at the same time
	         $maxlifetime = $this->session_lifespan;
	         $stmt = "DELETE FROM http_session WHERE (ascii_session_id = '". $this->php_session_id . "') OR (time(now()) - time(created) > '$maxlifetime second')";
			 $result = $this->PDOF->prepare($stmt);
			 $result->execute() or die(print_r($result->errorInfo()));
	         # Clean up stray session variables
	         $stmt = "DELETE FROM session_variable WHERE session_id NOT IN (SELECT id FROM http_session)";
	         $result = $this->PDOF->prepare($stmt);
	         $result->execute() or die(print_r($result->errorInfo()));
	         # Get rid of this one... this will force PHP to give us another
	         unset($_COOKIE["PHPSESSID"]);
	       };
	      };
	
	      # Set the life time for the cookie
	      session_set_cookie_params($this->session_lifespan);
	      # Call the session_start method to get things started
	      session_start();
	    }
	
	    public function Impress() 
	    {
	      if ($this->native_session_id)
	       {
	        	$stmt = "UPDATE http_session SET last_impression = now() WHERE id = '" . $this->native_session_id . "'";
	        	$result = $this->PDOF->prepare($stmt);
	        	$result->execute() or die(print_r($result->errorInfo()));
	      };
	    }
	
	    public function IsLoggedIn()
	    {
	      return($this->logged_in);
	    }
	
	    public function GetUserName() 
	    {
	      if ($this->logged_in) 
	      {
	        return($this->user_name);
	      } 
	      else 
	      {
	        return false;
	      };
	    }
	
	    public function GetUserObject() 
	    {
	      if ($this->logged_in) 
	      {
	        if (class_exists("User")) 
	        {
	          $objUser = new User();
	          $this->userEntity->getObject($objUser , array("userName" => $this->user_name));
	          return($objUser);
	        } 
	        else 
	        {
	          return(false);
	        };
	      };
	    }
	
	    public function GetSessionIdentifier() 
	    {
	      return($this->php_session_id);
	    }
	
	    public function Login($strUsername, $strPlainPassword) 
	    {
	      $stmt = "select userName FROM user WHERE userName = '$strUsername' AND password = '$strPlainPassword'";
	      $result = $this->PDOF->prepare($stmt);
	      $result->execute() or die(print_r($result->errorInfo()));
	      if ($result->rowCount()>0) 
	      {
	        $row = $result->fetch(PDO::FETCH_ASSOC);
	        $this->user_name = $row["userName"];
	        $this->logged_in = true;
	        $stmt = "UPDATE http_session SET logged_in = true, user_name = '" . $this->user_name . "' WHERE id = '" . $this->native_session_id . "'";
	        $result = $this->PDOF->prepare($stmt);
	        $result->execute() or die(print_r($result->errorInfo()));
	        return(true);
	      } 
	      else 
	      {
	        return(false);
	      };
	    }
	
	    public function LogOut() {
	      if ($this->logged_in == true) 
	      {
	        $stmt = "UPDATE http_session SET logged_in = false, user_name = '' WHERE id = '" . $this->native_session_id . "'";
	        $result = $this->PDOF->prepare($stmt);
	     	$result->execute() or die(print_r($result->errorInfo()));
	        $this->logged_in = false;
	        $this->user_name = '';
	        return(true);
	      } 
	      else 
	      {
	        return(false);
	      };
	    }
	
	    public function __get($nm) 
	    {
	      $stmt = "SELECT variable_value FROM session_variable WHERE session_id = " . $this->native_session_id . " AND variable_name = '" . $nm . "'";
	      $result = $this->PDOF->prepare($stmt);
	      $result->execute() or die(print_r($result->errorInfo()));
	      if ($result->rowCount()>0) 
	      {
	        $row = $result->fetch(PDO::FETCH_ASSOC);
	        return(unserialize($row["variable_value"]));
	      } 
	      else 
	      {
	        return(false);
	      };
	    }
	
	    public function __set($nm, $val) 
	    {
	      $strSer = serialize($val);
	      $stmt = "INSERT INTO session_variable(session_id, variable_name, variable_value) VALUES(" . $this->native_session_id . ", '$nm', '$strSer')";
	      $result = $this->PDOF->prepare($stmt);
	      $result->execute() or die(print_r($result->errorInfo()));
	    }
	
	    private function _session_open_method($save_path, $session_name) 
	    {
	      # Do nothing
	      return(true);
	    }
	
	    private function _session_close_method() 
	    {
	      $this->PDOF = NULL;
	      return(true);
	    }
	
	    public function _session_read_method($id) 
	    {
	      # We use this to determine whether or not our session actually exists.
	      $strUserAgent = $_SERVER["HTTP_USER_AGENT"];
	      $this->php_session_id = $id;
	      # Set failed flag to 1 for now
	      $failed = 1;
	      # See if this exists in the database or not.
	      $stmt = "select id, logged_in, user_name from http_session where ascii_session_id = '" . $id . "'";
	      $result = $this->PDOF->prepare($stmt);
	      $result->execute() or die(print_r($result->errorInfo()));
	      if ($result->rowCount()>0) 
	      {
	       $row = $result->fetch(PDO::FETCH_ASSOC);
	       $this->native_session_id = $row["id"];
	       if ($row["logged_in"]==true) 
	       {
	         $this->logged_in = true;
	         $this->user_name = $row["user_name"];
	       } 
	       else 
	       {
	         $this->logged_in = false;
	       };
	      }
	      else 
	      {
	        $this->logged_in = false;
	        # We need to create an entry in the database
	        $stmt = "INSERT INTO http_session(ascii_session_id, logged_in,user_name, created, user_agent) VALUES ('$id','f',0,now(),'$strUserAgent')";
	        $result = $this->PDOF->prepare($stmt);
	        $result->execute() or die(print_r($result->errorInfo()));
	        # Now get the true ID
	        $stmt = "select id from http_session where ascii_session_id = '$id'";
	        $result = $this->PDOF->prepare($stmt);
	        $result->execute() or die(print_r($result->errorInfo()));
	        $row = $result->fetch(PDO::FETCH_ASSOC);
	        $this->native_session_id = $row["id"];
	      };
	      # Just return empty string
	      return("");
	    }
	    public function _session_write_method($id, $sess_data) 
	    {
	      return(true);
	    }
	
	    private function _session_destroy_method($id) 
	    {
	      $stmt = "DELETE FROM http_session WHERE ascii_session_id = '$id'";
	      $result = $this->PDOF->prepare($stmt);
	      $result->execute() or die(print_r($result->errorInfo()));
	      return($result);
	    }
	
	    private function _session_gc_method($maxlifetime) 
	    {
	      return(true);
	    }
	
	 }
	 

	 
	 
?>
