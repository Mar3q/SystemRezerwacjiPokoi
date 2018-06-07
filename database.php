<?php
class Database
{
    private static $dbName = '' ;
    private static $dbHost = '' ;
    private static $dbUsername = '';
    private static $dbUserPassword = '';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Funkcja Init function nie jest dozwolona');
    }
     
    public static function connect()
    {
       // Jedno połaczenie za pośrednictwem aplikacji
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword,array(
							PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
							PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
		}
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>
