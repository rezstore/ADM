<?php
function get_css($filename){
 return base_url('assets/css/fanpage/'.$filename);
}

function get_jquery_css($filename){
 return base_url('assets/css/jquery_css/'.$filename);
}

function get_js($filename){
 return base_url('assets/js/fanpage/'.$filename);
}

function get_js_family($filename){
 return base_url('assets/js/jquery-family/'.$filename);
}

function get_image_post($filename='',$type=''){
 if($type == "basedir"){
  return PUBPATH.'assets/uploads/fanpage/'.$filename;
 }
 return base_url('assets/uploads/fanpage/'.$filename);
}

function get_images_icon($filename){
 return base_url('assets/css/fanpage/images/icons/'.$filename);
}

function get_url($pagename){
 return site_url('fanpage/'.$pagename);
}

#----------------------------------------------------------------------
function input($name,$value='',$class=''){
 return form_input($name,$value,$class);
}

function dropdown($name,$arr=array(),$value='',$class=''){
 return form_dropdown($name,$arr,$value,$class);
}

function textarea($name,$value='',$class=''){
 return form_textarea($name,$value,$class);
}

function upload($name,$value='',$class=''){
 return form_upload($name,$value,$class);
}

function submit($name,$value='',$class=''){
 return form_submit($name,$value,$class);
}

?>
