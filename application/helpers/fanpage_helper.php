<?php
include('global_helper.php');

function get_css($filename){
 return base_url('assets/fanpage/css/'.$filename);
}

function get_js($filename){
 return base_url('assets/fanpage/js/'.$filename);
}

function get_image_post($filename='',$type=''){
 if($type == "basedir"){
  return PUBPATH.'assets/uploads/fanpage/'.$filename;
 }
 return base_url('assets/uploads/fanpage/'.$filename);
}

function get_images_icon($filename){
 return base_url('assets/fanpage/css/images/icons/'.$filename);
}

function get_url($pagename){
 return site_url('fanpage/'.$pagename);
}

function get_site_url($pagename){
 return site_url('fanpage/'.$pagename);
}

#----------------------------------------------------------------------

?>
