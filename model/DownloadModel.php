<?php

class DownloadModel 
{
	private $xml;
	
	function __construct()
	{  
		$this->xml = $_SESSION['xmlUniques'];
	}
	
	public function getXML()
	{
		return $this->xml;
	}
}
?>