<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// since we have a session in Concrete5, we need to get session from script
$session_name = 'CONCRETE5';

if (!isset($_POST[$session_name])) {
    exit;
} else {
    session_id($_POST[$session_name]);
    session_start();
}

// Define a destination
$targetFolder = $_POST['DIR_BASE'] . '/audio'; // Relative to the root

$verifyToken = md5('resource_library_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('mp3'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1' . $tempFile = $_FILES['Filedata']['tmp_name'] . ' - ' . $targetFile;
	} else {
		echo 'Invalid file type.';
	}
}
?>