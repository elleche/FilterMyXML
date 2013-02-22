<?php

	session_start();	
	$xml = $_SESSION['xmlUniques'];
	
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
//	header("Content-Length: ". filesize("$filename").";");
	header("Content-Disposition: attachment; filename=Unique records.xml");
	header("Content-Type: application/octet-stream; "); 
	header("Content-Transfer-Encoding: binary");
		
	echo $xml;
?>