<?php  
defined('C5_EXECUTE') or die(_("Access Denied."));

$subject = SITE . " " . t("cornerstonebible.org Registration Approved");
$body = t("Dear %s,

Thank you for registering with www.cornerstonebible.org. Your registration has been approved.

Please visit the site and check out the forums and other features.
http://www.cornerstonebible.org

", $userName );

