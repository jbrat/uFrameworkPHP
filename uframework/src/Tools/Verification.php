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
    
    /**
     * Method to check if it's a correct length for a tweet
     */
    static function checkTweetMessage($message) {
        if(strlen($message) <= 140) {
            return true;
        }
        return false;
    }
}
