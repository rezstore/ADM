<?php
define('SITE_NAME',"REZstore.com");

define('BSTRAP_CSS','assets/global_css/bootstrap/');
define('BSTRAP_JS','assets/global_js/bootstrap/');
define('JQUERY','/assets/global_js/jquery-family/');
define('TINYMCE','/assets/global_js/tinymce/');
define('J_CSS','/assets/global_css/jquery_css/');
#ADMINITSTRATION
define('ADM_IMAGE','/assets/administration/images/');
define('ADM_CSS','/assets/administration/css/');
define('ADM_AWSM_CSS','/assets/global_css/font-awesome/css/');
define('ADM_JS','/assets/administration/js/');
define('ADM_SITE','administration');

define('SITE',site_url());
define('BASE',base_url());


function get_site_name(){
	 return anchor('http://www.rezstore.com',SITE_NAME);
	}

function get_bootstrap_css($filename='bootstrap.css'){
	 return BASE.BSTRAP_CSS.$filename;
	}
	
function get_bootstrap_js($filename='bootstrap-min.js'){
	 return BASE.BSTRAP_JS.$filename;
	}

function get_js_family($filename){
	 return BASE.JQUERY.$filename;
	}

function get_jquery_css($filename){
	 return BASE.J_CSS.$filename;
	}

function get_global_css($filename){
	 return BASE.ADM_CSS.$filename;
	}

function get_js_tinymce($filename){
	 return BASE.TINYMCE.$filename;
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

function combo_bulan($val=''){
	$bulan=array('1'=>'Januari','2'=>'Februari','3'=>'Maret','4'=>'April','5'=>'Mei','6'=>'Juni',
			'7'=>'Juli','8'=>'Agustus','9'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember');
	return dropdown('cmb_bulan',$bulan,$val,'class="form-control" style="width:200px;float:left;"');
}

function combo_tahun($val=''){
	$tahun=array();
	$th=2014;
	$th_now=date('Y');
	for($a=$th;$a<=$th_now;$a++){
		$tahun[$a]=$a;
	}
	return dropdown('cmb_tahun',$tahun,$val,'class="form-control" style="width:200px;float:left;"');
}

?>
