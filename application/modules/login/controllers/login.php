<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html'));
		$this->load->model('m_school');
	 }
	
	function index(){
	 $this->check_login();
	}
	
	function check_login()
	 {
		$this->load->library('encrypt');
		if($_POST){
		$user=$this->input->post('user');
		$pass=$this->input->post('pass');
		$code=$this->input->post('auth_code');
		$type=$this->input->post('type');
		  if ($user != '' and $pass != '' and $code != '' and $type != '' ){
			//query mencari user
			$q1=$this->m_school->select_user_where($user);
			if ($q1->num_rows() > 0){
			  foreach($q1->result() as $r){
			    $pswd=$this->encrypt->decode($r->password);
			    $usr_pos=$r->user_positions;
			    $c_auth=$r->authentication_code;
			    $redir=$r->redirect_path;
			  }
			  if (/*$pass == $pswd and*/ $code == $c_auth and $type == $usr_pos){
			   if ($type == "swa"){$tp="siswa";}elseif($type == "gr"){$tp="guru";}elseif($type == "adm"){$tp="administrator";}else{$tp="pegawai";}
			    $this->session->set_userdata(array($tp=>$user));
			    redirect($redir);
			  }else{$err="Data yang anda masukkan Tidak cocok. <br>Harap Coba Lagi";}
			}else{$err= "Data yang anda masukkan Tidak cocok. <br>Harap Coba Lagi ";}
		  }else{
			$err= "Harap tidak mengkosongkan kolom yang di sediakan";
		  }
		$data['error']=$err;
		$data['user']=$user;
		}
		$this->load->helper('form');
		$data['controller']=$this;
 		$this->load->view('login',$data);
	 }
	 
	function set_timezone()
	 {
	   date_default_timezone_set('Asia/Jakarta');
	 }
	
	
}
//end of file
