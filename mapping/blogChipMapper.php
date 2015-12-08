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
class BlogChipMapper {

    public static function map(BlogChip $blogChip, array $properties) {
       
        if (array_key_exists('chip_colour', $properties)) {
            $blogChip->setChipColour($properties['chip_colour']);
        }
        if (array_key_exists('chip_crunch', $properties)) {
            $blogChip->setChipCrunch($properties['chip_crunch']);
        }
        if (array_key_exists('chip_consistency', $properties)) {
            $blogChip->setChipConsistency($properties['chip_consistency']);
        }
        if (array_key_exists('chip_condiments', $properties)) {
            $blogChip->setChipCondiments($properties['chip_condiments']);
        }
        if (array_key_exists('chip_cash', $properties)) {
            $blogChip->setChipCash($properties['chip_cash']);
        }
        if (array_key_exists('chip_charisma', $properties)) {
            $blogChip->setChipCharisma($properties['chip_charisma']);
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
