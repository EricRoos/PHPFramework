<?php 
  require_once('generator.php');
  class MigrationGenerator extends Generator{
    protected $model;
    protected $columns;

    public function __construct($params){
      $this->model = $params['model'];
      $this->columns = $params['columns'];
    }
    
		public function generate(){
			$converted_name = $this->convert_model_name($this->model);
			$ret = "";
			$ret .= "CREATE TABLE ".$converted_name."(id int not_null auto increment PRIMARY KEY,\n";
			$itr = 0;			
			foreach(array_keys($this->columns) as $column){
				$type = $this->columns[$column];
				switch($type){
						case "integer":
							$type = "int";
						break;

						case "references":
							$type = "int FOREIGN KEY(".$this->convert_model_name($column)."_id) REFERENCES $column"."s(id)";
						break;

						case "string":
							$type = "VARCHAR(55)";
						break;
						default:
						break;
				}
		
				$ret .= "    ".$column." ".$type;
				if($itr != count($this->columns)-1){
					$ret .=",\n";
				}
				$itr++;
			}
			$ret .=");\n";
			return $ret;
		}
    public function get_model(){
      return $this->model;
    }
    public function set_model($model){
      $this->model = $model;
    }
    
    public function get_columns(){
      return $this->columns;
    }
    public function set_columns($columns){
      $this->columns = $columns;
    }
    
  }
?>
