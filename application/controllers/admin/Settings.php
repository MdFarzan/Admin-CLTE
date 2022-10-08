<?php 
defined('BASEPATH') or exit('No direct script access allowed!');

class Settings extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('admin/site_model');
    }

    public function index(){

        $bigLogoError = $logoIconError = $siteIconError = '';

        if($this->input->method() == 'post'){

            $data = [];
            $sys_title = trim($this->input->post('system-title'));
            $sys_tagline = trim($this->input->post('system-tagline'));
            $data['title'] = $sys_title != '' ?$sys_title:null;
            $data['tagline'] = $sys_tagline != '' ? $sys_tagline:null;

            $config['upload_path'] = PUBLIC_DIR.'/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '2048';
            $config['overwrite'] = TRUE;

            // if big logo exists
            if($_FILES['big-logo']['size'] > 0){
                
                $config['file_name'] = 'big-logo';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('big-logo'))
                        $bigLogoError = $this->upload->display_errors();
                
                else{
                    $data['big_logo_src'] = PUBLIC_DIR.'/'. $this->upload->data()['file_name'];
                    echo "Big logo uploaded";
                }
                        
            }
            else{
                $BIG_LOGO_FLAG = $this->input->post('flag-big-logo');
                if($BIG_LOGO_FLAG == 1)
                  $data['big_logo_src'] = null;   
            }


            // if logo icon exists
            if($_FILES['logo-icon']['size'] > 0){

                $config['file_name'] = 'logo-icon';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('logo-icon'))
                    $logoIconError = $this->upload->display_errors();
                
                else{
                    $data['logo_icon_src'] = PUBLIC_DIR.'/'. $this->upload->data()['file_name'];
                }
                        
            }
            else{
                $LOGO_ICON_FLAG = $this->input->post('flag-logo-icon');

                if($LOGO_ICON_FLAG == 1)
                    $data['logo_icon_src'] = null;   
            }

            // if site icon exists
            if($_FILES['site-icon']['size'] > 0){
                
                $config['file_name'] = 'site-icon';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('site-icon'))
                    $logoIconError = $this->upload->display_errors();
                
                else{
                    $data['site_icon_src'] = PUBLIC_DIR.'/'. $this->upload->data()['file_name'];
                    
                }
                        
            }
            else{

                $SITE_ICON_FLAG = $this->input->post('flag-site-icon');
                if($SITE_ICON_FLAG == 1)
                    $data['site_icon_src'] = null;   
            }

            //  if no error then success
            if($bigLogoError == '' && $logoIconError == '' && $siteIconError == ''){
                $this->site_model->update_site_settings($data);
                
                $error = ['type'=>'success', 'msg'=> 'Settings saved successfully.'];
                $this->session->set_flashdata('alert', $error);
                redirect(site_url('/admin/settings'));

            }
            else{
                $error = ['type'=>'failed', 'msg'=> '<b>Failed!</> Please correct below errors!'];
                    $this->session->set_flashdata('alert', $error);
                    redirect(site_url('/admin/settings'));
            }
            


        }

        $site_settings = $this->site_model->get_site_settings();

        $this->page_data['page_title'] = 'Settings';
        $this->page_data['parent_menu'] = null;
        $this->page_data['current_menu'] = 'settings';

        $this->load->view('admin/partials/header.php', $this->page_data);
        $this->load->view('admin/partials/sidenav.php', $this->page_data);
        $this->page_data['BIG_LOGO_ERROR'] = $bigLogoError;
        $this->page_data['LOGO_ICON_ERROR'] = $logoIconError;
        $this->page_data['SITE_ICON_ERROR'] = $siteIconError;
        $this->page_data['site_settings'] = $site_settings;
        $this->load->view('admin/settings.php', $this->page_data);
        $this->load->view('admin/partials/footer.php');
    }
}

