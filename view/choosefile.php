<html>
<head>
	<title>FilterMyXML - Choose File</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script>
		jQuery(document).ready(function() {
			jQuery('#uploadForm').submit(function() {
				var selectedFile = jQuery('#userFile').val();
				if (selectedFile == null || selectedFile == "")
				{
					alert("Please, choose an XML file for upload.");
					return false;
				}
				else return true;
			});
		});
	</script>    
</head>
<body>
<h1>Upload a XML file with addresses</h1>
Use the form below to choose an XML file from your hard disk and upload it to the server. 
The XML file contains a number of records with contact data of persons.

<form name="uploadForm" id="uploadForm" action="index.php?task=upload" method="POST" enctype="multipart/form-data">
    <label for="userFile">Select file: </label>
	<input type="file" name="userFile" id="userFile"/>
    <input type="submit" value="Upload" />
</form>

</body>
</html> 