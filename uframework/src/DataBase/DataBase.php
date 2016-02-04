<?php

namespace DataBase;

use PDO;

class DataBase {
    
    private $dbh = null,
    $statement;
    
    private $login = "uframework",
    $mdp = "p4ssw0rd",
    $DataBase = "uframework",
    $host = "localhost";

    public function __construct() {   
        $this->dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->DataBase.'',$this->login,$this->mdp); 
    }
    
    public function prepareAndExecuterQuery($requete, $param){

        $this->statement = $this->dbh->prepare($requete);

        if (isset($param) && $param!=null) {
            for ($i = 1; $i <= count($param); $i++) {
                $this->statement->bindParam($i, $param[$i][0], $param[$i][1]);
            }
        }
        $this->statement->execute();
    }

    public function getResult(){
          return $this->statement->fetchAll();   
    }     

    public function destroyQueryResults(){
        $this->$statement->closeCursor();
        $this->$statement=NULL;
    }   
}
