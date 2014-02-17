<?php 
	defined('C5_EXECUTE') or die(_("Access Denied."));
	//$textHelper = Loader::helper("text"); 
	// now that we're in the specialized content file for this block type, 
	// we'll include this block type's class, and pass the block to it, and get
	// the content
	
	if (count($cArray) > 0) { ?>
   		<ul>
   		<?php 
   		for ($i = 0; $i < count($cArray); $i++ ) {
            $cobj = $cArray[$i]; 
            $title = $cobj->getCollectionName(); ?>
        	<li><a href="<?php echo $nh->getLinkToCollection($cobj)?>"><?php echo $title?></a></li><?php
		}  ?>
		</ul><?php
	}  ?>