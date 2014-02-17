<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>  
<?php 
$includeAssetLibrary = true;
$al = Loader::helper('concrete/asset_library');
if(intval($mapObj->kml_fID)>0){ 
	$bf = $mapObj->getFileObject();
}
?>
<style>
table#googleMapBlockSetup th {font-weight: bold; text-style: normal; padding-right: 8px; white-space: nowrap; vertical-align:top ; padding-bottom:8px}
table#googleMapBlockSetup td{ font-size:12px; vertical-align:top; padding-bottom:8px;}
</style> 

<table id="googleMapBlockSetup" width="100%"> 
	<tr>
		<th><?php echo t('Map Title')?>: <div class="note">(<?php echo t('Optional')?>)</div></th>
		<td><input id="ccm_googlemap_block_title" name="title" value="<?php echo $mapObj->title?>" maxlength="255" type="text" style="width:100%"></td>
	</tr>	
	<tr>
		<th><?php echo t('Google Maps API Key')?>:</th>
		<td>
			<input id="ccm_googlemap_block_api_key" name="api_key" value="<?php echo $mapObj->api_key?>" maxlength="255" type="text" style="width:100%">
			<div class="ccm-note"><a href="http://code.google.com/apis/maps/signup.html" target="_blank"><?php echo t('Sign up for your key')?></a></div>
		</td>
	</tr>
	<tr>
		<th><?php echo t('Default View')?>:</th>
		<td>
		<select id="ccm_googlemap_block_map_type" name="map_type">
			<?php  foreach($mapObj->map_types as $map_type_key=>$constant){ ?>
			<option value="<?php echo $map_type_key?>" <?php echo ($map_type_key==$mapObj->map_type)?'selected':'' ?>><?php echo $map_type_key?></option>
			<?php  } ?>
		</select>
		</td>
	</tr>
    <tr>
		<th><?php echo t('Try to use google Earth on load')?>:</th>
		<td>
		<input type="checkbox" value="1" name="load_earth" <?php echo ($mapObj->load_earth)?'checked':'' ?> />
		</td>
	</tr>
	<tr>
		<th><?php echo t('Show Google Earth Button')?>:</th>
		<td>
		<input type="checkbox" value="1" name="show_earth" <?php echo ($mapObj->show_earth)?'checked':'' ?> />
		</td>
	</tr>		
    <tr>
		<th><?php echo t('Width')?>:</th>
		<td>
		<input id="ccm_googlemap_block_w" name="w" value="<?php echo $mapObj->w?>" maxlength="255" type="text" size="6"> 
		</td>
	</tr>
	<tr>
		<th><?php echo t('Height')?>:</th>
		<td>
		<input id="ccm_googlemap_block_h" name="h" value="<?php echo $mapObj->h?>" maxlength="255" type="text" size="6"> 
		</td>
	</tr>
	<tr>
		<th><?php echo t('Zoom')?>:</th>
		<td>
		<input id="ccm_googlemap_block_zoom" name="zoom" value="<?php echo $mapObj->zoom?>" maxlength="255" type="text">
		<div class="ccm-note"><?php echo t('Enter a number from 0 to 17, with 17 being the most zoomed in.')?> </div>
		</td>
	</tr>
	<tr>
		<th><?php echo t('Latitude')?>:</th>
		<td>
		<input id="ccm_googlemap_block_latitude" name="latitude" value="<?php echo $mapObj->latitude?>" maxlength="255" type="text">
		</td>
	</tr>
	<tr>
		<th><?php echo t('Longitude')?>:</th>
		<td>
		<input id="ccm_googlemap_block_longitude" name="longitude" value="<?php echo $mapObj->longitude?>" maxlength="255" type="text">
		</td>
	</tr>			
	<tr>
		<th><?php echo t('KML Upload')?>:</th>
		<td>
		<?php echo $al->file('ccm-b-file', 'fID', t('Choose File'), $bf);?></div>
		<div class="ccm-note">
			<a href="http://code.google.com/apis/kml/documentation/" target="_blank"><?php echo t("What's a KML file?")?></a><br />
			<?php echo t('(For your KML file to work, it has to be accessible by google over the internet)'); ?>
		</div>
		</td>
	</tr>
	
</table>