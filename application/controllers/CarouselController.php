<?php
class CarouselController extends CarouselModel {
    public function __construct()
	{
		if( !isset($_SESSION) )
		{
            session_start();
        }
        
    }  

    public function make_carousel()
    {
        return $this->get_carousel_items();
    }

}