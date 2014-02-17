<?php
class ResourceLibraryPageTypeController extends Controller {
    
	public function on_start() {
		Loader::model('resource_library', 'resource_library');
		$this->addHeaderItem(Loader::helper('html')->javascript('resource_library.js', 'resource_library'));
		
		$years = ResourceLibrary::getYears();
		$this->set('years', $years);
		$this->set('audioPath', 'audio');
	}

	public function view() {
		global $c;
		$action = $c->getAttribute('action');
		
		if ( strstr($action,'date') || $action == null ) { 
			$this->bydate(date('Y')); //runs the search by year
			$this->set('action', $action);
		}
		
		/*switch ($action) {
			case 'date':
				$this->date(date('Y')); //runs the search by year
				break;
		}*/
    }
  
  /* Deprecated - keep for existing URLs */
  function date($year = NULL) {
    $audioRecords = $this->bydate($year);
		$this->set('whichTab','date');
  }
	
	/* Get all records based on year/date filter */
	function bydate($year = NULL) {
		
		//set the year
		if (!strlen($year)) {
		  $year = date('Y');
		}
		//find out if we have any records for current year
		if ( !in_array($year, ResourceLibrary::getYears()) ) {
  		$year = date('Y') - 1;
		}

		$audioRecords = ResourceLibrary::getSermons(NULL, NULL, $year); //getSermons(speaker_id, searies_id, year)
		$this->set('audioRecords', $audioRecords);
		$this->set('whichTab','date');
	}
	
	
	//get all records based on speaker filter
	function author($authorByURL = NULL) {
		Loader::model('resource_library', 'resource_library');
		
		$audioRecords = ResourceLibrary::getSermonsByURL($authorByURL, NULL, NULL); //getSermons(speaker_id, searies_id, year)
		if (count($audioRecords)) $this->set('audioRecords', $audioRecords);	
		$this->set('whichTab','authors');
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