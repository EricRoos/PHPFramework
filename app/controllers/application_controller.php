<?php
	$controller = $_GET['controller'];
	$method = strtolower($_GET['method']);
	$view_path = $_SERVER['DOCUMENT_ROOT'].'/app/views/'.$controller.'/'.$method.'.php';
	require_once($_SERVER['DOCUMENT_ROOT'].'/app/controllers/'.$controller.'_controller.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/index.php');
?>
