<?php
namespace Tools;

class Verification {
    
    /**
     * Method to check if the parameter is an Integer
     */
    static function checkInteger($param) {
       
        if(isset($param) && is_numeric($param)) { 
            return true;
        } else {
            return false;
        }
    }
}
