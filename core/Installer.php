<?php

class Installer {

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
         * 1. check if user has provided name user and pass for the database;
         * 2. check if the database is installed;
         * 3. check if there is superuser account;
         * 4. check if templates for the public and suser interfaces are defined;
         * 5. check if website data is collected;
         * 
         */
    }

}
