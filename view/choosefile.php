<html>
<head>
	<title>FilterMyXML - Choose File</title>
<!--
validation can be done with jquery too:
http://stackoverflow.com/questions/1854556/check-if-inputs-are-empty-using-jquery
$('#signupform').submit(function() {
    var errors = 0;
    $("#signupform :input").map(function(){
         if( !$(this).val() ) {
              $(this).parents('td').addClass('warning');
              errors++;
        } else if ($(this).val()) {
              $(this).parents('td').removeClass('warning');
        }   
    });
    if(errors > 0){
        $('#errorwarn').text("All fields are required");
        return false;
    }
    // do the ajax..    
});
-->
<script>
    function validateForm()
    {
        var selectedFile  = document.forms["uploadForm"]["userFile"].value;
        if (selectedFile == null || selectedFile == "")
        {
            alert("Select an XML file to upload.");
            return false;
        }
        return true;
    }
</script>    
</head>
<body>

<h1>Upload a XML file with addresses</h1>
Use the form below to choose an XML file from your hard disk and upload it to the server. 
The XML file contains a number of records with contact data of persons.

<form name="uploadForm" action="index.php?task=upload" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
    <label for="userFile">Select file: </label>
	<input type="file" name="userFile" id="userFile"/>
    <input type="submit" value="Upload" />
</form>

</body>
</html> 