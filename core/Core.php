<?php

class Core {
    
    public $db;
    public $interfaces;

    function __construct() {
        $this->db = new \Models\Database();
        
        $this->getRegisteredInterfaces();
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
        $this->interfaces = $this->db->query('SELECT * FROM `core_interfaces`', NULL);
    }

}