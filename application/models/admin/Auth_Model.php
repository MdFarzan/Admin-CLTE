<?php 
/* 
    Auth_Model.php
    contains authentication related models
*/

class Auth_Model extends CI_Model{

    // get user for authentication
    public function get_admin_by_email($email){
        $this->db->where('email', $email);
        $data = $this->db->get('admin_credentials')->row_array();
        return $data;
    }
}