<?php

class ResourcesController extends Controller {
	//Main Resources Page
	
	public function on_start() {
		Loader::model('resource_library', 'resource_library');
		$this->addHeaderItem(Loader::helper('html')->javascript('resource_library.js', 'resource_library'));
		
		$years = ResourceLibrary::getYears();
		$this->set('years',$years);
		$this->set('audioPath', 'audio');
	}

	public function view() {
		$this->year(date('Y'));
    }
    
	
	//get all records based on year/date filter
	function year($year = NULL) {
		
		if (!$year) { $year = date('Y'); }

		$audioRecords = ResourceLibrary::getSermons(NULL, NULL, $year); //getSermons(speaker_id, searies_id, year)
		if (count($audioRecords)) {
		  $this->set('audioRecords', $audioRecords);
		} else {
  		$year = intval($year) -1;
  		$audioRecords = ResourceLibrary::getSermons(NULL, NULL, $year); //getSermons(speaker_id, searies_id, year)
		  $this->set('audioRecords', $audioRecords);
		}
		$this->set('whichTab','year');
		$this->set('year' $year);
	}
	
	
	//get all records based on speaker filter
	function speaker($speakerByURL = NULL) {
		Loader::model('resource_library', 'resource_library');
		
		$audioRecords = ResourceLibrary::getSermonsByURL($speakerByURL, NULL, NULL); //getSermons(speaker_id, searies_id, year)
		if (count($audioRecords)) $this->set('audioRecords', $audioRecords);	
		$this->set('whichTab','speakers');
	}
	
	
	//get all records based on series title filter
	function series($seriesByURL = NULL) {
		Loader::model('resource_library', 'resource_library');
		/*
		$seriesList = ResourceLibrary::getSeries();
		$formattedList = array();
		foreach ($seriesList as $series_id => $series_name) {
			$seriesURL = $this->cleanURL($series_name);
			$formattedList[$series_id] = $seriesURL;
		}
		$seriesURL = $this->cleanURL($series);
		
		//change this to read default saved from dashboard config
		if (!$series) { $series = '1';
		} else { $series = current(array_keys($formattedList, $seriesURL)); } //match them up
		*/
		
		$audioRecords = ResourceLibrary::getSermonsByURL(NULL, $seriesByURL, NULL); //getSermons(speaker_id, searies_id, year)
		if (count($audioRecords)) $this->set('audioRecords', $audioRecords);	
		$this->set('whichTab','series');
	}
	
	
	/*** Misc ***/
	function cleanURL($url) {
		return strtolower(preg_replace("![^a-z0-9]+!i", "-", $url));
	}
	
}
//$_REQUEST['format']
?>
