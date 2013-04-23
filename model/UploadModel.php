<?php 
require_once('model/File.php');

class UploadModel 
{
	private $file;
	private $fileError;
	
	function __construct($userFile)
	{  
		$this->file = new File($userFile);
	}
	
	public function getFile()
	{
		return $this->file;
	}
}
?>