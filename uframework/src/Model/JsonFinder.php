<?php

namespace Model;
use Model\FinderInterface;

class JsonFinder implements FinderInterface{
    
    private $path = "status.json";
    
    public function findAll() {
        $data = file_get_contents($this->path);
        return json_decode($data,true);
        
    }
    
    public function findOneById($id) {
        $data = file_get_contents($this->path);
        $tab = json_decode($data,true);
        foreach($tab as $statut) {
            if($statut['id']=$id) {
                return $statut;
            }
        }
    }
    
    public function writeStatus($user,$message) {
        $data = $this->findAll();
        $id = count($data)+2;
        $arrayStatus = array('id'=>$id,'user'=>$user,'message'=>$message);
        $data[] = $arrayStatus;
        file_put_contents($this->path, json_encode($data));
        
    }
    
    public function deleteStatus($id) {
        $data = file_get_contents($this->path);
        $tab = json_decode($data,true);
        if(count($tab)<$id) {
            return -1;
        }
        $tab[$id-1] = null;
        file_put_contents($this->path, json_encode($tab));
        
    }
}
