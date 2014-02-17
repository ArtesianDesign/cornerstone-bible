<?php 
 
class ApplicationUser extends Object {
 
	public function setupUserJoinInfo($ui) {  
		Loader::model('groups');
		$u = $ui->getUserObject(); 
		
		// add new user to groups
		$g1 = Group::getByName('unvalidated');
		$g2 = Group::getByName('Registered Users');
		if (is_object($g1)) { 
			echo 'unvalidated';
			$u->enterGroup($g1);
		}     
		
		if (is_object($g2)) { 
			$u->enterGroup($g2);
		}     
		
		// Notify admin that new user added
		$adminUserInfo=UserInfo::getByID(USER_SUPER_ID);
		$adminEmailAddress = $adminUserInfo->getUserEmail();
		
		$mh = Loader::helper('mail');
		$mh->addParameter('userName', $ui->getUserName());
		$mh->addParameter('userID', $ui->getUserID());
		$mh->to($adminEmailAddress . ', ibh@cornerstonebible.org, carlosc@cornerstonebible.org');
		$mh->load('notify_new_user_added');
		$mh->sendMail();      
	}

	//force add to Registered Users group?
	public function setupUserGroup($ui) {  
		Loader::model('groups');
		Loader::model('userinfo');
		//$u = $ui->getUserObject();
		 $u = Userinfo::getByID($ui->getUserID());
		
		// add new user to groups
		$g1 = Group::getByName('Registered Users');
		if (is_object($g1)) { 
			//print_r($ui);
		echo '<p style="color:red;">Remember to add user to groups</p>';
		$u->updateGroups( array($g1->getGroupID()) );
		$u->enterGroup($g1);
		}     
		
		// Notify user that they have been approved
		
		$mh = Loader::helper('mail');
		$mh->addParameter('userName', $ui->getUserName());
		$mh->to($u->getUserEmail());
		$mh->load('notify_user_approved');
		$mh->sendMail();      
	}
  
}
