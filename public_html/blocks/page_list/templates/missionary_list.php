<?php defined('C5_EXECUTE') or die(_("Access Denied."));

$textHelper = Loader::helper("text"); 
$imgHelper = Loader::helper('image');
	
	if (count($cArray) > 0) { ?>
	
	<?php 
	for ($i = 0; $i < count($cArray); $i++ ) {
		$cobj = $cArray[$i]; 
		$title = $cobj->getCollectionName(); ?>
		
	<div class="missionary-person-container">
		<?php if($cobj->getAttribute('thumbnail')) { ?>
		<div class="person-photo">
			<img src="<?php echo $imgHelper->getThumbnail($cobj->getAttribute('thumbnail'), 190, 160)->src; ?>" alt="<?php echo $title ?>" />
		</div>
		<?php  
		} //end if
		?>
	
		<div class="person-description" style="width:500px;">
			<h2 class="person-name"><a href="<?php echo $nh->getLinkToCollection($cobj)?>"><?php echo $title?></a></h2>
			<p><?php 
				if(!$controller->truncateSummaries){
					echo $cobj->getCollectionDescription();
				} else {
					echo $textHelper->shorten($cobj->getCollectionDescription(),$controller->truncateChars);
				}//end if
				?>
			</p>
		</div>
		<div class="clearfix"></div>
	</div>
<?php } //end for loop?

	if(!$previewMode && $controller->rss) { 
			$btID = $b->getBlockTypeID();
			$bt = BlockType::getByID($btID);
			$uh = Loader::helper('concrete/urls');
			$rssUrl = $controller->getRssUrl($b);
			?>
			<div class="rssIcon">
				<a href="<?php echo $rssUrl?>" target="_blank"><img src="<?php echo $uh->getBlockTypeAssetsURL($bt, 'rss.png')?>" width="14" height="14" /></a>
				
			</div>
			<link href="<?php echo $rssUrl?>" rel="alternate" type="application/rss+xml" title="<?php echo $controller->rssTitle?>" />
		<?php  
	} //end if
	?>
<?php  
} //end if count array
	
if ($paginate && $num > 0 && is_object($pl)) { $pl->displayPaging(); }
	
?>