<?php 

Loader::library('mp3file', 'resource_library');

class ResourceLibrary extends Model {
	
	// add database interactivity here

	function getSermonsByURL($speaker_url = NULL, $series_url = NULL, $year = NULL, $limit = NULL) {
		$db = Loader::db();

		$sql = "
			SELECT *
			FROM ResourceLibraryAudio sm
			JOIN ResourceLibraryAuthors sp ON sp.speaker_id = sm.speaker_id
			LEFT OUTER JOIN ResourceLibrarySeries se ON se.series_id = sm.series_id
			WHERE sermon_id != ''
		";

		if ( ! is_null($speaker_url)) {
			$sql .= "AND sp.url = ".$db->quote($speaker_url)."\n";
		}

		if ( ! is_null($series_url)) {
			$sql .= "AND se.url = ".$db->quote($series_url)."\n";
		}

		if ( ! is_null($year)) {
			if ( ! is_numeric($year) or $year < 1000 or $year > 9999) {
				FwError::fatal("Received invalid year '$year'");
			}

			$sql .= "AND sm.date >= '{$year}-01-01' AND sm.date <= '{$year}-12-31'\n";
		}

		$sql .= "ORDER BY sm.date DESC\n";

		if ( ! is_null($limit)) {
			$sql .= "LIMIT " . $limit . "\n";
		}

		return $db->getAll($sql);
	}
	// following is from old Cornerstone site by Brent Moen
	function getSermons($speaker_id = NULL, $series_id = NULL, $year = NULL, $limit = NULL) {
		$db = Loader::db();

		$sql = "
			SELECT *
			FROM ResourceLibraryAudio sm
			JOIN ResourceLibraryAuthors sp ON sp.speaker_id = sm.speaker_id
			LEFT OUTER JOIN ResourceLibrarySeries se ON se.series_id = sm.series_id
			WHERE sermon_id != ''
		";

		if ( ! is_null($speaker_id)) {
			$sql .= "AND sm.speaker_id = ".$db->quote($speaker_id)."\n";
		}

		if ( ! is_null($series_id)) {
			$sql .= "AND sm.series_id = ".$db->quote($series_id)."\n";
		}

		if ( ! is_null($year)) {
			if ( ! is_numeric($year) or $year < 1000 or $year > 9999) {
				FwError::fatal("Received invalid year '$year'");
			}

			$sql .= "AND sm.date >= '{$year}-01-01' AND sm.date <= '{$year}-12-31'\n";
		}

		$sql .= "ORDER BY sm.date DESC\n";

		if ( ! is_null($limit)) {
			$sql .= "LIMIT " . $limit . "\n";
		}

		$records = $db->getAll($sql);

		if (count($records)) {
  		return $records;
		} else {
		  return null;
		}
	}
	
	function getSpeakersFull() {
		$db = Loader::db();

		return $db->getAssoc("
			SELECT * 
			FROM ResourceLibraryAuthors sp
			ORDER BY order_num, speaker_name
		");
	}
	
	function getSeriesFull() {
		$db = Loader::db();

		return $db->getAssoc("
			SELECT * 
			FROM ResourceLibrarySeries
			ORDER BY series_name
		");
	}

	function getSpeakers() {
		$db = Loader::db();

		return $db->getAssoc("
			SELECT DISTINCT sp.speaker_id, sp.speaker_name 
			FROM ResourceLibraryAuthors sp
			ORDER BY order_num, speaker_name
		");
	}


	function getSeries() {
		$db = Loader::db();

		return $db->getAssoc("
			SELECT DISTINCT series_id, series_name
			FROM ResourceLibrarySeries
			ORDER BY series_name
		");
	}


	//Get listing (array) of MP3 files in the Audio directory
	function getMp3Files() {
		//$dir = FwConfig::getRequired("mp3_folder");
		//need to set the audio folder
		$dir = 'audio';
		$mp3 = array("" => "(no audio)");
		$files = scandir($dir);

		foreach ($files as $file) {
			if ($file == "." or $file == "..") {
				continue;
			}

			if (strtolower(substr($file, -4)) == ".mp3") {
				$mp3[] = $file;
			}
		}

		if (empty($mp3)) {
			return array();
		}

		return array_combine($mp3, $mp3);
	}

	function createSpeaker($speaker_name) {
		$db = Loader::db();
		$speakerURL = ResourceLibrary::cleanURL($speaker_name);
		$values = array (
			'speaker_name'	=> $speaker_name,
			'url' 			=> $speakerURL
		);
		$db->Execute("insert into ResourceLibraryAuthors (speaker_name, url) values (?, ?)", $values);
		return $db->Insert_ID();
	}

	function createSeries($series_name) {
		$db = Loader::db();
		$seriesURL = ResourceLibrary::cleanURL($series_name);
		$values = array (
			'speaker_name'	=> $series_name,
			'url' 			=> $seriesURL
		);
		$db->Execute("insert into ResourceLibrarySeries (series_name, url) values (?, ?)", $values);
		return $db->Insert_ID();
	}

	function create($date, $title, $reference, $speaker_id, $series_id, $mp3file) {
		$db = Loader::db();		
		return $db->execute("insert into ResourceLibraryAudio (speaker_id, series_id, date, is_evening, title, reference, mp3file) values (?, ?, ?, ?, ?, ?, ?)", array($speaker_id, $series_id, $date, '0', $title, $reference, $mp3file));
	}

	function delete($sermon_id) {
		$db = Loader::db();
		if ( ! is_numeric($sermon_id)) {
			FwError::fatal("Invalid sermon id '$sermon_id'");
		}
		return $db->Execute("delete from ResourceLibraryAudio where sermon_id = ".$db->quote($sermon_id));
	}

	function getData($sermon_id) {
		$db = Loader::db();

		return $db->getRow("
			SELECT *
			FROM ResourceLibraryAudio
			WHERE sermon_id = ".$db->quote($sermon_id)."
		");
	}

	function update($sermon_id, $date, $title, $reference, $speaker_id, $series_id, $mp3file) {
		$db = Loader::db();
		return $db->Execute('update ResourceLibraryAudio set speaker_id = ?,  series_id = ?,  date = ?,  is_evening = ?,  title = ?,  reference = ?,  mp3file = ? where sermon_id = ?', array($speaker_id, $series_id, $date, '0', $title, $reference, $mp3file, $sermon_id));

		/*return $db->update("ResourceLibraryAudio", "sermon_id = ".$db->quote($sermon_id), array(
			"date" => $db->SQLDate($date),
			"title" => $title,
			"reference" => $reference,
			"speaker_id" => $speaker_id,
			"series_id" => $series_id,
			"mp3file" => $mp3file
		));*/
	}

	function getYears() {
		$db = Loader::db();
		$years = array();

		$dates = $db->getCol("
			SELECT date
			FROM ResourceLibraryAudio
		");

		foreach ($dates as $date) {
			//$year = date("Y", $date);
			$year = date('Y', strtotime($date));

			if ( ! in_array($year, $years)) {
				$years[] = $year;
			}
		}

		sort($years);
		return $years;
	}

	function guessMP3($date, $is_evening) {
		static $files = NULL;
		$date = date("n-j-y", $date);

		if ($is_evening) {
			$date .= "_b";
		}

		$date .= ".mp3";

		if (is_null($files)) {
			//$mp3path = FwConfig::getRequired("mp3_folder");
			//need to set the audio folder
			$mp3path = 'audio';
			$files = scandir($mp3path);
		}

		foreach ($files as $file) {
			if (strtolower($file) == $date) {
				return $file;
			}
		}
	}

////////
	
	//convert dates to and from MySQL
	function dateconvert($date,$func) {
		if ($func == 1) { //insert conversion
			list($day, $month, $year) = split('[/.-]', $date);
			$date = "$year-$month-$day";
			return $date;
		}
		if ($func == 2) { //output conversion
			list($year, $month, $day) = split('[-.]', $date);
			$date = "$day/$month/$year";
			return $date;
		}
	}

//////////
	
	function format_date($original='', $format="%d.%m.%Y") 
	{ 
		return (!empty($original) ? strftime($format, strtotime($original)) : "" ); 
	}
	
	
	function sqlDate($time = NULL) {
		return ResourceLibrary::date("Y-m-d", $time);
	}

	function date($format, $time = NULL) {
		return date($format, ResourceLibrary::toUnixTimestamp($time));
	}

	function toUnixTimestamp($time = NULL) {
		if (is_null($time)) {
			return time();
		}

		// MMDDYY
		if (preg_match("/^(\d\d)(\d\d)(\d\d)$/", $time, $matches))   {
			$matches[3] += ($matches[3] > 70) ? 1900 : 2000;
			return mktime(0,0,0,$matches[1],$matches[2],$matches[3]);
		}

		// MMDDYYYY
		if (preg_match("/^(\d\d)(\d\d)(\d{4})$/", $time, $matches))  {
			return mktime(0,0,0,$matches[1],$matches[2],$matches[3]);
		}

		if (is_numeric($time)) {
			return $time;
		}

		if (empty($time)) {
			return 0;
		}

		// MM-DD-YYYY or MM/DD/YYYY
		if (preg_match("/^\s*(\d{1,2})[\-\/](\d{1,2})[\-\/](\d{4})\s*$/", $time, $matches)) {
			return mktime(0,0,0, $matches[1], $matches[2], $matches[3]);
		}

		// MM-DD-YY or MM/DD/YY
		if (preg_match("/^\s*(\d{1,2})[\-\/](\d{1,2})[\-\/](\d\d)\s*$/", $time, $matches)) {
			$matches[3] += ($matches[3] > 70) ? 1900 : 2000;
			return mktime(0,0,0, $matches[1], $matches[2], $matches[3]);
		}

		$time = strtotime($time);

		if ($time === -1 or $time === FALSE) {
			return FALSE;
		}

		return $time;
	}
	
	public function cleanURL($url) {
		return strtolower(preg_replace("![^a-z0-9]+!i", "-", $url));
	}
 
	/*END*/


} /* END class ResourceLibrary */
?>