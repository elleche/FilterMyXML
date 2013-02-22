<?php 

	session_start();
	$recordsCount = 0;
	$checkBoxesHTML = '<br>';
	
	//TODO check for errors SESSION or in parsing(go to Error page)?	
	$root = simplexml_load_string($_SESSION['rootRecordAsXML']);
	$recordsCount = $root->count();
	
	//if there are any Records in root, build the Fields checkboxes
	if( $recordsCount > 0 )
	{
		$allRecords = $root->children();
		$firstRecord = $allRecords[0];
		buildCheckBoxesHTML($firstRecord);
	}
	
	function buildCheckBoxesHTML($firstRecord)
	{
		global $checkBoxesHTML;
		if( $firstRecord->count() > 0 )
		{
			foreach($firstRecord->children() as $field)
			{
				$fieldName = $field->getName();
				$checkBoxesHTML .= 
				'<input type="checkbox" id="'.$fieldName.'CheckBox" value="'.$fieldName.'"> <label for="'.$fieldName.'CheckBox">'.$fieldName.'</label><br>';
			}
		}
	}	
?>