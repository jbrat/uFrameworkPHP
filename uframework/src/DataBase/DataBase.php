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

    public  function prepareAndExecuteQuery($query, array $parameters = []){
        $this->statement = $this->prepare($query);
        foreach($parameters as $name => $value){
            $this->statement->bindValue(':'.$name,$value);
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
