<?php 
    
    $uploadErrors = array(
    UPLOAD_ERR_OK         => 'There is no error, the file uploaded with success.',
    UPLOAD_ERR_INI_SIZE   => 'The uploaded file exceeds the upload_max_filesize directive in php.ini.',
    UPLOAD_ERR_FORM_SIZE  => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.',
    UPLOAD_ERR_PARTIAL    => 'The uploaded file was only partially uploaded.',
    UPLOAD_ERR_NO_FILE    => 'No file was uploaded.',
    UPLOAD_ERR_NO_TMP_DIR => 'Missing a temporary folder.',
    UPLOAD_ERR_CANT_WRITE => 'Failed to write file to disk.',
    UPLOAD_ERR_EXTENSION  => 'File upload stopped by extension.',
    UPLOAD_ERR_EMPTY      => 'The file that you uploaded is empty.',
    UPLOAD_ERR_NO_XML     => 'The file that you uploaded did not contain valid XML code.'
    );  
	
	$errorDescription = $uploadErrors[$error->errorCode];
?>
<html>
<head>
	<title>FilterMyXML - Error</title>
</head>
<body>
	<h1>Error</h1>
		<p>
			<?= $errorDescription ?>
<?php if($error->mimeType != '') {?> </br>The type of the uploaded file is <?= $error->mimeType ?>. <?php } ?>
        </p>
        <a href="index.php?task=choose_file">Click here to upload a new file.</a>
</body>
</html>