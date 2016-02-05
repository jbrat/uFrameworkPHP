<?php

namespace Dispatcher;

trait EventDispatcherTrait
{
    private $events = [];
    
    public function addListener($name, $callable) {
        $this->events[$name][] = $callable;
    }
    
    public function dispatch($name, array $argument = []) {
        foreach($this->events[$name] as $callable) {
            call_user_func_array($callback, $arguments);
        }
    }
}
