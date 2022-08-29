<?php
include APPPATH.'config/routes.php';
class PageController extends PageModel {
	/*
	 * public constructor method
	 * @param array $urlArr
	 * @return void
	 * 
	 * Standard constructor method. Called when PageController is instantiated.
	 */
	public function __construct( $urlArr )
	{
		if ( $urlArr['baseUrl'] ) $this->set_baseUrl($urlArr['baseUrl']);
		if ( $urlArr['pagename'] ) $this->set_pagename($urlArr['pagename']);
		if ( $urlArr['pageVars'] ) $this->set_pageVars($urlArr['pageVars']);
		$this->get_header();
	}

	public function get_header()
	{
		$this->set_pageObj();

		$this->get_template();
	}

	private function set_pageObj()
	{
		$pagename = ( isset($this->pagename) ? $this->pagename : 'home' );
		$objName = ucfirst($pagename) . 'Page';
		if( file_exists(APPPATH . 'pages\\' . $objName . '.php') )
		{
			$this->pageObj = new $objName();
		}
	}

	private function get_part( $file )
	{	
		$filename = VIEWPATH . 'components\\' . $file . '.phtml';
		if ( file_exists($filename) )
		{
			include $filename;
		}
		else
		 {
			die('No such file: '.$filename);
		}
	}

	private function get_template()
	{
		$head = (file_exists(VIEWPATH.'layout\head.phtml')) ? VIEWPATH.'layout\head.phtml' : '';
		$header = (file_exists(VIEWPATH.'layout\header.phtml')) ? VIEWPATH.'layout\header.phtml' : '';
		$footer = (file_exists(VIEWPATH.'layout\footer.phtml')) ? VIEWPATH.'layout\footer.phtml' : '';

		// $home = (file_exists(VIEWPATH.'template\pages\home.phtml')) ? VIEWPATH.'template\pages\home.phtml' : '';
		// $sushi = (file_exists(VIEWPATH.'template\pages\sushi.phtml')) ? VIEWPATH.'template\pages\sushi.phtml' : '';
		// $wraps_soups = (file_exists(VIEWPATH.'template\pages\wraps_soups.phtml')) ? VIEWPATH.'template\pages\wraps_soups.phtml' : '';
		// $contact = (file_exists(VIEWPATH.'template\pages\contact.phtml')) ? VIEWPATH.'template\pages\contact.phtml' : '';

		$pagename = ( isset($this->pagename) ? $this->pagename : 'home' );

		// $filenames = array($home, $sushi, $wraps_soups, $contact);
		$filename = VIEWPATH.'template\pages\\' . $pagename . '.phtml';

		$carouselItems = $this->get_carousel_items();

		if ( file_exists($filename) )
		{
			include VIEWPATH . 'template\skeleton' . '.phtml';
		}
		else
		{
			include VIEWPATH . 'errors\error-404.html';
		}
	}

	private function get_carousel_items()
	{
		$serverName = "localhost";
        $userName = "root";
        $password = "password";
        $databaseName = "beyond_sushi";

        $conn = mysqli_connect($serverName, $userName, $password, $databaseName) or die("Database is niet werkzaam");

        $query = "SELECT * FROM `photos`";

        $result = mysqli_query($conn, $query);

		$records = mysqli_fetch_all($result, MYSQLI_ASSOC);

		if( !empty($records) ){
			return $records;
		}
		return NULL;
	}
}