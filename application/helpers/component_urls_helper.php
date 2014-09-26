<?php
/*		Student		*/


 
function tinymce_url($obj='')
 {
  return base_url('assets/js/tinymce/'.$obj);
 }
 
function tokenInput_url($obj='')
 {
  return base_url('assets/js/token_input/'.$obj);
 }

/*		properties		*/ 
function properties_images_url($obj='')
 {
  return base_url('assets/images/'.$obj);
 }
 
function jquery_url($obj='')
 {
  return base_url('assets/js/jquery-family/'.$obj);
 }
 
function get_domain()
{
  $url=site_url();//bisa berjalan hanya pada hosting
  $pieces = parse_url($url);
  $domain = isset($pieces['host']) ? $pieces['host'] : '';
  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
    return $regs['domain'];
  }
  return false;
}

 ###########################################################
 ################### UPLOAD PATH ###########################
 ###########################################################

function get_student_upload_path()
 {
  return "http://localhost/tugas/school-archives/student-images/upload/";
 }
 
function get_teacher_upload_path()
 {
  return "http://localhost/tugas/school-archives/teacher-images/upload/";
 }

 function student_image_upload($filename)
 {
  return get_student_upload_path().$filename;
 }
 
function teacher_image_upload($obj)
 {
  return get_teacher_upload_path().$obj;
 }
 
 ###########################################################
 ################### PROPERTIES ############################
 ########################################################### 
function admin_css_url($obj='')
 {
  return base_url('assets/css/admin/'.$obj);
 }
 
function admin_script_url($obj='')
 {
  return base_url('assets/js/admin/'.$obj);
 }
 
function student_css_url($obj='')
 {
  return base_url('assets/css/siswa/'.$obj);
 }
 
function student_script_url($obj='')
 {
  return base_url('assets/js/siswa/'.$obj);
 }
 
function teacher_css_url($obj)
 {
 return base_url('assets/css/guru/'.$obj);
 }
 
function teacher_script_url($obj)
 {
  return base_url('assets/js/guru/'.$obj);
 }

 ###########################################################
 ################### SITES URL #############################
 ########################################################### 
 
function admin_site_url($obj='',$attr='')
 {
  if($attr==''){
  	return site_url('administrator/sudo/'.$obj);
  }else{
	  return site_url('administrator/sudo/'.$obj).'?'.$attr;
  }
 } 
 
function student_site_url($obj='',$attr='')
 {
  return site_url('siswa/'.$obj).'?'.$attr;
 }
 
function teacher_site_url($obj,$attr='')
 {
  return site_url('guru/'.$obj).'?'.$attr;
 }


 
?>
