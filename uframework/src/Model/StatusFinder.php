<?php

namespace Model;

use DataBase\DataBase;
use Model\Status;


class StatusFinder implements FinderInterface {
    
    private $conn;
    function __construct(DataBase $conn) {
        $this->conn = $conn;
    }
    
    public function findAll() {
        
        $requete = "SELECT * FROM statuses";
        
        $this->conn->prepareAndExecuteQuery($requete, array());
        $resultat = $this->conn->getResult();
        $this->conn->destroyQueryResults();
        $statuses = array();
        foreach($resultat as $status) {
            $statuses[] = new Status($status['id'], $status['user'], $status['message'], $status['date']);            
        }
        return $statuses;
    }

    public function findOneById($id) {
        
        $requete = "SELECT * FROM statuses WHERE id=:id"; 
        $param=array('id' => $id);

        $this->conn->prepareAndExecuteQuery($requete, $param);
        $result = $this->conn->getResult()[0];
        $this->conn->destroyQueryResults();

        return new Status($result['id'], $result['user'], $result['message'], $result['date']);
    }
}
