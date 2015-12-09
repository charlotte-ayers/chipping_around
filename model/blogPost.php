<?php

class BlogPost extends SimpleBlogPost{
        private $nameOfRestaurant;
    private $overallRating;
        private $username;
        function getNameOfRestaurant() {
            return $this->nameOfRestaurant;
        }

        function getOverallRating() {
            return $this->overallRating;
        }

        function getUsername() {
            return $this->username;
        }

        function setNameOfRestaurant($nameOfRestaurant) {
            $this->nameOfRestaurant = $nameOfRestaurant;
        }

        function setOverallRating($overallRating) {
            $this->overallRating = $overallRating;
        }

        function setUsername($username) {
            $this->username = $username;
        }


}
