<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sudo extends CI_Controller {
	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html','component_urls','sudos'));
		$this->load->model('m_sudo');
	 }
	
	function index()
	 {
		$this->viewScore();
	 }
	
	function check_session()
	 {
		$user=$this->get_userdata('1');
		if ($user == ''){ redirect('login/check_login');}
	 }
	 
	function get_userdata($opt=''){
	 if($opt==""){
	 	$this->check_session();
	 }
	 return $this->session->userdata('administrator');
	}
	
	function get_controller()
	{
		return $this;
	}
	
	function get_model()
	{
		return $this->m_sudo;
	}
	
	function load_left_header($title){
		$this->get_header($title);
		$this->get_leftside($title);
	}
	
	function token_input()
	{
		$user=$this->get_userdata();
		$clue=$this->input->get('q');
		$type=$this->uri->segment(4);
		if ($type=='') $tp="all_user";
		if ($type="all_user"){
			$q=$this->m_sudo->get_all_user($clue,$user);
		}
		echo json_encode($q);
	}
	
	
	
####################################################################################################################
####################################################################################################################
####################################################################################################################

	function viewScore()
	 {
		$user=$this->get_userdata();
		$title="Lihat Nilai";
		$data['user']=$user;
		$data['model']=$this->get_model();
	 	$data['controller']=$this->get_controller();
		$this->load_left_header($title);
		if ($_POST){
		  $s=$this->input->post('selected');
		  $act=$this->input->post('action');
		  if ($s != ""){
		   foreach($s as $e){
		    if ($act == 2){
		   	$this->trash('student_test_report','ID_test',$e);
		    }
		    $this->m_sudo->execute_action($act,$e);
		   }
		  }
		}
	 	if ($_GET){
	 		$nim=$this->input->get('id');
	 		$data['nilai']=$this->m_sudo->get_student_scoreByNIM($nim);
	 		$this->load->view('student_scoreByNim',$data);
	 	}else{
		 	if ($_POST){
			 	$nim=$this->input->post('NIM');
			 	$kelas=$this->input->post('kelas');
			 	$subject=$this->input->post('subject');
			 }else{
			 	$nim="";
			 	$kelas="";
			 	$subject="";
			 }
		 	$data['nim']=$nim;
		 	$data['subject']=$subject;
		 	$data['kelas']=$kelas;
		 	$this->load->helper('form');
			$data['nilai']=$this->m_sudo->get_student_score_where($kelas,$subject,$nim);
			$data['pending']=$this->m_sudo->get_student_score_pending($kelas);
			$this->load->view('view_student_score',$data);
		}
	 }
	 
	 function inbox()
	 {
	 	$title="Inbox";
	 	$this->load->helper('form');
	 	$user=$this->get_userdata();
	 	$data['message']=$this->m_sudo->get_messages($user);
	 	$data['outMessage']=$this->m_sudo->get_outmessages($user);
	 	$data['model']=$this->get_model();
		$this->load_left_header($title);
		$this->load->view('view_messages',$data);
	 }
	 
	 function trash($tbname,$col,$val){
	 	$data=$this->m_sudo->get_data_before_trash($tbname,$col,$val);
	 	$sql="";
	 	if ($tbname=="student_test_report"){
	 	 foreach($data as $row){
	 		$user=$this->db->escape($row->user);
	 		$nim=$this->db->escape($row->NIM);
	 		$class=$this->db->escape($row->class);
	 		$sub_code=$this->db->escape($row->subject_code);
	 		$u1=$this->db->escape($row->u1);	$u2=$this->db->escape($row->u2);	$u3=$this->db->escape($row->u3);	
	 		$u4=$this->db->escape($row->u4);	$u5=$this->db->escape($row->u5);	$u6=$this->db->escape($row->u6);	
	 		$u7=$this->db->escape($row->u7);	$u8=$this->db->escape($row->u8);	$u9=$this->db->escape($row->u9);
	 		$u10=$this->db->escape($row->u10);	
	 		$ms1=$this->db->escape($row->mid_semester1);	$s1=$this->db->escape($row->semester1);	
	 		$ms2=$this->db->escape($row->mid_semester2);	$s2=$this->db->escape($row->semester2);
	 		$activate=$row->activated;
	 		$sql="INSERT INTO student_test_report (`user`,`NIM`,`class`,`subject_code`,`u1`,`u2`,`u3`
	 			,`u4`,`u5`,`u6`,`u7`,`u8`,`u9`,`u10`,`mid_semester1`,`semester1`,`mid_semester2`,`semester2`,`activated`)
	 			 VALUES ($user,$nim,$class,$sub_code,$u1,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10,$ms1,$s1,$ms2,$s2,$activate)";
	 	 }
	 	}
	 	$this->m_sudo->trash($tbname,$sql);
	 	return true;
	 }
	 
	 function delete_score()
	 {
	 	$user=$this->get_userdata();
	 	$id=$this->input->get('id');
	 	$nim=$this->input->get('NIM');
	 	$cek=$this->m_sudo->check_if_exists_score($id,$nim);
	 	if($cek >= 1){
		 	$this->trash('student_test_report','ID_test',$id);
		 	$this->m_sudo->delete_score_where_id($id);
		 	redirect(admin_site_url('viewScore'));
	 	}else{
	 		echo "data yang anda maksud tidak ada dalam data kami";
	 	}
	 }
	 
	 function edit_score()
	 {
	 	$user=$this->get_userdata();
 	 	$this->load->helper('form');
	 	$title="Edit Score";
	 	if($_GET){
	 		$id=$this->input->get('id');
	 		$NIM=$this->input->get('NIM');
	 		$cek=$this->m_sudo->check_if_exists_score($id,$NIM);
	 		if($cek >= 1){
	 			$data['error']="";
	 			$data['subject_name']=$this->m_sudo->get_teaching($user);
	 		  	$data['nilai']=$this->m_sudo->get_student_score_by_id($id);
			 	$data['message']=$this->m_sudo->get_messages($user);
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
	 	$user=$this->get_userdata();
	 	$type=$this->uri->segment(4);
	 	if($type=="ulangan_harian" OR $type=="ulangan_smtr"){
	 	 $id=$this->input->get('id');
	 	 $nim=$this->input->get('nim');
	 	 $cek=$this->m_sudo->check_if_exists_score($id,$nim);
	 	 if ($cek == 0)exit();
	 	 if($_POST){
	 	  $kelas=$this->input->post('kelas');
	 	  $subject=$this->input->post('subject');
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
	   	  $this->m_sudo->update_score($type,$id,$kelas,$subject,$u1,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10,$m1,$s1,$m2,$s2);
	   	  redirect(admin_site_url('viewScore'));
	 	 }
	 	}
	 }
	 
	 function sendReport()
	 {
	 	$this->load->helper('form');
	 	$title="Send Report";
	 	$user=$this->get_userdata();
	 	if ($_POST){
	 		$content=$this->input->post('content');
	 		$subject="Kesalahan";
	 		$this->m_sudo->sendReport($user,$content,$subject);
	 	}
	 	$data['model']=$this->get_model();
		$this->load_left_header($title);
		$this->load->view('send_report',$data);
	 }
	 
	function send_message()
	{
	 	$user=$this->get_userdata();
	 	$title="Send Message";
	 	if($_POST){
	 	   $userto=$this->input->post('userTo');
	 	   $content=$this->input->post('content');
	 	  if($userto != "" and $content != ""){
	 	  	$this->m_sudo->insert_new_message_send($user,$userto,$content);
	 	  	redirect(admin_site_url('inbox'));
	 	  }else{echo "salah Satu Data tidak boleh ada yang kosong";}
	 	}elseif($_GET){
	 	  $this->load->helper('form');
	 	  $username=$this->input->get('id');
	 	  $q=$this->m_sudo->select_user_fromUsername($username);
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
	 	$data['user']=$this->get_userdata();
	 	$title="Read message";
		$id=$this->input->get('id');
		if($id != 0 OR is_numeric($id)){
		  $q=$this->m_sudo->select_fromMessageID($id);
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
	    $this->load->helper('form');
	    $user=$this->get_userdata();
	    $title="Percakapan";	
	    $from=$this->input->get('id');
	    $check_user=$this->m_sudo->update_message_state($user,$from);
	    $data['model']=$this->get_model();
	    $data['controller']=$this->get_controller();
	    $data['conversation']=$this->m_sudo->select_chats_fromCurrentuser($from,$user);
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
	     $this->m_sudo->update_teacher_info($NIK,$nama,$email,$gender,$teach,$alamat,$kota,$post,$phone,$info);
	   }
	   $this->profile();
	 }
	
	function get_nik($user)
	 {
	 	$nik=$this->session->userdata('NIK');
		if ($nik == ''){
			$q=$this->m_sudo->get_nik($user);
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
	   	$this->load->helper('form');
	   	$user=$this->get_userdata();
	 	$title="Input Nilai";
	   	$data['error']=$error;
	   	$data['model']=$this->get_model();
	   	$this->load_left_header($title);
	   	$this->load->view('add_student_score',$data);
	 }
	
	function insert_new_score()
	 {
	   $user=$this->get_userdata();
	   $id=$this->uri->segment(4);
	   	if($_POST and $id="ulangan_harian"){
	   	  $nim=$this->input->post('nim');
	   	  $kelas=$this->input->post('kelas');
	   	  $subject=$this->input->post('subject');
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
	   	  $check=$this->check_duplicate($nim,$kelas,$subject);
	   	  if($check == 0 and $nim != ''){
		   	  $this->m_sudo->insert_student_score($user,$nim,$kelas,$subject,$u1,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10,$user);
	   	  	$error='';
	   	  }else{
	   	  	$error="Maaf Data Sudah Ada Sebelumnya, Atau terjadi Kesalahan Tehnis ,Mohon Dicek Kembali";
	   	  }
	   	}
	   $this->add_student_score($error);
	 }
	 
	 function update_smtr()
	 {
	   $user=$this->get_userdata();
	   $subject=$this->m_sudo->get_teaching($user);
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
	 			$this->m_sudo->update_smtr($c,$nim,$user,$kelas,$m1,$m2,$s1,$s2);	 			
	 			$error='';
	   	  }else{
	   	  	$error="Maaf terjadi Kesalahan Tehnis ,Mohon Dicek Kembali";
	   	  }
	   $this->add_student_score($error);

	 	}
	 
	function  check_duplicate($nim,$kelas,$subject)
	 {
		$check=$this->m_sudo->get_duplicate_score($nim,$kelas,$subject);
		return $check;
	 }
	 
	function delete_chats(){
	 $user=$this->get_userdata();
	 $id=$this->input->get('id');
	 $check=$this->m_sudo->get_chat_from_id($id);
	 if ($check->num_rows() > 0){
	  foreach($check->result() as $r){
	   $pengirim=$r->user_from;
	   $tujuan=$r->user_to;
	  }
	  if ($pengirim == $user)$user2=$tujuan; else $user2=$pengirim;
	  if ($pengirim == $user OR $tujuan == $user){
	    $q=$this->m_sudo->delete_messages_from_user($user,$user2);
	    redirect(admin_site_url('inbox',''));
	  }
	 }
	}
	
	function notifications()
	{
		$this->load->helper('form');
		$user=$this->get_userdata();
		$page2=$this->input->get('p');
		if($page2 > 1)$page2 = ($page2-1)*10+1;
		$act=$this->input->get('act');
		if($act == 'new'){
		  $category=$this->input->post('categories');
		  $title=$this->input->post('title');
		  $content=$this->input->post('content');
		  if($category != '' and $title!= '' and $content!=''){
		    $this->m_sudo->insert_new_posting($user,$category,$title,$content);
		  }
		}
		if ($_POST and $act != "new"){
		 $id=$this->input->post('selected');
		 $action=$this->input->post('action');
		 if ($action != "" and $id != ""){
			 $this->m_sudo->update_post_state($id,$action);
		 }
		}
		if($page2 == '')$page2=0;
	 	$title="Notifikasi";
		$data['user']=$user;
		$data['model']=$this->get_model();
		$data['notif']=$this->m_sudo->get_notifications($page2,$page2+10);
		$totalNotif=$this->m_sudo->get_total_notifications();
		$data['pagging']= pagging(2000,$page2,10,'notifications');
		$this->load_left_header($title);
		$this->load->view('notifications',$data);
	}
	
	function view_current_notif()
	{
		$this->load->helper('form');
		$user=$this->get_userdata();
		$id=$this->uri->segment(4);
	 	$title="Lihat Notifikasi";
		$data['user']=$user;
		$data['model']=$this->get_model();
		$data['notif']=$this->m_sudo->get_notification_whereID($id);
		$this->load_left_header($title);
		$this->load->view('view_notification',$data);
	}
	
	function edit_post(){
		$id=$this->input->get('id');
		$this->load->helper('form');
		$title="edit post";
		if($id != '' AND is_numeric($id)){
		 if ($_POST){
		  $categories=$this->input->post('categories');
		  $title=$this->input->post('title');
		  $content=$this->input->post('content');
		  $state=$this->input->post('state');
		  $this->m_sudo->update_post($id,$categories,$title,$content,$state);
		  redirect(admin_site_url('notifications'));
		 }
		  $data['data']=$this->m_sudo->select_postByID($id);
		  $data['model']=$this->get_model();
		  $this->load_left_header($title);
		  $this->load->view('edit_post',$data);
		}
	}
	
	function delete_student(){
		$id=$this->input->get('nim');
		if($id != ""){
		  $this->m_sudo->delete_student($id);
		  redirect(admin_site_url('studentDatas'));
		}
	}
	
	function delete_post(){
		$user=$this->get_userdata();
		$id=$this->input->get('id');
		$this->m_sudo->delete_post($id);
		redirect(admin_site_url('notifications'));
	}
	
	function post($str){
	 echo $this->input->post($str);
	}
	
	function studentDatas()
	{
		$this->load->helper('form');
		$user=$this->get_userdata();
		//$class=$this->uri->segment(4);
		if ($_GET){
		 if ($_POST){echo var_dump($_POST);
		  $nim=$this->post("NIM");	$student_name=$this->post("student_name");	$class=$this->post("class");
		  $major=$this->post("major");	$student_email=$this->post("student_email");	$student_religi=$this->post("student_religi");
		  $student_gender=$this->post("student_gender");	$student_addr=$this->post("student_addr");	$student_city=$this->post("student_city");
		  $student_post=$this->post("student_post");	$student_noTelp=$this->post("student_noTelp");	$student_info=$this->post("student_info");
		  $parent_name=$this->post("parent_name");	$parent_gender=$this->post("parent_gender");	$parent_agama=$this->post("parent_agama");
		  $parent_addr=$this->post("parent_addr");	$parent_city=$this->post("parent_city");	$parent_post=$this->post("parent_post");
		  $parent_noTelp=$this->post("parent_noTelp");	$photo=$this->post("photo");	$state=$this->post("state");
		  
		  if ($nim != ""){
		    $this->m_sudo->insert_new_student($nim, $student_name, $class, $major, $student_email, 
		    					$student_religi, $student_gender, $student_addr, $student_city, 
		    					$student_post, $student_noTelp, $student_info, $parent_name, 
		    					$parent_gender, $parent_agama, $parent_addr, $parent_city, 
		    					$parent_post, $parent_noTelp, $photo, $state);
		  }
		 }
		 exit();
		}
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
		$data['student_data']=$this->m_sudo->get_all_students_where($class,$jurusan);
		$this->load_left_header($title);
		$this->load->view('student_datas',$data);
	}
	
	function student_detail()
	{
		$user=$this->get_userdata();
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
		$data['datas']=$this->m_sudo->get_student_info($NIM);
		$this->load_left_header($title);
		$this->load->view('student_detail',$data);
	}
	
	function teacher_detail()
	{
		$user=$this->get_userdata();
		if($_GET){
			 $NIK=$this->input->get('id');
			}else{
			 $NIK='';
			}
	 	$title="Data Guru";
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		$data['datas']=$this->m_sudo->get_teacher_info($NIK);
		$this->load_left_header($title);
		$this->load->view('teacher_detail',$data);
	}
	
	function teacherDatas()
	{
		$this->load->helper('form');
		$user=$this->get_userdata();
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
		$data['count']=$this->m_sudo->get_all_teacher();
		$data['datas']=$this->m_sudo->get_all_teacher_where($teach);
		$this->load_left_header($title);
		$this->load->view('teacher_datas',$data);
	}
	
	function view_complaints()
	{
		$this->load->helper('form');
		$user=$this->get_userdata();
	 	$title="Laporkan";
		$data['user']=$user;
		$data['controller']=$this->get_controller();
		$data['model']=$this->get_model();
		if($_POST){
		 $content=$this->input->post('content');
		 $this->m_sudo->add_new_complaint($user,$content);
		}
		$data['report']=$this->m_sudo->get_report_where($user);
		$this->load_left_header($title);
		$this->load->view('view_complaint',$data);
	}
	
	function view_detailComplaint(){
		$user=$this->get_userdata();
		$id=$this->input->get('id');
	 	$title="Laporkan";
	 	$data['type']="Detail";
	 	$data['detail']=$this->m_sudo->get_specific_complaint($id);
	 	$this->m_sudo->update_compaint_state($id);
	 	$this->load_left_header($title);
		$this->load->view('view_complaint_detail',$data);
	}
	
	function view_detail_student(){
		$user=$this->get_userdata();
		$nim=$this->input->get('id');
	 	$title="Detail Siswa";
	 	$data['detail']=$this->m_sudo->get_detail_siswa($nim);
	 	$data['controller']=$this->get_controller();
	 	$this->load_left_header($title);
		$this->load->view('detail_siswa',$data);
	}
	
	function edit_detail_student(){
		$user=$this->get_userdata();
		$this->load->helper('form');
		$nim=$this->input->get('id');
		$act=$this->input->get('act');
	 	$title="Detail Siswa";
	 	$data['detail']=$this->m_sudo->get_detail_siswa($nim);
	 	$data['controller']=$this->get_controller();
	 	if($act=="save"){
	 	 if($_POST){
			$NIM=$this->input->post('NIM');			 $nama=$this->input->post('student_name');	$kelas=$this->input->post('class');
			$jurusan=$this->input->post('major');		 $email=$this->input->post('student_email');	$agama=$this->input->post('student_religi');
			$jk=$this->input->post('student_gender');	 $alamat=$this->input->post('student_addr');	$kota=$this->input->post('student_city');
			$kode_pos=$this->input->post('student_post');	 $notelp=$this->input->post('student_noTelp');	$info=$this->input->post('student_info');
			$nama_ortu=$this->input->post('parent_name');	 $jk_ortu=$this->input->post('parent_gender');	$agama_ortu=$this->input->post('parent_agama');
			$alamat_ortu=$this->input->post('parent_addr');	 $kota_ortu=$this->input->post('parent_city');	$kodepost_ortu=$this->input->post('parent_post');
			$notelp_ortu=$this->input->post('parent_noTelp'); $state=$this->input->post('state');
			
			if($NIM == $nim){
			  $this->m_sudo->save_detail_student($nim,$nama,$kelas,$jurusan,$email,$agama,
			  	$jk,$alamat,$kota,$kode_pos,$notelp,$info,$nama_ortu,$jk_ortu,$agama_ortu,
			  	$alamat_ortu,$kota_ortu,$kodepost_ortu,$notelp_ortu,$state);
			}else{echo "as";}
	 	 }
	 	}
	 	$this->load_left_header($title);
		$this->load->view('edit_detail_student',$data);
	}
	
	
	
	function delete_complaint(){
		$id=$this->input->get('id');
		$q=$this->m_sudo->delete_complaint($id);
		redirect(admin_site_url('view_complaints'));
	}
	
	function get_header($title)
	{
		$data['model']=$this->get_model();
		$data['title']=$title;
		$data['profile']=$this->get_userdata();;
		$this->load->view('header',$data);
	}
	
	function get_leftside()
	{
		$this->load->view('leftside');
	}
	
	function get_major($maj)
	{
		$major=$this->m_sudo->get_major($maj);
		foreach($major as $r ){return $r->major_name;}
	}
	
	function logout()
	{
		$user=$this->get_userdata();
		$this->session->unset_userdata('administrator');
		$this->index();
	}
	
}
//end of file
