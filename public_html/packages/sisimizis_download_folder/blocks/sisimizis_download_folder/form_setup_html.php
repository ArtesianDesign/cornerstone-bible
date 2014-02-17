<?php    
defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<style>
table#SisimizisDownloadFolderSetup th {font-weight: bold; text-style: normal; padding-right: 8px; white-space: nowrap}
table#SisimizisDownloadFolderSetup td{ font-size:12px }

</style> 

<table id="SisimizisDownloadFolderSetup" width="100%" cellpadding="5">
	<tr>
		<th><?php  echo t('Title')?> (<?php  echo t('Optional')?>):</th>
		<td><input name="title" value="<?php  echo $dirObj->title?>" maxlength="255" type="text" style="width:100%"></td>
	</tr>
	<tr>
		<th><?php  echo t('Path to download folder')?>:</th>
		<td width="100%"><input name="relpath" value="<?php   echo $dirObj->relpath?>" maxlength="255" type="text" style="width:100%"></td>
	</tr>
	<tr>
		<th> </th>
		<td><?php  echo t('A folder on your server')?>, <?php  echo t('relative to c5 root.')?><br><?php  echo t('Example')?>: ./downloads/ <?php  echo t('or')?> ../files/public/ </td>
	</tr>
	<tr>
		<th><?php  echo t('Sort files by')?>:</th>
		<td>
			<input name="sortBy" type="radio" value="2" <?php  echo ($dirObj->sortBy)?'checked':''?>><?php  echo t('Name')?>&nbsp; <br>
			<input name="sortBy" type="radio" value="1" <?php  echo ($sortBy=='1')?'checked':''?>><?php  echo t('Size')?>&nbsp; <br>
			<input name="sortBy" type="radio" value="0" <?php  echo ($sortBy=='0')?'checked':''?>><?php  echo t('Date')?>
		</td>
	</tr>
	<tr>
		<th><?php  echo t('Sort order')?>:</th>
		<td>
			<input name="sortOrder" type="radio" value="1" <?php  echo ($dirObj->sortOrder)?'checked':''?>><?php  echo t('Ascending')?>&nbsp; <br>
			<input name="sortOrder" type="radio" value="0" <?php  echo (!$dirObj->sortOrder)?'checked':''?>><?php  echo t('Descending')?>
		</td>
	</tr>
	<tr>
		<th><?php  echo t('Show filesize')?></th>
		<td>
			<input name="showSize" type="checkbox" value="1" <?php  echo ($dirObj->showSize)?'checked':''?>>
		</td>
	</tr>
	<tr>
		<th><?php  echo t('Show filedate')?></th>
		<td>
			<input name="showDate" type="checkbox" value="1" <?php  echo ($dirObj->showDate)?'checked':''?>>
		</td>
	</tr>
	<tr>
		<th><?php  echo t('Show download icon')?></th>
		<td>
			<input name="showIcon" type="checkbox" value="1" <?php  echo ($dirObj->showIcon)?'checked':''?>>
		</td>
	</tr>	
	<tr>
		<th><?php  echo t('Subdomain URL')?> (<?php  echo t('Optional')?>):</th>
		<td width="100%"><input name="subdomain" value="<?php   echo $dirObj->subdomain?>" maxlength="255" type="text" style="width:100%"></td>
	</tr>
	<tr>
		<th> </th>
		<td><?php  echo t('Public URL of your download folder if you use a subdomain for it.')?><br><?php  echo t('Example')?>: http://download.sisimizi.org/software/ </td>
	</tr>
</table>
