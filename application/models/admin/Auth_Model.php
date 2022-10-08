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

    public function get_data_by_email($email){
        $this->db->select('id, name, email, avtar, contact_no');
        $this->db->where('email', $email);
        $data = $this->db->get('admin_credentials')->row_array();
        return $data;
    }

    public function update_admin_by_id($id, $data){
        $this->db->where('id', $id);
        $this->db->update('admin_credentials', $data);
        return $this->db->affected_rows();
    }
}