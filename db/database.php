<?php
  require_once("passwords.php");
  class mysql_connection{
    public static $db;

    public function __construct($user, $password){
      $db_name = "php_framework_dev";
      self::$db = $this->open_connection($user,$password);
      if(!self::$db){
        die("Couldnt connect to db".mysql_error());
      }
      if(!$this->select_db($db_name,self::$db)){
        die('Couldnt choose database: '.$db_name.';'.mysql_error());
      }
    }
    function open_connection($user,$password){
      return mysql_connect('localhost',$user,$password);
    }

    function select_db($db_name,$db){
      return mysql_select_db($db_name,self::$db);
    }
    function close_connection(){
      mysql_close(self::$db);
    }
  }

  $mysql_connection = new mysql_connection($user,$password);
?>
