<?php

/**
 * Description of FlightBooking
 *
 * @author richard_lovell
 */
class BlogRestaurant {

    private $id;
    private $nameOfRestaurant;
    private $overallRating;
    private $date;
    private $status = self::PENDING;

    const PENDING = 'pending';
    const ACTIVE = 'active';
    const VOIDED = 'voided';

    function getId() {
        return $this->id;
    }

    function getNameOfRestaurant() {
        return $this->nameOfRestaurant;
    }

    function getOverallRating() {
        return $this->overallRating;
    }

    function getDate() {
        return $this->date;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNameOfRestaurant($nameOfRestaurant) {
        $this->nameOfRestaurant = $nameOfRestaurant;
    }

    function setOverallRating($overallRating) {
        $this->overallRating = $overallRating;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    public static function allStatuses() {
        return array(
            self::PENDING,
            self::ACTIVE,
            self::VOIDED
        );
    }

}
