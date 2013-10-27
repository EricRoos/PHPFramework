<?php
  abstract class Generator{
    
    public function __construct(){

    }
    public function convert_model_name($model){
      $ret = "";
      for($i = 0 ; $i < strlen($model) ; $i++){
        if($model[$i] == strtoupper($model[$i])){
          if($i > 0){
            $ret .= "_";
          }
        }
        $ret .= strtolower($model[$i]);
      }  
      $ret .= "s";
      return $ret;
    }
    public abstract function generate();
  }

?>
