<?php

namespace Model;

use Persistance\StatusMapper;
use DataBase\DataBase;
use Model\Status;


class DBFinder implements FinderInterface {
    
    private $statusMapper;
    
    function __construct() {
        $this->statusMapper = new StatusMapper(new DataBase());
    }
    
    public function findAll($limit,$orderby) {
       return $this->statusMapper->getAllStatus($limit,$orderby);
    }

    public function findOneById($id) {
        return $this->statusMapper->getStatus($id);
    }
    
    public function addStatus($user,$message) {
        $status = new Status(null,$user,$message,date("Y-m-d H:i:s"));
        $this->statusMapper->addStatus($status);
        
    }
    
    public function deleteStatus($id) {
        if(!$this->findOneById($id)) {
            return -1;
        }
        $this->statusMapper->removeStatus($id);
    }

}
