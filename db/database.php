<?php
  class mysql_instance{
    private static $instance;
		private $db_conn;
		public static function get_instance(){
			if(!isset(self::$instance)){
					mysql_instance::$instance = new mysql_instance();
			}
			return mysql_instance::$instance;
		}

    private function __construct(){
      $db_name = "php_framework_dev";
			$user = ini_get("mysqli.default_user");
			$password = ini_get("mysqli.default_pw");
	    $this->db_conn = mysqli_connect('127.0.0.1',$user,$password,$db_name) OR DIE ("unable to connect to db");
		}
	
		private function generate_insert($table,$attributes){
			$statement = sprintf("INSERT INTO %s",$table);
			$attribute_decl = sprintf("(%s)",implode(array_keys($attributes),","));
			$values = sprintf("VALUES ('%s')",implode(array_values($attributes),"','"));
			$sql = $statement . " " . $attribute_decl . " " . $values;
			return $sql;
			
		}

		private function generate_select($table,$attributes){
			$sql = sprintf("SELECT %s FROM %s",implode($attributes,","),$table);
			return $sql;
		}

		private function generate_where($table,$attributes,$where_clause){
			$select = $this->generate_select($table,$attributes);
			$sql = $select . " WHERE " . $where_clause;
			return $sql;
		}

		public function insert($table,$attributes){
			$sql = $this->generate_insert($table,$attributes).";";
			$results = mysqli_query($this->db_conn,$sql) or die("unable to insert: " . $sql);
		}

		public function select($table,$attributes){
			$sql = $this->generate_select($table,$attributes).";";
			$results = mysqli_query($sql);
		}

		public function select_where($table,$attributes,$where_clause){
			$sql = $this->generate_where($table,$attributes, $where_clause).";";
			$results = mysqli_query($sql);
		}

    function close_instance(){
      mysqli_close($this->db_conn);
    }
  }
?>
