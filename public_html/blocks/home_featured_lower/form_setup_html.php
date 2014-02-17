<?php defined('C5_EXECUTE') or die(_("Access Denied."));
$includeAssetLibrary = true; 
$assetLibraryPassThru = array(
	'type' => 'image'
);

$al = Loader::helper('concrete/asset_library');

?>

<div class="ccm-block-field-group">
<p>Number of Columns:
<input type="radio" name="numColumns" value="2" <?php  if ($controller->numColumns == '2') { ?> checked<?php  } ?> />
		<?php echo t('2 Columns')?> / 
<input type="radio" name="numColumns" value="3" <?php  if ($controller->numColumns == '3') { ?> checked<?php  } ?> />
		<?php echo t('3 Columns')?> /
<input type="radio" name="numColumns" value="4" <?php  if ($controller->numColumns == '4') { ?> checked<?php  } ?> />
		<?php echo t('4 Columns')?>
</p>
</div>
			
<h2>Block 1</h2>
<div class="ccm-block-field-group">
	<h3><?php echo t('1. Title')?></h3>
	<?= $form->text('titleOne', $titleOne, array('style' => 'width: 250px;')); ?>
</div>

<div class="ccm-block-field-group">
	<h3><?php echo t('1. Text')?></h3>
	<?= $form->textarea('textOne', $controller->textOne, array('style' => 'width:300px; height:60px;')); ?>
</div>

<div class="ccm-block-field-group">
	<h3><?php echo t('1. Link to')?></h3>
	<?= $form->text('linkOne', $linkOne, array('style' => 'width: 250px;')); ?>
	<h3><?php echo t('1. Image')?></h3>
	<?=$al->image('ccm-b-image1', 'fIDOne', t('Choose Image'), $bfOne);?>
</div>
<hr/>


<div class="ccm-block-field-group">
<h2>Block 2</h2>
	<h3><?php echo t('2. Title')?></h3>
	<?= $form->text('titleTwo', $titleTwo, array('style' => 'width: 250px;')); ?>
</div>
<div class="ccm-block-field-group">
	<h3><?php echo t('2. Text')?></h3>
	<?= $form->textarea('textTwo', $controller->textTwo, array('style' => 'width:300px; height:60px;')); ?>
</div>
<div class="ccm-block-field-group">
	<h3><?php echo t('2. Link to')?></h3>
	<?= $form->text('linkTwo', $linkTwo, array('style' => 'width: 250px;')); ?>
	<h3><?php echo t('2. Image')?></h3>
	<?=$al->image('ccm-b-image2', 'fIDTwo', t('Choose Image'), $bfTwo);?>
</div>
<hr/>


<div class="ccm-block-field-group">
<h2>Block 3</h2>
	<h3><?php echo t('3. Title')?></h3>
	<?= $form->text('titleThree', $titleThree, array('style' => 'width: 250px;')); ?>
</div>
<div class="ccm-block-field-group">
	<h3><?php echo t('3. Text')?></h3>
	<?= $form->textarea('textThree', $controller->textThree, array('style' => 'width:300px; height:60px;')); ?>
</div>
<div class="ccm-block-field-group">
	<h3><?php echo t('3. Link to')?></h3>
	<?= $form->text('linkThree', $linkThree, array('style' => 'width: 250px;')); ?>
	<h3><?php echo t('3. Image')?></h3>
	<?=$al->image('ccm-b-image3', 'fIDThree', t('Choose Image'), $bfThree);?>
</div>
<hr/>


<div class="ccm-block-field-group">
<h2>Block 4</h2>
	<h3><?php echo t('4. Title')?></h3>
	<?= $form->text('titleFour', $titleFour, array('style' => 'width: 250px;')); ?>
</div>
<div class="ccm-block-field-group">
	<h3><?php echo t('4. Text')?></h3>
	<?= $form->textarea('textFour', $controller->textFour, array('style' => 'width:300px; height:60px;')); ?>
</div>
<div class="ccm-block-field-group">
	<h3><?php echo t('4. Link to')?></h3>
	<?= $form->text('linkFive', $linkFive, array('style' => 'width: 250px;')); ?>
	<h3><?php echo t('4. Image')?></h3>
	<?=$al->image('ccm-b-image4', 'fIDFour', t('Choose Image'), $bfFour);?>
</div>
<hr/>


