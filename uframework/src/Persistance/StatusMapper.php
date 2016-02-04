<?php

namespace Persistance;

use DataBase\DataBase;
use Model\Status;
use Tools\Verification;
use PDO;

class StatusMapper {

    private $conn;

    function __construct(DataBase $conn) {
        $this->conn = $conn;
    }

    function addStatus(Status $status) {
         $requete = "INSERT INTO statuses(user,message,date) value(?,?,?)";
         $param = array(
             '1' => array($status->getUser(), PDO::PARAM_STR),
             '2' => array($status->getMessage(), PDO::PARAM_STR),
             '3' => array($status->getDate(), PDO::PARAM_STR)
         );
         $this->conn->prepareAndExecuterQuery($requete, $param);
    }

    function removeStatus($id) {
        $requete = "DELETE FROM statuses WHERE id=?";
        $param = array('1'=>array($id,PDO::PARAM_INT));
        $this->conn->prepareAndExecuterQuery($requete, $param);
    }

    function getStatus($id) {

        $requete = "SELECT * FROM statuses WHERE id=?"; 
        $param=array('1'=>array($id,PDO::PARAM_INT));

        $this->conn->prepareAndExecuterQuery($requete, $param);
        $result = $this->conn->getResult()[0];
        $this->conn->destroyQueryResults();

        return new Status($result['id'], $result['user'], $result['message'], $result['date']);
    }

    function getAllStatus($limit,$orderby) {
        
        $requete = "SELECT * FROM statuses";
        
        if(!$limit && !$orderby) { 
                $param = null;
        } else {
            $param = array();
            
            if(Verification::checkInteger($limit)) {
                $requete .=" LIMIT 0,?";  
                $param[0] = array($limit,PDO::PARAM_INT);
            }
            if($orderby) {
                $requete .=" ORDER BY ?";
                $param[1] = array($orderby,PDO::PARAM_STR);
            }
        }
        
        $this->conn->prepareAndExecuterQuery($requete, $param);
        $resultat = $this->conn->getResult();
        $this->conn->destroyQueryResults();
        $statuses = array();
        foreach($resultat as $status) {
            $statuses[] = new Status($status['id'], $status['user'], $status['message'], $status['date']);            
        }
        return $statuses;
    }

}
