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
class BlogMemberMapper {

    public static function map(BlogMember $blogMember, array $properties) {
        if (array_key_exists('member_id', $properties)) {
            $blogMember->setId($properties['member_id']);
        }
        if (array_key_exists('username', $properties)) {
            $blogMember->setUsername($properties['username']);
        }
        if (array_key_exists('email', $properties)) {
            $blogMember->setEmail($properties['email']);
        }
         if (array_key_exists('password', $properties)) {
            $blogMember->setPassword($properties['password']);
        }


    }


}
