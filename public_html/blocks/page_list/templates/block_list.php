<?php defined('C5_EXECUTE') or die(_("Access Denied."));

$imgHelper = Loader::helper('image');
	
	if (count($cArray) > 0) { ?>
   		<ul class="block-list option2">
   		<?php 
   		for ($i = 0; $i < count($cArray); $i++ ) {
            $cobj = $cArray[$i]; 
            $title = $cobj->getCollectionName(); ?>
        	<li><div class="list-thumbnail rounded">
        		<a href="<?php echo $nh->getLinkToCollection($cobj)?>" class="rounded">
        			<img src="<?php echo $imgHelper->getThumbnail($cobj->getAttribute('thumbnail'), 80, 80)->src; ?>" alt="<?php echo $title ?>" />
        		</a>
        		</div>
        		<a href="<?php echo $nh->getLinkToCollection($cobj)?>" class="rounded"><?php echo $title?></a>
        	</li><?php
		}  ?>
		</ul>
		<div class="clearfix"></div><?php
	}  ?>