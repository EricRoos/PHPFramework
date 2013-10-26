<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/app/models/comment.php');		
	require_once($_SERVER['DOCUMENT_ROOT'].'/app/models/member.php');		

	switch($_GET['method']){
		case "index":
			$comments = Comment::all();
		break;

		case "show":
			$comment = Comment::find($id);
		break;

		case "new":

		break;

		case "create":
			Comment::create($_POST);
			header("Location: /members/".$_POST['member_id']);
		break;

		default:
			$view_path = '404.html';
		break;
	}
?>
