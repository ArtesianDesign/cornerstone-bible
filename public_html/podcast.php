<?php

require('config/site.php');
require('podcast_lib.php');

// General properties
define('TITLE', 'Cornerstone Fellowship Bible Church Sermons');
define('LINK', 'http://dev.brentmoen.com/');
define('LANGUAGE', 'en-us');
define('COPYRIGHT', '&#xA9; ' . date('Y') . ' Cornerstone Fellowship Bible Church');
define('DESCRIPTION', 'Sermons from Cornerstone Fellowship Bible Church in Riverside, CA.');

// iTunes properties
define('SUBTITLE', 'Sermons');
define('AUTHOR', 'Cornerstone Fellowship Bible Church');
define('SUMMARY', DESCRIPTION);
define('OWNER_NAME', 'Brent Moen');
define('OWNER_EMAIL', 'brent.moen@gmail.com');
define('IMAGE', 'http://dev.brentmoen.com/themes/cfbc_2010/images/Cornerstone-LogoX2.png');
define('CATEGORY', 'Religion &amp; Spirituality');
define('SUBCATEGORY', 'Christianity');

// Other settings
define('NUM_SERMONS', 10);
define('AUDIO_URL_PREFIX', 'http://www.cornerstonebible.org/audio/');
define('AUDIO_LOCAL_PATH', 'audio/');



function getMp3Length($file) {
	$mp3file = new mp3file($file);
	$metadata = $mp3file->get_metadata();

	if (isset($metadata['Length']) AND is_numeric($metadata['Length'])) {
		return $metadata['Length'];
	} else {
		return "";
	}
}

function printPodcastXmlRecords($numSermons) {
    $db = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    
    $statement = $db->prepare('
        SELECT ad.title, at.speaker_name, ad.reference, ad.mp3file, ad.length, ad.date, s.series_name
        FROM ResourceLibraryAudio ad
        JOIN ResourceLibraryAuthors at USING (speaker_id)
        JOIN ResourceLibrarySeries s USING (series_id)
        ORDER BY ad.date DESC
        LIMIT :numSermons
    ');
    
    $statement->bindParam(':numSermons', $numSermons, PDO::PARAM_INT);
    $statement->execute();
    
    while (FALSE !== ($row = $statement->fetch(PDO::FETCH_ASSOC))) {
    	if ($row['mp3file'] != '(no audio)') {
			echo "\t<item>\n";
			echo "\t\t<title>" . $row['title'] . "</title>\n";
			echo "\t\t<itunes:author>" . AUTHOR . "</itunes:author>\n";
			echo "\t\t<itunes:subtitle>" . $row['speaker_name'] . " | " . $row['reference'] . " | Series: " . $row['series_name'] . "</itunes:subtitle>\n";
			echo "\t\t<itunes:summary>" . $row['speaker_name'] . " | " . $row['reference'] . " | Series: " . $row['series_name'] . "</itunes:summary>\n";
			echo "\t\t<enclosure url=\"" . AUDIO_URL_PREFIX . $row['mp3file'] . "\" length=\"" . filesize(AUDIO_LOCAL_PATH . $row['mp3file']) . "\" type=\"audio/mp3\" />\n";
			echo "\t\t<guid>" . $row['mp3file'] . "</guid>\n";
			echo "\t\t<pubDate>" . date("D, j M Y G:i:s T", strtotime($row['date'])) . "</pubDate>\n";
			echo "\t\t<itunes:duration>" . getMp3Length(AUDIO_LOCAL_PATH . $row['mp3file']) . "</itunes:duration>\n";
			echo "\t</item>\n";
		}
    }
}

echo '<?xml version="1.0" encoding="UTF-8"?>';

?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
<channel>
	<title><?php echo TITLE; ?></title>
	<link><?php echo LINK; ?></link>
	<language><?php echo LANGUAGE; ?></language>
	<copyright><?php echo COPYRIGHT; ?></copyright>
	<itunes:subtitle><?php echo SUBTITLE; ?></itunes:subtitle>
	<itunes:author><?php echo AUTHOR; ?></itunes:author>
	<itunes:summary><?php echo SUMMARY; ?></itunes:summary>
	<description><?php echo DESCRIPTION; ?></description>
	<itunes:owner>
		<itunes:name><?php echo OWNER_NAME; ?></itunes:name>
		<itunes:email><?php echo OWNER_EMAIL; ?></itunes:email>
	</itunes:owner>
	<itunes:image href="<?php echo IMAGE; ?>" />
	<itunes:category text="<?php echo CATEGORY; ?>">
		<itunes:category text="<?php echo SUBCATEGORY; ?>"/>
	</itunes:category>
<?php printPodcastXmlRecords(NUM_SERMONS); ?>
</channel>
</rss>
