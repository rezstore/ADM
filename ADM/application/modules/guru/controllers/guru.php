<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guru extends CI_Controller {
var $title="";
	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html','component_urls','teacher'));
		$this->load->model('m_teacher');
	 }
	
	function index()
	 {
		$this->profile();
	 }
	
	function check_session()
	 {
		$user=$this->session->userdata('guru');
		if ($user == ''){ redirect('login/');}
	 }
	
	function get_controller()
	{
		return $this;
	}
	
	function get_model()
	{
		return $this->m_teacher;
	}
	
	function load_left_header($title){
		$this->get_header($title);
		$this->get_leftside($title);
	}
	
	function token_input()
	{
		$user=$this->session->userdata('guru');
		$clue=$this->input->get('q');
		$type=$this->uri->segment(4);
		if ($type=='') $tp="all_user";
		if ($type="all_user"){
			$q=$this->m_teacher->get_all_user($clue,$user);
		}
		echo json_encode($q);
	}
	
	function profile()
	{
		
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('guru');
		$data['user']=$user;
	 	$title="Profil";
		$model=$this->get_model();
		$nik=$this->get_nik($user);
		$data['m']=$this->m_teacher;
		$data['my_profile']=$this->m_teacher->get_my_profile($nik);
		$this->load_left_header($title);
		$this->load->view('profile',$data);
	}
	
	function viewScore()
	 {
	 	$this->check_session();
		$user=$this->session->userdata('guru');
		$title="Lihat Nilai";
		$data['user']=$user;
		$data['model']=$this->get_model();
	 	$data['controller']=$this->get_controller();
		$this->load_left_header($title);
	 	if ($_GET){
	 		$nim=$this->input->get('id');
	 		$data['nilai']=$this->m_teacher->get_student_scoreByNIM($nim);
	 		$this->load->view('student_scoreByNim',$data);
	 	}else{
		 	$kelas=$this->input->post('kelas');
		 	if($kelas == '')$kelas="x";
		 	$data['kelas']=$kelas;
		 	$this->load->helper('form');
			$data['nilai']=$this->m_teacher->get_student_score_where($user,$kelas);
			$data['subject_name']=$this->m_teacher->get_teaching($user);
			$this->load->view('view_student_score',$data);
		}
	 }
	 
	 function inbox()
	 {
	 	$this->check_session();
	 	$title="Inbox";
	 	$this->load->helper('form');
	 	$user=$this->session->userdata('guru');
	 	$data['message']=$this->m_teacher->get_messages($user);
	 	$data['model']=$this->get_model();
		$this->load_left_header($title);
		$this->load->view('view_messages',$data);
	 }
	 
	 function delete_score()
	 {
	 	$this->check_session();
	 	$user=$this->session->userdata('guru');
	 	$id=$this->input->get('id');
	 	$nim=$this->input->get('NIM');
	 	$cek=$this->m_teacher->check_if_exists_score($id,$nim,$user);
	 	if($cek >= 1){
		 	$this->m_teacher->delete_score_where_id($id);
		 	redirect(teacher_site_url('viewScore'));
	 	}else{
	 		echo "data yang anda maksud tidak ada dalam data kami";
	 	}
	 }
	 
	 function edit_score()
	 {
	 	$this->check_session();
	 	$user=$this->session->userdata('guru');
 	 	$this->load->helper('form');
	 	$title="Edit Score";
	 	if($_GET){
	 		$id=$this->input->get('id');
	 		$NIM=$this->input->get('NIM');
	 		$cek=$this->m_teacher->check_if_exists_score($id,$NIM,$user);
	 		if($cek >= 1){
	 			$data['error']="";
	 			$data['subject_name']=$this->m_teacher->get_teaching($user);
	 		  	$data['nilai']=$this->m_teacher->get_student_score_by_id($id);
			 	$data['message']=$this->m_teacher->get_messages($user);
			 	$data['model']=$this->get_model();
			 	$data['action']="edit";
			 	$this->load_left_header($title);
				$this->load->view('add_student_score',$data);
	 		}else{
	 			echo "Maaf Anda Tidak Mempunyai Hak akses untuk data ini...";
	 		}
	 	}
	 }
	 
	 function update_score(){
	 	$this->check_session();
	 	$user=$this->session->userdata('guru');
	 	$type=$this->uri->segment(4);
	 	if($type=="ulangan_harian" OR $type=="ulangan_smtr"){
	 	 $id=$this->input->get('id');
	 	 $nim=$this->input->get('nim');
	 	 $cek=$this->m_teacher->check_if_exists_score($id,$nim,$user);
	 	 if ($cek == 0)exit();
	 	 if($_POST){
	 	  $kelas=$this->input->post('kelas');
	   	  $u1=$this->input->post('u1');
	   	  $u2=$this->input->post('u2');
	   	  $u3=$this->input->post('u3');
	   	  $u4=$this->input->post('u4');
	   	  $u5=$this->input->post('u5');
	   	  $u6=$this->input->post('u6');
	   	  $u7=$this->input->post('u7');
	   	  $u8=$this->input->post('u8');
	   	  $u9=$this->input->post('u9');
	   	  $u10=$this->input->post('u10');
	   	  $kelas=$this->input->post('kelas');
 		  $m1=$this->input->post('msmtr1');
 		  $m2=$this->input->post('msmtr2');
 		  $s1=$this->input->post('smtr1');
 		  $s2=$this->input->post('smtr2');
	   	  $this->m_teacher->update_score($type,$id,$kelas,$u1,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10,$m1,$s1,$m2,$s2);
	   	  redirect(teacher_site_url('viewScore'));
	 	 }
	 	}
	 }
	 
	 function sendReport()
	 {
	 	$this->check_session();
	 	$this->load->helper('form');
	 	$title="Send Report";
	 	$user=$this->session->userdata('guru');
	 	if ($_POST){
	 		$content=$this->input->post('content');
	 		$subject="Kesalahan";
	 		$this->m_teacher->sendReport($user,$content,$subject);
	 	}
	 	$data['model']=$this->get_model();
		$this->load_left_header($title);
		$this->load->view('send_report',$data);
	 }
	 
	function send_message()
	{
		$this->check_session();
	 	$user=$this->session->userdata('guru');
	 	$title="Send Message";
	 	if($_POST){
	 	   $userto=$this->input->post('userTo');
	 	   $content=$this->input->post('content');
	 	  if($userto != "" and $content != ""){
	 	  	$this->m_teacher->insert_new_message_send($user,$userto,$content);
	 	  	redirect(teacher_site_url('inbox'));
	 	  }else{echo "salah Satu Data tidak boleh ada yang kosong";}
	 	}elseif($_GET){
	 	  $this->load->helper('form');
	 	  $username=$this->input->get('id');
	 	  $q=$this->m_teacher->select_user_fromUsername($username);
	 	  if($q->num_rows() == 1){
	 	    $data['username']=$username;
	 	    $data['model']=$this->get_model();
	 	    $data['controller']=$this->get_controller();
	 	    $this->load_left_header($title);
	 	    $this->load->view('new_compose',$data);
	 	  }else{echo "^_^ Data Belum Tersedia , Harap Hubungi Administrator";}
	 	}
	}
	
	function readCurrentMessage(){
		$this->check_session();
	 	$data['user']=$this->session->userdata('guru');
	 	$title="Read message";
		$id=$this->input->get('id');
		if($id != 0 OR is_numeric($id)){
		  $q=$this->m_teacher->select_fromMessageID($id);
		  if($q->num_rows() == 1){
		    $this->load->helper('form');
		    $data['message']=$q;
		    $data['model']=$this->get_model();
	 	    $data['controller']=$this->get_controller();
	 	    $this->load_left_header($title);
		    $this->load->view('message_detail',$data);
		  }else{
		    echo "Pesan Tidak Dapat ditemukan";
		  }
		}
	}
	
	function openConversation()
	{
	    $this->check_session();
	    $this->load->helper('form');
	    $user=$this->session->userdata('guru');
	    $title="Percakapan";	
	    $from=$this->input->get('id');
	    $check_user=$this->m_teacher->update_message_state($user,$from);
	    $data['model']=$this->get_model();
	    $data['controller']=$this->get_controller();
	    $data['conversation']=$this->m_teacher->select_chats_fromCurrentuser($from,$user);
	    $this->load_left_header($title);
	    $this->load->view('conversation',$data);
	}
		
	function update_teacher_info()
	 {
	   //echo var_dump($_POST);
	   $NIK=$this->session->userdata('NIK');
	   $nama=$this->input->post('nama');
	   $email=$this->input->post('email');
	   $gender=$this->input->post('gender');
	   $teach=$this->input->post('teach');
	   $alamat=$this->input->post('alamat');
	   $kota=$this->input->post('kota');
	   $post=$this->input->post('ps_kode');
	   $phone=$this->input->post('no_telp');
	   $info=$this->input->post('info');
	   if($nama != ''){
	     $this->m_teacher->update_teacher_info($NIK,$nama,$email,$gender,$teach,$alamat,$kota,$post,$phone,$info);
	   }
	   $this->profile();
	 }
	
	function get_nik($user)
	 {
	 	$nik=$this->session->userdata('NIK');
		if ($nik == ''){
			$q=$this->m_teacher->get_nik($user);
			$nik='-';
			foreach($q->result() as $r){
			 $nik=$r->NIK;
			}
			$this->session->set_userdata('NIK',$nik);
			$nik=$this->session->userdata('NIK');
		}
		return $nik;
	 }
	 
	function add_student_score($error='')
	 {
	   	$this->check_session();
	   	$this->load->helper('form');
	   	$user=$this->session->userdata('guru');
	 	$title="Input Nilai";
	   	$data['subject_name']=$this->m_teacher->get_teaching($user);
	   	$data['error']=$error;
	   	$data['model']=$this->get_model();
	   	$this->load_left_header($title);
	   	$this->load->view('add_student_score',$data);
	 }
	
	function insert_new_score()
	 {
	   $this->check_session();
	   $user=$this->session->userdata('guru');
	   $id=$this->uri->segment(4);
	   	if($_POST and $id="ulangan_harian"){
	   	  $nim=$this->input->post('nim');
	   	  $kelas=$this->input->post('kelas');
	   	  $subject=$this->m_teacher->get_teaching($user);
	   	  $u1=$this->input->post('u1');
	   	  $u2=$this->input->post('u2');
	   	  $u3=$this->input->post('u3');
	   	  $u4=$this->input->post('u4');
	   	  $u5=$this->input->post('u5');
	   	  $u6=$this->input->post('u6');
	   	  $u7=$this->input->post('u7');
	   	  $u8=$this->input->post('u8');
	   	  $u9=$this->input->post('u9');
	   	  $u10=$this->input->post('u10');
	   	  $check=$this->check_duplicate($nim,$kelas,$subject[1]);
	   	  if($check == 0 and $nim != ''){
		   	  $this->m_teacher->insert_student_score($user,$nim,$kelas,$subject[1],$u1,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10,$user);
	   	  	$error='';
	   	  }else{
	   	  	$error="Maaf Data Sudah Ada Sebelumnya, Atau terjadi Kesalahan Tehnis ,Mohon Dicek Kembali";
	   	  }
	   	}
	   $this->add_student_score($error);
	 }
	 
	 function update_smtr()
	 {
	   $this->check_session();
	   $user=$this->session->userdata('guru');
	   $subject=$this->m_teacher->get_teaching($user);
	 	if($_POST){
	 		$nim=$this->input->post('nim');
	 		$kelas=$this->input->post('kelas');
	 		$m1=$this->input->post('msmtr1');
	 		$m2=$this->input->post('msmtr2');
	 		$s1=$this->input->post('smtr1');
	 		$s2=$this->input->post('smtr2');
	 		}
	 		$c=$this->check_duplicate($nim,$kelas,$subject[1]);
	 		if($nim != '' and $user != '' and $subject != ''){
	 			$this->m_teacher->update_smtr($c,$nim,$user,$kelas,$m1,$m2,$s1,$s2);	 			
	 			$error='';
	   	  }else{
	   	  	$error="Maaf terjadi Kesalahan Tehnis ,Mohon Dicek Kembali";
	   	  }
	   $this->add_student_score($error);

	 	}
	 
	function  check_duplicate($nim,$kelas,$subject)
	 {
		$check=$this->m_teacher->get_duplicate_score($nim,$kelas,$subject);
		return $check;
	 }
	 
	function delete_chats(){
	 $this->check_session();
	 $user=$this->session->userdata('guru');
	 $id=$this->input->get('id');
	 $check=$this->m_teacher->get_chat_from_id($id);
	 if ($check->num_rows() > 0){
	  foreach($check->result() as $r){
	   $pengirim=$r->user_from;
	   $tujuan=$r->user_to;
	  }
	  if ($pengirim == $user)$user2=$tujuan; else $user2=$pengirim;
	  if ($pengirim == $user OR $tujuan == $user){
	    $q=$this->m_teacher->delete_messages_from_user($user,$user2);
	    redirect(teacher_site_url('inbox',''));
	  }
	 }
	}
	
	function notifications()
	{
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('guru');
		$page1=$this->input->post('pg');
		$page2=$this->input->get('pg');
		$act=$this->input->get('act');
		if($act != ''){
		  $category=$this->input->post('categories');
		  $title=$this->input->post('title');
		  $content=$this->input->post('content');
		  if($category != '' and $title!= '' and $content!=''){
		    $this->m_teacher->insert_new_posting($user,$category,$title,$content);
		  }
		}
		if($page2 != '')$page=$page2;
		if($page1 != '')$page=$page1;
		if($page1 =='' and $page2 =='') $page=0;
	 	$title="Notifikasi";
		$data['val']=$page+1;
		$data['user']=$user;
		$data['model']=$this->get_model();
		$data['notif']=$this->m_teacher->get_notifications($page*6,($page*6) + 5);
		$data['totalNotif']=$this->m_teacher->get_total_notifications();
		$this->load_left_header($title);
		$this->load->view('notifications',$data);
	}
	
	function view_current_notif()
	{
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('guru');
		$id=$this->uri->segment(4);
	 	$title="Lihat Notifikasi";
		$data['user']=$user;
		$data['model']=$this->get_model();
		$data['notif']=$this->m_teacher->get_notification_whereID($id);
		$this->load_left_header($title);
		$this->load->view('view_notification',$data);
	}
	
	function studentDatas()
	{
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('guru');
		//$class=$this->uri->segment(4);
		if($_POST){
			 $class=$this->input->post('kelas');
			 $jurusan=$this->input->post('major');
			}else{
			 $class='x';$jurusan='ipa';
			}
	 	$title="Data Siswa";
		$data['class']=$class;
		$data['jurusan']=$jurusan;
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$data['datas']=$this->m_teacher->get_all_students_where($class,$jurusan);
		$this->load_left_header($title);
		$this->load->view('student_datas',$data);
	}
	
	function student_detail()
	{
		$this->check_session();
		$user=$this->session->userdata('guru');
		//$class=$this->uri->segment(4);
		if($_GET){
			 $NIM=$this->input->get('id');
			}else{
			 $NIM='';
			}
	 	$title="Data Siswa";
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$data['datas']=$this->m_teacher->get_student_info($NIM);
		$this->load_left_header($title);
		$this->load->view('student_detail',$data);
	}
	
	function teacher_detail()
	{
		$this->check_session();
		$user=$this->session->userdata('guru');
		if($_GET){
			 $NIK=$this->input->get('id');
			}else{
			 $NIK='';
			}
	 	$title="Data Guru";
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$data['datas']=$this->m_teacher->get_teacher_info($NIK);
		$this->load_left_header($title);
		$this->load->view('teacher_detail',$data);
	}
	
	function teacherDatas()
	{
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('guru');
		$data['user']=$user;
	 	$title="Data Guru";
	 	if($_POST){
	 	 $teach=$this->input->post('pengajar');
	 	}else{
	 	 $teach='ing';
	 	}
	 	$data['teach']=$teach;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$data['count']=$this->m_teacher->get_all_teacher();
		$data['datas']=$this->m_teacher->get_all_teacher_where($teach);
		$this->load_left_header($title);
		$this->load->view('teacher_datas',$data);
	}
	
	/*function complains()
	{
		$this->check_session();
		$this->load->helper('form');
		$user=$this->session->userdata('guru');
	 	$title="Laporkan";
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		if($_POST){
		 $content=$this->input->post('content');
		 $this->m_teacher->add_new_complaint($user,$content);
		}
		$data['complaints']=$this->m_teacher->get_complaint_where($user);
		$this->load_left_header($title);
		$this->load->view('view_complaint',$data);
	}*/
	
	function get_header($title)
	{
		$data['model']=$this->get_model();
		$data['title']=$title;
		$data['profile']=$this->session->userdata('guru');;
		$this->load->view('header',$data);
	}
	
	function get_leftside()
	{
		$this->load->view('leftside');
	}
	
	function get_major($maj)
	{
		$major=$this->m_teacher->get_major($maj);
		foreach($major as $r ){return $r->major_name;}
	}
	
	function logout()
	{
		$user=$this->session->userdata('guru');
		$this->check_session();
		$this->session->unset_userdata('guru');
		$this->index();
	}
	
}
//end of file
