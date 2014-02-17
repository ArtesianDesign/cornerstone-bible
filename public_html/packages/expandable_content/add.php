<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$replaceOnUnload = 1;
?>
<div style="float:left">
	<div>Title (HTML - Expands content on click)</div>
	<input style="width:300px" name="title">
</div>
<div style="float:left;margin-left:15px;">
	<div>Slide Speed</div>
	<select name="speed">
		<option value="slow">Slow</option>
		<option value="normal">Normal</option>
		<option value="fast">Fast</option>
	</select>
</div>
<div style="float:left;margin-left:15px;">
	<div>Default Content View</div>
	<select name="visibility">
		<option value="block">Visible</option>
		<option value="none">Hidden</option>
	</select>
</div>
<div style="clear:both;height:15px;"></div>
<?php
$bt->inc('editor_init.php');
?>
<div style="text-align: center"><textarea id="ccm-content-<?php echo $a->getAreaID()?>" class="advancedEditor" name="content"></textarea></div>