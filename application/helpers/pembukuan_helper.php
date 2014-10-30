<?php

include('global_helper.php');

function get_js($filename='',$true=false){
 if($true==false){
  return BASE.'/assets/global_js/pembukuan/'.$filename;
 }else{
  return BASE.'/assets/global_js/'.$filename;
 }
}

function get_css($filename=''){
	return BASE.'assets/pembukuan/css/'.$filename;
}

function get_site_url($pagename=''){
 return site_url('pembukuan/'.$pagename);
}
/*
function get_image_post($filename='',$type=''){
 if($type == "basedir"){
  return PUBPATH.'assets/uploads/pembukuan/'.$filename;
 }
 return base_url('assets/uploads/pembukuan/'.$filename);
}*/

function get_images_icon($filename=''){
 return BASE.'/assets/pembukuan/images/icons/'.$filename;
}


?>
