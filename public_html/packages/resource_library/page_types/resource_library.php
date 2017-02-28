<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

	<div>
	<?php 
	$a = new Area('Main');
	$a->display($c);
	?>
	</div>

<?php /* add page attribute 'action' to automatically run the search */
//var_dump($count) ?>
<?php if ($this->controller->getTask() != 'view' || $c->getAttribute('action')) { ?>

<div class="resources-filter">
	<div class="rss-link">
		<a href="<?php echo $rss_link ?>">Subscribe to Podcast RSS <img src="<?php echo $rss_link_image_src; ?>"/></a>
	</div>
	Filter By:
	<ul class="idTabs">
		<li><a href="#resources-authors">Speakers</a></li>
		<li><a href="#resources-series">Series</a></li>
		<li><a href="#resources-date">Date</a></li>
		<!-- <li><a href="#resources-scripture">Scripture</a></li> -->
		<li><a href="#resources-sundayschool">Sunday School</a></li>
	</ul>
	<!--<div id="resources-search">
		search
	</div>-->
	<div id="resources-authors" class="block">
		<ul>
		<?php
    	$authors = ResourceLibrary::getSpeakersFull();
    	$nothing = sort($authors);
    	$links='';
		foreach ($authors as $authorRecord) {
			//$nameURL = $this->controller->cleanURL($authorRecord['speaker_name']);
			$links .= '<li><a href="' . BASE_URL . DIR_REL . $this->getViewPath() . '/author/' . $authorRecord['url'] . '">' . $authorRecord['speaker_name'] . '</a></li>';
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
	
	<div id="resources-date" class="block">
		<ul>
		<?php
    	$years = array_reverse(ResourceLibrary::getYears(), true);
    	$links='';
		foreach ($years as $value) {
			$links .= '<li><a href="' . BASE_URL . DIR_REL . $this->getViewPath() . '/bydate/' . $value . '">' . $value . '</a></li>';
		}
		echo $links;
   		?>
   		</ul>
	</div>
	
	<div id="resources-sundayschool" class="block">
		<ul>
		<?php
    	$series = ResourceLibrary::getSundaySchool();
    	$links='';
		foreach ($series as $seriesRecord) {
			//$seriesURL = $this->controller->cleanURL($series_name);
			$links .= '<li><a href="' . BASE_URL . DIR_REL . $this->getViewPath() . '/series/' . $seriesRecord['url'] . '">' . $seriesRecord['series_name'] . '</a></li>';
		}
		echo $links;
		?>
		</ul>
	</div>
	<!-- 
	<div id="resources-scripture" class="block">
		<p>search by scripture coming soon</p>
	</div> -->
	
	<script type="text/javascript"> 
 		$(".resources-filter ul").idTabs("resources-<?php echo $whichTab; ?>"); 
	</script>
</div><!-- !END .resources-filter //-->
<?php 

//echo $this->getViewPath();

//echo '<div>Total found: ' . count($audioRecords) . '</div>';
Loader::model('resource_library', 'resource_library');
$db = Loader::db();

if ($this->controller->getTask() == 'view') $thisTask = 'recent';
else $thisTask = $this->controller->getTask();
if (!is_null($thisTask)) {
	if (strstr($thisTask,'author'))  $filterTitle = 'Speaker: ' . $audioRecords[0]['speaker_name']; 
	if (strstr($thisTask,'bydate'))  $filterTitle = 'Year: ' . date('Y', strtotime($audioRecords[0]['date'])); 
	if (strstr($thisTask,'series'))  $filterTitle = 'Series: ' . $audioRecords[0]['series_name']; 
	if (strstr($thisTask,'recent'))  $filterTitle = 'Recent Sermons from ' . date('Y',strtotime($audioRecords[0]['date']));
	echo '<h2 style="color:#222;">' . $filterTitle . '</h3>';
} else { echo '<h2 style="color:#222;">Most Recent:</h3>'; } //not working?
	
	
if (is_array($audioRecords)) { ?>
	<div class = "resource-library-block">
	<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<th class="resources-list-title">Title</th><th class="resources-list-author">Speaker</th><th class="resources-list-date">Date</th>
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
