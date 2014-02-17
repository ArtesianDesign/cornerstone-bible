<?php 
  defined('C5_EXECUTE') or die(_("Access Denied."));

  Loader::model('page');
  Loader::model('page_list');
  Loader::model('collection_version');
  Loader::model('blog','blog');
  Loader::model('blog_config','blog');
  Loader::model('blog_directory','blog');
  Loader::helper('date');
  Loader::helper('navigation');
  Loader::helper('dateutil','blog');

  $btID = $b->getBlockTypeID();
  $bt = BlockType::getByID($btID);
  $uh = Loader::helper('concrete/urls');
  $blogPageID = BlogModel::determineParentBlogPages($currentPageObject,true);
  $currentPage = Page::getCurrentPage();
?>

<!--<div class="ccm-blog-archive-rss">
  <a href="<?php  echo($controller->getRssUrl()) ?>"><img src="<?php  echo $uh->getBlockTypeAssetsURL($bt, 'rss.png')?>" width="14" height="14" alt="rss feed" /> <?php  echo blog_t('Subscribe') ?></a><br />
  <link href="<?php  echo $controller->getRssUrl() ?>" rel="alternate" type="application/rss+xml" title="<?php  echo blog_t('RSS') ?>" />
</div>-->

<h2>
  <?php 
    $archiveNamePrefix = '';
    if(trim(strlen($controller->ulName)) > 0 && $controller->ulName != "blog-archive"){
      $archiveNamePrefix = $controller->ulName;
    }
    echo blog_t('%s Archive', $archiveNamePrefix);
  ?>
</h2>

<ul class="ccm-blog-archive-list">
  <?php 
    if((int)$controller->blogcID > 0){
      $blogPage = Page::getByID($controller->blogcID);
    }elseif($controller->globalArchive){
      $blogPage = Page::getByID(1); //whew this could suck on large sites
      echo '<h2>'.blog_t('Site-Wide Blog Feed').'</h2>';
    }
    if(!is_object($blogPage)){  //we don't have a valid Page object yet
    $blogPageID = BlogModel::determineParentBlogPages($currentPageObject,true);
    if($blogPageID[0] > 1){ //we use this guy
      $blogPage = Page::getByID($blogPageID[0]);
    }else{ //we go to the main blog
      $blogPage = BlogModel::getBlogPageObject();
    }
    }
    //now we have a blogPage :)  unless the install is totally screwed.
    if(!$controller->globalArchive){
      /* Preload page objects */
      $yearsArray = array_map(create_function('$pageID', 'return Page::getByID($pageID);'), $blogPage->getCollectionChildrenArray(1));
      /* Ensure years are sorted properly */
      usort($yearsArray, create_function('$a, $b', 'return (int)$b->getCollectionName() - (int)$a->getCollectionName();'));
      
      $monthCount = $monthShow;
      $plistTrim = array();

      foreach($yearsArray as $year){
        /* Filter out future years */
        if(strtotime($year->getCollectionDatePublic()) < date('U')){
          $navSelectedClass = ($currentPage->getCollectionID() == $year->getCollectionID()) ? "nav-selected" : "";
          
          $yearURL = NavigationHelper::getLinkToCollection($year,true);

          /* Print year link, list tag closed after potential child months */
          printf('<li class="%s"><a class="%s" href="%s">%s</a>', $navSelectedClass, $navSelectedClass, $yearURL, $year->getCollectionName());

          $monthsArray = array_map(create_function('$pageID', 'return Page::getByID($pageID);'), $year->getCollectionChildrenArray(1)); 

          if(count($monthsArray) > 0) {
            /* Ensure months are sorted properly */
            usort($monthsArray, create_function('$a, $b', 'return (int)$a->getCollectionName() - (int)$b->getCollectionName();'));
            echo('<ul class="blog-month">');

            foreach($monthsArray as $month) {
              $navSelectedClass = ($currentPage->getCollectionID() == $month->getCollectionID()) ? "nav-selected" : "";
              if(strtotime($month->getCollectionDatePublic()) < date('U')) {
                $monthURL = NavigationHelper::getLinkToCollection($month,true);
                $monthName = DateUtilHelper::getMonthNameFromInt( sprintf('%02d', $month->getCollectionName()) );

                /* Print month link */
                printf('<li class="%s"><a class="%s" href="%s">%s</a></li>', $navSelectedClass, $navSelectedClass, $monthURL, $monthName);
              }
            }
            echo('</ul>');
          }
          echo('</li>');
        }
      }
    }
  ?>
</ul>
