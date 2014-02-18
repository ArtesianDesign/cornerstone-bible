<?php defined('C5_EXECUTE') or die(_("Access Denied."));
//$this->addHeaderItem(Loader::helper('html')->css('ccm.core.commerce.dashboard.css', 'core_commerce'));
$ih = Loader::helper('concrete/interface');
$valt = Loader::helper('validation/token');
$form = Loader::helper('form');
Loader::model('resource_library', 'resource_library');
?>

<style type="text/css">
.ccm-dashboard-inner form label { display:inline-block; width:120px; margin-right:5px; text-align:right; }
.ccm-dashboard-inner form td { padding:4px 0; }
</style>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Add New Resource Item'), t('Manage a library of audio, visual and document resources. Great for lectures or sermons and their corresponding documents.'), 'span12', true); ?>

	<form method="post" action="<?php echo $this->action('add_audio')?>" id="resource-library-add-form">
		<fieldset>
			<p class="help-block"><?php echo t('Fill in all fields:')?></p>
		<table class="table table-striped table-hover table-bordered">
			<tr><td>
				<?php echo $form->label('date', t('Date'))?>
				<span name="date">
					<input name="date" value="1" type="hidden" />
					<select name="date_month">
						<option value="1" <?php if (date('n') == 1) echo 'selected="selected"'; ?>>January</option>
						<option value="2" <?php if (date('n') == 2) echo 'selected="selected"'; ?>>February</option>
						<option value="3" <?php if (date('n') == 3) echo 'selected="selected"'; ?>>March</option>
						<option value="4" <?php if (date('n') == 4) echo 'selected="selected"'; ?>>April</option>
						<option value="5" <?php if (date('n') == 5) echo 'selected="selected"'; ?>>May</option>
						<option value="6" <?php if (date('n') == 6) echo 'selected="selected"'; ?>>June</option>
						<option value="7" <?php if (date('n') == 7) echo 'selected="selected"'; ?>>July</option>
						<option value="8" <?php if (date('n') == 8) echo 'selected="selected"'; ?>>August</option>
						<option value="9" <?php if (date('n') == 9) echo 'selected="selected"'; ?>>September</option>
						<option value="10" <?php if (date('n') == 10) echo 'selected="selected"'; ?>>October</option>
						<option value="11" <?php if (date('n') == 11) echo 'selected="selected"'; ?>>November</option>
						<option value="12" <?php if (date('n') == 12) echo 'selected="selected"'; ?>>December</option>
					</select>
					<input name="date_day" value="<?php echo date('d') ?>" type="text" style="width: 30px; margin-left: 4px; margin-right: 4px;" />
					<input name="date_year" value="<?php echo date('Y') ?>" type="text" style="width: 40px;" />
				</span>
			</td></tr>
			<tr><td>
					<?php echo $form->label('title', t('Title'))?>
					<?php echo $form->text('title', array('style'=>'width:285px;'))?>
			</td></tr>
			<tr><td>
					<?php echo $form->label('reference', t('Scripture Reference'))?>
					<?php echo $form->text('reference', array('style'=>'width:285px;'))?>
			</td></tr>
			<tr><td>
					<?php 
						$speakersArray = ResourceLibrary::getSpeakers();
						$speakersArray[0] = 'Select';
						ksort($speakersArray);
						echo $form->label('speaker_id', t('Speaker Name'));
						echo $form->select('speaker_id', $speakersArray, ' ', array('style'=>'width:150px;')); ?>
					&nbsp; or new speaker <?php echo $form->text('speaker_add', array('style'=>'width:150px;'))?>
			</td></tr>
			<tr><td>
					<?php
						$seriesArray = ResourceLibrary::getSeries();
						$seriesArray[0] = 'Select';
						ksort($seriesArray);
						echo $form->label('series_id', t('Series'));
						echo $form->select('series_id', $seriesArray, ' ', array('style'=>'width:150px;')); ?>
					&nbsp; or new series <?php echo $form->text('series_add', array('style'=>'width:150px;'))?>
			</td></tr>
			<tr><td>
				<?php echo $form->label('mp3file_existing', t('MP3 Audio File'))?>
				<?php echo $form->select('mp3file_existing',ResourceLibrary::getMp3Files()); ?>
			</td></tr>
			<!--
			<tr><td>
					<?php echo $form->label('resource_file', t('File'))?>
					<input id="mp3file_upload" type="file" name="mp3file_upload"/>
			</td></tr>
			-->
		</table>
		
		<input type="hidden" name="url" id="url" value="" />
		
		<div class="ccm-spacer">&nbsp;</div>
		<br/>
		<div class="ccm-buttons">
			<?php echo $ih->submit(t('Add'), 'resource-library-add-form', 'left')?>
		</div>
		<div class="ccm-spacer">&nbsp;</div>
		</fieldset>
	</form>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false); ?>