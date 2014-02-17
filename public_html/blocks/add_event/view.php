<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
?>
<div id="simplecal">
	<div id="img">
		<div id="month">
			<?php  echo date('M', strtotime($sdt)) ; ?>
		</div>
		<div id="day">
			<?php  echo date('d', strtotime($sdt)) ; ?>
		</div>
	</div>
	<div id="titlehead">
		<div id="title"><h2><?php  echo $title ; ?></h2></div>
		<div id="local"><?php  echo $location ; ?></div>
	</div>
	<div id="datespan">
	<?php  
	if ($edt > $sdt){
		if ($eurotime==1){
			echo date('Y/m/d', strtotime($sdt)).'  -  '.date('Y/m/d', strtotime($edt)) ;
		}else{
			echo date('m/d/Y', strtotime($sdt)).'  -  '.date('m/d/Y', strtotime($edt)) ;
		}
	}
	?>
	</div>
	<div id="time">
	<?php  
	
			if ($allday !=1){
			
				if ($eurotime==1){
					if($st_a =='PM'){
						$sh = $st_h +12;	
					}else{
						$sh = $st_h;
					}
					
					if($et_a =='PM'){
						$eh = $et_h +12;
					}else{
						$eh = $et_h;
					}
				
					echo $sh.':'.$st_m.' - '.$eh.':'.$et_m ;
			
				}else{
			
					echo $st_h.':'.$st_m.' '.$st_a.' - '.$et_h.':'.$et_m.' '.$et_a ; 
			
				}
			}else{
			echo t('All Day');
			}
	?>
	</div>
	<div id="deswrap">
		<div id="description">
			<?php echo $controller->getContent() ; ?>
		</div>
	</div>
	<div id="eventfoot">
	<?php 
	if ($cEmail !=''){ ?>
		<a href="mailto:<?php  echo $cEmail ;?>"><?php   echo t('contact');?></a>
		<?php  } if ($cEmail !='' && $address !=''){ ?> || <?php  } if($address !=''){ ?><a href="http://maps.google.com/maps?f=q&amp;hl=en&amp;&saddr=<?php  echo $address ;?>"> get directions</a> <?php  } ?>
	</div>
	<div class="clearfix"></div>
	<?php
	if ($bta = BlockType::getByHandle('addthis')) $bta->render('view');
	?>
	
</div>