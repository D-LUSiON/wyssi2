<?php

class Core {
    
    public $db;
    public $interfaces;

    function __construct() {
        $this->_autoloadModels();
        
        $this->_autoloadModules();
        
        $this->db = new \Models\Database();
    }
    
    private function _autoloadModels(){
        $core_models_dir = CORE_DIR . 'models';
        if (file_exists($core_models_dir)) {
            $core_models = scandir($core_models_dir);
            for ($i = 0; $i < count($core_models); $i++) {
                if (!in_array($core_models[$i], Array('.', '..'))) {
                    require $core_models_dir . DIRECTORY_SEPARATOR . $core_models[$i];
                }
            }
        }
        
        // load models for modules
        for ($i = 0; $i < count($this->modules); $i++) {
            $models_dir = MODULES_DIR . $this->modules[$i] . '/models';
            if (file_exists($models_dir)) {
                $models = scandir($models_dir);
                for ($j = 0; $j < count($models); $j++) {
                    if (!in_array($models[$j], Array('.', '..'))) {
                        require_once $models_dir . DIRECTORY_SEPARATOR . $models[$j];
                    }
                }
            }
        }
        
    }
    
    private function _autoloadModules(){
        $mods = scandir(MODULES_DIR);
        for ($i = 0; $i < count($mods); $i++) {
            if (!in_array($mods[$i], Array('.', '..'))) {
                $this->modules[] = $mods[$i];
            }
        }
    }
    
    /**
     * Gets from database registered interfaces
     * There are two types of interfaces:
     * - public - where the users see the web site
     * - administrative - where site administrators edit the content.
     * 
     * There can be many administrative interfaces for the admin roles - superuser, content editor & etc.
     * 
     * If there is a registered "admin" interface, it's address might be {site_root}/admin or {site_root}/administrator
     * There is a table in the DB that the path is defined.
     * 
     * Initially, when an interface is created, the path is defined in the configuration file
     * 
     * Note to myself: Think of creating superuser interface for managing modules and interfaces;
     * 
     */
    public function getRegisteredInterfaces(){
        $this->interfaces = $this->db->query(
                'SELECT interfaces.id, ' . 
                       'interfaces.title, ' .
                       'interfaces.sys_path, ' .
                       'types.* ' .
                'FROM `system_interfaces` AS interfaces ' .
                    'INNER JOIN `system_interface_types` AS types ' .
                        'ON interfaces.type = types.type_id',
        NULL, 'Models\Wyssi_interface');
    }
    
    public function getPublicInterfaces(){
        $this->interfaces = $this->db->query(
                'SELECT interfaces.id, ' . 
                       'interfaces.title, ' .
                       'interfaces.sys_path, ' .
                       'types.* ' .
                'FROM `system_interfaces` AS interfaces ' .
                    'INNER JOIN `system_interface_types` AS types ' .
                        'WHERE types.interface_type_title = `public`',
        NULL, 'Models\Wyssi_interface');
    }

}