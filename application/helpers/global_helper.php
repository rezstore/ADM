<?php
define('BSTRAP_CSS','assets/global_css/bootstrap/');
define('BSTRAP_JS','assets/global_js/bootstrap/');
define('JQUERY','assets/global_js/jquery-family/');
define('J_CSS','assets/global_css/jquery_css/');
#ADMINITSTRATION
define('ADM_IMAGE','assets/administration/images/');
define('ADM_CSS','assets/administration/css/');
define('ADM_AWSM_CSS','assets/global_css/font-awesome/css/');
define('ADM_JS','assets/administration/js/');
define('ADM_SITE','administration');

define('SITE',site_url());
define('BASE',base_url());


function get_bootstrap_css($filename='bootstrap.css'){
	 return BASE.BSTRAP_CSS.$filename;
	}
	
function get_bootstrap_js($filename='bootstrap-min.js'){
	 return base_url(BSTRAP_JS.$filename);
	}

function get_js_family($filename){
	 return base_url(JQUERY.$filename);
	}

function get_jquery_css($filename){
	 return base_url(J_CSS.$filename);
	}

function get_global_css($filename){
	 return base_url(ADM_CSS.$filename);
	}


//FORM

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
