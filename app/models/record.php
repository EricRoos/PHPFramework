<?php
  $_SERVER['DOCUMENT_ROOT'] = '/var/www/PHPFramework';
  require_once($_SERVER['DOCUMENT_ROOT'].'/db/database.php');
  class Record{

    protected $id;
		private $db; 

    public function __construct(){
    }
    
    public function get_id(){
      return $this->id;
    }

    public function set_id($id){
      $this->id = $id;
    }
  

    public static function find($id){
      $called_class = get_called_class();
      $table_name = strtolower(get_called_class()).'s';
      $sql = 'SELECT * FROM '.$table_name.' WHERE id = '.$id.';';
      $result_set = mysql_query($sql,mysql_connection::$db);
      $arr = mysql_fetch_array($result_set);
      return new $called_class($arr);
    }
    protected function getVariables(){
      return get_object_vars($this);
    }
    public static function create($params){
      $called_class = get_called_class();
      $table_name = strtolower(get_called_class()).'s';
   		$db = mysql_instance::get_instance(); 
			$result = $db->insert($table_name,$params);
	    if($result){
        $params['id'] = mysql_insert_id();
        return new $called_class($params);
      }
      return null;
    }
    public static function where($clause){
      $called_class = get_called_class();
      $table_name = strtolower(get_called_class()).'s';
      $sql = "SELECT * FROM ".$table_name." WHERE ".$clause;
      $result_set = mysql_query($sql,mysql_connection::$db) or die("ERROR!");
      $arr = array();
      while($row = mysql_fetch_array($result_set)){
        $arr[] = new $called_class($row);
      }
      return $arr;
    }
    public static function all(){
      $called_class = get_called_class();
      $table_name = strtolower($called_class).'s';
      $sql = 'SELECT * FROM '.$table_name.';'; 
      $result_set = mysql_query($sql,mysql_connection::$db) or die("ERROR!");
      $arr = array();
      while($row = mysql_fetch_array($result_set)){
        $arr[] = new $called_class($row);
      }
      return $arr;
    }

    public static function destroy($id){
      $called_class = get_called_class();
      $table_name = strtolower($called_class).'s';
      $sql = 'DELETE FROM where id ='.$id.';';
    }

    public function delete(){
      $called_class = get_called_class();
      $called_class::destroy($this->get_id());
      $this->set_id(null);
    }
  }
?>
