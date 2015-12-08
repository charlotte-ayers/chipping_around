<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlightBookingMapper
 *
 * @author richard_lovell
 */
class BlogRestaurantMapper {

    public static function map(BlogRestaurant $blogPost, array $properties) {
       
        if (array_key_exists('name_of_restaurant', $properties)) {
            $blogPost->setNameOfRestaurant($properties['name_of_restaurant']);
        }
        if (array_key_exists('overall_rating', $properties)) {
            $blogPost->setOverallRating($properties['overall_rating']);
        }
    }

    private static function createDateTime($input) {
        return DateTime::createFromFormat('Y-n-j H:i:s', $input);
//        $date = explode('-', $input);
//        $time = mktime(0, 0, 0, $date[2], $date[1], $date[0]);
//        $mysqldate = date('Y-m-d H:i:s', $time);
//        return $mysqldate;
        //return date('d/m/Y', strtotime($input));
        //return new DateTime($input);//date('Y-m-d H:i:s', strtotime($input));
    }

}
