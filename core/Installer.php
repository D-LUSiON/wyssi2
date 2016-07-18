<?php

class Installer {
    
    public $installation;
    
    public $current_step;

    function __construct() {
        $this->core = new \Core();
        
        /*
         * 1. welcome screen
         * 2. DB connection data
         * 3. check if database exist if yes - drop it and enter definitions
         * 4. register admin account
         * 5. choose templates for public and admin
         * 6. collect website data - site name, owner, contact info and other optional data
         * 7. go to admin
         */
        
        /*
         * pass through steps to find where the user was last
         * 1. check if user has provided name data for the database access;
         * 2. check if the database is installed;
         * 3. check if there is superuser account;
         * 4. check if templates for the public and suser interfaces are defined;
         * 5. check if website data is collected;
         * 
         */
        
        $this->installation = unserialize($this->core->session['installation']);
        
        $this->_manageCurrentStep();
        
        if ($this->core->request_method == 'GET') {
            // showing interface
            switch ($this->current_step){
                case 'start':
                    //show start screen
                    $this->showDbDataForm();
                    break;
                default :
                    break;
            }
        } else if ($this->core->request_method == 'POST') {
            // saving provided data
            switch ($this->current_step){
                case 'start':
                    //save data for database
                    $this->saveDbDataForm();
                    break;
                default :
                    break;
            }
        }
    }
    
    private function _manageCurrentStep(){
        if (!$this->installation or !$this->installation->db_host or !$this->installation->db_name or !$this->installation->db_user or !$this->installation->db_pass) {
            $this->current_step = 'start';
        } else {
            // check if database exist
        }
    }
    
    public function showDbDataForm(){
        echo "Showing database data form...\n";
    }
    
    public function saveDbDataForm(){
        echo "Saving database data form...\n";
    }

}