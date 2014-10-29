<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contact extends CI_Controller {

	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html'));
		$this->load->model('m_contacts');
		$this->load->helper('contacts');
	 }
	function index(){
	$this->header();
	}
	
	function view_kota()
	{
	  $data['q']=$this->m_contacts->select();
	  $this->header();
	  $this->load->view('kota_view',$data);

	  }
	  
	function header(){
	$this->load->view('header');
	
	}
	

	function insert(){
	$this->load->helper('form');
	  $this->header();
	if($_POST){
	
	$nama=$this->input->post('nama');
	$profinsi=$this->input->post('profinsi');
	$this->m_contacts->insert($nama,$profinsi);
	}
	$this->load->view('input_view');
	
	}
	function edit($id){
	$this->load->helper('form');
	if($_POST){
	$nama=$this->input->post('nama');
	$profinsi=$this->input->post('profinsi');
	$this->m_contacts->update($id,$nama,$profinsi);
	redirect('contact/view_kota');
	}
	else{
	$this->load->helper('form');
	$this->header();
	$data['q']=$this->m_contacts->select_db($id);
	$this->load->view('edit_view',$data);
	}
	
	}
function delete($id=""){
 if($id !=""){
	
	$this->m_contacts->delete($id);
    redirect('contact/view_kota');
	}	

	}
	
}
//end of file
