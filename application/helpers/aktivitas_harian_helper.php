<?php 
function get_site_url($pagename){
return site_url('aktivitas_harian/'.$pagename);
}
function get_js_family($filename){
return base_url('assets/js/jquery-family/'.$filename);
}
function get_jquery_css($filename){
return base_url('assets/css/jquery_css/'.$filename);
}
function get_js_tinymce($filename){
return base_url('assets/js/tinymce/'.$filename);
}


?>