<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
    email.php
    email configuration file
*/
$config['protocol'] = 'sendmail';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['smtp_host'] = 'smtp@gmail.com';
$config['smtp_port'] = 587;
$config['smtp_encryption'] = 'TLS';
$config['smtp_user'] = PASS_RECOVERY_EMAIL;
$config['smtp_pass'] = PASS_RECOVERY_PASSKEY;
$config['smtp_crypto'] = 'ssl';
$config['newline'] = '\r\n';
$config['mailtype'] = 'html';
$config['smtp_timeout'] = '7';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;


// $this->email->initialize($config);