<?php defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<?php
Loader::block('library_file');
$form = Loader::helper('form');

class HomeFeaturedLowerBlockController extends BlockController {

	protected $btInterfaceWidth = 500;
	protected $btInterfaceHeight = 500;
	protected $btTable = 'btHomeFeaturedLower';

	public function getBlockTypeDescription() {
		return t("Featured pages on lower portion of home page.");
	}
	
	public function getBlockTypeName() {
		return t("Home Featured Lower");
	}
	
	public function getJavaScriptStrings() {
		return array(
			'image-required' => t('You must select an image.')
		);
	}
	
	/*function view () {
		$this->set('title', $this-title);
	}*/

	function getFileID($blockNum) {
		switch ($blockNum) {
			case 1 :
				return $this->fIDOne;
				break;
			case 2 :
				return $this->fIDTwo;
				break;
			case 3 :
				return $this->fIDThree;
				break;
			case 4 :
				return $this->fIDFour;
				break;
		}
	}
	
	
	function getFileObject($blockNum) {
		switch ($blockNum) {
			case 1 :
				return File::getByID($this->fIDOne);
				break;
			case 2 :
				return File::getByID($this->fIDTwo);
				break;
			case 3 :
				return File::getByID($this->fIDThree);
				break;
			case 4 :
				return File::getByID($this->fIDFour);
				break;
		}
	}	
	
		
	function getTitle($blockNum) {
		switch ($blockNum) {
			case 1 :
				return $this->titleOne;
				break;
			case 2 :
				return $this->titleTwo;
				break;
			case 3 :
				return $this->titleThree;
				break;
			case 4 :
				return $this->titleFour;
				break;
		}
	}
	
	function getLinkedURL($pageID) {
		$page   = Page::getById($pageID);
	    return $page->getCollectionPath();  
	}
		
	function save($args) {
		//$args['textcolor'] = isset($args['textcolor']) ? 'fff' : 'fff';
		parent::save($args);
	}
}

?>