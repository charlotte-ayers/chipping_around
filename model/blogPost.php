<?php

/**
 * Description of FlightBooking
 *
 * @author richard_lovell
 */
class BlogPost {

    private $id;
    private $date;
    private $content;
    private $createdBy;
    private $modifiedBy;
    private $description;
    private $nameOfRestaurant;
    private $overallRating;
    private $restaurant_id;
    private $username;
    private $status = self::PENDING;
    

    const PENDING = 'pending';
    const ACTIVE = 'active';
    const VOIDED = 'voided';

    function getId() {
        return $this->id;
    }

    function getDate() {
        return $this->date;
    }

    function getStatus() {
        return $this->status;
    }
    function getContent() {
        return $this->content;
    }
    function getCreatedBy() {
        return $this->createdBy;
    }
function getModifiedBy() {
        return $this->modifiedBy;
    }
    function getDescription() {
        return $this->description;
    }
        function getNameOfRestaurant() {
        return $this->nameOfRestaurant;
    }
    function getRestaurantId() {
        return $this->restaurant_id;
    }

    function getOverallRating() {
        return $this->overallRating;
    }
    function getUsername() {
        return $this->username;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setStatus($status) {
        $this->status = $status;
    }
    function setContent($content) {
        $this->content = $content;
    }
    function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }
        function setModifiedBy($modifiedBy) {
        $this->modifiedBy = $modifiedBy;
    }
            function setDescription($description) {
        $this->description = $description;
    }
        function setNameOfRestaurant($nameOfRestaurant) {
        $this->nameOfRestaurant = $nameOfRestaurant;
    }

    function setOverallRating($overallRating) {
        $this->overallRating = $overallRating;
    }
    function setRestaurantId($restaurant_id) {
        $this->restaurant_id = $restaurant_id;
    }
        function setUsername($username) {
        $this->username = $username;
    }

    public static function allStatuses() {
        return array(
            self::PENDING,
            self::ACTIVE,
            self::VOIDED
        );
    }

}
