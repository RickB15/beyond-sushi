<?php
class ApplicationController extends ApplicationModel {

	public function __construct()
	{
		// $parsed_url = parse_url($url, PHP_URL_PATH);
		$this->parse_url( '/examen-opdarcht/' );
		
		$this->set_pageObj( new PageController( $this->urlArr ) );
	}

	/*
	 * private parse_url method
	 * @return array
	 */
	private function parse_url( $baseUrl ) 
	{
		// Remove the baseurl from the whole url.
		// Using the REDIRECT_URL or the REQUEST_URI, depending on if REDIRECT_URL is set. 
		$varStr 	= substr(parse_url((isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : $_SERVER['REQUEST_URI']), PHP_URL_PATH), 1);
		// Make an array out of it by splitting the string on the /
		$urlVars 	= (strpos($varStr, '/') !== false ? explode('/', $varStr) : array($varStr)) ;
		// Count the amount of variables
		$count 		= count($urlVars);

		// Set the variables to false to avoid "undefined variables" error
		$urlArr['baseUrl'] = $baseUrl;
		$urlArr['pagename']	= false;
		$urlArr['pageVars']	= false;

		// Check if last value of the array has a file extension. 
		// If it does, stop this method. 
		if (strpos(end($urlVars), '.') !== false) return;

		// If the array count is more than 0 means that there are vars to be parsed
		if ( $count > 0 )
		{

			// For loop, runs as long as the count is high
			for ( $i = 0; $i < $count; $i++ )
			{
				// If the variable is empty, it can be skipped. 
				if ( !empty( $urlVars[ $i ] ) )
				{
					// First value is used as pagename
					// Else it is considered a page variable
					if ( $i == 0 )  $urlArr['pagename'] = $urlVars[ $i ];
					else $urlArr['pageVars'][ $i ] = $urlVars[ $i ];
				}
			}
		}

		// Calling the set_urlArr method from the ApplicationModel
		$this->set_urlArr($urlArr);
	}
}