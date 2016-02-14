<?php

namespace Persistance;

use DataBase\DataBase;
use Model\User;


class UserFinder {
    
    private $conn;
    
    
    function __construct(DataBase $conn) {
        $this->conn = $conn;   
    }
    
    function findOneById($id) {
        
        $requete = "SELECT * FROM user WHERE id=:id"; 
        $param = array('id' => $id);

        $this->conn->prepareAndExecuteQuery($requete, $param);
        $result = $this->conn->getResult()[0];
        $this->conn->destroyQueryResults();

        return new User($result['id'], $result['login'], $result['password']);
    }
    
    function findOneByLogin($login) {
        $requete = "SELECT * FROM user WHERE login=:login";
        $param = array('login' => $login);
        
        $this->conn->prepareAndExecuteQuery($requete, $param);
        $result = $this->conn->getResult()[0];
        $this->conn->destroyQueryResults();
        
        return new User($result['id'], $result['login'], $result['password']);
    }
    
}
