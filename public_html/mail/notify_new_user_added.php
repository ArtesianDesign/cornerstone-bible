<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));

$subject = SITE . " " . t("cornerstonebible.org New User Registration");
$body = t("A new user has registered at cornerstonebible.org with the username %s:

Login to approve this user:
%s 


", $userName, BASE_URL . DIR_REL . View::url('dashboard/users/search?uID=') . $userID );

