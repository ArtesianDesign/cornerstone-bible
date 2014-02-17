<?php 
	defined('C5_EXECUTE') or die(_("Access Denied."));
	class SisimizisDownloadFolderBlockController extends BlockController {
		
		var $pobj;
		
		protected $btTable = 'btSisimizisDownloadFolder';
		protected $btInterfaceWidth = "580";
		protected $btInterfaceHeight = "420";
		
		public $sortBy = "2";
		public $sortOrder = "1";
		public $showSize = "1";
		public $showDate = "1";
		public $showIcon = "1";
		public $title = "";

		/** 
		 * Used for localization. If we want to localize the name/description we have to include this
		 */
		public function getBlockTypeDescription() {
			return t("List all files from a folder on your server and make them available for download.");
		}
			
		public function getBlockTypeName() {
			return t("Sisimizi's Download Folder");
		}
		
		function save($data) { 
			$args['relpath'] = isset($data['relpath']) ? $data['relpath'] : '';
			$args['subdomain'] = isset($data['subdomain']) ? $data['subdomain'] : '';
			$args['sortBy'] = (in_array($data['sortBy'], array("0", "1", "2"))) ? intval($data['sortBy']) : 2 ;
			$args['sortOrder'] = ($data['sortOrder']==1) ? 1 : 0;
			$args['showSize'] = ($data['showSize']==1) ? 1 : 0;
			$args['showDate'] = ($data['showDate']==1) ? 1 : 0;
			$args['showIcon'] = ($data['showIcon']==1) ? 1 : 0;
			$args['title'] = isset($data['title']) ? $data['title'] : '';
			parent::save($args);
		}		
		
	}
	
?>