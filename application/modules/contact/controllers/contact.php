<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contact extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html'));
		$this->load->model('m_contacts');
		$this->load->helper('contacts');
	}
	  
	function header($data=''){
		$this->load->view('templates/adm_header',$data);
		$data['type']="contact";
		$this->load->view('templates/menus',$data);
	}
	  
	function footer($data=''){
		$this->load->view('templates/adm_footer',$data);
	}
	
	function index(){
		$this->header();
		$this->footer();
	}
	
	function view_kota()
	{
	  $data['q']=$this->m_contacts->daftar_kota();
	  $data['title']="Daftar Kota";
	  $this->header($data);
	  $this->load->view('kota_view',$data);
	  $this->footer($data);
	}

	function new_kota(){
		if($_POST){
			$nama=$this->input->post('nama');
			$profinsi=$this->input->post('profinsi');
			$this->m_contacts->insert($nama,$profinsi);
		}
		$this->load->helper('form');
		$data['title']="New City";
		$this->header($data);
		$this->load->view('input_view');
		$this->footer($data);
	}
	
	function edit($id){
		$this->load->helper('form');
		if($_POST){
			$nama=$this->input->post('nama');
			$profinsi=$this->input->post('profinsi');
			$this->m_contacts->update($id,$nama,$profinsi);
			redirect(get_site_url('view_kota'));
		}else{
			$this->load->helper('form');
			$data['title']="Edit Kota";
			$this->header($data);
			$data['q']=$this->m_contacts->select_kota($id);
			$this->load->view('edit_view',$data);
			$this->footer($data);
		}
	}
	
	function delete($id=""){
	 if($id !=""){
		$this->m_contacts->delete($id);
		redirect(get_site_url('view_kota'));
	 }
	}
	
	function contacts(){
		$data['q']=$this->m_contacts->view_contacts();
		$data['title']="Daftar Kontak";
		$this->header($data);
		$this->load->view('kontak',$data);
		$this->footer($data);
	}
	function insert_contacts(){
	
	if($_POST){
	$nama=$this->input->post('name');
	$alamat=$this->input->post('alamat');
	$kota=$this->input->post('kota');
	$kode=$this->input->post('kode_pos');
	$notlp1=$this->input->post('notlp1');
	$notlp2=$this->input->post('notlp2');
	$notlp3=$this->input->post('notlp3');
	$email=$this->input->post('email');
	$this->m_contacts->input_db($nama,$alamat,$kota,$kode,$notlp1,$notlp2,$notlp3,$email);
	}
	$this->load->helper('form');
	$data['title']="Daftar Kontak";
	$this->header($data);
	$this->load->view('input_contacts');
	$this->footer($data);
	}
function edit_contact($id){
	$this->load->helper('form');
	if($_POST){
	$id=$this->input->post();
	$nama=$this->input->post('name');
	$alamat=$this->input->post('alamat');
	$kota=$this->input->post('kota');
	$kode=$this->input->post('kode');
	$notlp1=$this->input->post('notlp1');
	$notlp2=$this->input->post('notlp2');
	$notlp3=$this->input->post('notlp3');
	$email=$this->input->post('email');
	$this->m_contacts->edit_contacts($id,$nama,$alamat,$kota,$kode,$notlp1,$notlp2,$notlp3,$email);
	redirect(get_site_url('contact'));
	}
	$data['q']=$this->m_contacts->select_contact($id);
	$this->load->view('input_contacts',$data);
	
	}
	
function delete_contact($id=""){
if($id!=""){
 $this->m_contacts->delete_kontak($id);
 redirect(get_site_url('contacts'));
 }


}
}
//end of file
