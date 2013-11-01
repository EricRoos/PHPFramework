<?php
	require_once('record.php');
	require_once('comment.php');
	class Member extends Record{
		protected $name;
		protected $age;

	  public function __construct($params){
	    $this->set_name($params['name']);
			$this->set_age($params['age']);
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

	  public function get_age(){
	    return $this->age;
	  }
  
  	public function set_age($agee){
	    $this->name = $age;
	  }


  	public function comments(){
    	return Comment::where("member_id = ".$this->get_id());
	  } 
	}
	$params = array();
	$params['name'] = "Jane Doe";
	$params['age'] = "22";

	Member::create($params);
?>
