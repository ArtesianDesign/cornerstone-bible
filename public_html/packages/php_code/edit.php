<?php 
/*	
	PHPCode block for concrete5
	version: 1.0
	website: http://www.struckandspink.com.au
	contact: dang@struckandspink.com.au
*/
?><?php 
$th = $c->getCollectionThemeObject();
$replaceOnUnload = 1;
include("editor_init.php");
?>

<div style="text-align: center"><textarea id="ccm-content-<?php echo $a->getAreaID()?>" name="content" style="width:620px; height:460px" tabindex="3"><?php $content = str_replace("\'","'",$content); $content = str_replace('\"','"',$content); echo $content?></textarea></div>