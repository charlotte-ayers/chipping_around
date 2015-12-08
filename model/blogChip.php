<?php

/**
 * Description of FlightBooking
 *
 * @author richard_lovell
 */
class BlogChip {

    private $id;
    private $date;
    private $status = self::PENDING;
    private $chipColour;
    private $chipCrunch;
    private $chipConsistency;
    private $chipCondiments;
    private $chipCash;
    private $chipCharisma;

    const PENDING = 'pending';
    const ACTIVE = 'active';
    const VOIDED = 'voided';

    function getId() {
        return $this->id;
    }

    function getChipColour() {
        return $this->chipColour;
    }

    function getChipCrunch() {
        return $this->chipCrunch;
    }

    function getChipCondiments() {
        return $this->chipCondiments;
    }

    function getChipConsistency() {
        return $this->chipConsistency;
    }

    function getChipCash() {
        return $this->chipCash;
    }

    function getChipCharisma() {
        return $this->chipCharisma;
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

    function setChipColour($chipColour) {
        $this->chipColour = $chipColour;
    }

    function setChipCrunch($chipCrunch) {
        $this->chipCrunch = $chipCrunch;
    }

    function setChipConsistency($chipConsistency) {
        $this->chipConsistency = $chipConsistency;
    }

    function setChipCondiments($chipCondiments) {
        $this->chipCondiments = $chipCondiments;
    }

    function setChipCash($chipCash) {
        $this->chipCash = $chipCash;
    }

    function setChipCharisma($chipCharisma) {
        $this->chipCharisma = $chipCharisma;
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
