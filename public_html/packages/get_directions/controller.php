<?php 
defined('C5_EXECUTE') or die(_("Access Denied."));
class GetDirectionsPackage extends Package {
	protected $pkgHandle = 'get_directions';
	protected $appVersionRequired = '5.2.0';
	protected $pkgVersion = '1.0b';
	public
	function getPackageDescription() {
		return t("Get Google driving directions to a preset location from a user-entered address.");
	}
	public
	function getPackageName() {
		return t("Get Directions");
	}
	public
	function install() {
		$pkg = parent::install();
		// install block
		BlockType::installBlockTypeFromPackage('get_directions', $pkg);
	}
}
