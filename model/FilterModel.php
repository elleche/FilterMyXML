<?php 
require_once('model/File.php');		

class FilterModel 
{
	private $field;
	private $isUnique;
	private $uniqueRecords;
	private $recordsCount;
	private $allFieldsStatus;
	private $root;
	private $result;
	
	function __construct($selectedField, $isFieldUnique)
	{  					
		$this->field = $selectedField;
		$this->isUnique = $isFieldUnique;
			
		$this->result = array('doubles'=>0, 'uniques'=>0);	
		$this->uniqueRecords = array();				
		$this->allFieldsStatus = array();
		
		$this->recordsCount = 0;
		if (isset($_SESSION['recordsCount'])) $this->recordsCount = $_SESSION['recordsCount'];
		
		//read
		if (isset($_SESSION['fieldsState'])) $this->allFieldsStatus = $_SESSION['fieldsState'];	
		//update
		$this->allFieldsStatus[$this->field] = ($this->isUnique) ? 1 : 0;
		//save
		$_SESSION['fieldsState'] = $this->allFieldsStatus;
		
	}
	
	public function reCount()
	{
		$noFieldSelected = (array_sum($this->allFieldsStatus) == 0);
		if($noFieldSelected) 
		{
			$this->result['doubles'] = 0;
			$this->result['uniques'] = 'all';
			return $this->result;
		}
		
		//TODO check for errors SESSION ?
		$this->root = simplexml_load_string($_SESSION['rootRecordAsXML']);
//		$allRecordsCount = $this->root->count();
		$allRecordsCount = $this->recordsCount;
		if( $allRecordsCount > 0 )
		{
			$allRecords = $this->root->children();
			foreach($allRecords as $record)
			{
				$recordToString = '';
				//get a string for current record imprint(according to fieldsStatus) and put it into an array as key
				foreach($record->children() as $field)
				{
					$fieldName = $field->getName();
					$fieldValue = (string)$field;
					if(!isset($this->allFieldsStatus[$fieldName])) $this->allFieldsStatus[$fieldName] = 0;
					$recordToString .= ($this->allFieldsStatus[$fieldName]) ? $fieldValue : '';
				}
				//for doubles, this approach will always take the last(latest, the one at the bottom) record from the file
				$this->uniqueRecords[$recordToString] = $record;				
			}
		}		
	
		$uniquesCount = count($this->uniqueRecords);
		$this->result['uniques'] = $uniquesCount;
		$this->result['doubles'] = $allRecordsCount - $this->result['uniques'];
		
		//save the unique records as XML as well (in SESSION for now)
		$this->uniqueRecordsToXML();
		
		return $this->result;
	}	
	
	private function uniqueRecordsToXML()
	{
		$this->uniqueRecords = array_values($this->uniqueRecords);
		
		$dom = new DOMDocument('1.0');
		$element = $dom->appendChild(new DOMElement($this->root->getName()));
		foreach ($this->uniqueRecords as $uniqueR)
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
}