<?php
  
  $_SERVER['DOCUMENT_ROOT'] = "/var/www/";
  require_once('/var/www/db/database.php');
  require_once('/var/www/app/models/member.php');

  function print_record($member){
    echo $member->get_name()."<".$member->get_id().">";
  }
  $params = array("name" => "John Doe");
  $john_doe = new Member($params);
  $crud_john_doe = Member::create($params);

  echo "Object creation test:\t\t";
  if($john_doe->get_name() == $crud_john_doe->get_name()){
    echo "Pass";
  }else{
    echo "Fail";
  }
  echo "\n";


  echo "Object search test:\t\t";
  $searched_john_doe = Member::find($crud_john_doe->get_id());
  if($searched_john_doe->get_id() == $crud_john_doe->get_id()){
    echo "Pass";
  }else{
    echo "Fail";
  }
  echo "\n";


    
  echo "Object delete test:\t\t";
  $crud_john_doe->delete();
  if($crud_john_doe->get_id() == null){
    echo "Pass";
  }else{
    echo "Fail";
  }
  echo "\n";
?>
