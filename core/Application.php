<?php
class Application {
    
    public $core;
    public $url;
    public $controller_name;
    public $method_name;
    public $controller_file;
    public $controller;
    public $request;
    public $interface;
    public $modules;

    function __construct() {
        $this->core = new \Core();
        
        $this->core->getRegisteredInterfaces();
        
        $this->_manageRequest();
        
        $this->_setInterface();
        
        $this->_setController();
        
        if (method_exists($this->controller, $this->method_name)) {
            $this->controller->{$this->method_name}($this->request, $this->errorText);
        } else {
            http_response_code(404);
            echo 'method not found!<br/>';
        }
    }
    
    private function _manageRequest(){
        $this->url = explode('/', strtolower(rtrim($_REQUEST['url'], '/')));
        $query = Array();
        foreach ($_REQUEST as $key=>$value) {
            if ($key != 'url')
                $query[$key] = $_REQUEST[$key];
        }
        $this->request['_server'] = $_SERVER;
        $this->request = $query;
    }
    
    private function _setInterface(){
        for ($i = 0; $i < count($this->core->interfaces); $i++) {
            if ($this->url[0] == $this->core->interfaces[$i]->sys_path) {
                $this->interface = $this->core->interfaces[$i];
            }
        }
        
        if ($this->interface == NULL) {
            for ($i = 0; $i < count($this->core->interfaces); $i++) {
                if ($this->core->interfaces[$i]->interface_type_title == 'public') {
                    $this->interface = $this->core->interfaces[$i];
                    continue;
                }
            }
        }
        
        if ($this->url[0] == $this->interface->sys_path) {
            array_splice($this->url, 0, 1);
        }
    }
    
    private function _setController(){
        $this->controller_name = ucfirst(
            (isset($this->url[0]))? $this->url[0] : 'index'
        );
        $this->method_name = ucfirst(
            (isset($this->url[1]))? $this->url[1] : 'index'
        );
        
        $this->controller_file = CORE_DIR . 'controllers' . ($this->interface->sys_path == ''? '' : DIRECTORY_SEPARATOR . $this->interface->sys_path) . DIRECTORY_SEPARATOR . $this->controller_name . '.php';
        
        if (!file_exists($this->controller_file)) {
            $this->controller_file = MODULES_DIR . lcfirst($this->controller_name) . ($this->interface->sys_path == ''? '' : DIRECTORY_SEPARATOR . $this->interface->sys_path) . DIRECTORY_SEPARATOR . $this->controller_name . '.php';
            
            if (!file_exists($this->controller_file)) {
                // not found
                http_response_code(404);
                $this->errorText = 'Controller "' . $this->controller_name . '" not found!';
                $this->controller_file = 'core' . DIRECTORY_SEPARATOR . 'controllers' . ($this->interface->sys_path == ''? '' : DIRECTORY_SEPARATOR . $this->interface->sys_path) . DIRECTORY_SEPARATOR . 'Error.php';
                $this->controller_name = 'Error';
            }
        }
        
        require $this->controller_file;
        
        $this->controller_name = 'Controllers\\' . $this->controller_name;
        
        $this->controller = new $this->controller_name;
    }

}