<html>
<head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js">
	</script>
	<style>
		.bold
		{
			font-weight: bold;
		}
	</style>
</head>
<body>
<?php include 'LoadFirstRecordAndCount.php'; ?>

<h1>Filter Page</h1>
The file that you uploaded contains <span id="total" class="bold"><?php echo $recordsCount; ?></span> records. You can now remove all doubles from this file. 
Use the checkboxes to specify the field or the combination of fields that should be unique.
<?php echo $checkBoxesHTML; ?>
Based on the checkboxes that you have selected, <span id="doubles" class="bold">0</span> doubles were removed and the file now contains <span id="uniques" class="bold">all</span> unique records. 

<form action="FileDownload.php" method="get">
<input type="submit" id="fileDownload" value="Download filtered file">
</form>


<script>
//TODO have all the result text on a div, which is shown only if something is selected.
//TODO have the download button hidden at first too.
	$('input[type=checkbox]').click(
		function() 
		{
			var isChecked = $(this).is(':checked');
			var value = $(this).val();
			$.post("FilterRecordsByField.php", { field: value, isUnique: isChecked }, function(data)
				{
					$('#doubles').text(data.doubles);
					$('#uniques').text(data.uniques);
	//			alert('aaa unchecked!' + data.doubles + ' ' + data.uniques + ' ' + data.all);
				}, "json");
		});
</script>


</body>
</html> 