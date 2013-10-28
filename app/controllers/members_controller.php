<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/app/models/member.php');    
  switch($_GET['method']){
    case 'index':
      $members = Member::all();
    break;

    case 'show':
      $id = $_GET['params']['id'];
      $member = Member::find($id);
    break;

    case 'new':

    break;

    case 'create':
      Member::create($_POST);
      header('Location: /members');
    break;

    default:
      $view_path = '404.html';
    break;
  }
?>
