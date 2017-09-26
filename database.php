<?php
class Database
{
	public static $dbName = 'classicmodels' ; 
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'root';
	private static $dbUserPassword = 'root';
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {      
        try 
        {
          		self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName.";"."charset=".'utf8', self::$dbUsername, self::$dbUserPassword);          		
		}
        catch(PDOException $e) 
        {
          //die($e->getMessage()); 
          echo "Error on connection!!"; 
        }
       } 
       return self::$cont;
	}
	
	
	public static function disconnect()
	{
		self::$cont = null;
	}
}
