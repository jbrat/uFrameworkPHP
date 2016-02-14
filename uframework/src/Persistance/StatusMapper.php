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
         $requete = "INSERT INTO statuses(id, user, message, date) value(:id, :user, :message, :date)";
         $param = array(
             'id'       => $status->getId(),
             'user'     => $status->getUser(),
             'message'  => $status->getMessage(),
             'date'     => $status->getDate()
         );
         $this->conn->prepareAndExecuteQuery($requete, $param);
    }

    function remove($id) {
        $requete = "DELETE FROM statuses WHERE id=:id";
        $param = array('id'  => $id);
        $this->conn->prepareAndExecuteQuery($requete, $param);
    }
}
