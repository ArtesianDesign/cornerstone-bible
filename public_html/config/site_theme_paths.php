<?php  

defined('C5_EXECUTE') or die(_("Access Denied."));


/* 
	you can override system layouts here  - but we're not going to by default 
	
	For example: if you would like to theme your login page with the Green Salad theme,
	you would uncomment the lines below and change the second argument of setThemeByPath 
	to be the handle of the the Green Salad theme "greensalad" 

*/


$v = View::getInstance();

$v->setThemeByPath('/login', "cfbc_2010");
$v->setThemeByPath('/page-not-found', "cfbc_2010");
$v->setThemeByPath('/page_not_found', "cfbc_2010");
$v->setThemeByPath('/404', "cfbc_2010");
$v->setThemeByPath('/403', "cfbc_2010");
$v->setThemeByPath('/register', "cfbc_2010");
//$v->setThemeByPath('/dashboard', "yourtheme");

