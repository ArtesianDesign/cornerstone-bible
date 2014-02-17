<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?> 
<style type="text/css">
table#searchBlockSetup th {font-weight: bold; text-style: normal; padding-right: 8px; white-space: nowrap; vertical-align:top }
table#searchBlockSetup td{ font-size:12px; vertical-align:top }
table#searchBlockSetup .note{ font-size:10px; color:#999999; font-weight:normal }
</style>


<table id="searchBlockSetup" width="100%">
	<tr>
		<th><?php echo t('Search Title')?>:</th>
		<td><input id="ccm_search_block_title" name="title" value="<?php echo $searchObj->title?>" maxlength="255" type="text" style="width:100%"></td>
	</tr>	
	<tr>
		<th><?php echo t('Submit Button Text')?>:</th>
		<td><input name="buttonText" value="<?php echo $searchObj->buttonText?>" maxlength="255" type="text" style="width:100%"></td>
	</tr>
	<tr>
		<th><?php echo t('Results Page')?>:</th>
		<td>
			<div>
				<input id="ccm-searchBlock-externalTarget" name="externalTarget" type="checkbox" value="1" <?php echo (strlen($searchObj->resultsURL))?'checked':''?> />
				<?php echo t('Post to Another Page Elsewhere')?>
			</div>
			<div id="ccm-searchBlock-resultsURL-wrap" style=" <?php echo (strlen($searchObj->resultsURL))?'':'display:none'?>" >
				<input id="ccm-searchBlock-resultsURL" name="resultsURL" value="<?php echo $searchObj->resultsURL?>" maxlength="255" type="text" style="width:100%">
			</div>
		</td>
	</tr>			
</table>