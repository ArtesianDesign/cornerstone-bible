<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); 
$layoutClass = 'one-column home';
include('elements/header_common.php'); ?>
<div id="page" <?php if ($layoutClass) echo ('class="' . $layoutClass .'"'); ?>>
<div class="top-bar"></div>
<!--<div id="quick-links-wrapper">
    <div id="quick-links">
        <div class="quick-links-content"></div><div class="quick-links-link"><a href="#">Quick Links</a></div>
    </div>
</div>-->
<div id="top-links"</div>
<div id="wrapper">
	<div id="header">
    	<div id="logo">
    		<?php $homeLink = DIR_REL ? BASE_URL . DIR_REL . '/' : BASE_URL . '/'; ?>
        	<a href="<?php echo $homeLink; ?>" title="<?php echo SITE; ?>">
        	<?php
				$block = Block::getByName('My_Site_Name');
				if( $block && $block->bID ) { $block->display();
				} else { echo '<span>' . SITE . '</span>'; } ?>
			</a>
        </div>
        
        <div class="topExtraNav">
        	<?php
			$topLinksBlock = Block::getByName('Top Links');
			$tl = new BlockView();
			$tl->render($topLinksBlock);
			?>
        </div>
        
        <div class="topSearch">
            <form action="" method="get" id="search-bar-form">
                <input name="query" type="text" class="input-text" value="" />
                <button type="submit" class="button-submit"><span>search</span></button>
            </form>
        </div>
        
        <div id="mainNav">
        	<?php
			$standardMainNavBlock = Block::getByName('Main Nav');
			$bv = new BlockView();
			$bv->render($standardMainNavBlock );
			?>
        </div><!-- !END #mainNav -->
    </div><!-- !END #upper -->
        
    <div id="central">
    	<div class="left">
			<?php 
			$as = new Area('Sidebar');
			$as->display($c);
			?>
    	</div>
		<div id="column-main" class="center">
			<?php 
			$a = new Area('Main');
			$a->display($c);
			?>
		</div>
    	<div class="right">
			<?php 
			$aas = new Area('Sidebar Secondary');
			$aas->display($c);
			?>
    	</div>
		<div class="clearfix">&nbsp;</div>
    </div><!-- !END #lower -->
</div><!-- !END #wrapper -->

<?php  $this->inc('elements/footer.php'); ?>