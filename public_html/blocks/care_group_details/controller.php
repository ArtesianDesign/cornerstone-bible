<?php defined('C5_EXECUTE') or die(_("Access Denied.")); ?>
<?php
Loader::block('library_file');
$form = Loader::helper('form');
Loader::helper('form/date_time');

class CareGroupDetailsBlockController extends BlockController {
	
	protected $btInterfaceWidth = 500;
	protected $btInterfaceHeight = 500;
	protected $btTable = 'btCareGroupDetails';

	public function getBlockTypeDescription() {
		return t("Custom block for listing care group details");
	}
	
	public function getBlockTypeName() {
		return t("Care Group Details");
	}
	
	public function getJavaScriptStrings() {
		return array(
			'image-required' => t('You must select an image.')
		);
	}
	
	/*function view () {
		$this->set('title', $this-title);
	}*/

	function getFileID() { return $this->cgPhoto; }
	function getFileObject() { return File::getByID($this->cgPhoto); }	
	function getName() { return $this->cgName; }
	function getLeaders() { return $this->cgLeaderNames; }
	function getRegionID() { return $this->regionID; }
	function getCityID() { return $this->cityID; }
	function getDateTime() { return $this->cgDateStamp; }
	function getTimeEnd() { return $this->cgTimeEnd; }
	function getEmail() { return $this->cgEmail; }
	function getPhone() { return $this->cgPhone; }
		
	/**** See eCommerce /product block for how to save to multiple databases ****/
		
	function save($args) {
	
		$args['cgDateStamp'] = FormDateTimeHelper::translate('cgDateStamp', $args);
		$args['cgTimeEnd'] = FormDateTimeHelper::translate('cgTimeEnd', $args);
		parent::save($args);
	}
}

?>