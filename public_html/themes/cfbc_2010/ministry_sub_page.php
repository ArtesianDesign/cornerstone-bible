<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php');
$layoutClass = 'two-columns-left';
include('elements/header_common.php'); ?>
    
    <div id="banner" class="rounded">
		<?php 
        $hi = new Area('Header Image');
        $hi->display($c);
        ?>
    </div>
    
    <?php
	//get the top most parent
    $autoNav = BlockType::getByHandle('autonav');
    $anController = $autoNav->getController();
    $topParentID = ($anController->getParentAtLevel(2));
    $topParentPage = Page::getByID($topParentID);
    ?>
    
	<?php include('elements/breadcrumbs.php'); ?>
			
    <div id="central">
        <div id="sidebar">
       		<?php if (!$c->getAttribute('hide_sidenav_heading')) { ?>
        	<h2 class="no-top-margin"><a href="<?php echo DIR_REL . $topParentPage->getCollectionPath(); ?>"><?php echo $topParentPage->getCollectionName(); ?></a></h2>
        	<?php
        	}
        	if (!$c->getAttribute('hide_sidenav')) { 
				$bt = BlockType::getByHandle('autonav');
				$bt->controller->displayPages = 'second_level';
				$bt->controller->orderBy = 'display_asc';                    
				$bt->controller->displaySubPages = 'relevant'; 
				$bt->controller->displaySubPageLevels = 'custom';
				$bt->controller->displaySubPageLevelsNum = '2';                   
				$bt->render('view');
			}
			?>
			<?php 
			$as = new Area('Sidebar');
			$as->display($c);
			?>
		</div>
		
		<div id="column-main">
        	<h1><?php echo $c->getCollectionName(); ?></h1>
			<?php 
			$a = new Area('Main');
			$a->display($c);
			?>
		</div>
		<div class="clearfix"></div>
    </div><!-- !END #central -->
    
    <div id="lower">
    	<?php 
		$af = new Area('Lower');
		$af->display($c);
		?>
    </div>
</div><!-- !END #wrapper -->

<?php $this->inc('elements/footer.php'); ?>
