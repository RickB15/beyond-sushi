<?php
include 'autoloader.php';

$application_folder = 'application';
$resources_folder = '\resources\main';
$view_folder = '';

// De naam van DIT bestand
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
// Het pad naar DIT bestand
define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

// Het pad naar de "application" folder
if (is_dir($application_folder))
{
	if (($_temp = realpath($application_folder)) !== FALSE)
	{
		$application_folder = $_temp;
	}
	else
	{
		$application_folder = strtr(
			rtrim($application_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
}
else
{
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'De applicatie folder is niet goed gezet. Open dit bestand om het aan te passen: '.SELF;
	exit(3); // EXIT_CONFIG
}

define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);

// Het pad naar de "views" folder
if ( ! isset($view_folder[0]) && is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
{
	$view_folder = APPPATH.'views';
}
elseif (is_dir($view_folder))
{
	if (($_temp = realpath($view_folder)) !== FALSE)
	{
		$view_folder = $_temp;
	}
	else
	{
		$view_folder = strtr(
			rtrim($view_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
}
elseif (is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
{
	$view_folder = APPPATH.strtr(
		trim($view_folder, '/\\'),
		'/\\',
		DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
	);
}
else
{
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo 'De view folder is niet goed gezet. Open dit bestand om het aan te passen: '.SELF;
	exit(3); // EXIT_CONFIG
}

define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);

define('IMGPATH', $resources_folder . '\img' . DIRECTORY_SEPARATOR);
define('JSPATH', $resources_folder . '\js' . DIRECTORY_SEPARATOR);
define('CSSPATH', $resources_folder . '\style\css' . DIRECTORY_SEPARATOR);

$app = new ApplicationController();