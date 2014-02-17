<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<?php  if(strlen($controller->title) ){ ?>
<div style="margin-bottom:8px">Name: <?php echo  $controller->title ?></div>
<?php  } ?>
<div>KML File: <?php echo ($controller->kml_fID)? $controller->getFileURL() : 'None' ?></div>