<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html','login'));
		$this->load->model('m_login');
	 }
	
	function get_user(){
		$this->load->library('session');
		return $this->session->userdata('user_account');
	}
	
	function index(){
	 $this->check_login();
	}
	
	function check_login(){
		$this->load->library('encrypt');
		if($_POST){
			$user=$this->input->post('user');
			$pass=$this->input->post('pass');
			  if ($user != '' and $pass != ''){
				$q1=$this->m_login->select_user_where($user);
				if ($q1->num_rows() > 0){
				  foreach($q1->result() as $r){
				    $pswd=$this->encrypt->decode($r->password);
					  # CHECK MATCH #
					  if ($pswd == $pass){
					  	$this->set_session($user);
					  	redirect('administrations');
					  }
				  }
				}
				$err= "Data yang anda masukkan Tidak cocok. <br>Harap Coba Lagi ";
			  }else{
				$err= "Harap tidak mengkosongkan kolom yang di sediakan";
			  }
			$data['error']=$err;
			$data['user']=$user;
		}
		if($this->get_user() != "") redirect('administrations');
		$this->load->helper('form');
		$data['controller']=$this;
 		$this->load->view('login',$data);
 		
	 }
	 
	function set_session($user){
		$this->load->library('session');
		$this->session->set_userdata('user_account',$user);
	}
	
	function encript($str){
		$this->load->library('encrypt');
		echo $this->encrypt->encode($str);
	}
	 
	function set_timezone()
	 {
	   date_default_timezone_set('Asia/Jakarta');
	 }
	
	
}
//end of file
