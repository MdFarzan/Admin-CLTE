<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?php echo $page_title; ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <?php get_alert(); ?>
          </div>
          <div class="col-12">
          <?php echo form_open_multipart(htmlspecialchars(current_url()), ['method'=>'post'])?>
            <div class="card">
                <div class="card-header">
                  <h5 class="m-0">Title & Tagline</h5>
                </div>
              <div class="card-body">
                <div class="form-row">
                  
                  <div class="col-md-6 mb-3 px-md-3">
                    <label for="system-title">System Title</label>
                    <input type="text" name="system-title" class="form-control" id="system-title" 
                        value="<?php echo $site_settings['title']!=null?$site_settings['title']:''; ?>"  placeholder="" />
                    <p class="text-danger mb-0"><?php echo form_error('system-title') ?></p>
                  </div>
                  

                  <div class="col-md-6 mb-3 px-md-3">
                    <label for="system-title">Tagline</label>
                    <input type="text" name="system-tagline" class="form-control" id="system-tagline" 
                        value="<?php echo $site_settings['tagline']!=null?$site_settings['tagline']:''; ?>"  placeholder="" />
                    <p class="text-danger mb-0"><?php echo form_error('system-tagline') ?></p>
                  </div>
                  
                </div>
                
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Branding</h5>
              </div>
              <div class="card-body">
              
                <div class="form-row">
                  <div class="col-md-4 mb-3 px-md-3">
                    <label for="big-logo">Big Logo</label>
                    <p>Shown on sign in page</p>
                    <div class="siup" id="big-logo"></div>
                    <p class="text-danger mb-0"><?php echo $BIG_LOGO_ERROR ?></p>
                    
                  </div>
                  <div class="col-md-4 mb-3 px-md-3">
                    <label for="logo-icon">Logo icon</label>
                    <p>Shown in top left of admin panel</p>
                    <div class="siup" id="logo-icon"></div>
                    <p class="text-danger mb-0"><?php echo $LOGO_ICON_ERROR ?></p>
                  </div>
                  <div class="col-md-4 mb-3 px-md-3">
                    <label for="site">Site Icon</label>
                    <p>Shown in browser tab</p>
                    <div class="siup" id="site-icon"></div>
                    <p class="text-danger mb-0"><?php echo $SITE_ICON_ERROR ?></p>
                  </div>

                </div>
              <p class="mt-3 px-md-3 lead"><strong>Note: </strong>Site setting will be visible from next sign in.</p>
              </div>
            </div>

            <div class="card card-info card-outline">
              <div class="card-body">
                <a href="<?php echo base_url('admin/dashboard') ?>" onclick="return confirm('Do you want to back to Dashboard?')" class="btn btn-outline-danger">Back to Dashboard</a>
                <input type="submit" value="Update Settings" class="btn btn-primary float-right" />
              </div>
            </div>
            <?php echo form_close(); ?>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/siup/style.css'); ?>">
  <script src="<?php echo base_url('assets/plugins/siup/script.js'); ?>"></script>
  <script>
    
    SIUP.setAcceptFormats('.jpg,.jpeg,.png,.gif');

    const bigLogo = new SIUP('big-logo');
    const siteIcon = new SIUP('site-icon');
    const logoIcon = new SIUP('logo-icon');

    <?php 
      $url = base_url('/');
    ?>
    

    <?php 
    
      if($site_settings['big_logo_src'] != null)
        echo 'bigLogo.populate("'.$url.$site_settings['big_logo_src'].'")';
    ?>

    <?php 
      if($site_settings['logo_icon_src'] != null)
        echo 'logoIcon.populate("'.$url.$site_settings['logo_icon_src'].'")';
    ?>

  <?php 
      if($site_settings['site_icon_src'] != null)
        echo 'siteIcon.populate("'.$url.$site_settings['site_icon_src'].'")';  
    ?>

  </script>