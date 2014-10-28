<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class aktivitas_harian  extends CI_Controller {

function __construct(){
	parent::__construct();
	$this->load->helper(array('html','url'));
	$this->load->model('m_aktivitas');
	$this->load->helper('aktivitas_harian');
}

function index(){
	$this->view();
}

function input(){
	  $this->load->helper('form');
	  $this->load_header();
	  $this->load->view('input_aktivitas');
}

function load_header($data=""){
$this->load->view('templates/header',$data);
}

function panggil_session(){
	$this->load->library("session");
	
	return $this->session->userdata("user_account");
}

function view(){
	$this->load->helper('form');
	$data['q']=$this->m_aktivitas->tampil();
	$this->load_header();
	$this->load->view('view_aktivitas',$data);

	}

function tambah(){
	$this->load->helper('form');
	if($_POST){
		$user=$this->panggil_session(); 
		$date=$this->input->post('tanggal');
		$text=$this->input->post('text');
		$data['q']=$this->m_aktivitas->insert_db($user,$date,$text);
		redirect (get_site_url('input'));		
	}
}

function edit($id){
$this->load->helper('form');

	if($_POST)
	{			
		$user=$this->panggil_session();
		$date=$this->input->post('date');
		$actifis=$this->input->post('activity');
		$data['q']=$this->m_aktivitas->update_db($id,$user,$date,$actifis);
		redirect (get_site_url('view'));
	}
	
	else{
		$this->load->helper('form');
		$data['q']=$this->m_aktivitas->select_db($id);
		$this->load_header();
		$this->load->view('insert_aktivitas',$data);
	}
	
}



}
	
	?>