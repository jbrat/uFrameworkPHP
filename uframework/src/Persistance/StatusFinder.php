<?php

namespace Persistance;

use DataBase\DataBase;
use Model\Status;
use Persistance\FinderInterface;


class StatusFinder implements FinderInterface {
    
    private $conn;
    function __construct(DataBase $conn) {
        $this->conn = $conn;
    }
    
    public function findAll($filtre) {

        $requete = "SELECT * FROM statuses";
        $param = array();

        if($filtre['orderby'] && $filtre['typeOrder']) {
            $requete .= " ORDER BY ".$filtre['orderby']." ".$filtre['typeOrder'];
        }
        
        if($filtre['limit']) {
            $requete .= " LIMIT ".intval($filtre['limit']);   
        }

        $this->conn->prepareAndExecuteQuery($requete,$param);
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
        $param = array('id' => $id);

        $this->conn->prepareAndExecuteQuery($requete, $param);
        $result = $this->conn->getResult()[0];
        $this->conn->destroyQueryResults();

        return new Status($result['id'], $result['user'], $result['message'], $result['date']);
    }
}
