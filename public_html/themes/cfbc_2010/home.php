<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); 
$layoutClass = 'one-column home';
include('elements/header_common.php'); ?>
        
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
		<div class="clearfix">&nbsp;</div>
    </div><!-- !END #central -->
    
    <div id="lower">
    	<?php 
		$af = new Area('Lower');
		$af->display($c);
		?>
    </div>
</div><!-- !END #wrapper -->

<?php  $this->inc('elements/footer.php'); ?>