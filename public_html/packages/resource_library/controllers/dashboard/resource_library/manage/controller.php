<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class DashboardResourceLibraryManageController extends Controller {
	// dashboard page for managing the Resource Library package

   public function view() {
   
   		/* 
   		 * A quick way to add a single page after the fact for this package:
   		 *
   		Loader::model('single_page');
   		Loader::model('package');
   		$pkg = Package::getByHandle('resource_library');
		SinglePage::add('/dashboard/resource_library/manage/list', $pkg);
		SinglePage::add('/dashboard/resource_library/manage/edit', $pkg);
		*/
		
		$this->redirect('/dashboard/resource_library/manage/list');
	}

}
?>