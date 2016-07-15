<?php
class Application {
    
    public $core;

    function __construct() {
        $this->core = new \Core();
        
        var_dump($this->core->interfaces);
    }

}