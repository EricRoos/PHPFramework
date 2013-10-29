<?php
  $_SERVER['DOCUMENT_ROOT'] = '/var/www/PHPFramework';
  require_once($_SERVER['DOCUMENT_ROOT'].'/db/database.php');
  class Record{

    protected $id;
		private $db; 

    public function __construct($params){
       $this->set_id($params['id']);
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
      $result_set = mysql_instance::get_instance()->select_where($table_name,array("*"),"id = ".$id);
      $arr = $result_set->fetch_assoc();
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
      $result_set = mysql_instance::get_instance()->select_where($table_name,array("*"),$clause);
      $arr = array();
      while($row = $result_set->fetch_assoc()){
        $arr[] = new $called_class($row);
      }
      return $arr;
    }
    public static function all(){
      $called_class = get_called_class();
      $table_name = strtolower($called_class).'s';
      $result_set = mysql_instance::get_instance()->select($table_name,array("*"));
      $arr = array();
      while($row  = $result_set->fetch_assoc()){
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
