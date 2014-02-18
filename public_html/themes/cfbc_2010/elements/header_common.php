<?php defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<div id="page" <?php if ($layoutClass) echo ('class="' . $layoutClass .'"'); ?>>
<div id="wrapper">
   <div class="topExtraNav">
	  <div id="topLogin">
	  	<?php 
	  	$uInfo = new User();
		if ($uInfo->isLoggedIn()) {
	  		echo '<a href="' . DIR_REL . '/login/-/logout/" rel="nofollow" class="lowercase">Sign Out</a>';
		} else { 
			echo '<a href="' . DIR_REL . '/login/" rel="nofollow">Sign In</a>';
	  	}
	  	?>	  	
	  </div>
      <div class="topSearch">
         <form action="<?php echo DIR_REL; ?>/search-results/" method="get" id="searchForm">
             <input name="query" type="text" class="input-text" />
             <input class="search-button" type="submit" value="search" />
         </form>
      </div>
      <div id="topLinks">
		<?php
			$topLinksBlock = Block::getByName('Top Links');
			$tl = new BlockView();
			$tl->render($topLinksBlock);
			?>
      </div>
   </div>
   
	<div id="header">
    	<div id="logo">
    		<?php $homeLink = DIR_REL ? BASE_URL . DIR_REL . '/' : BASE_URL . '/'; ?>
        	<a href="<?php echo $homeLink; ?>" title="<?php echo SITE; ?>"><img src="<?php echo $this->getThemePath() . DIR_REL ?>/images/Cornerstone-LogoX2.png" alt="Cornerstone Fellowship Bible Church of Riverside" /><?php /*
				$block = Block::getByName('My_Site_Name');
				if( $block && $block->bID ) { $block->display();
				} else { echo '<span>' . SITE . '</span>'; } */ ?></a>
      </div>
        
      <div id="mainNav">
        	<?php 
        	
        	/*
			$standardMainNavBlock = Block::getByName('Main Nav');
			$bv = new BlockView();
			$bv->render($standardMainNavBlock );
			*/
			$stack = Stack::getByName('Main Navigation');
    		if ($stack instanceof Stack) {
    			$stack->display($c);
    		}
			
			?>
      </div><!-- !END #mainNav -->
      <div class="clearfix"></div>
    </div><!-- !END #header -->