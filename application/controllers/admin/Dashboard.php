<?php
/* 
    Dashboard.php

*/

defined('BASEPATH') || exit('Direct script access not allowed!');

class Dashboard extends MY_Controller{  

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        echo "Dashboard";
        var_dump($_SESSION);
    }

}