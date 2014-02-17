<?php  
	defined('C5_EXECUTE') or die(_("Access Denied."));
	
	class MatogertelTagCloudLiteBlockController extends BlockController {
		
		protected $btTable = 'btMatogertelTagCloudLite';
		protected $btInterfaceWidth = "300";
		protected $btInterfaceHeight = "300";
		
		public function getBlockTypeDescription() {
			return t("Create a Tag Cloud of your website");
		}
		
		public function getBlockTypeName() {
			return t("Tag Cloud Lite");
		}
		
		public function save($data) {
			if (is_array($data['akIDs'])) {
				$data['akIDs'] = implode(",",$data['akIDs']);
			}
			$data['maxTags'] = (int) $data['maxTags'];
			if (!$data['link_to']) $data['link_to_cID'] = 0;
			parent::save($data);
		}
		
		public function getCollectionSelectAttributes() {
			Loader::model('attribute/categories/collection');
			$searchFieldAttributes = CollectionAttributeKey::getList();
			$validAttributes = array();
			//filter unsopported attributes untill we fix them
			foreach($searchFieldAttributes as $ak) {
				$type = $ak->getAttributeKeyType()->getAttributeTypeHandle();
				if (!in_array($type,array('select'))) continue;
				$validAttributes[] = $ak;
			}
			return $validAttributes;
		}
		
		public function getPossibleOrders() {
			return array('random'=>t('Random'),
				'size_asc'=>t('By Weight Ascending'),
				'size_desc'=>t('By Weight Descending'),
				'word_asc'=>t('By Tag Ascending'),
				'word_desc'=>t('By Tag Descending'));
		}
		
		public function local_inc($filename) {
			$dir1 = dirname(__FILE__);
			$dir2 = DIR_FILES_BLOCK_TYPES . '/' .$this->btHandle;
			if (file_exists($dir1."/".$filename)) {
				include_once($dir1."/".$filename);
			}
			elseif ($dir1 != $dir2) {
				include_once($dir2."/".$filename);
			}
		}
		
		public function getQuery() {
			if ($this->akIDs != "") {
				$w = "aso.akID in (".$this->akIDs.")";
			}
			else {
				$w = "0";
			}
			
			$query = "select aso.value as word,count(aso.ID) as size 
				from 
				atSelectOptionsSelected asos, 
				atSelectOptions aso,
				CollectionAttributeValues cav
			where 
				asos.avID = cav.avID
				AND aso.ID = asos.atSelectOptionID 
				AND cav.cvID in (select cv.cvID from Pages p1 inner join CollectionVersions cv on cv.cID = p1.cID WHERE cvIsApproved=1 AND p1.cIsTemplate = 0)
				AND {$w}
			group by 
				aso.ID
			order by size desc 
			";			
			
			if ($this->maxTags>0) {
				$query .= " limit ".$this->maxTags;
			}
			return $query;
		}
		
		public function add() {
			$this->set('maxTags',20);
		}
		
		public function view() {
			$validAttributes = $this->getCollectionSelectAttributes();
			$this->local_inc("inc/wordcloud.class.php");
			$query = $this->getQuery();
			$allWords = Loader::db()->getAll($query);
			$cloud = new wordCloudLite();
			foreach ($allWords as $word) {
				$cloud->addWord($word);
			}
			$order = explode("_",$this->tagOrder);
			if ($order[0] != "" && $order[0] != "random") {
				$cloud->orderBy($order[0],$order[1]);
			}
			$stopwords = array();
			foreach ($stopwords as $word) {
				$word = trim($word);
				$cloud->removeWord($word);
			}
			$myCloud = $cloud->showCloud('array');
			
			if ($this->link_to_cID>0) {
				$nh = Loader::helper('navigation');
				$sc = Page::getById($this->link_to_cID);
				if ($sc->getCollectionId()>0) {
					$path = $nh->getLinkToCollection($sc);
					foreach ($myCloud as $i=>$word) {
						//note tag search is buggy in 5.3.3, so this feature is disabled until 5.4
						$myCloud[$i]['link'] = $path."?query=".urlencode($word['word']);
					}							
				}
			}
			
			$this->set('tags',$myCloud);
			
			
		}
	
	}
	
?>