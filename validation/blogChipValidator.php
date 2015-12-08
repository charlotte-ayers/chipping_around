<?php

/**
 * A class for validating the Flight bookings.
 * @author Richard Lovell
 */
class BlogChipValidator{
    
    public static function validate(BlogChip $blogChip){
        $errors = array();
        if(!trim($blogChip->getChipColour())){
            $errors[] = new Error('chip_colour', 'Chip Colour cannot be empty.');
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

