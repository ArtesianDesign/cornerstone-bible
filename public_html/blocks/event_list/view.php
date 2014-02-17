<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$html = Loader::helper('html');
$uh = Loader::helper('concrete/urls');
$bt = BlockType::getByHandle('event_list');
$site = 'http://'.$_SERVER["SERVER_NAME"];


    if (isset($_GET['pageno'])) {
   	$pageno = $_GET['pageno'];
	} else {
   	$pageno = 1;
	} // if

	echo '<div>';
	echo '<h1>'.$rssTitle.'</h1>' ;


	//###################################################################################//
	//here we lay out they way the page looks, html with all our vars fed to it	     //
	//this is the content that displays.  it is recommended not to edit anything beyond  //
	//the content parse.  Feel free to structure and re-arrange any element and adjust   //
	//CSS as desired.							 	     //
	//###################################################################################//

	if (!function_exists('eventlistParse')) {
	function eventlistParse($url,$title,$time,$content,$date,$todate,$location){
	
	?>

		<div class="smallcal">
			<div class="calwrap">
				<div class="img">
					<div class="month">
						<?php  echo date('M', strtotime($date)) ; ?>
					</div>
					<div class="day">
						<?php  echo date('d', strtotime($date)) ; ?>
					</div>
				</div>
			</div>
			<div class="infowrap">
				<div class="titlehead">
					<div class="title">
					<?php 
						echo '<a href="'.$url.'">'.$title.'</a>' ; 	
					?>
					</div>
				   	<div class="local">
						<?php  echo $location ; ?>
					</div>
					<div class="time">
						<?php  echo $time;	?>
					</div>
				</div>
				<div class="description">
					<?php   echo $content; ?>
				</div>
			</div>
		</div>
		<br class="clearfloat" />
<?php 
		}
	}
				
	//#####################################################################################//
	//this is the end of the recommended content area.  please do not edit below this line //
	//#####################################################################################//
	
	

		$db = Loader::db();

	//go grab the posts, check if they are current, return only current posts
		$events = $controller->getCurrentBlocks($ctID,$ordering);
	
	//count the number of current posts returned	
		$pcount = count($events);

	//if no events are returned, then we display a user defined message	
		if($pcount==0){
		
			echo $nonelistmsg;
		
		}
		
	//now calc the last page	
		$lastpage = ceil($pcount/$num);
		
	
	//set the current page min max keys -1 as array key's start @ 0
		$sKey = $num * ($pageno-1) ;
		$eKey = ($num * ($pageno-1)) + ($num-1) ;
	
		
	//take each current post and treat it like a query, for each one do X
		foreach($events as $key => $row){
	
	//check for external URL, if none, rout to parent page
		if($row['urlLink']!=''){
			$url = $row['urlLink'];
		}else{
			$url = $controller->grabURL($row['cParentID']); 
		}
		
		$location = $row['location'];
		$title = $row['title'];
		$date = $row['sdt'];
		$todate = $row['edt'];
		
		if ($row['allday'] !=1){
						if ($row['eurotime']==1){
							if($row['st_a']=='PM'){
								$sh = $row['st_h']+12;
							}else{
								$sh = $row['st_h'];
							}
							if($row['et_a']=='PM'){
								$eh = $row['et_h']+12;
							}else{
								$eh = $row['et_h'];
							}
							$time = $sh.':'.$row['st_m'].' - '.$eh.':'.$row['et_m'] ;
							}else{
							$time = $row['st_h'].':'.$row['st_m'].' '.$row['st_a'].' - '.$row['et_h'].':'.$row['et_m'].' '.$row['et_a'] ; 
							}
					}else{
						$time= 'All Day';
					}
	
				$content = strip_tags($row['description']);
				
				if($truncateSummaries == 1){
			  		if (strlen($content) >= $truncateChars){
			  			$content =  substr($content,0,$truncateChars).'.....';
			  		}
			  	}
	
	//check if paging is enabled
			if($isPaged){


			//check to make sure the array key is within the range	
				if($key >= $sKey && $key <= $eKey){
				
		 			eventlistParse($url,$title,$time,$content,$date,$todate,$location);
  	
				}
				
				
	//if paging is not selected, use number of items designated in the list block
			}else{
					
					$i += 1;

					eventlistParse($url,$title,$time,$content,$date,$todate,$location);
					
			//once we reach the set number stop the script		
					if($i >= $num){ break; }	

			}
		}
	
	
	
	//is iCal feed option is sellected, show it
		if($showfeed==1){
			
			?>
			    <div class="iCal">
        			<p><img src="<?php   echo $controller->getRssIconUrl() ;?>" width="25" alt="iCal feed" />&nbsp;&nbsp;
        			<a href="<?php   echo($controller->getiCalUrl());?>?ctID=<?php  echo $ctID ;?>&bID=<?php  echo $bID ; ?>&ordering=<?php  echo $ordering ;?>" class="getFeed">
        			<?php   echo t('get iCal link');?></a></p>
        			<link href="<?php   echo $controller->getiCalUrl();?>" rel="alternate" type="application/rss+xml" title="<?php   echo t('RSS');?>" />
    			</div>
    		<?php 
			
		}	
		


	//if pagination is set, if it is needed, show it	
		if($isPaged==1){
				
			if ($pcount > $num) {
				echo '<div class="pagination">';
			
				if ($pageno == 1) {
   					echo t(' FIRST PREV ');
				} else {
   					echo ' <a href='.$_SERVER['PHP_SELF'].'?pageno=1>'.t('FIRST').'</a> ';
   					$prevpage = $pageno-1;
   					echo ' <a href='.$_SERVER['PHP_SELF'].'?pageno='.$prevpage.'>'.t('PREV').'</a> ';
				} // if
			
				echo ' ( Page '.$pageno.' of '.$lastpage.' ) ';
			
				if ($pageno == $lastpage) {
   					echo t(' NEXT LAST ');
				} else {
   					$nextpage = $pageno+1;
   					echo ' <a href='.$_SERVER['PHP_SELF'].'?pageno='.$nextpage.'>'.t('NEXT').'</a> ';
   					echo ' <a href='.$_SERVER['PHP_SELF'].'?pageno='.$lastpage.'>'.t('LAST').'</a> ';
				} // if		
				echo '</div>';
			}
		}			

	if (isset($bID)) { echo '<input type="hidden" name="bID" value="'.$bID.'" />';}	
?>
</div>