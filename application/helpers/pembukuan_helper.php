<?php
function get_bootstrap_css($filename='bootstrap.css'){
 return base_url('assets/global_css/bootstrap/'.$filename);
}
function get_css($filename){
 return base_url('assets/pembukuan/css/'.$filename);
}

function get_jquery_css($filename=''){
 return base_url('assets/global_css/jquery_css/'.$filename);
}

function get_js($filename,$true=false){
 if($true==false){
  return base_url('assets/global_js/pembukuan/'.$filename);
 }else{
  return base_url('assets/global_js/'.$filename);
 }
}

function get_js_family($filename){
 return base_url('assets/global_js/jquery-family/'.$filename);
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
}*/

function get_images_icon($filename){
 return base_url('assets/pembukuan/images/icons/'.$filename);
}


#----------------------------------------------------------------------
function input($name,$value='',$class=''){
 return form_input($name,$value,$class.' style="height:30px;"');
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
