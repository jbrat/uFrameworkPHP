<?php

namespace Model;

use Persistance\StatusMapper;
use DataBase\DataBase;
use Model\Status;


class DBFinder implements FinderInterface {
    
    private $statusMapper;
    private $conn;
    function __construct() {
        $this->conn = new DataBase();
        $this->statusMapper = new StatusMapper($this->conn);
    }
    
    public function findAll() {
        
        $requete = "SELECT * FROM statuses";
        
        $this->conn->prepareAndExecuterQuery($requete, null);
        $resultat = $this->conn->getResult();
        $this->conn->destroyQueryResults();
        $statuses = array();
        foreach($resultat as $status) {
            $statuses[] = new Status($status['id'], $status['user'], $status['message'], $status['date']);            
        }
        return $statuses;
    }

    public function findOneById($id) {
        
        $requete = "SELECT * FROM statuses WHERE id=?"; 
        $param=array('1'=>array($id,\PDO::PARAM_INT));

        $this->conn->prepareAndExecuterQuery($requete, $param);
        $result = $this->conn->getResult()[0];
        $this->conn->destroyQueryResults();

        return new Status($result['id'], $result['user'], $result['message'], $result['date']);
    }
    
    public function addStatus($user,$message) {
        $status = new Status(null,$user,$message,date("Y-m-d H:i:s"));
        $this->statusMapper->persist($status);
        
    }
    
    public function deleteStatus($id) {
        if(!$this->findOneById($id)) {
            return -1;
        }
        $this->statusMapper->remove($id);
    }

}
