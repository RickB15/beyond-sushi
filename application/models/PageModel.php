<?php 

class PageModel {

	public $baseUrl;

	public function set_baseUrl( string $baseUrl )
	{
		$this->baseUrl = $baseUrl;
	}

	public function set_pagename( string $pagename )
	{
		$this->pagename = $pagename;
	}

	public function set_pageVars( array $pageVars )
	{
		$this->pageVars = $pageVars;
	}
}