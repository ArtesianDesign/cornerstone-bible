<?php 
	Loader::block('library_file');

	defined('C5_EXECUTE') or die(_("Access Denied."));
	class SearchHighlighterBlockController extends BlockController {

		protected $btInterfaceWidth = 300;
		protected $btInterfaceHeight = 300;
		protected $btTable = 'btSearchHighlighter';

		/**
		 * Used for localization. If we want to localize the name/description we have to include this
		 */
		public function getBlockTypeDescription() {
			return t("Highlights search terms on a page when referred by search engine.");
		}

		public function getBlockTypeName() {
			return t("Search Highlighter");
		}

	public function on_page_view() {
         $html = Loader::helper('html');

         $v = View::GetInstance();

         $b = $this->getBlockObject();
         $btID = $b->getBlockTypeID();
         $bt = BlockType::getByID($btID);

         $url = Loader::helper('concrete/urls');

         $v->addHeaderItem('<style>.hilite1{ background-color:' . $this->color1 . '; } .hilite2{ background-color:' . $this->color2 . '; } .hilite3{ background-color:' . $this->color3 . '; } .hilite4{ background-color:' . $this->color4 . '; } .hilite5{ background-color:' . $this->color5 . '; } .hilite6{ background-color:' . $this->color6 . '; } .hilite7{ background-color:' . $this->color7 . '; } .hilite8{ background-color:' . $this->color8 . '; } .hilite9{ background-color:' . $this->color9 . '; } .hilite10{ background-color:' . $this->color10 . '; }</style>','CONTROLLER');
         $v->addHeaderItem('<script type="text/javascript" src="' . $url->getBlockTypeAssetsURL($bt) . '/search-highlighter.js"></script>','CONTROLLER');
	}

      function getBlockURL() {

       $b = $this->getBlockObject();
       $btID = $b->getBlockTypeID();
       $bt = BlockType::getByID($btID);
       $uh = Loader::helper('concrete/urls');
       $blockURL = $uh->getBlockTypeAssetsURL($bt);

      return $blockURL;

      }

    	function get_search_query() {
		$referer = urldecode($_SERVER['HTTP_REFERER']);
		$query_array = array();

		if ( preg_match('@^http://(.*)?\.?(google|yahoo|lycos).*@i', $referer) ) {
			$query =  preg_replace('/^.*(&q|query|p)=([^&]+)&?.*$/i','$2', $referer);
		}

		preg_match_all('/([^\s"\']+)|"([^"]*)"|\'([^\']*)\'/', $query, $query_array);

		return $query_array[0];
		}

		function getFileID() {return $this->fID;}

		function getFileObject() {
    		    return File::getByID($this->fID);
		}

		function getAssetFileObject() {
		    return LibraryFileBlockController::getFile($this->fID);
		}

		public function save($args) {
			$args['fID'] = ($args['fID'] != '') ? $args['fID'] : 0;
			parent::save($args);
		}
	}

?>