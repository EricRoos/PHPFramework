<?php 
  class UserRouter extends Router{
    
    public function __construct(){
    parent::__construct();
      $this->define_resource('members',array('index','new','show','create'));
      $this->define_resource('comments',array('index','new','show','create'));
    }


    public function define_get(){
    }
    public function define_post(){
    }
    public function define_put(){
    }
    public function define_delete(){
    }

  }
?>
