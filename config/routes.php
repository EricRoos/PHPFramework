<?php
	$path = $_SERVER['REQUEST_URI'];
	$uri_tokens = explode('/',$path);
	$requested_model = $uri_tokens[1];
	echo $requested_model;
	$root_extension = '/app/controllers/'.$requested_model.'_controller.php';
	if(file_exists($_SERVER['DOCUMENT_ROOT'].$root_extension)){
		require_once($_SERVER['DOCUMENT_ROOT'].$root_extension);
	}else{
	 	require_once($_SERVER['DOCUMENT_ROOT'].'/404.html');
	}
?>
