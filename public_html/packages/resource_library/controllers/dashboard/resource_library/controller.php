<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class DashboardResourceLibraryController extends Controller {

    function view() {
		$this->redirect('/dashboard/resource_library/add');
	}

}
?>