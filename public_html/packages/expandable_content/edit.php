<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$replaceOnUnload = 1;
?>
<div style="float:left">
	<div>Title (HTML - Expands content on click)</div>
	<input style="width:300px" name="title" value="<?php echo htmlspecialchars($controller->title)?>">
</div>
<div style="float:left;margin-left:15px;">
	<div>Slide Speed</div>
	<select name="speed">
		<option value="slow" <?php if ($controller->speed == 'slow') { echo 'selected="selected"'; } ?> >Slow</option>
		<option value="normal" <?php if ($controller->speed == 'normal') { echo 'selected="selected"'; } ?> >Normal</option>
		<option value="fast" <?php if ($controller->speed == 'fast') { echo 'selected="selected"'; } ?> >Fast</option>
	</select>
</div>
<div style="float:left;margin-left:15px;">
	<div>Default Content View</div>
	<select name="visibility">
		<option value="block" <?php if ($controller->visibility == 'block') { echo 'selected="selected"'; } ?> >Visible</option>
		<option value="none" <?php if ($controller->visibility == 'none') { echo 'selected="selected"'; } ?> >Hidden</option>
	</select>
</div>
<div style="clear:both;height:15px;"></div>
<?php
$bt->inc('editor_init.php');
?>
<div style="text-align: center" id="ccm-editor-pane">
<textarea id="ccm-content-<?php echo $b->getBlockID()?>-<?php echo $a->getAreaID()?>" class="advancedEditor" name="content"><?php echo $controller->getContentEditMode()?></textarea>
</div>