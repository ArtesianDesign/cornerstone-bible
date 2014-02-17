<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$controllerObj=$controller;

$bfOne = null;

if ($controller->getFileID() > 0) $bfOne = $controller->getFileObject();

?>

<?php
include($this->getBlockPath().'/form_setup_html.php');
?> 