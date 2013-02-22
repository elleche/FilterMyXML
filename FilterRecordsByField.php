<?php

	session_start();
	
	$result = array();	
	updateFieldState();
	reCount();	
	echo json_encode($result);	
	exit;
	
	function updateFieldState()
	{
		$field = $_POST['field'];
		$isUnique = filter_var($_POST['isUnique'], FILTER_VALIDATE_BOOLEAN);		
		$_SESSION['fieldsState'][$field] = $isUnique;
	}
	
	function reCount()
	{
		global $result;
		
		$fieldsState = $_SESSION['fieldsState'];
		$noFieldSelected = (array_sum($fieldsState) == 0);
		if($noFieldSelected) 
		{
			$result['doubles'] = 0;
			$result['uniques'] = 'all';
			return;
		}
		
		//TODO check for errors SESSION ?
		$uniqueRecords = array();
		$root = simplexml_load_string($_SESSION['rootRecordAsXML']);
		$allRecordsCount = $root->count();
		if( $allRecordsCount > 0 )
		{
			$allRecords = $root->children();
			foreach($allRecords as $record)
			{
				$recordToString = '';
				//get a string for current record imprint(according to fieldsState) and put it into an array as key
				foreach($record->children() as $field)
				{
					$fieldName = $field->getName();
					$fieldValue = (string)$field;
					$recordToString .= ($fieldsState[$fieldName]) ? $fieldValue : '';
				}				
				$uniqueRecords[$recordToString] = $record;				
			}
		}		
	
		$uniquesCount = count($uniqueRecords);
		$result['uniques'] = $uniquesCount;
		$result['doubles'] = $allRecordsCount - $result['uniques'];		
		$result['all'] = $allRecordsCount;		
		
		$uniqueRecords = array_values($uniqueRecords);
		$dom = new DOMDocument('1.0');
		$element = $dom->appendChild(new DOMElement($root->getName()));
		foreach ($uniqueRecords as $uniqueR)
		{
			$unique = dom_import_simplexml($uniqueR);
			if (!$unique ) {
			echo 'Error while converting XML';
			exit;
			}
			$unique = $dom->importNode($unique , true);
			$unique = $element->appendChild($unique );
		}

		$_SESSION['xmlUniques'] = $dom->saveXML();
	}
?>