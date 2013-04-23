<?php
//	header("Location: uploadform.html");
//    exit;
	
	require_once("controller/Controller.php");  
  
	session_start();
	
	$controller = new Controller();  
	$controller->invoke();  
?>