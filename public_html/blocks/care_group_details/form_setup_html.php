<?php defined('C5_EXECUTE') or die(_("Access Denied."));
$includeAssetLibrary = true; 
$assetLibraryPassThru = array(
	'type' => 'image'
);

$al = Loader::helper('concrete/asset_library');
$dateHelper = Loader::helper('form/date_time');
?>

<div class="ccm-block-field-group">
	<h3><?php echo t('Name')?></h3>
	<?= $form->text('cgName', $cgName, array('style' => 'width: 250px;')); ?>
</div>

<div class="ccm-block-field-group">
	<h3><?php echo t('Leader Names')?></h3>
	<?= $form->text('cgLeaderNames', $cgLeaderNames, array('style' => 'width: 250px;')); ?>
</div>

<div class="ccm-block-field-group">
	<h3><?php echo t('Region'); ?></h3>
	<?php //need to change this to read from DB tables
	echo $form->select('regionID', array(
		'0' => 'Cornerstone West/South', 
		'1' => 'Cornerstone South', 
		'2' => 'Cornerstone East', 
		'4' => 'Cornerstone North' 
		), $regionID);
	?>
</div>

<div class="ccm-block-field-group">
	<h3><?php echo t('City')?></h3>
	<?php //need to change this to read from DB tables
	echo $form->select('cityID', array(
		'0' => 'Riverside', 
		'1' => 'Moreno Valley', 
		'2' => 'Moreno Valley South', 
		'3' => 'Grand Terrace', 
		'4' => 'Woodcrest/Orangecrest area of Riverside', 
		'5' => 'Riverside near downtown', 
		'6' => 'South Riverside/Lake Matthews area', 
		'7' => 'Northeast Riverside near the church', 
		'8' => 'Moreno Valley North' 
		), $cityID);
	?>
</div>

<div class="ccm-block-field-group">
	<h3><?php echo t('Day/Time') ?> <small style="font-weight:normal"(select day of week)></small></h3>
	<label for"cgDateStamp">starts:</label> <?php echo $dateHelper->datetime('cgDateStamp', $cgDateStamp); ?><br/>
	<label for"cgTimeEnd">ends:</label> <?php echo $dateHelper->datetime('cgTimeEnd', $cgTimeEnd); ?>
</div>

<div class="ccm-block-field-group">
	<h3><?php echo t('E-mail')?></h3>
	<?= $form->text('cgEmail', $cgEmail, array('style' => 'width: 250px;')); ?>
</div>

<div class="ccm-block-field-group">
	<h3><?php echo t('Phone')?></h3>
	<?= $form->text('cgPhone', $cgPhone, array('style' => 'width: 250px;')); ?>
</div>

<div class="ccm-block-field-group">
	<h3><?php echo t('Photo')?></h3>
	<?=$al->image('ccm-b-image', 'cgPhoto', t('Choose Image'), $bfOne);?>
</div>


