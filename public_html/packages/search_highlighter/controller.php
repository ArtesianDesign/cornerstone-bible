<?php 

defined('C5_EXECUTE') or die(_("Access Denied."));

class SearchHighlighterPackage extends Package {

	protected $pkgHandle = 'search_highlighter';
	protected $appVersionRequired = '5.2.0';
	protected $pkgVersion = '1.0';

	public function getPackageDescription() {
		return t("Highlights search terms on a page when referred by search engine.");
	}

	public function getPackageName() {
		return t("Search Highlighter");
	}

	public function install() {
		$pkg = parent::install();

		// install block
		BlockType::installBlockTypeFromPackage('search_highlighter', $pkg);

	}




}