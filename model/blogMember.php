<?php

class BlogMember {

    private $member_id;
    private $username;
    private $email;
    private $password;

    function getId() {
        return $this->member_id;
    }
    
    function getUsername() {
        return $this->username;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

        function setId($member_id) {
        $this->member_id = $member_id;
    }
    
    function setUsername($username) {
        $this->username = $username;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

}
