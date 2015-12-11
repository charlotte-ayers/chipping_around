<?php

/**
 * A class for validating the Flight bookings.
 * @author Richard Lovell
 */
class BlogMemberValidator {

    public static function validate(BlogMember $blogMember) {
        $errors = array();
        if (!trim($blogMember->getUsername())) {
            $errors[] = new Error('username', 'Username cannot be empty.');
        }
        if (!trim($blogMember->getPassword())) {
            $errors[] = new Error('password', 'Password cannot be empty.');
        }
        if (!trim($blogMember->getEmail())) {
            $errors[] = new Error('email', 'Email cannot be empty.');
        }
        return $errors;
    }
    
//    public static function validate(BlogMember $blogMember) {
//        $errors = array();
//        if (!trim($blogMember->getPassword())) {
//            $errors[] = new Error('password', 'Password cannot be empty.');
//        }
//        return $errors;
//    }

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

