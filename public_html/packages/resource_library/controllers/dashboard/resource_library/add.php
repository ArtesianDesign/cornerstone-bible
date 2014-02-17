<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class DashboardResourceLibraryAddController extends Controller {
	// dashboard page for managing the Resource Library package
	
    /*public function on_start() {} 
    
    public function save() {
    	...
    }*/
    
    public function view() {
       //Loader::model('resource_library','resource_library');
		/*
		$html = Loader::helper('html');
		$this->addHeaderItem($html->javascript('jquery.uploadify.v2.1.0.min.js','resource_library'));
		$this->addHeaderItem($html->javascript('swfobject.js'));
		$this->addHeaderItem($html->css('uploadify.css', 'resource_library'));
		*/
    }
	
    
    public function upload() {
    	if ($this->isPost()) {
    		$args = $this->post();
    		
    		if (!empty($_FILES)) {
				$tempFile = $_FILES['Filedata']['tmp_name'];
				$targetPath = $_SERVER['DOCUMENT_ROOT'] . DIR_REL . '/audio/';
				$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
				//mkdir(str_replace('//','/',$targetPath), 0755, true);
				move_uploaded_file($tempFile,$targetFile);
			}
    		
    	}
        
        //$this->set('message', t('Audio resource has been added.'));
        $this->set('message', t('Error - audio upload is not yet funtioning.'));
    }
    
    
    
    //Add audio record to database
    public function add_audio() {
    	Loader::model('resource_library','resource_library');
    	
    	if ($this->isPost()) {
    		$data = $this->post();
			$get = array();
			$extraMessage = '';
			
			
			if ( !is_null($data["speaker_add"]) && strlen($data["speaker_add"]) ) {
				$data["speaker_id"] = ResourceLibrary::createSpeaker($data["speaker_add"]);
				//$recordSetObject = ResourceLibrary::createSpeaker($data["speaker_add"]);
				//print_r($recordSetObject);
				//$extraMessage .= '  speaker_add:' . $data["speaker_add"];
				//$extraMessage .= '  returned ID:' . $data["speaker_id"];
				
			}
	
			if ( !is_null($data["series_add"]) && strlen($data["series_add"]) ) {
				$data["series_id"] = ResourceLibrary::createSeries($data["series_add"]);
				//$extraMessage .= '  series_add:' . $data["series_add"];
				//$extraMessage .= '  returned ID:' . $data["series_id"];
			}
	
			/*
			if ($data->fields["mp3file_upload"]) {
				$data["mp3file_existing"] = "";
	
				$file = $data->fields["mp3file_upload"]->save();
	
				if ($file !== FALSE) {
					$data["mp3file_existing"] = basename($file);
					$get["m_mp3"] = $data["mp3file_existing"];
				}
			}*/
			
			$timestamp = mktime(0,0,0, $data["date_month"], $data["date_day"], $data["date_year"]);
			$data["date"] = ResourceLibrary::sqlDate($timestamp);
		
			ResourceLibrary::create($data["date"], $data["title"], $data["reference"], $data["speaker_id"], $data["series_id"], $data["mp3file_existing"]);
			
	    }//END if isPost
        
        //$this->set('message', t('Audio resource has been added.'));
        $message = t('Audio Resource has been added.') . ' <br/>' . $extraMessage;
        $this->set('message', $message);
    }//END function add_audio()
    
    
	
}
?>