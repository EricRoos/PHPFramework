<?php
	$view_path = $_SERVER['DOCUMENT_ROOT'].'/app/views/'.$_GET['controller'].'/'.$_GET['method'].'.php';
	require_once($_SERVER['DOCUMENT_ROOT'].'/app/controllers/'.$_GET['controller'].'_controller.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/index.php');
?>
