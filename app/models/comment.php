<?php

require_once('record.php');
class Comment extends Record{
	protected $member;
	protected $data;
	public function __construct($arr){
		$this->member = Member::find($arr['member_id']);
		$this->set_data($arr['data']);	
	}

	public function member(){
		return $this->member;
	}
	public function set_member($member){
		if(get_class($member) != "Member"){
			die('Invalid paramater');
		}
		$this->$member = $member;
	}
	public function set_data($data){
		$this->data = $data;
	}

	public function get_data(){
		return $this->data;
	}

	

	
}

?>
