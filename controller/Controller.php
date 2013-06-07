<?php 
require_once('model/UploadModel.php');
require_once('model/FilterModel.php');
      
class Controller 
{  
 //       public $model;
   
      
	public function __construct()    
	{    
//          $this->model = new Model();
		
	}   
          
	public function invoke()  
	{  
		if (isset($_GET['task'])) $task = $_GET['task'];
		else $task = '';
		
		switch($task)
		{			
			case 'upload':
				if (isset($_FILES['userFile']))
				{
					$userFile = $_FILES['userFile'];
					$model = new UploadModel($userFile);				
					$file = $model->getFile();				
					if ($file->hasError())
					{
						$errorCode = $file->getErrorCode();
						$fileMimeType = $file->getFileMimeType();
						include 'view/viewerror.php';
					}
					else
					{				
						include 'view/showfile.php';
					}
					break;
				}
				
			case 'choose_file':
			default:
				include 'view/choosefile.php'; 
			break;
				
			case 'filter':
				if (isset($_GET['format']) && $_GET['format']=='json') 
				{
					if(isset($_POST['field']) && isset($_POST['isUnique']))
					{	
						$model = new FilterModel($_POST['field'], filter_var($_POST['isUnique'], FILTER_VALIDATE_BOOLEAN));	
						$result = $model->reCount();
						echo json_encode($result);
						exit;
					}
					else echo json_encode('problem na POST');
					exit;
				}
				else echo json_encode('problem na GET');
				exit;
			break;
			
			case 'download':
				include 'view/downloadfile.php';
				exit;
			break;
		}
	}  
}  
?>