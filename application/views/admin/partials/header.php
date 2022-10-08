<?php $SITE_SETTINGS = $this->session->userdata('SITE_SETTINGS'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $SITE_SETTINGS['title'] . ' | ' . $page_title; ?></title>
  <link rel="short icon" href="<?php echo base_url($SITE_SETTINGS['site_icon_src']); ?>">    

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css'); ?>">
  <!-- Theme Customization -->
  <link rel="stylesheet" href="<?php echo base_url('assets/styles/adminlte.css'); ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link text-dark">
          Hello, <?php echo $this->session->userdata('ADMIN_NAME')?$this->session->userdata('ADMIN_NAME'):'Super Admin'; ?>
        </a>
      </li>
      
    </ul>
    
    <!-- right nav links starts -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" title="Full Screen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>      
      <!-- Profile Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-1">
          <div class="profile-avtar">
            
            <img src="<?php echo $this->session->userdata('ADMIN_AVTAR') ?>" class="img-fluid" alt="profile" /> 
          </div>
          <span class="h-6 dropdown-item dropdown-header">
            <h5 class="mb-1 lead admin-title">Hello, <?php echo $this->session->userdata('ADMIN_NAME') !=null ?$this->session->userdata('ADMIN_NAME'): 'Super Admin' ?></h5>
          </span>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('/admin/profile'); ?>" class="dropdown-item <?php echo $current_menu=='profile'?' active':''; ?>">
          <i class="fas fa-user-cog mr-2"></i> Profile Setting
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-cogs mr-2"></i></i> Site Setting
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url(); ?>" class="dropdown-item">
            <i class="fas fa-arrow-left mr-2"></i> Back to Site
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('/admin/logout'); ?>" class="btn btn-warning dropdown-item dropdown-footer">LOGOUT</a>
        </div>
      </li>
    </ul>

    <!-- right nav links end -->
</nav>