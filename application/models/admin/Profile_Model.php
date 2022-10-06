<?php
/* 
    Profile_Model.php
    to handle user profile changes
*/

class Profile_Model extends CI_Model{
    
    public function get_profile_by_id($id){
        $this->db->select('email, name, avtar, contact_no, DATE(updated_at) as last_update_date, TIME(updated_at) as last_update_time');
        $this->db->where('id', $id);
        $query = $this->db->get('admin_credentials');
        return $query->row_array();
    }

    public function update_profile_by_id($id, $data){
        $this->db->where('id', $id);
        $this->db->update('admin_credentials', $data);
        return  $this->db->affected_rows();
    }
}

