<?php

namespace Persistance;

use DataBase\DataBase;
use Model\Status;


class StatusMapper {

    private $conn;

    function __construct(DataBase $conn) {
        $this->conn = $conn;
    }

    function persist(Status $status) {
         $requete = "INSERT INTO statuses(user,message,date) value(?,?,?)";
         $param = array(
             '1' => array($status->getUser(), \PDO::PARAM_STR),
             '2' => array($status->getMessage(), \PDO::PARAM_STR),
             '3' => array($status->getDate(), \PDO::PARAM_STR)
         );
         $this->conn->prepareAndExecuterQuery($requete, $param);
    }

    function remove($id) {
        $requete = "DELETE FROM statuses WHERE id=?";
        $param = array('1'=>array($id, \PDO::PARAM_INT));
        $this->conn->prepareAndExecuterQuery($requete, $param);
    }
}
