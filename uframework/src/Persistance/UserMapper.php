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
        $requete = "INSERT INTO user(login, password) value(:login,:password)";
        $param = array(
            'login'     => $user->getLogin(),
            'password'  => $user->getPassword()
        );
        $this->conn->prepareAndExecuteQuery($requete, $param); 
    }
    
    function remove($id) {
        $requete = "DELETE FROM user WHERE id= :id";
        $param = array('id' =>  $id);
        $this->conn->prepareAndExecuteQuery($requete, $param);
    }
}
