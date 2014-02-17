<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
$controllerObj=$controller;

$bfOne = null;
$bfTwo = null;
$bfThree = null;
$bfFour = null;

/*$psOne = null;
$psTwo = null;
$psThree = null;
$psFour = null;*/


if ($controller->getFileID(1) > 0) { 
	$bfOne = $controller->getFileObject(1);
}

if ($controller->getFileID(2) > 0) { 
	$bfTwo = $controller->getFileObject(2);
}

if ($controller->getFileID(3) > 0) { 
	$bfThree = $controller->getFileObject(3);
}

if ($controller->getFileID(4) > 0) { 
	$bfFour = $controller->getFileObject(4);
}


/*if ($controller->linkOne) { 
	$psOne = $controller->linkOne;
}
if ($controller->linkTwo) { 
	$psOne = $controller->linkTwo;
}
if ($controller->linkThree) { 
	$psOne = $controller->linkThree;
}
if ($controller->linkFour) { 
	$psOne = $controller->linkFour;
}*/

?>

<?php
include($this->getBlockPath().'/form_setup_html.php');
?> 