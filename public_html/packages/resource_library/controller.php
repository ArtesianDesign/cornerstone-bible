<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class ResourceLibraryPackage extends Package {

	protected $pkgHandle = 'resource_library';
	protected $appVersionRequired = '5.3.0';
	protected $pkgVersion = '1.0'; 
	
	public function getPackageName() {
		return t("Resource Library"); 
	}	
	
	public function getPackageDescription() {
		return t("Manage a library of audio, visual and document resources. Great for lectures or sermons and their corresponding documents.");
	}
	
	public function install() {
		$pkg = parent::install();

        Loader::model('collection_types');
		Loader::model('single_page');
		
		// install blocks		
		BlockType::installBlockTypeFromPackage('resource_library_search', $pkg);
		
		// install page types
        $pdt = CollectionType::getByHandle('resource_library');
        if( !$pdt || !intval($pdt->getCollectionTypeID()) ){
            $data['ctHandle'] = 'resource_library';
            $data['ctName'] = t('Resource Library');
            $pdt = CollectionType::add($data, $pkg);
        }
		
		// install single pages
		SinglePage::add('/resources', $pkg);
		$rl = SinglePage::add('/dashboard/resource_library', $pkg);
		SinglePage::add('/dashboard/resource_library/add', $pkg);
		SinglePage::add('/dashboard/resource_library/manage', $pkg);
		SinglePage::add('/dashboard/resource_library/manage/list', $pkg);
		SinglePage::add('/dashboard/resource_library/manage/edit', $pkg);
      	$rl->update(array('cName'=>t('Resource Library'), 'cDescription'=>t('Manage audio, documents, etc.')));
	}

}