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
        
        $this->page_data['page_title'] = 'Dashboard';

        $this->load->view('admin/partials/header.php', $this->page_data);
        $this->load->view('admin/partials/sidenav.php');
        $this->load->view('admin/dashboard.php');
        $this->load->view('admin/partials/footer.php');
    }

}