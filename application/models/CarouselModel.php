<?php
class CarouselModel {
    function get_carousel_items() {
        $db = new DatabaseController();

        $db->query('SELECT * FROM photos');
        if( $db->execute() && $db->resultset() ) 
        {
            return $db->resultset();
        }
    }
}