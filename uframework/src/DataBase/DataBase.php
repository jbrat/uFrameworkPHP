<?php

namespace DataBase;

use PDO;
use App;

class DataBase extends PDO {
    
    private $statement;
    
    public function __construct() { 
       
       $paramDataBase = App::getDataBaseInformation();
       parent::__construct($paramDataBase['dsn'], $paramDataBase['user'], $paramDataBase['password']);
    }
    
    public function prepareAndExecuterQuery($requete, $param){

        $this->statement = $this->prepare($requete);
        
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
        $this->statement->closeCursor();
        $this->statement=NULL;
    }   
}
