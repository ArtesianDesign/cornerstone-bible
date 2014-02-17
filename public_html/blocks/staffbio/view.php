<? defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<div class="staff-person-container">
<?php
$ih = Loader::helper('image');
$resizedImage = $ih->getThumbnail($controller->getFileObject(), 140, 250)->src;
$extraRole = null;
if ($controller->elder == true) $extraRole = ' | elder';
if ($controller->staff == true && $extraRole) {
	$extraRole .= ' | staff';
} else if ($controller->staff) {
	$extraRole = ' | staff';
}

//echo "<div class=\"staff-photo\"><img src=\"" . $controller->getFileObject()->getURL() . "\" alt=\"\"></div>";
echo "<div class=\"staff-photo\"><img src=\"" . $resizedImage . "\" alt=\"\"></div>";
echo "<div class=\"staff-description\"><h2 class=\"staff-name\">" . $controller->name . "</h2>";
echo "<h4 class=\"staff-title\">" . $controller->title; 
if ($extraRole) echo '<span class="staff-indicator">' . $extraRole . '</span>';
echo "</h4><p>" . nl2br($controller->description) . "</p>";
echo "</div>";
?>
<div style="clear:both"></div>
</div>