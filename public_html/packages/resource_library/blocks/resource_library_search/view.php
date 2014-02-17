<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<?php 
global $c;
?>

<h2><?php echo $title; ?></h2><br/>

<?php
echo '<div>Total Records: ' . count($audioRecords) . '</div>';
Loader::model('resource_library', 'resource_library');
$db = Loader::db();

if (is_array($audioRecords)) { ?>
<div class = "resource-library-block">
<table cellpadding="0" cellspacing="0" border="0">
<tr>
	<th>Title</th><th>Speaker</th><th>Date</th>
</tr>
<?php
	foreach ($audioRecords as $audioRecord) {
		if ( ! empty($audioRecord["mp3file"]) and substr(strtolower($audioRecord["mp3file"]), -4) == ".mp3") {
			$mp3 = "<a href=\"{$mp3path}/".$audioRecord["mp3file"]."\">download</a>";
		}
	
		else {
			$mp3file = ResourceLibrary::guessMP3($audioRecord["date"], $audioRecord["is_evening"]);
	
			if ( ! empty($mp3file)) {
				$mp3 = "<a href=\"{$mp3path}/".$mp3file."\">download</a>";
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
			. '<td>' . date('F j, Y', strtotime($audioRecord["date"])) . ' <small>' . date('D', strtotime($audioRecord["date"])) . '.</small></td>'
			. "</tr>\n"
			. '<tr class="last-row">'
			. '<td><span class="seriestitle">series:</span> ' . $audioRecord["series_name"] . '</td>'
			. '<td><a href="http://www.gnpcb.org/esv/search/?q=' . $audioRecord["reference"] . '" target="_blank" class="nowrap">' . $audioRecord["reference"] . '</a></td>'
			. '<td><span class="nowrap">' . $mp3 . '</span></td>'
			. "</tr>\n";
		echo $recordHTML;
	}/*end foreach */ ?>
</table>
</div><!-- !END .resource-library-block //-->
<?php
}/*end if */

/*
//if the form posts data for "search_speaker" key, do the following:
if ($this->controller->getTask() == 'search_speaker') { 
	echo 'getTask';
}*/
?>