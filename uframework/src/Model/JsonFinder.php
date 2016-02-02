<?php

namespace Model;
use Model\FinderInterface;

class JsonFinder implements FinderInterface{
    
    private $path = "status.json";
    
    public function findAll() {
        $data = file_get_contents($this->path);
        $tab = json_decode($data,true);
        return array_filter($tab); 
    }
    
    public function findOneById($id) {
        $tab = $this->findAll();
        return $tab[$id];

    }
    
    public function writeStatus($user,$message) {
        $data = $this->findAll();
        $id = count($data)+1;
        $arrayStatus = array('id'=>$id,'user'=>$user,'message'=>$message);
        $data[] = $arrayStatus;
        file_put_contents($this->path, json_encode($data));
        
    }
    
    public function deleteStatus($id) {
        $tab = $this->findAll();
        if(!isset($tab[$id-1])) {
            return -1;
        }
      
        $tab[$id-1]="";
        file_put_contents($this->path, json_encode($tab));
        
    }
}
