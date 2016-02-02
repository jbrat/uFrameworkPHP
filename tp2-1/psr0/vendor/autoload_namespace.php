<?php

function autoload($class) {
        $nameSpace = explode('\\', $class);   
        $class = implode('/', $nameSpace);
        
        if(file_exists($class)) {
            require_once __DIR__."/".$class.'.php';
        } else {
            return false;
        }
    }

spl_autoload_register("autoload");
