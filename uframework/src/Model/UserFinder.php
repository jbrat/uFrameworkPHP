<?php

namespace Model;

use DataBase\DataBase;
use Model\User;

class UserFinder {
    
    private $conn;
    
    
    function __construct(DataBase $conn) {
        $this->conn = $conn;   
    }
    
    function findOneById($id) {
        
        $requete = "SELECT * FROM user WHERE id=?"; 
        $param=array('1'=>array($id,\PDO::PARAM_INT));

        $this->conn->prepareAndExecuterQuery($requete, $param);
        $result = $this->conn->getResult()[0];
        $this->conn->destroyQueryResults();

        return new User($result['id'], $result['login'], $result['password']);
    }
    
    function findOneByLogin($login) {
        $requete = "SELECT * FROM user WHERE login=?";
        $param = array('1'=>array($login,PDO::PARAM_STR));
        
        $this->conn->prepareAndExecuterQuery($requete, $param);
        $result = $this->conn->getResult()[0];
        $this->conn->destroyQueryResults();
        
        return new User($result['id'], $result['login'], $result['password']);
    }
    
}
