<?php
class User {

  public $FirstName='First';
  public $LastName='Last';
  
  public function __construct() {
		echo __CLASS__.' created: '.$this->FirstName.'<br><br>';
  }
  
   public function __destruct()
  {
      echo 'The class "', __CLASS__, '" was destroyed.<br />';
  }
  
  public function setProperty($attr,$newval)
  {
	switch ($attr) {
    case 'Name':
      $this->FirstName = $newval;
	break;
	
	case 'LastName':
      $this->LastName = $newval;
	break;}
  }
 
  public function getProperty()
  {
      return $this->FirstName. ' ' .$this->LastName . "<br />";
  }
  
  public function Iam()
  {
      return __CLASS__;
  }
} 
