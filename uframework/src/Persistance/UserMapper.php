<?php

namespace Persistance;

use Model\User;
use DataBase\DataBase;

class UserMapper {
    
    private $conn;
    
    function __construct(DataBase $conn) {
        $this->conn = $conn;
    }
    
    function persist(User $user) {
        $requete = "INSERT INTO user(login, password) value(?,?)";
        $param = array(
            '1' => array($user->getLogin(), \PDO::PARAM_STR),
            '2' => array($user->getPassword(), \PDO::PARAM_STR)
        );
        $this->conn->prepareAndExecuterQuery($requete, $param); 
    }
    
    function remove($id) {
        $requete = "DELETE FROM user WHERE id=?";
        $param = array('1'=>array($id, \PDO::PARAM_INT));
        $this->conn->prepareAndExecuterQuery($requete, $param);
    }
}
