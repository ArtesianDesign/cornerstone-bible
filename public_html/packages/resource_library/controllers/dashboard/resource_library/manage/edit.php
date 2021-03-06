<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class DashboardResourceLibraryManageEditController extends Controller {
	// dashboard page for managing the Resource Library package

    /*public function on_start() {} 
    */
    
    public function view() {
    	$this->set('resourceID', -1);
    }
    
    
    public function edit_item($resourceID) {
    	$this->set('resourceID', $resourceID);
    }
    
	/* Moved this to "Manage" Controller (/dashboard/resource_library/manage/controller.php)
	//Update audio record
    public function update_item($resourceID) {
    	$this->set('resourceID', $resourceID);
    	Loader::model('resource_library','resource_library');
    	
    	if ($this->isPost()) {
    		$data = $this->post();
    		$this->set('data', $data);
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
			
			$timestamp = mktime(0,0,0, $data["date_month"], $data["date_day"], $data["date_year"]);
			$data["date"] = ResourceLibrary::sqlDate($timestamp);
		
			ResourceLibrary::update($data["sermon_id"], $data["date"], $data["title"], $data["reference"], $data["speaker_id"], $data["series_id"], $data["mp3file_existing"]);
			
	    }//END if isPost
        
        $message = t('Audio Resource has been updated.') . ' <br/>' . $extraMessage;
        $this->set('message', $message);
    }//END function update_audio()
	*/
}
?>