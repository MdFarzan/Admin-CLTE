<?php
/* 
    Dashboard.php

*/

defined('BASEPATH') || exit('Direct script access not allowed!');

class Dashboard extends CI_Controller{  

    public function index(){
        echo "Dashboard";
        $this->load->library('session');
        var_dump($_SESSION);
                        die();
    }

}