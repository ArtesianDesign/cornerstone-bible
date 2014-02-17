<?php  Loader::model('block_types'); 
$bt = BlockType::getByHandle('blog_archive');
$uh = Loader::helper('concrete/urls'); ?> 
<a href="<?php  echo($controller->getRssUrl());?>"><img src="<?php  echo $uh->getBlockTypeAssetsURL($bt, 'rss.png')?>" width="14" height="14" alt="rss feed" /></a>
<link href="<?php  echo $controller->getRssUrl();?>" rel="alternate" type="application/rss+xml" title="<?php  echo blog_t('RSS');?>" />
	