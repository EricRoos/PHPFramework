<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/db/database.php');
	class Record{

		protected $id;
		
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
			$sql = "INSERT INTO ".$table_name."(";
			$params_size = count($params);
			$vars = array_keys($params); 
			for($i = 0; $i < $params_size ; $i++){
				$sql = $sql.$vars[$i];
				if($i < $params_size-1){
					$sql = $sql.',';
				}
			}
			$sql = $sql.') VALUES(';
			for($i = 0; $i < $params_size ; $i++){
				$sql = $sql.'\''.$params[$vars[$i]].'\'';
				if($i < $params_size-1){
					$sql = $sql.',';
				}
			}
			$sql = $sql.');';
			$sql = strip_tags($sql);
			if(!mysql_query($sql,mysql_connection::$db)){
				return false;
			}
			return true;
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
	}
?>
