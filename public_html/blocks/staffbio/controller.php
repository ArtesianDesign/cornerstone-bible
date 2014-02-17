<? defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<?php
Loader::block('library_file');
$form = Loader::helper('form');
class StaffbioBlockController extends BlockController {

	protected $btInterfaceWidth = 400;
	protected $btInterfaceHeight = 520;
	protected $btTable = 'btStaffbio';

	public function getBlockTypeDescription() {
		return t("Adds a Staff Bio Block.");
	}
	
	public function getBlockTypeName() {
		return t("Staff Bio");
	}
	
	public function getJavaScriptStrings() {
		return array(
			'image-required' => t('You must select an image.')
		);
	}
	
	public function getSearchableContent() {
		$searchableContent = $this->name . ' ' . $this->title . ' ' . $this->description;
		return $searchableContent;
	}

	function getFileID() {return $this->fID;}
	function getFileObject() {
		return File::getByID($this->fID);
	}		
	function getName() {return $this->name;}
	function getTitle() {return $this->title;}
	function getDescription() {return $this->description;}
	function getIsStaff() {
		if ($this->staff == 1) {
			return 1;
		} else { return 0; }
	}
	function getIsElder() {
		if ($this->elder == 1) {
			return 1;
		} else { return 0; }
	}
		
	function save($args) {
		$args['staff'] = isset($args['staff']) ? 1 : 0;
		$args['elder'] = isset($args['elder']) ? $args['elder'] : 0;
		parent::save($args);
	}
}

?>