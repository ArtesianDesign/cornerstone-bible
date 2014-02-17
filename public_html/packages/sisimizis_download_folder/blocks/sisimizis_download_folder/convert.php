<?php 
/**
* Convert filesize to kB/MB/GB  (function found on php.net forums, released by "xnavigator")
*/
function byteConvert( $bytes ) {
	if ($bytes<=0)
		return '0 Byte';
	$convention=1000; //[1000->10^x|1024->2^x]
	$s=array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB');
	$e=floor(log($bytes,$convention));
	return round($bytes/pow($convention,$e),2).' '.$s[$e];
}
?>