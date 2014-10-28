<?php 
function get_bootstrap_css($filename){
return base_url('assets/css/jquery_css/'.$filename);

}
function get_site_url($pagename){
return site_url('contact/'.$pagename);
}

?>