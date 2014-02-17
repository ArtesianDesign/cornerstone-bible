<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));  
$ih = Loader::helper('image'); 
?> 
	
<div id="tonyNextPrevious<?php echo intval($bID)?>" class="tonyNextPreviousWrap">
	<?php  if( is_object($nextCollection) ){ ?> 
    <div class="tonyNextPrevious_nextLink">
        <a href="<?php echo View::url($nextCollection->getCollectionPath())?>"><?php echo $nextLinkText ?></a>
    </div>
    <?php  } ?>
    
    <?php  if( is_object($previousCollection) ){ ?>
    <div class="tonyNextPrevious_previousLink">
        <a href="<?php echo View::url($previousCollection->getCollectionPath())?>"><?php echo $previousLinkText ?></a>  
    </div>
    <?php  } ?>
    
    <div class="spacer"></div> 
</div>