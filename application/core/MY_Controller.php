<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
    MY_Controller.php
    Must be extended controllers that uses admin authentication
*/

class MY_Controller extends CI_Controller{
    
    protected $page_data;

    public function __construct(){
        
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('misc');
        check_auth();
        
    }

}