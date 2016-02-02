<?php

namespace Http;

class Request {

    const GET    = 'GET';
    const POST   = 'POST';
    const PUT    = 'PUT';
    const DELETE = 'DELETE';
    
    private $parameters;
    
    function __construct(array $query = array(), array $request = array()) {
        $this->parameters = array_merge($query,$request);
    }
    
    
    public function getParameter($name, $default = null)
    {
        return $this->parameters[$name] ?? $default;
    }
    
    
    static function createFromGlobals() {
        return new self($_GET,$_POST);
    }
    
    function getMethod() {
        $method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : self::GET;
        
        if (self::POST === $method) {
            return $this->getParameter('_method', $method);
        }
   
        return $method;
    }
    
    function getUri() {
        $uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        
        if ($pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        
        return $uri;
    }
    
}
