<?php
include('global_helper.php');

//define('ADM_UPLOAD','assets/administration/uploads/');

function get_css($filename){
 return base_url(ADM_CSS.$filename);
}

function get_awesome_css($filename){
 return base_url(ADM_AWSM_CSS.$filename);
}

function get_js($filename){
 return base_url(ADM_JS.$filename);
}

function get_admin_plugin_css($filename){
 return base_url(ADM_CSS.'plugins/'.$filename);
}

function get_site_url($pagename){
 return site_url(ADM_SITE.$pagename);
}


?>
