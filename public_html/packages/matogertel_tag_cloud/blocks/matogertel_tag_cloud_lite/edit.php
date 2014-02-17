<?php   
defined('C5_EXECUTE') or die(_("Access Denied."));
$replaceOnUnload = 1;
$validAttributes = $controller->getCollectionSelectAttributes();
$form = Loader::helper('form');
$orders = $controller->getPossibleOrders();
foreach ($validAttributes as $ak) {

}
if (!is_array($akIDs)) $akIDs = explode(",",$akIDs);
if ($maxTags==0) $maxTags = "";
?>
<style type="text/css">
	div.ccm-pane-controls label.matogertel_tag_cloud_label { font-weight: normal !important; display: inline !important}
	.matogertel_tag_cloud_note { color: #838383 !important; display: block; margin-bottom: 2px; }
	#maxTags { width: 20px !important }
</style>
<h3><?php  echo t("Attributes this tag cloud will be created from:") ?></h3>
<?php  
if (count($validAttributes)>0) {
	$i=0;
	foreach ($validAttributes as $ak) {
		?>
		<input type="checkbox" id="akIDs_<?php  echo $i ?>" name="akIDs[]" value="<?php  echo $ak->getAttributeKeyID() ?>" <?php  if (in_array($ak->getAttributeKeyID(),$akIDs)) { echo 'checked="checked"'; } ?> >
		<label class="matogertel_tag_cloud_label" for="<?php  echo "akIDs_{$i}" ?>"><?php  echo $ak->getAttributeKeyName(); ?></label><br/><?php 
		$i++;
	}
}
else {
	echo t("No select attributes found. The tag cloud uses any select attributes in a page to build the cloud.");
}
?>
<h3><?php  echo t("Maximum tags:"); ?></h3>
<?php  echo $form->text('maxTags',$maxTags,array('size'=>5)); ?><br/>
<h3><?php  echo t("Order tags by:") ?></h3>
<?php  echo $form->select('tagOrder',$orders,$tagOrder); ?><br/>
<?php  /* //Tag Search is buggy in 5.3.3 so thif feature is disabled until 5.4 is out 
<h2><?php  echo t('Search results page')?></h2>
<?php  echo $form->checkbox('link_to',1, $link_to_cID>0);?> <label class="matogerel_tag_cloud_label" for="link_to"><?php  echo t("Link to Search Results page") ?></label><br/>
<?php   $form = Loader::helper('form/page_selector');
	print $form->selectPage('link_to_cID', $link_to_cID);
?>
*/ ?>