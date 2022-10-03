<?php
/* 
    Auth.php
    controls authentication for admin
*/

defined("BASEPATH") OR exit("No direct script access allowed");

class Auth extends CI_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->helper('captcha');
        $this->load->helper('misc');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('admin/auth_model');
    }

    // for authentication 
    public function index(){
        

        if($this->input->method() == 'post'){

            if($this->form_validation->run('admin_sign_in') != FALSE){
                // from validation success

                $email = $this->input->post('email');
                $password  = $this->input->post('password');
                
                $data = $this->auth_model->get_admin_by_email($email);

                if(!empty($data)){

                    if(password_verify($password, $data['passkey'])){
                        // password matched

                        $session_data = [
                            'ADMIN_ID' => $data['id'],
                            'ADMIN_EMAIL' => $data['email'],
                            'ADMIN_NAME' => $data['name']
                        ];

                        init_session($session_data);
                        redirect(base_url('admin/dashboard'));
                        
                    }
                    else{
                        $error = ['type'=>'failed', 'msg'=> 'Password not matched!'];
                        $this->session->set_flashdata('alert', $error);
                    }

                }
                else{
                    // email not matched
                    $error = ['type'=>'failed', 'msg'=> 'Email not found!'];
                        $this->session->set_flashdata('alert', $error);
                }
                
            }

        }


        $captcha_config = [
            'img_path' => './assets/captcha/',
            'img_url' => base_url('/assets/captcha/'),
            'font_path' => '/assets/fonts/Roboto-Regular.ttf',
            'font_size' => 30,
            'word_length' => 6,
            'img_width' => 140,
            'img_height' => 45
        ];

        $captcha = create_captcha($captcha_config);
        $this->session->set_userdata('captcha_code', $captcha['word']);
        
        $page_data["title"] = "Sign in";
        $page_data["captcha_img"] = $captcha['image'];

        $this->load->view("admin/auth/sign-in", $page_data);
    }

    
    // callback to test captcha
    public function captcha_check($captcha){
        $code = $this->session->userdata('captcha_code');
        $this->session->unset_userdata('captcha_code');
        return $captcha == $code ? true : false;
    }


    // for logout
    public function logout(){
        session_destroy();
        redirect(base_url('/admin'));
    }


    // end of class
}