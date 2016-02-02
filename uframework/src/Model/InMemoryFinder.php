<?php

namespace Model;

class InMemoryFinder implements FinderInterface
{
    
    private $data = array("Toto","titi","tutu");
    
    public function findAll(){
        return $this->data;
    }
    
    public function findOneById($id){   
        return $this->data[$id];    
    }
    
    
}
