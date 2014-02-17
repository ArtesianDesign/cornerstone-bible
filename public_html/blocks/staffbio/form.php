<? 
defined('C5_EXECUTE') or die(_("Access Denied."));
$includeAssetLibrary = true; 
$assetLibraryPassThru = array(
	'type' => 'image'
);

$al = Loader::helper('concrete/asset_library');

?>
<div class="ccm-block-field-group">
<h2><?=t('Photo')?></h2>
<?=$al->image('ccm-b-image', 'fID', t('Choose Photo'), $bf);?>
</div>

<div class="ccm-block-field-group">
<h2><?=t('Name')?></h2>
<?= $form->text('name', $name, array('style' => 'width: 350px;')); ?>
</div>

<div class="ccm-block-field-group">
<h2><?=t('Title')?></h2>
<?= $form->text('title', $title, array('style' => 'width: 350px;')); ?>
</div>

<div class="ccm-block-field-group">
<h2><?=t('Bio')?></h2>
<?= $form->textarea('description', $description, array('style' => 'width: 350px;height:120px;')); ?>
</div>

<div class="ccm-block-field-group">
<h2><?=t('Extra')?></h2>
<?= $form->checkbox('elder', 1, $controller->getIsElder()); ?> Elder?<br/>
<?= $form->checkbox('staff', 1, $controller->getIsStaff()); ?> Staff?
</div>