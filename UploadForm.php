<?php
	session_start();

    $userFile = $_FILES['userFile'];    
    define("UPLOAD_ERR_EMPTY", 5);
    define("UPLOAD_ERR_NO_XML", 9);

    checkUploadErrors();
    checkFileType();
    checkXMLvalid();
    
    //TODO set a custom limit for size?
    function checkUploadErrors()
    {
        global $userFile;
         
        if($userFile['size'] == 0 && $userFile['error'] == 0)
        {
            $userFile['error'] = UPLOAD_ERR_EMPTY;
        }
        
        if ($userFile['error'] > 0 || $userFile['size'] == 0)
        {        
            showError();
        }        
    }
    
    function checkFileType()
    {
        global $userFile;
        $userFileExtension = end(explode('.', $userFile['name']));
        $userFileExtension = strtolower($userFileExtension);
        
        $allowedMimeTypes = array('text/xml','application/xml','application/x-xml');
        
        $fileName = $userFile['tmp_name'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $userFileMime = finfo_file($finfo, $fileName);
        finfo_close($finfo);
               
        if($userFileExtension != 'xml' || !in_array($userFileMime, $allowedMimeTypes)) 
        {  
            $userFile['error'] = UPLOAD_ERR_NO_XML;
            $userFile['type'] = $userFileMime;
            showError();
        }
    }
 
    function checkXMLvalid()
    {
        global $userFile;
        $fileName = $userFile['tmp_name'];
        $root = simplexml_load_file($fileName);
        if ($root === false)
        {
            $userFile['error'] = UPLOAD_ERR_NO_XML;
            showError();
        }
        else
        {
			// either save file and go to the filter page, where at parsing time will look for XML errors
			// or parse here and save file
			//               and put XML in session data  <- ?
	
			$_SESSION['rootRecordAsXML'] = $root->asXML();
			
			header('Location: FilterPage.php');
            exit;
        }
    }    
    
    function showError()
    {        
        global $userFile;      
        
        $errorCode = $userFile['error'];
        $mimeType = $userFile['type'];
        $mimeParameter = (empty($mimeType)) ? "" : "&mime=$mimeType" ;
        header("Location: ErrorPage.php?err=$errorCode".$mimeParameter);
        exit;
    }
?> 