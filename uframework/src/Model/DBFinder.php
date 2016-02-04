<?php

namespace Model;

use DataBase\DataBase;

class DBFinder implements FinderInterface {
    
    public function findAll() {
       $database = new DataBase();
       $database->prepareAndExecuterQuery("SHOW TABLES", null);
       var_dump($database->getResult());
    }

    public function findOneById($id) {
        
    }
    
    public function addStatus() {
        
    }
    
    public function deleteStatus($id) {

    }

}
