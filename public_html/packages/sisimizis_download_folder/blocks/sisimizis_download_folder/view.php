<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
 
$dirObj=$controller;

$b = $controller->getBlockObject();
$btID = $b->getBlockTypeID();
$bt = BlockType::getByID($btID);
$uh = Loader::helper('concrete/urls');

// byteConvert function for filesize (once only, else it will fail if there is another Sisimizi's Download Folder block on the same page)
include_once($this->getBlockPath().'/convert.php');

$_relpath = $relpath;
$_subdomain = $subdomain;

// try to add missing prefixes and slashes to relative and subdomain paths
if((substr($_relpath, -1, 1)!="/") && $_relpath!="") $_relpath = $_relpath . "/";
if((substr($_relpath, 0, 1)=="/") && $_relpath!="") $_relpath = "." . $_relpath;
if((substr($_relpath, 0, 2)!="./") && (substr($_relpath, 0, 3)!="../") && $_relpath!="") $_relpath = "./" . $_relpath;
if((substr($_subdomain, -1, 1)!="/") && $_subdomain!="") $_subdomain = $_subdomain . "/";
if((substr($_subdomain, 0, 7)!="http://") && $_subdomain!="") $_subdomain = "http://" . $_subdomain;

// try to open directory
is_dir($_relpath) or die(_("Relative path probably does not exist or has wrong declaration."));
$dir_handle = @opendir($_relpath) or die(_("Unable to open folder."));

// read filelist (exclude folder navigation, htaccess file and other directories by default)
while (false !== ($file = readdir($dir_handle))) { 
	if ($file!="." && $file!=".." && $file!=".htaccess" && @filetype($_relpath.$file)!="dir") {
		$n++;
		if($sortBy==0) {
			$num = @filemtime($_relpath.$file).".$n";
		}
		elseif($sortBy==1) {
			$num = @filesize($_relpath.$file).".$n";
		}
		else {
			$num = $n;
		}
		$files[$num] = $file;
	}
}
closedir($dir_handle); 

// sort filelist
if($sortBy==0) {
	@ksort($files, SORT_NUMERIC);
}
elseif($sortBy==1) {
	@ksort($files, SORT_NUMERIC);
}
else {
	@natcasesort($files);
}
if($sortOrder!=1) {
	$files = @array_reverse($files);
}

$files = @array_values($files);
	
?>

<style>
.SisimizisDownloadFolder .SisimizisDownloadFolderTitle{ margin-bottom:8px; font-weight:bold }
.SisimizisDownloadFolder .SisimizisDownloadFolderItem{ margin-bottom:16px }
.SisimizisDownloadFolder .SisimizisDownloadFolderItem .table#SisimizisDownloadFolder td {text-style: normal; white-space: nowrap}
</style>

<div id="SisimizisDownloadFolder<?php   echo intval($survey->questionSetId)?>" class="SisimizisDownloadFolder">

	<?php    
	if( strlen($title)>0 ){ ?>
		<div class="SisimizisDownloadFolderTitle"><?php   echo $title; ?></div><?php 
	} ?>

	<div class="SisimizisDownloadFolderItem">
		<table id="SisimizisDownloadFolder" border="0" cellpadding="0" cellspacing="0" width="100%">
		<?php 
		$arraysize = sizeof($files);
		// if no subdomain is available, use relative server path
		if (empty($_subdomain)) { 
			for($i=0; $i<$arraysize; $i++) { ?>
					<tr>
						<td align="left" height="21"><a href="<?php  echo $_relpath.$files[$i]; ?>"><?php  echo $files[$i]; ?></a></td>
						<?php 
						if($showSize!=0) { ?>
							<td width="80" align="right" height="21"><?php  echo (byteConvert(filesize($_relpath.$files[$i]))); ?></td>
						<?php 
						}
						if($showDate!=0) { ?>
							<td width="120" align="right" height="21"><?php  echo (date(" d-m-Y  H:i", filemtime($_relpath.$files[$i]))); ?></td>
						<?php 
						}
						if($showIcon!=0) { ?>
							<td width="30" align="right" height="21"><a href="<?php  echo $_relpath.$files[$i]; ?>"><img src="<?php  echo $uh->getBlockTypeAssetsURL($bt); ?>/download.png" alt="<?php  echo $files[$i]; ?>"></a></td>
						<?php  
						} ?>
					</tr>
			<?php 
			}
		}
		// if subdomain is available, substitute relative path with absolute path
		else { 
			for($i=0; $i<$arraysize; $i++) { ?>
					<tr>
						<td align="left" height="21"><a href="<?php  echo $_subdomain.$files[$i]; ?>"><?php  echo $files[$i]; ?></a></td>
						<?php 
						if($showSize!=0) { ?>						
							<td width="80" align="right" height="21"><?php  echo (byteConvert(filesize($_relpath.$files[$i]))); ?></td>
						<?php 
						}
						if($showDate!=0) { ?>
							<td width="120" align="right" height="21"><?php  echo (date(" d-m-Y  H:i", filemtime($_relpath.$files[$i]))); ?></td>
						<?php 
						}
						if($showIcon!=0) { ?>
							<td width="30" align="right" height="21"><a href="<?php  echo $_subdomain.$files[$i]; ?>"><img src="<?php  echo $uh->getBlockTypeAssetsURL($bt); ?>/download.png" alt="<?php  echo $files[$i]; ?>"></a></td>
						<?php  
						} ?>
					</tr>
			<?php 
			}	
		} ?>
		</table>
	</div>
</div>

