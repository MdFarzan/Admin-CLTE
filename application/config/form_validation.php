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
            'errors'=> array(
                'captcha_check' => 'Enter a valid captcha!'
            )
        ),

    ),

    
                
);

$config['error_prefix'] = '<p class="text-danger" style="font-size:14.5px;">';
$config['error_suffix'] = '</p>';