<?php  
class FileError
{
	public $errorCode;
    public $mimeType;
	
	public function __construct($fileErrorCode, $fileMimeType) 	
	{ 
		$this->errorCode = $fileErrorCode;
		$this->mimeType = $fileMimeType;
	}	
}
?>