<?php     
/*
* Area Splitter Block for c5
*
* Written by Matias Gertel - http://www.codium.co.nz
*/
/*
* Version History:
* 1.0 - Initial release
* 1.0.1 - Fixed a minor bug in the aop hide override function.
*/
defined('C5_EXECUTE') or die(_("Access Denied."));

class MatogertelTagCloudPackage extends Package {

	protected $pkgHandle = 'matogertel_tag_cloud';
	protected $appVersionRequired = '5.3.3.1';
	protected $pkgVersion = '1.0';
	
	public function getPackageDescription() {
		return t("Make a tag cloud of your site.");
	}
	
	public function getPackageName() {
		return t("Tag Cloud");
	}
	
	public function install() {
		$pkg = parent::install();
		
		// install block		
		BlockType::installBlockTypeFromPackage('matogertel_tag_cloud_lite', $pkg);
		
	}
	
	
}