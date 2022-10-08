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
        $this->load->model('admin/site_model');
    }

    // for authentication 
    public function index(){

        $SITE_SETTINGS = $this->site_model->get_site_settings();
        $SITE_SETTINGS['big_logo_src'] = $SITE_SETTINGS['big_logo_src']!=null ? $SITE_SETTINGS['big_logo_src'] : 'assets/default-branding/big-logo-default.png';
        $SITE_SETTINGS['logo_icon_src'] = $SITE_SETTINGS['logo_icon_src'] !=null ? $SITE_SETTINGS['logo_icon_src'] : 'assets/default-branding/logo-icon-default.png';
        $SITE_SETTINGS['site_icon_src'] = $SITE_SETTINGS['site_icon_src'] !=null ? $SITE_SETTINGS['site_icon_src'] : 'assets/default-branding/site-icon-default.png';
        $SITE_SETTINGS['title'] = $SITE_SETTINGS['title']!=null ? $SITE_SETTINGS['title'] : 'Admin CLTE';
        $SITE_SETTINGS['tagline'] = $SITE_SETTINGS['tagline']!=null ? $SITE_SETTINGS['tagline'] : 'Developed by Md Farzan';
        $this->session->set_userdata('SITE_SETTINGS', $SITE_SETTINGS);
        
        check_auth(TRUE);

        if($this->input->method() == 'post'){

            if($this->form_validation->run('admin_sign_in') != FALSE){
                // from validation success

                $email = $this->input->post('email');
                $password  = $this->input->post('password');
                
                $data = $this->auth_model->get_admin_by_email($email);

                if(!empty($data)){

                    if(password_verify($password, $data['passkey'])){
                        // password matched
                        
                        $avtar = $data['avtar']!=null?$data['avtar']:PUBLIC_DIR.'avtars/default.png';

                        $session_data = [
                            'ADMIN_ID' => $data['id'],
                            'ADMIN_EMAIL' => $data['email'],
                            'ADMIN_NAME' => $data['name'],
                            'ADMIN_AVTAR' => base_url($avtar)
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

        if(empty($captcha)){
            $this->form_validation->set_message('captcha_check', 'Captcha cannot be empty!');
            return false;
        }

        else if($captcha == $code){
            return true;
        }

        else{
            $this->form_validation->set_message('captcha_check', 'Enter correct captcha!');
            return false;
        }
        
    }


    // for logout
    public function logout(){
        session_destroy();
        redirect(base_url('/admin'));
    }


    // password recovery
    public function forget_password(){
        
        if($this->input->method() == 'post'){

            if($this->form_validation->run('admin_password_recovery') != FALSE){

                $email = $this->input->post('email');
                $this->load->library('email');
                // For test set below condition to true and uncomment otp
                // $otp  = 1234;
                if($otp = $this->send_password_recovery_mail($email)){
                    

                    // email sent
                    $data = $this->auth_model->get_data_by_email($email);
                    $this->session->set_userdata('RECOVERY_USER_ID', $data['id']);
                    $this->session->set_userdata('RECOVERY_EXP', time() * 600);
                    $this->session->set_userdata('RECOVERY_OTP', $otp);
                    redirect(base_url('/admin/password-reset'));
                    
                }

                else{
                    // email not send
                    // it just removed on production
                    echo "email not sent! Please check configuration of mailer.<br>
                        It's not configured by default.";
                    die();
                }

            }

            else{
                // form validation failed
                $error = ['type'=>'failed', 'msg'=> 'Please correct below errors!'];
                        $this->session->set_flashdata('alert', $error);
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
        $this->load->view('admin/auth/password-recovery', $page_data);
    }


    // resetting password
    public function password_reset(){
        $user_id = $this->session->userdata('RECOVERY_USER_ID');
        $exp_time = $this->session->userdata('RECOVERY_EXP');
        
        if($this->input->method() == 'post'){
            if($this->form_validation->run('admin_password_reset') != FALSE){
                
                $password = $this->input->post('password');
                $password = password_hash($password, PASSWORD_BCRYPT);
                date_default_timezone_set('Asia/Kolkata');
                $data = ['passkey' => $password];
                $data['updated_at'] = date('Y-m-d H:i:s');

                $this->auth_model->update_admin_by_id($user_id, $data);
                
                $this->session->unset_userdata(['RECOVERY_USER_ID', 'RECOVERY_EXP']);
                $error = ['type'=>'success', 'msg'=> 'Password reset successfully!'];
                        $this->session->set_flashdata('alert', $error);

                redirect(base_url('/admin'));

            }   
            else{
                $error = ['type'=>'failed', 'msg'=> 'Please correct below errors!'];
                        $this->session->set_flashdata('alert', $error);
            }
        }

        
        // preventing direct access
        if($user_id !=null){
            $this->page_data['IS_EXPIRED'] = $exp_time < time()? true: false;
            $this->load->view('admin/auth/password-reset', $this->page_data);
        }

        else{
            redirect(base_url('admin/'));
        }

    }

    // callback to check user exist
    public function is_email_exists($email){

        $data = $this->auth_model->get_data_by_email($email);
        if(empty($email)){
            $this->form_validation->set_message('is_email_exists', 'Email is required!');
            return false;
        }
        else if(!empty($data)){
            return true;
        }
            
        else{
            $this->form_validation->set_message('is_email_exists', 'This email is not exist!');
            return false;
        }
            

    }


    // sending forget password email
    private function send_password_recovery_mail($email){

        $title = $this->session->userdata('SITE_SETTINGS')['title'];

        $this->email->from(PASS_RECOVERY_EMAIL, $title);
        $this->email->to($email);
        
        $this->email->subject($title. ' | Password reset email');
        $otp = $this->generate_otp();

        $body = 'Hi, Your password reset OTP is:  '.$otp.' .Valid only for 10 Minutes.';

        $this->email->message($body);

        if($this->email->send())
            return $otp;
        else
            return false;
        
    }


    // generating otp for password reset
    private function generate_otp(){
        $min = 1111;
        $max = 9999;
        return rand($min, $max);
    }


    // callback for validation otp on password reset
    public function valid_otp($otp){
        $server_otp = $this->session->userdata('RECOVERY_OTP');

        if(empty($otp)){
            $this->form_validation->set_message('valid_otp', 'OTP cannot be empty!');
            return false;
        }

        else if($server_otp == $otp){
            return true;
        }

        else{
            $this->form_validation->set_message('valid_otp', 'OTP not matched!');
            return false;
        }
    }
    // end of class
}