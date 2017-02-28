<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
/* 
 * Copy this file into your current theme's directory to customize it according to your theme.
 */
Loader::model('resource_library', 'resource_library');
?>

<?php /* add page attribute 'action' to automatically run the search */ ?>
<?php if ($this->controller->getTask() != 'view' || $c->getAttribute('action')) { ?>

<div class="resources-filter">
	Filter By: 
	<ul class="idTabs">
		<li><a href="#resources-speakers">Speakers</a></li>
		<li><a href="#resources-series">Series</a></li>
		<li><a href="#resources-year">Date</a></li>
		<!-- <li><a href="#resources-scripture">Scripture</a></li> -->
		<li><a href="#resources-sundayschool">Sunday School</a></li>
	</ul>
	<!--<div id="resources-search">
		search
	</div>-->
	<div id="resources-speakers" class="block">
		<ul>
		<?php
    	$speakers = ResourceLibrary::getSpeakersFull();
    	$nothing = sort($speakers);
    	$links='';
		foreach ($speakers as $speakerRecord) {
			//$nameURL = $this->controller->cleanURL($speakerRecord['speaker_name']);
			$links .= '<li><a href="' . BASE_URL . DIR_REL . $this->getViewPath() . '/speaker/' . $speakerRecord['url'] . '">' . $speakerRecord['speaker_name'] . '</a></li>';
		}
		echo $links;
   		?>
   		</ul>
	</div>
	
	<div id="resources-series" class="block">
		<ul>
		<?php
    	$series = ResourceLibrary::getSeriesFull();
    	$links='';
		foreach ($series as $seriesRecord) {
			//$seriesURL = $this->controller->cleanURL($series_name);
			$links .= '<li><a href="' . BASE_URL . DIR_REL . $this->getViewPath() . '/series/' . $seriesRecord['url'] . '">' . $seriesRecord['series_name'] . '</a></li>';
		}
		echo $links;
		?>
		</ul>
	</div>
	
	<div id="resources-year" class="block">
		<ul>
		<?php
    	$years = array_reverse(ResourceLibrary::getYears(), true);
    	$links='';
		foreach ($years as $value) {
			$links .= '<li><a href="' . BASE_URL . DIR_REL . $this->getViewPath() . '/year/' . $value . '">' . $value . '</a></li>';
		}
		echo $links;
   		?>
   		</ul>
	</div>
	
	<div id="resources-scripture" class="block">
		<p>search by scripture coming soon</p>
	</div>
	
	<div id="resources-sundayschool" class="block">
		<ul>
		<?php
    	$series = ResourceLibrary::getSeriesWildcard('Sunday Schoo%');
    	$links='';
		foreach ($series as $seriesRecord) {
			$links .= '<li><a href="' . BASE_URL . DIR_REL . $this->getViewPath() . '/series/' . $seriesRecord['url'] . '">' . $seriesRecord['series_name'] . '</a></li>';
		}
		echo $links;
		?>
		</ul>
	</div>
	
	<script type="text/javascript"> 
 		$(".resources-filter ul").idTabs("resources-<?php echo $whichTab; ?>"); 
	</script>
</div><!-- !END .resources-filter //-->
<?php 

//echo $this->getViewPath();

//echo '<div>Total found: ' . count($audioRecords) . '</div>';
Loader::model('resource_library', 'resource_library');
$db = Loader::db();

$thisTask = $this->controller->getTask();
if (!is_null($thisTask)) {
	if (strstr($thisTask,'speaker'))  $filterTitle = 'Speaker: ' . $audioRecords[0]['speaker_name']; 
	if (strstr($thisTask,'year'))  $filterTitle = 'Year: ' . date('Y',strtotime($audioRecords[0]['date'])); 
	if (strstr($thisTask,'series'))  $filterTitle = 'Series: ' . $audioRecords[0]['series_name']; 
	echo '<h2 style="color:#222;">' . $filterTitle . '</h3>';
} else { echo '<h2 style="color:#222;">Most Recent:</h3>'; } //not working?
	
if (is_array($audioRecords)) { ?>
	<div class = "resource-library-block">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<th class="resources-list-title">Title</th><th class="resources-list-speaker">Speaker</th><th class="resources-list-date">Date</th>
	</tr>
	<?php
		foreach ($audioRecords as $audioRecord) {
			if (!empty($audioRecord["mp3file"]) and substr(strtolower($audioRecord["mp3file"]), -4) == ".mp3") {
				$mp3 = '<a href="' . BASE_URL . DIR_REL . '/' . $audioPath . '/' . $audioRecord["mp3file"] . '">download</a>';
			} else {
				$mp3file = ResourceLibrary::guessMP3($audioRecord["date"], $audioRecord["is_evening"]);		
				if ( ! empty($mp3file)) {
					$mp3 = '<a href="' . BASE_URL . DIR_REL . $audioPath . '/' . $mp3file . '">download</a>';
				} else {
					//$sermon_request_email = FwConfig::get("sermon_request_email");
					if ( ! empty($sermon_request_email)) {
						$mp3 = "<a href=\"mailto:{$sermon_request_email}\">request a CD</a>";
					} else {
						$mp3 = "";
					}
				}
			}
			
			$recordHTML = ""
				. '<tr class="first-row">'
				. '<td><h3 class="record-title">' . $audioRecord["title"] . '</h3></td>'
				. '<td><span style="white-space:nowrap;">' . $audioRecord["speaker_name"]. '</span></td>'
				. '<td class="resources-list-date">' . date('F j, Y', strtotime($audioRecord["date"])) . ' <small>' /*. date('D', strtotime($audioRecord["date"])) . '.</small></td>'*/
				. "</tr>\n"
				. '<tr class="last-row">'
				. '<td><span class="seriestitle">series:</span> ' . $audioRecord["series_name"] . '</td>'
				. '<td><a href="http://www.gnpcb.org/esv/search/?q=' . $audioRecord["reference"] . '" target="_blank" class="nowrap">' . $audioRecord["reference"] . '</a></td>'
				. '<td class="resources-list-date"><span class="nowrap">' . $mp3 . '</span></td>'
				. "</tr>\n";
			echo $recordHTML;
		}/*end foreach */
		?>
	</table>
	</div><!-- !END .resource-library-block //-->
	<?php
} else { /*end if */
	echo '<p><strong>No records found</strong></p>';
}

}//end if $controller->getTask()

/*
//if the form posts data for "search_speaker" key, do the following:
if ($this->controller->getTask() == 'search_speaker') { 
	echo 'getTask';
}*/
