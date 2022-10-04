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
        $this->page_data['parent_menu'] = null;
        $this->page_data['current_menu'] = 'dashboard';

        $this->load->view('admin/partials/header.php', $this->page_data);
        $this->load->view('admin/partials/sidenav.php', $this->page_data);
        $this->load->view('admin/dashboard.php', $this->page_data);
        $this->load->view('admin/partials/footer.php');
    }

}