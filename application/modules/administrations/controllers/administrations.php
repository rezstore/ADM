<?php

class Administrations extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->helper(array('html','url','admin'));
}

function get_userdata(){
	$this->load->library('session');
	return $this->session->userdata('user_account');
}

function index(){
 $this->home();
 //redirect('fanpage');
}

function load_header(){
 $this->load->view('template/adm_header.php');
}

function load_footer(){
 $this->load->view('template/adm_footer.php');
}

function home(){
	$data['title']="Home";
	$this->load_header($data);
	$this->load->view('home.php');
	$this->load_footer($data);
}


}
?>
