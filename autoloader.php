<?php

spl_autoload_register( function($className) {

	// Check if classname has either Controller or Model in the name. 
	if ( strpos($className, 'Controller') !== false ) {
		// Set the dir of a controller application
		$filename = 'application\controllers\\';
	} elseif ( strpos($className, 'Model') !== false ) {
		// Set the dir of a model application
		$filename = 'application\models\\';
	} elseif ( strpos($className, 'Page') !== false ) {
		// Set the dir of a model application
		$filename = 'application\pages\\';
	}

	// Add $classname with extension to the filename
	$filename .= $className.'.php';
	
	if ( file_exists($filename) ) {
		include $filename;
	} elseif( strpos($className, 'Page') === false ) {
		throw new \Exception( 'No such class file: '.$filename );
	}

} );