<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$textHelper = Loader::helper("text"); 
// now that we're in the specialized content file for this block type, 
// we'll include this block type's class, and pass the block to it, and get
// the content

$imgHelper = Loader::helper('image');
$nh = Loader::helper('navigation');

$careGroups = array ();
$regions = array(
		'0' => 'Cornerstone West/South', 
		'1' => 'Cornerstone South', 
		'2' => 'Cornerstone East', 
		'4' => 'Cornerstone North');
$cities = array(
		'0' => 'Riverside', 
		'1' => 'Moreno Valley', 
		'2' => 'Moreno Valley South', 
		'3' => 'Grand Terrace', 
		'4' => 'Woodcrest/Orangecrest area of Riverside', 
		'5' => 'Riverside near downtown',
		'6' => 'South Riverside/Lake Matthews area', 
		'7' => 'Northeast Riverside near the church', 
		'8' => 'Moreno Valley North');


if (count($cArray) > 0) { 

	for ($i = 0; $i < count($cArray); $i++ ) {
		$cobj = $cArray[$i]; 
		$title = $cobj->getCollectionName();
		// get the care group detail block from the sub-page
		$pBlocks = $cobj->GetBlocks();
		foreach ($pBlocks as $pBlock){
		    if ($pBlock->btHandle == 'care_group_details') {
		    	$bController = $pBlock->getInstance();
		    	
	    		$careGroups[$i]['fileID'] = $bController->getFileID();
		    	$careGroups[$i]['fileObject'] = $bController->getFileObject();
		    	$careGroups[$i]['name'] = $bController->getName();
		    	$careGroups[$i]['leaderNames'] = $bController->getLeaders();
		    	$careGroups[$i]['regionID'] = $bController->getRegionID();
		    	$careGroups[$i]['cityID'] = $bController->getCityID();
		    	$careGroups[$i]['dateTime'] = $bController->getDateTime();
		    	$careGroups[$i]['timeEnd'] = $bController->getTimeEnd();
		    	$careGroups[$i]['link'] = $nh->getLinkToCollection($cobj);
		        //$pBlock->display();
		    }
		}
	}//end for loop
	
	//sort by region
	//$careGroups = array_sort($careGroups, 'regionID');
	//sort($careGroups, ksort($careGroups));
	$careGroups = mySort($careGroups, 'regionID');
	
	//cycle through each block
	for ($j = 0; $j < count($careGroups); $j++) {
		if (strlen($careGroups[$j]['name']) > 1) { 
		
			if ($oldRegion != $careGroups[$j]['regionID']) { 
				$regionID = $careGroups[$j]['regionID'];
				echo '<h2 class="careGroupTitle rounded">' . $regions[$regionID] . '</h2>';
			} 
			?>
			<div class="care-group-container">
				<div class="person-photo" style="width:100px; height:100px;">
					<?php if($careGroups[$j]['fileID']) { ?>
					<img src="<?php echo $imgHelper->getThumbnail($careGroups[$j]['fileObject'], 100, 100)->src; ?>" alt="<?php echo $careGroups[$j]['leaderNames'] ?>" /><?php  
					} //end if photo ?>
				</div>
				<div class="days">
					<?php echo date('l',strtotime($careGroups[$j]['dateTime'])); ?>s<br/>
					<?php echo date('g:i a',strtotime($careGroups[$j]['dateTime'])); ?> - <?php echo date('g:i a',strtotime($careGroups[$j]['timeEnd'])); ?>
				</div>
				<div class="person-description">
					<h2><a href="<?php echo $careGroups[$j]['link']; ?>"><?php echo $careGroups[$j]['name'] . '<br/>'; ?></a></h2>
					<div class="clearfix"></div>
					<p><?php
						echo 'Leaders: ' . $careGroups[$j]['leaderNames'] . '<br/>';	
						$locationID = $careGroups[$j]['cityID'];
						echo 'Area: ' . $cities[$locationID] . '<br/>';
						?>
					</p>
				</div>
				<div class="clearfix"></div>
			</div>
			<?php
			
			$oldRegion = $careGroups[$j]['regionID'];	
		}
			
	}//end for loop



	//RSS feed
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
	
} //end if count array
	
if ($paginate && $num > 0 && is_object($pl)) { $pl->displayPaging(); }


function mySort($theArray, $sortKey) {
	
	$sortArray = array(); 
	
	foreach($theArray as $person){ 
	    foreach($person as $key=>$value){ 
	        if(!isset($sortArray[$key])){ 
	            $sortArray[$key] = array(); 
	        } 
	        $sortArray[$key][] = $value; 
	    } 
	} 	
	array_multisort($sortArray[$sortKey], SORT_DESC, $theArray); 
	return $theArray;
}

?>