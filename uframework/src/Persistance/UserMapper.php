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
        $requete = "INSERT INTO user(id, login, password) value(:id, :login,:password)";
        $param = array(
            'id'        => $user->getId(),
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
