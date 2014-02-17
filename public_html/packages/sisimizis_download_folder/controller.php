<?php   

defined('C5_EXECUTE') or die(_("Access Denied."));

class SisimizisDownloadFolderPackage extends Package {

	protected $pkgHandle = 'sisimizis_download_folder';
	protected $appVersionRequired = '5.3.0';
	protected $pkgVersion = '1.0'; 
	
	public function getPackageName() {
		return t("Sisimizi's Download Folder"); 
	}	
	
	public function getPackageDescription() {
		return t("List all files from a folder on your server and make them available for download.");
	}
	
	public function install() {
		$pkg = parent::install();
		
		// install block		
		BlockType::installBlockTypeFromPackage('sisimizis_download_folder', $pkg);		
	}

}