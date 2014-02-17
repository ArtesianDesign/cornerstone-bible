<div class="content-block">
<?php 
	defined('C5_EXECUTE') or die(_("Access Denied."));
	$content = $controller->getContent();
	print $content;
?>
</div>