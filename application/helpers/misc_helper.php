<?php
    /* 
        misc.php
        contains miscellaneous helper function
        which reduces the line of code in main files
    */

// to display alert
function get_alert(){
    $ci = &get_instance();

    if($ci->session->flashdata('alert') != null){
        $type = $ci->session->flashdata('alert')['type'];
        $msg = $ci->session->flashdata('alert')['msg'];                

        $type = $type =='success'?"alert-success":"alert-danger";
        
        echo '
        <div class="alert '. $type . ' alert-dismissible fade show" role="alert">'
            .$msg
            .'<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
        }  
}


// to set session data
function init_session(array $data){
    $ci = &get_instance();

    foreach($data as $key=>$val)
        $ci->session->set_userdata($key, $val);
        
}
    
