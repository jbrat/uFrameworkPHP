<?php


namespace Model;

class Status {
 
    private $id,
            $user,
            $message;
    
    function __construct($id, $user, $message) {
        $this->id = $id;
        $this->user = $user;
        $this->message = $message;
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

    function setId($id) {
        $this->id = $id;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setMessage($message) {
        $this->message = $message;
    }


}
