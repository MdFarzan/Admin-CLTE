<?php 
/* 
    Profile.php
    contains profile setting for the admin
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->model('admin/profile_model');
    }

    public function index(){

        $id = $this->session->userdata('ADMIN_ID');
        $data = $this->profile_model->get_profile_by_id($id);

        $passwordError = '';
        $contactError = '';
        $imgError = '';

        if($this->input->method() == 'post'){

            $password = $this->input->post('password');
            $contact = $this->input->post('contact-no');
            $pass_len = strlen($password);
            $contact_len = strlen($contact);

            // validating password if exist
            if($pass_len !=0 && $pass_len < 6 || $pass_len > 15 ){
                $passwordError = 'Password must be 6 to 15 characters!';
            }
            else{

                // validating contact no if exist
                if($contact_len !=0 && $contact_len < 10 || $contact_len > 10 ){
                    $contactError = 'Enter valid 10 digit mobile no!';
                }

                else{

                    // all done validated
                    $data2 = [];
                    $data2['name'] = $this->input->post('full-name')!=''?$this->input->post('full-name'):null;
                    $data2['contact_no'] = $this->input->post('contact-no')!=''?$this->input->post('contact-no'):null;

                    if(strlen($password) > 0){
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        $data2['passkey'] = $password;
                    }

                    
                    if($_FILES['profile-img']['size']>0){
                        // image exist
                        $config['upload_path']   = PUBLIC_DIR.'avtars';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['max_size']      = 1024;
                        $config['max_width']     = 1024;
                        $config['max_height']    = 1024;
                        $config['file_name'] = $id.'-user-avtar';

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('profile-img')){
                                $imgError = $this->upload->display_errors();                                
                        }
                        else{
                        
                                $img_data = $this->upload->data();
                                
                                unlink($data['avtar']);
                                $data2['avtar'] = PUBLIC_DIR.'avtars/'.$img_data['file_name'];
                        }
                    }

                    else{
                        // is file flag is set
                        $data2['avtar'] = $this->input->post('profile-img-flag')!=''?$this->input->post('profile-img-flag'):null;

                    }

                    // is all ok then update
                    if($imgError == '' && $passwordError == '' && $contactError == ''){
                        date_default_timezone_set('Asia/Kolkata');
                        $data2['updated_at'] = date('Y-m-d H:i:s');
                        
                        $this->profile_model->update_profile_by_id($id, $data2);
                        $error = ['type'=>'success', 'msg'=> 'Profile updated successfully.'];
                        $this->session->set_flashdata('alert', $error);
                        redirect(site_url('/admin/profile'));
                        
                    }


                }
                         
            }

            // setting alert if has error
            if($imgError != '' || $passwordError != '' || $contactError != ''){
                    $error = ['type'=>'failed', 'msg'=> '<b>Failed,</b> Please correct below errors first!'];
                    $this->session->set_flashdata('alert', $error);
            }

            
        }

        $this->page_data['profile'] = $data;
        
        $this->page_data['page_title'] = 'Profile';
        $this->page_data['parent_menu'] = null;
        $this->page_data['current_menu'] = 'profile';
        $this->page_data['password_error'] = $passwordError;
        $this->page_data['contact_error'] = $contactError;
        $this->page_data['img_error'] = $imgError;

        $this->load->view('admin/partials/header.php', $this->page_data);
        $this->load->view('admin/partials/sidenav.php', $this->page_data);
        $this->load->view('admin/profile.php', $this->page_data);
        $this->load->view('admin/partials/footer.php');


    }

}