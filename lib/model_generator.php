<?php

  require_once('generator.php');

  class ModelGenerator extends Generator{
  
    protected $model;
    protected $columns;
    public function __construct($params){
      $this->model = $params['model'];
      $this->columns = $params['columns'];
    }

    public function generate(){
      $tab = "  ";
      $ret = "";
      $ret .= "<?php \n";
      $ret .= $tab."require_once('record.php');\n";
      $ret .= $tab."class $this->model extends Record{\n";
      $attribute_keys = array_keys($this->columns);
      foreach($attribute_keys as $key){
        $ret .= $tab.$tab."protected \$$key;\n";
      }    
      $ret .= "\n";
      $ret .= $tab.$tab."public function __construct(\$params){\n";
      foreach($attribute_keys as $key){
        $ret .= $tab.$tab.$tab."\$this->$key = \$params['$key'];\n";
      }
      $ret .= $tab.$tab."}\n";
      $ret .= $tab.$tab."\n";
      foreach($attribute_keys as $key){
        $ret .= $tab.$tab."public function get_$key(){\n";
        $ret .= $tab.$tab.$tab."return \$this->$key;\n";
        $ret .= $tab.$tab."}\n";
        $ret .= $tab.$tab."public function set_$key(\$$key){\n";
        $ret .= $tab.$tab.$tab."\$this->$key = \$$key;\n";
        $ret .= $tab.$tab."}\n";
        $ret .= $tab.$tab."\n";
      }
      $ret .= $tab."}\n";
      $ret .= "}\n";
      $ret .= "?>\n";
      return $ret;
    }
  }
  
?>
