<?php

/**
 * A class for validating the Flight bookings.
 * @author Richard Lovell
 */
class BlogPostValidator{
    
    public static function validate(BlogPost $blogPost){
        $errors = array();
//        if(!trim($blogPost->getDate())){
//            $errors[] = new Error('date', 'Date cannot be empty.');
//        }
        return $errors;
    }
    
    /**
     * Validate the given status.
     * @param string $status status to be validated
     * @throws Exception if the status is not known
     */
    public static function validateStatus($status) {
        if (!self::isValidStatus($status)) {
            throw new NotFoundException('Unknown status: ' . $status);
        }
    }
    
    private static function isValidStatus($status) {
        return in_array($status, BlogPost::allStatuses());
    }
}

