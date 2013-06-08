<?php

	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=UniqueRecords.xml");
	header("Content-Type: application/octet-stream; "); 
	header("Content-Transfer-Encoding: binary");
		
	echo $xml;
?>