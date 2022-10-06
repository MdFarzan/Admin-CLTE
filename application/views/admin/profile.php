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
                  <h5 class="m-0">Credentials</h5>
                </div>
              <div class="card-body">
                <div class="form-row">
                  <div class="col-md-6 mb-3 px-md-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" 
                        value="<?php echo $profile['email'] ?>" readonly />
                  </div>

                  <div class="col-md-6 mb-3 px-md-3">
                    <label for="password">Password</label>
                    <input type="Password" name="password" class="form-control" id="password" 
                        value=""  placeholder="Leave for no change" />
                    <p class="text-danger mb-0"><?php echo $password_error; ?></p>
                  </div>
                  
                </div>
                <div class="form-row">
                  <div class="col-md-3 mb-3 px-md-3">
                    <label for="last-update">Last Update</label>
                    <input type="date" class="form-control" id="last-update"
                       value="<?php echo $profile['last_update_date'] ?>" readonly />
                  </div>
                  <div class="col-md-3 mb-3 px-md-3">
                    <label for="updated-at">At</label>
                    <input type="time" value="<?php echo $profile['last_update_time'] ?>"
                     class="form-control" id="updated-at" readonly>
                  </div>
                </div>
                
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Personal Details</h5>
              </div>
              <div class="card-body">
              
                <div class="form-row">
                  <div class="col-md-4 mb-3 px-md-3">
                    <label for="full-name">Full Name</label>
                    <input type="text" class="form-control" name="full-name" id="full-name"
                       value="<?php echo $profile['name'] ?>">
                  </div>
                  <div class="col-md-4 mb-3 px-md-3">
                    <label for="contact-no">Contact No</label>
                    <input type="tel" class="form-control" name="contact-no" 
                      value="<?php echo $profile['contact_no'] ?>" id="contact-no" value="Mark" >
                    <p class="text-danger mb-0"><?php echo $contact_error; ?></p>
                  </div>
                  <div class="col-md-4 mb-3 px-md-3">
                  </div>


                  <div class="col-md-4 mb-3 px-md-3">
                  <div class="img-upload">
                    <label for="">Profile Image</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                          <input type="hidden" name="profile-img-flag" value="">
                          <input type="file" name="profile-img" data-preview-id="profile-img" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                          <label class="custom-file-label" for="inputGroupFile01">
                            Choose Image
                          </label>
                        </div>
                      </div>
                      <p class="text-danger mb-0 file-error"><?php echo $img_error; ?></p>
                    </div>
                    <div class="img-upload-preview" id="profile-img"
                       data-not-img="<?php echo base_url('/assets/plugins/image-upload-preview/image-icon.png'); ?>"
                       data-base-url="<?php echo base_url(); ?>"
                       >
                    </div>

                  </div>
                </div>

              </div>
            </div>

            <div class="card card-info card-outline">
              <div class="card-body">
                <a href="<?php echo base_url('admin/dashboard') ?>" onclick="return confirm('Do you want to back to Dashboard?')" class="btn btn-outline-danger">Back to Dashboard</a>
                <input type="submit" value="Update Profile" class="btn btn-primary float-right" />
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
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/image-upload-preview/iup.css'); ?>">
  <script src="<?php echo base_url('assets/plugins/image-upload-preview/iup.js'); ?>">
    
  </script>
  <script>
    <?php 
    /* repopulating uploaded image */
      if($profile['avtar'] != null){
    ?>
      populateUpload('profile-img', '<?php echo $profile['avtar'] ?>');
    <?php 
      }
    ?>
    
  </script>