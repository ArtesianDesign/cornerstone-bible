<?php defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<div class="homeFeaturedLower">
	<?php
	$ih = Loader::helper('image');
	$resizedImgOne = $ih->getThumbnail($controller->getFileObject(1), 70, 140)->src;
	$resizedImgTwo = $ih->getThumbnail($controller->getFileObject(2), 70, 140)->src;
	$resizedImgThree = $ih->getThumbnail($controller->getFileObject(3), 70, 140)->src;
	$resizedImgFour = $ih->getThumbnail($controller->getFileObject(4), 70, 140)->src;
	?>
	
	<ul class="numColumns<?php echo $numColumns; ?>" >
		<li style="background:url(<?php echo $resizedImgOne; ?>) no-repeat;">
			<h2><a href="<?php echo $controller->linkOne; ?>"><?php echo $titleOne; ?></a></h2>
			<p><?php echo $textOne; ?></p>
		</li>
		<li style="background:url(<?php echo $resizedImgTwo; ?>) no-repeat;" <?php if ($numColumns == 2) echo 'class="last"'; ?>>
			<h2><a href="<?php echo $controller->linkTwo; ?>"><?php echo $titleTwo; ?></a></h2>
			<p><?php echo $textTwo; ?></p>
		</li>
		<?php if ($numColumns > 2) { ?>
		<li style="background:url(<?php echo $resizedImgThree; ?>) no-repeat;" <?php if ($numColumns == 3) echo 'class="last"'; ?>>
			<h2><a href="<?php echo $controller->linkThree; ?>"><?php echo $titleThree; ?></a></h2>
			<p><?php echo $textThree; ?></p>
		</li><?php
		}
		if ($numColumns == 4) { ?>
		<li style="background:url(<?php echo $resizedImgFour; ?>) no-repeat;" <?php if ($numColumns == 4) echo 'class="last"'; ?>>
			<h2><a href="<?php echo $controller->linkFour; ?>"><?php echo $titleFour; ?></a></h2>
			<p><?php echo $textFour; ?></p>
		</li>
		<?php
		} ?>
	</ul>
	<div class="clearfix" style="clear:both"></div>
</div>