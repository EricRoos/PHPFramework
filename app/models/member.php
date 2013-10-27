<?php
require_once('record.php');
require_once('comment.php');
class Member extends Record{

  public function __construct($arr){
    $this->set_name($arr['name']);
    if(isset($arr['id'])){
      $this->set_id($arr['id']);
    }
  }

  public function get_name(){
    return $this->name;
  }
  
  public function set_name($name){
    $this->name = $name;
  }

  public function comments(){
    return Comment::where("member_id = ".$this->get_id());
  }
  
  
}
?>
