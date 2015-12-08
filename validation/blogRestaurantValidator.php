<?php

/**
 * A class for validating the Flight bookings.
 * @author Richard Lovell
 */
class BlogRestaurantValidator{
    
    public static function validate(BlogRestaurant $blogRestaurant){
        $errors = array();
        if(!trim($blogRestaurant->getNameOfRestaurant())){
            $errors[] = new Error('name_of_restaurant', 'Name of Restaurant cannot be empty.');
        }
        return $errors;
    }
    
    /**
     * Validate the given status.
     * @param string $status status to be validated
     * @throws Exception if the status is not known
     */
//    public static function validateStatus($status) {
//        if (!self::isValidStatus($status)) {
//            throw new NotFoundException('Unknown status: ' . $status);
//        }
//    }
//    
//    private static function isValidStatus($status) {
//        return in_array($status, BlogPost::allStatuses());
//    }
}

