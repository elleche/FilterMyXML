<?php

	$xml = $_SESSION['xmlUniques'];
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=UniqueRecords.xml");
	header("Content-Type: application/octet-stream; "); 
	header("Content-Transfer-Encoding: binary");
		
	echo $xml;

	

//$file= $this->paramfile;

//header (“Content-type: octet/stream”);

//header (“Content-disposition: attachment; filename=”.$file.“;”);

//header(“Content-Length: “.filesize($file));

//readfile($file);

//exit;

?>