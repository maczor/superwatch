<?php

	function delTree($dir) { 
		$delfiles = array_diff(scandir($dir), array('.','..')); 
		foreach ($delfiles as $delfile) { 
			(is_dir("$dir/$delfile")) ? delTree("$dir/$delfile") : unlink("$dir/$delfile"); 
		} 
		return rmdir($dir); 
	}

	// *** Include the class
	include("resize-class.php");


	$sizes = array(
		'xs' => array(
			'crop' => true,
			'max_width' => 60,
			'max_height' => 60,
			'jpeg_quality' => 60
			),
		'201' => array(
			'crop' => true,
			'max_width' => 201,
			'max_height' => 201,
			'jpeg_quality' => 70
			),
		'235' => array(
			'crop' => true,
			'max_width' => 235,
			'max_height' => 235,
			'jpeg_quality' => 70
			),
		'thumbnail' => array(
			'crop' => true,
			'max_width' => 80,
			'max_height' => 80,
			'jpeg_quality' => 70
			)
		);

	// Remove folders
	foreach ($sizes as $key => $size) {
		if(is_dir('files/'.$key)) {
			delTree('files/'.$key);
		}
	}

	$files = array();
	if ($handle = opendir('files')) {
	    while (false !== ($entry = readdir($handle))) {
	        if ($entry != "." && $entry != ".." && $entry !='.DS_Store' && $entry !='.gitignore' && $entry !='.htaccess') {
	            array_push($files, $entry);
	        }
	    }
	    closedir($handle);
	}
		
	foreach ($sizes as $key => $size) {
		mkdir('files/'.$key);
	}

foreach ($files as $file) {

	// Initialise / load image
	echo 'files/'.$file.'<br>';
	$resizeObj = new resize('files/'.$file);

	foreach ($sizes as $key => $size) {

		// Resize image (options: exact, portrait, landscape, auto, crop)
		$resizeObj -> resizeImage($size['max_width'], $size['max_height'], 'exact');

		// Save image
		$resizeObj -> saveImage('files/'.$key.'/'.$file, $size['jpeg_quality']);
		echo 'files/'.$key.'/'.$file.'<br>';

	}
}

?>
