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
class BlogPostMapper {

    public static function map(BlogPost $blogPost, array $properties) {
        if (array_key_exists('blog_id', $properties)) {
            $blogPost->setId($properties['blog_id']);
        }
        if (array_key_exists('date', $properties)) {
            $formattedDate = $properties['date'];
            $date = self::createDateTime($formattedDate);
            if ($date) {
                $blogPost->setDate($date);
            }
        }
        if (array_key_exists('content', $properties)) {
            $blogPost->setContent($properties['content']);
        }
        if (array_key_exists('created_by', $properties)) {
            $blogPost->setCreatedBy($properties['created_by']);
        }
        if (array_key_exists('description', $properties)) {
            $blogPost->setDescription($properties['description']);
        }
        if (array_key_exists('modified_by', $properties)) {
            $blogPost->setModifiedBy($properties['modified_by']);
        }
                if (array_key_exists('name_of_restaurant', $properties)) {
            $blogPost->setNameOfRestaurant($properties['name_of_restaurant']);
        }
        if (array_key_exists('overall_rating', $properties)) {
            $blogPost->setOverallRating($properties['overall_rating']);
        }
        if (array_key_exists('restaurant_id', $properties)) {
            $blogPost->setRestaurantId($properties['restaurant_id']);
        }
        if (array_key_exists('username', $properties)) {
            $blogPost->setUsername($properties['username']);
        }
    }
public static function simpleMap(SimpleBlogPost $blogPost, array $properties) {
        if (array_key_exists('blog_id', $properties)) {
            $blogPost->setId((int)$properties['blog_id']);
        }
        if (array_key_exists('date', $properties)) {
            $formattedDate = $properties['date'];
            $date = self::createDateTime($formattedDate);
            if ($date) {
                $blogPost->setDate($date);
            }
        }
        if (array_key_exists('content', $properties)) {
            $blogPost->setContent($properties['content']);
        }
        if (array_key_exists('created_by', $properties)) {
            $blogPost->setCreatedBy($properties['created_by']);
        }
        if (array_key_exists('description', $properties)) {
            $blogPost->setDescription($properties['description']);
        }
        if (array_key_exists('modified_by', $properties)) {
            $blogPost->setModifiedBy($properties['modified_by']);
        }

        if (array_key_exists('restaurant_id', $properties)) {
            $blogPost->setRestaurantId($properties['restaurant_id']);
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
