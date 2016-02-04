<?php


namespace Model;

class Status {
 
    private $id,
            $user,
            $message,
            $date;
    
    function __construct($id, $user, $message, $date) {
        $this->id = $id;
        $this->user = $user;
        $this->message = $message;
        $this->date = new \DateTime($date);
    }
    
    function getId() {
        return $this->id;
    }

    function getUser() {
        return $this->user;
    }

    function getMessage() {
        return $this->message;
    }

    function getDate() {
        return $this->date->format('Y-m-d');
    }
}
