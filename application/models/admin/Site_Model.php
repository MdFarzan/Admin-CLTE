<?php
/* 
    ** Site_Model.php
    contains site setting related models
*/

class Site_Model extends CI_Model{

    public function get_site_settings(){
        $data = $this->db->get('site_settings');
        return $data->row_array();
    }

    public function update_site_settings($data){
        $this->db->where('id', 1);
        $this->db->update('site_settings', $data);
        return $this->db->affected_rows();
        
    }

}