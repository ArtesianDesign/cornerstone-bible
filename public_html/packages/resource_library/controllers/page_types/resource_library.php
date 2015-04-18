<?php
class ResourceLibraryPageTypeController extends Controller {
    
	public function on_start() {
		// error_reporting(E_ALL);
		// ini_set('display_errors', 1);
		Loader::model('resource_library', 'resource_library');
		$c = Page::getCurrentPage();
		$this->title = SITE . ' ' . $c->getCollectionName();
		$current_url = BASE_URL . Page::getCollectionPathFromID($c->cID);
		$rss_link = $current_url . '/rss';
		$rss_link_tag = '<link rel="alternate" type="application/rss+xml" title="' . $this->title 
			. '" href="' . $rss_link . '" />';
		$this->addHeaderItem($rss_link_tag);
		$this->addHeaderItem(Loader::helper('html')->javascript('resource_library.js', 'resource_library'));

		$package = Package::getByHandle('resource_library');
		$package_path = $package->getRelativePath();
		// $package_path = BASE_URL . $package->getPackagePath();
		$rss_link_image_src = $package_path . '/img/podcast-itunes2.png';

		$years = ResourceLibrary::getYears();
		$this->set('years', $years);
		$this->set('audioPath', 'audio');
		$this->set('rss_link', $rss_link);
		$this->set('rss_link_image_src', $rss_link_image_src);
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

	function getMp3Length($file) {
		$mp3file = new mp3file($file);
		$metadata = $mp3file->get_metadata();

		if (isset($metadata['Length']) AND is_numeric($metadata['Length'])) {
			return $metadata['Length'];
		} else {
			return "";
		}
	}

	function rss($limit = 12) {
		// error_reporting(E_ALL);
		// ini_set('display_errors', 1);

		// General properties. TODO: move these into a dashboard edit page or separate include
		$TITLE = $this->title; //'Cornerstone Fellowship Bible Church Sermons';
		$LINK = BASE_URL; //'http://cornerstonebible.org/';
		$RSS_LANGUAGE = 'en-us';
		$COPYRIGHT = '&#xA9; ' . date('Y') . ' Cornerstone Fellowship Bible Church';
		$DESCRIPTION = 'Sermons from Cornerstone Fellowship Bible Church in Riverside, CA. Speakers include Milton Vincent, Mike Berry, Karlos Limtiaco and other elders and guest speakers.';

		// iTunes properties
		$SUBTITLE = 'Sermons';
		$AUTHOR = 'Cornerstone Fellowship Bible Church';
		$SUMMARY = $DESCRIPTION;
		$OWNER_NAME = 'Cornerstone Fellowship Bible Church';
		$OWNER_EMAIL = 'info@cornerstonebible.org';
		$IMAGE = 'http://cornerstonebible.org/images/cornerstone-sunrise-m.jpg';
		$CATEGORY = 'Religion &amp; Spirituality';
		$SUBCATEGORY = 'Christianity';

		// Other settings
		$AUDIO_LOCAL_PATH = 'audio/';
		$AUDIO_URL_PREFIX = BASE_URL . '/' . $AUDIO_LOCAL_PATH;

		$item_html = '';
		$audioRecords = ResourceLibrary::getSermons(NULL, NULL, NULL, $limit); //getSermons(speaker_id, searies_id, year, limit)

		foreach ($audioRecords as $audioRecord) {
			if ($audioRecord['mp3file'] != '(no audio)') {
				$item_html .= "\t<item>\n";
				$item_html .= "\t\t<title>" . $audioRecord['title'] . "</title>\n";
				$item_html .= "\t\t<itunes:author>" . AUTHOR . "</itunes:author>\n";
				$item_html .= "\t\t<itunes:subtitle>" . $audioRecord['speaker_name'] . " | " . $audioRecord['reference'] . " | Series: " . $audioRecord['series_name'] . "</itunes:subtitle>\n";
				$item_html .= "\t\t<itunes:summary>" . $audioRecord['speaker_name'] . " | " . $audioRecord['reference'] . " | Series: " . $audioRecord['series_name'] . "</itunes:summary>\n";
				$item_html .= "\t\t<enclosure url=\"" . $AUDIO_URL_PREFIX . $audioRecord['mp3file'] . "\" length=\"" . filesize($AUDIO_LOCAL_PATH . $audioRecord['mp3file']) . "\" type=\"audio/mp3\" />\n";
				$item_html .= "\t\t<guid>" . $audioRecord['mp3file'] . "</guid>\n";
				$item_html .= "\t\t<pubDate>" . date("D, j M Y G:i:s T", strtotime($audioRecord['date'])) . "</pubDate>\n";
				$item_html .= "\t\t<itunes:duration>" . $this->getMp3Length($AUDIO_LOCAL_PATH . $audioRecord['mp3file']) . "</itunes:duration>\n";
				$item_html .= "\t</item>\n";
			}
    }
		$html = '<?xml version="1.0" encoding="UTF-8"?>';
		$html .= "\n";
		$html .= '<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">';
		$html .= "\n<channel>\n";
		$html .= "\t<title>" . $TITLE . "</title>\n";
		$html .= "\t<link>" . $LINK . "</link>\n";
		$html .= "\t<language>" . $RSS_LANGUAGE . "</language>\n";
		$html .= "\t<copyright>" . $COPYRIGHT . "</copyright>\n";
		$html .= "\t<itunes:subtitle>" . $SUBTITLE . "</itunes:subtitle>\n";
		$html .= "\t<itunes:author>" . $AUTHOR . "</itunes:author>\n";
		$html .= "\t<itunes:summary>" . $SUMMARY . "</itunes:summary>\n";
		$html .= "\t<description>" . $DESCRIPTION . "</description>\n";
		$html .= "\t<itunes:owner>\n";
		$html .= "\t\t<itunes:name>" . $OWNER_NAME . "</itunes:name>\n";
		$html .= "\t\t<itunes:email>" . $OWNER_EMAIL . "</itunes:email>\n";
		$html .= "\t</itunes:owner>\n";
		$html .= "\t<itunes:image href=\"" . $IMAGE . "\" />\n";
		$html .= "\t<itunes:category text=\"" . $CATEGORY . "\">\n";
		$html .= "\t\t<itunes:category text=\"" . $SUBCATEGORY . "\" />\n";
		$html .= "\t</itunes:category>\n";
		$html .= $item_html .= "\n";
		$html .= "</channel>\n";
		$html .= "</rss>";

		echo $html;
		exit;
	}
	
	
	/*** Misc ***/
	function cleanURL($url) {
		return strtolower(preg_replace("![^a-z0-9]+!i", "-", $url));
	}
    
    
}