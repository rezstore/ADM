<?php
function get_bootstrap_css(){
 return base_url('assets/css/bootstrap.css');
}
function get_css($filename){
 return base_url('assets/css/pembukuan/'.$filename);
}

function get_jquery_css($filename){
 return base_url('assets/css/jquery_css/'.$filename);
}

function get_js($filename,$true=false){
 if($true==false){
  return base_url('assets/js/pembukuan/'.$filename);
 }else{
  return base_url('assets/js/'.$filename);
 }
}

function get_js_family($filename){
 return base_url('assets/js/jquery-family/'.$filename);
}

function get_site_url($pagename){
 return site_url('pembukuan/'.$pagename);
}
/*
function get_image_post($filename='',$type=''){
 if($type == "basedir"){
  return PUBPATH.'assets/uploads/pembukuan/'.$filename;
 }
 return base_url('assets/uploads/pembukuan/'.$filename);
}

function get_images_icon($filename){
 return base_url('assets/css/pembukuan/images/icons/'.$filename);
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
*/
?>