<?php



$config = array(
    'admin_sign_in' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|valid_email'
        ),

        array(   'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[6]|max_length[15]'
        ),

        array(
            'field' => 'captcha-code',
            'label' => 'Captcha',
            'rules' => 'required|callback_captcha_check',
        ),

    ),

    'admin_password_recovery' => array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|valid_email|callback_is_email_exists'
            
            
        ),

        array(
            'field' => 'captcha-code',
            'label' => 'Captcha',
            'rules' => 'required|callback_captcha_check',
        ),

    ),

    'admin_password_reset' => array(
        array(   'field' => 'password',
            'label' => 'Password',
            'rules' => 'required|min_length[6]|max_length[15]'
        ),
        array(   'field' => 'otp',
            'label' => 'OTP',
            'rules' => 'required|callback_valid_otp'
        ),
    ),
    
                
);

$config['error_prefix'] = '<p class="text-danger" style="font-size:14.5px;">';
$config['error_suffix'] = '</p>';