<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>


   <div id="footer">
      <div class="footer-address">
			<?php
         $footerAddressBlock = Block::getByName('Footer Address');
         $bvfa = new BlockView();
         $bvfa->render($footerAddressBlock );
         ?>
      </div>
      <div class="copyright">
			<?php
         $footerCopyright = Block::getByName('Footer Copyright');
         $bvc = new BlockView();
         $bvc->render($footerCopyright );
         ?>

         <?php
         $uInfo = new User();
         if ($uInfo->isLoggedIn()) {
            echo '<a href="' . DIR_REL . '/login/-/logout/" rel="nofollow" class="lowercase">Admin Logoff</a>';
         } else { 
            echo '<a href="' . DIR_REL . '/login/" rel="nofollow">Admin Login</a>';
         }
         ?> 
      </div>
      <div class="credit"><a href="http://www.artesiandesigninc.com" target="_blank" title="Web Design in Riverside, CA by Artesian Design Inc.">Web design and development by Artesian Design</a></div>
      <div class="clearfix"></div>
   </div>
</div><!-- !End #page -->

<?php  Loader::element('footer_required'); ?>
</body>
</html>