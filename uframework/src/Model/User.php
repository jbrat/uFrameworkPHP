<?php

namespace Model;


class User {
    
    private $id;
    private $login;
    private $password;
    
    function __construct($id, $login, $password) {
        $this->id = $id;
        $this->login = $login;
        $this->password = password_hash($password,PASSWORD_DEFAULT);
    }
    
    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

}
