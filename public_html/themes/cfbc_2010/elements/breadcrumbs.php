   <div class="breadcrumbs">
   <?php  defined('C5_EXECUTE') or die(_("Access Denied."));
      $btb = BlockType::getByHandle('autonav');
      $btb->controller->displayPages = 'top';
      $btb->controller->orderBy = 'display_asc';                    
      $btb->controller->displaySubPages = 'relevant'; 
      $btb->controller->displaySubPageLevels = 'custom';
      $btb->controller->displaySubPageLevelsNum = '0';                   
      $btb->render('templates/breadcrumbs');
   ?>
   </div>