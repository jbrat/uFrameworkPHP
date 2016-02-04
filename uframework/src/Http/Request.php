<?php

namespace Http;

use \Negotiation\Negotiator;

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

        if($_SERVER['HTTP_CONTENT_TYPE']=="application/json" && $_SERVER['CONTENT_TYPE']=="application/json") {
            $data    = file_get_contents('php://input');
            $request = @json_decode($data, true);
            
            return new self($_GET,$request);
        }
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
    
    static function guessBestFormat() {
       
        $negotiator = new Negotiator();     
        $acceptHeader = $_SERVER['HTTP_ACCEPT'];    
        $priorities = array('text/html; charset=UTF-8', 'application/json');          
        $value = $negotiator->getBest($acceptHeader, $priorities)->getValue();
        
        switch ($value) {    
            case 'application/json':     
                return 'json';      
            break;     
            case 'text/html':     
                return 'html';      
            break;   
            default:
                $response = new Response("Erreur de format",404);
                $response->send();
            break;
        }
    }    
}
