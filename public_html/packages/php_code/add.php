<?php 
/*	
	PHPCode block for concrete5
	version: 1.0
	website: http://www.struckandspink.com.au
	contact: dang@struckandspink.com.au
*/
?>
<?php
$th = $c->getCollectionThemeObject();
$replaceOnUnload = 1;
include("editor_init.php");
?>

<div style="text-align: center"><textarea id="ccm-content-<?php echo $a->getAreaID()?>" name="content" rows="30" cols="80" tabindex="3"></textarea></div>