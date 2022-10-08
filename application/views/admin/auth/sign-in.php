<?php $SITE_SETTINGS = $this->session->userdata('SITE_SETTINGS'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $SITE_SETTINGS['title'] ?> | Sign in</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/style.css') ?>">
    <link rel="short icon" href="<?php echo base_url($this->session->userdata('SITE_SETTINGS')['site_icon_src']); ?>">    
    
</head>
<body>
    <div id="wrap">
        <div class="container">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-6 offset-xl-1 col-xl-5 p-4 p-sm-5 bg-white">
                <?php get_alert(); ?>
                    <h2 class="mb-5 form-title position-relative">Sign In</h2>
                    <?php echo form_open(current_url(), ['class'=>'custom-form', 'method'=>'post']); ?>
                        <div class="mb-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                                </div>
                                <input type="email" name="email" value="<?php echo set_value('email') ?>" class="form-control" placeholder="Email" required />
                            </div>
                        <?php echo form_error('email'); ?>
                        </div>

                        <div class="mb-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-key"></i></div>
                                </div>
                                <input type="password" name="password" value="<?php echo set_value('password') ?>" class="form-control" placeholder="Password" required />
                            </div>
                            <?php echo form_error('password') ?>
                        </div>

                        <div class="">
                            <div class="d-flex">
                                <?php echo $captcha_img; ?>
                                <input type="text" name="captcha-code" value="<?php echo set_value('captcha-code') ?>" class="form-control captcha-code" placeholder="Captcha" required />
                            </div>
                            <?php echo form_error('captcha-code'); ?>
                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary mt-2">SIGN IN</button>
                            <a href="<?php echo base_url('/admin/forget-password') ?>" class="float-right mt-3 mt-md-3">Forget Password</a>
                        </div>
                        
                    <?php echo form_close(); ?>
                </div>
                <div class="col-md-6 col-xl-5 p-1 d-flex bg-white align-items-center justify-content-center p-0" >
                        <a href="<?php echo base_url(); ?>">
                            <img src="<?php echo base_url($this->session->userdata('SITE_SETTINGS')['big_logo_src']); ?>" alt="logo" id="form-logo" class="img-fluid mb-2" />
                        </a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/popper/popper-umd.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
</body>
</html>