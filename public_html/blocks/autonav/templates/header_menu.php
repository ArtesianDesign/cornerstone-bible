<?php 
	defined('C5_EXECUTE') or die(_("Access Denied."));
	$aBlocks = $controller->generateNav();
	$c = Page::getCurrentPage();
	echo("<ul class=\"nav-header\">");

	$nh = Loader::helper('navigation');

	$isFirst = true;
	foreach($aBlocks as $ni) {
		$_c = $ni->getCollectionObject();
		if (!$_c->getCollectionAttributeValue('exclude_nav')) {
		
			if ($ni->isActive($c) || strpos($c->getCollectionPath(), $_c->getCollectionPath()) === 0) {
				$navSelected='nav-selected';
			} else {
				$navSelected = '';
			}
			
			$pageLink = false;
			
			if ($_c->getCollectionAttributeValue('replace_link_with_first_in_nav')) {
				$subPage = $_c->getFirstChild();
				if ($subPage instanceof Page) {
					$pageLink = $nh->getLinkToCollection($subPage);
				}
			}
			
			if (!$pageLink) {
				$pageLink = $ni->getURL();
			}

			if ($isFirst) $isFirstClass = 'first';
			else $isFirstClass = '';
			if ( strlen($_c->getCollectionAttributeValue('nav_title')) ) {
				$linkText = $_c->getCollectionAttributeValue('nav_title');
			} else {
				$linkText = $ni->getName();
			}
			
			echo '<li class="'.$navSelected.' '.$isFirstClass.'">';
			
			//get custom link text
			if ($c->getCollectionID() == $_c->getCollectionID()) { 
				echo('<a class="nav-selected" href="' . $pageLink . '">' . $linkText . '</a>');
			} else {
				echo('<a href="' . $pageLink . '">' . $linkText . '</a>');
			}	
			
			echo('</li>');
			$isFirst = false;			
		}
	}
	
	echo('</ul>');
	echo('<div class="ccm-spacer">&nbsp;</div>');
?>