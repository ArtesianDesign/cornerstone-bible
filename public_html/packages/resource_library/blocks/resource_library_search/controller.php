<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class ResourceLibrarySearchBlockController extends BlockController {

	protected $btName = "Resources Library Search + Listing";
	protected $btDescription = "List or search from resources library";
	protected $btInterfaceWidth = 400;
	protected $btInterfaceHeight = 400;
	protected $btTable = 'btResourceLibrarySearch';
	
	
	public function search_speaker() {
		print 'I am running!';
	}
	
	
	function view() {
		$c = Page::getCurrentPage();
		$this->set('title', $this->title);
		$this->set('buttonText', $this->buttonText);	
		
		//auto target is the form action that is used if none is explicity set by the user
		$autoTarget= $c->getCollectionPath();
				
		$resultTargetURL = ($this->resultsURL != '') ? $this->resultsURL : $autoTarget;			
		$this->set('resultTargetURL', $resultTargetURL);

		//run query if display results elsewhere not set, or the cID of this page is set
		//if( !empty($_REQUEST['year'])) {
			$this->do_search();
		//}						
	}
	
	
	function save($data) {
		$args['title'] = isset($data['title']) ? $data['title'] : '';
		$args['buttonText'] = isset($data['buttonText']) ? $data['buttonText'] : '';
		$args['resultsURL'] = ( $data['externalTarget']==1 && strlen($data['resultsURL'])>0 ) ? trim($data['resultsURL']) : '';
		parent::save($args);
	}
	
	public $reservedParams=array('page=','query=','submit=');
	
	function do_search($yearA = NULL, $speakerA = NULL, $seriesA = NULL, $referenceA = NULL) {
		Loader::model('resource_library', 'resource_library');
		
		//change this to get current year
		if (empty($_REQUEST['year'])) { $year = date('Y'); }
		else { $year=$_REQUEST['year']; }
		
		  $this->set('year', $year);

		//ResourceLibrary::getSermons(speaker_id, searies_id, year)
		if ($audioRecords = ResourceLibrary::getSermons(NULL, NULL, $year)) {
		  $this->set('audioRecords', $audioRecords);
		} else {
		  $year = intval($year) - 1;
		  $audioRecords = ResourceLibrary::getSermons(NULL, NULL, $year);
  		$this->set('audioRecords', $audioRecords);
		}
				
	} //!END function do_search()
	
}
?>
