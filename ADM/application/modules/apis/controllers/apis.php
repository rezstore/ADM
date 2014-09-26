<?php

class apis extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model('apis_model');
 $this->load->helper(array('html','url'));
}

function index(){
 echo "(*_*)";
}

function getPost($string){
 return $this->input->post($string);
}

function new_user(){
 if ($_POST){
  $username=$this->getPost("username");
  $password=$this->getPost("password");
  $status=$this->getPost("status");
  $this->apis_model->insert_data_user($username,$password,$status);
  echo "berhasil di upload";
 }
}

function get_login_user(){
 $msg="error";
 if ($_POST){
  $user=$this->getPost("username");
  $pass=$this->getPost("password");
  $q1=$this->apis_model->get_login_user($user);
  if ($q1->num_rows() <> 0){
	foreach($q1->result() as $r){
	   $username=$r->username;
	   $password=$r->password;
	   if ($pass == $password){
		$msg=$username;
	   }
	}
  }  
 }
 echo $msg;
}


}
?>