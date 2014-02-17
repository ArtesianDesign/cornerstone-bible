<?php defined('C5_EXECUTE') or die(_("Access Denied."));
$ih = Loader::helper('image');
$resizedImg = $ih->getThumbnail($controller->getFileObject(), 160, 160)->src;

//need to change this to read from DB tables
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
?>


<div class="caregroup-details-block">
	<?php if ( $controller->getFileID() ) echo '<img src="' . $resizedImg . '" />'; ?>
	<div class="details">
		<h2><a href="<?php echo t($cgName); ?>"><?php echo $cgName; ?> Care Group</a></h2>
		<p>
			Leaders: <?php echo t($cgLeaderNames); ?><br/>
			Day: <?php echo date('l',strtotime($controller->cgDateStamp)); ?><br/>
			Time: <?php echo date('g:i a',strtotime($controller->cgDateStamp)); ?> - <?php echo date('g:i a',strtotime($controller->cgTimeEnd)); ?><br/>
			Area: <?php echo $regions[$regionID]; ?><br/>
			Meeting in: <?php echo $cities[$cityID]; ?>
			<?php if (strlen($cgEmail)) echo '<br/>Email:' . t($cgEmail); ?>
			<?php if (strlen($cgPhone)) echo '<br/>Phone:' . t($cgPhone); ?></p>
	</div>
	<div class="clearfix"></div>
</div>