<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
$this->inc('elements/header.php'); 
$layoutClass = 'one-column';
include('elements/header_common.php'); ?>
    
    <div id="banner">
		<?php 
        $hi = new Area('Header Image');
        $hi->display($c);
        ?>
    </div>
    
	<?php include('elements/breadcrumbs.php'); ?>
    
    <div id="central">
		<div id="column-main">
			<?php 
			$a = new Area('Main');
			$a->display($c);
			?>
		</div>	
    </div><!-- !END #lower -->
</div><!-- !END #wrapper -->

<?php  $this->inc('elements/footer.php'); ?>