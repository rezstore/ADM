<?php
class M_student extends CI_Model
{
  function get_user_details()
   {
   	$sql="SELECT * FROM user_type";
  	return $this->db->query($sql);
   }
  
  function get_nim($user)
   {
   	$user=$this->db->escape($user);
   	$sql="SELECT NIM FROM students where username = $user";
  	return $this->db->query($sql);
   }
 function get_ID_nilai_report($NIM,$id)
	{
		$nim=$this->db->escape($NIM);
		$id=$this->db->escape($id);
		$sql="SELECT ID_test FROM student_test_report WHERE NIM=$nim and ID_test=$id LIMIT 1";
		return $this->db->query($sql);
	}
 
 function get_all_name()
	{
		$sql="SELECT * FROM teachers";
		return $q=$this->db->query($sql);
	}

 function get_student_info_from_NIM($f_nim)
	{
		$nim=$this->db->escape($f_nim);
		$sql="SELECT students.NIM , students.student_name , students.student_class , majors.major_name FROM students LEFT JOIN majors ON students.student_major = majors.major_code WHERE students.NIM=$nim LIMIT 1";
		return $this->db->query($sql);
	}
   
  function get_nim_nama()
   {
   	$sql="SELECT NIM,student_name FROM students where 1";
  	return $this->db->query($sql);
   }
  
  function get_student_score($nim,$kls)
   {
	$NIM=$this->db->escape($nim);
   	if($kls != '' and $kls != 'none'){
   	  $kelas=$this->db->escape($kls);
 	  $where="student_test_report.NIM = $NIM and class=$kelas";
 	}else{
 	  $where="student_test_report.NIM = $NIM";
 	}
   	 $sql="SELECT student_test_report.*, students.student_name, subject.subject_name FROM student_test_report LEFT JOIN students 
   		ON students.NIM = student_test_report.NIM LEFT JOIN subject ON subject.subject_code = student_test_report.subject_code
   		where $where";
  	return $this->db->query($sql);
}

function get_student_score_where_NIM($nim,$kelas)
 {
	$nim=$this->db->escape($nim);
	$kelas=$this->db->escape($kelas);
		if($kelas != '')
		{
			$sql="SELECT * FROM student_test_report WHERE NIM = $nim AND class=$kelas ORDER BY subject_code ASC";
			return $this->db->query($sql);
		}
}
  
  function get_student_transkrip($nim,$kelas)
   {
	$NIM=$this->db->escape($nim);
	if($kelas != ''){
		$kelas=$this->db->escape($kelas);
		$where="AND class=$kelas ";
	}else{
		$where="";
	}
   	 $sql="SELECT student_test_report.*, students.student_name, subject.subject_name FROM student_test_report LEFT JOIN students 
   		ON students.NIM = student_test_report.NIM LEFT JOIN subject ON subject.subject_code = student_test_report.subject_code
   		where student_test_report.NIM = $NIM $where ORDER BY class ASC ";
  	return $this->db->query($sql);
   }
   
  function lihat_problem($id,$user){
   $id=$this->db->escape($id);
   $user=$this->db->escape($user);
   $sql="SELECT * FROM report_problem WHERE ID_report=$id AND `from`=$user LIMIT 1";
   $query=$this->db->query($sql);
   return $query;
  }
  
  function delete_problem($id,$user){
   $id=$this->db->escape($id);
   $user=$this->db->escape($user);
   $sql="DELETE FROM report_problem WHERE ID_report=$id AND `from`=$user LIMIT 1";
   $this->db->query($sql);
  }
  
  function update_messages_state($from,$to){
   $from=$this->db->escape($from);
   $to=$this->db->escape($to);
   $sql="UPDATE user_chats SET state_to=1 WHERE user_from=$from and user_to=$to";
   $this->db->query($sql);
  }
  
  function get_my_profile_info($nim)
   {
   	$nim=$this->db->escape($nim);
   	$sql="SELECT * FROM students where NIM= $nim LIMIT 1";
  	return $this->db->query($sql);
   }
  
  function select_all_subject()
   {
  	$sql="SELECT subject_code,subject_name FROM subject WHERE activated = 1 ORDER BY subject_name ASC";
  	return $this->db->query($sql);
   }
  
  function get_subject_name($value)
   {
  	$value=$this->db->escape($value);
  	$sql="SELECT subject_code,subject_name FROM subject WHERE subject_code=$value and activated = 1 LIMIT 1";
  	return $this->db->query($sql);
   }
   
  function delete_activity($id,$user)
   {
   	$user=$this->db->escape($user);
   	$id=$this->db->escape($id);
   	$sql="DELETE FROM student_activities WHERE user=$user and ID_activity=$id LIMIT 1";
   	$this->db->query($sql);
   }
   
  function insert_new_activities($user,$judul,$subject,$deskripsi)
   {
     $user=$this->db->escape($user);
     $judul=$this->db->escape($judul);
     $subject=$this->db->escape($subject);
     $deskripsi=$this->db->escape($deskripsi);
     if($judul != '' and $deskripsi != ''){
     	$sql="INSERT INTO student_activities (`user`,`date`,`title`,`subject`,`descriptions`) VALUES ($user,NOW(),$judul,$subject,$deskripsi)";
     	$this->db->query($sql);
     }
   }
   
  function select_nilai_error($id)
   {
   	$id=$this->db->escape($id);
   	$sql="SELECT * FROM student_test_report WHERE ID_test=$id LIMIT 1";
   	return $this->db->query($sql);
   }
   
  function get_activity_from_id($id,$user)
   {
    	$user=$this->db->escape($user);
   	$id=$this->db->escape($id);
   	$sql="SELECT ID_activity,title,subject,descriptions FROM student_activities WHERE ID_activity=$id and user = $user LIMIT 1";   
   	return $this->db->query($sql);
   }
   
  function update_activities($user,$id,$judul,$subject,$deskripsi)
   {
     $id=$this->db->escape($id);
     $user=$this->db->escape($user);
     $judul=$this->db->escape($judul);
     $subject=$this->db->escape($subject);
     $deskripsi=$this->db->escape($deskripsi);
     if($judul != '' and $deskripsi != ''){
     	$sql="UPDATE student_activities SET `date`=NOW(), `title`=$judul, `subject`=$subject ,`descriptions`=$deskripsi WHERE user=$user and ID_activity=$id LIMIT 1";
     	$this->db->query($sql);
     }
   }
   
  function insert_new_report_problem($nim,$subject,$description)
  {
  	$nim=$this->db->escape($nim);
  	$subject=$this->db->escape($subject);
  	$description=$this->db->escape($description);
  	$sql="INSERT INTO report_problem (`date`,`from`,`subject`,`content`) VALUES (NOW(),$nim,$subject,$description)";
  	$this->db->query($sql);
  }
  
  function get_activities($user)
   {
   	$user=$this->db->escape($user);
   	$sql="SELECT * FROM student_activities WHERE user= $user";
   	return $this->db->query($sql);
   }
   
  function select_notices()
   {
  	//$start=$this->db->escape($awal);
  	//$end=$this->db->escape($akhir);
  	$sql="SELECT * FROM posting_pages where activated = 1 order by date_time DESC ";
  	return $this->db->query($sql);
   }
   
  function get_notices($word)
   {
     if ($word != ''){
	     $word=$this->db->escape("%$word%");
	     $where="date_time LIKE $word or post_title LIKE $word or post_content LIKE $word or post_categories LIKE $word and activated = 1 ";
     }else{
     	$where="activated= 1";
     }
     $sql="SELECT * FROM posting_pages WHERE $where ORDER BY date_time DESC LIMIT 6";
     return $this->db->query($sql);
   }
   
  function get_notice_detail($id)
   {
   	$id=$this->db->escape($id);
   	$sql="SELECT * FROM posting_pages where ID_post = $id and activated = 1 LIMIT 1";
   	return $this->db->query($sql);
   }
   
  function get_students_where_class($kelas,$jurusan)
  {
  	$kls=$this->db->escape($kelas);
  	$jurusan=$this->db->escape($jurusan);
  	$sql="SELECT * FROM students WHERE student_class=$kls and student_major=$jurusan and activated=1";
  	$query=$this->db->query($sql);
  	return $query;
  }
  
  function get_my_report($nim){
  	$nim=$this->db->escape($nim);
  	$sql="SELECT * FROM report_problem WHERE `from` = $nim";
  	return $this->db->query($sql);
  }
   
  function get_students_where_nim($nim)
  {
  	$nim=$this->db->escape($nim);
  	$sql="SELECT * FROM students WHERE NIM=$nim LIMIT 1";
  	$query=$this->db->query($sql);
  	return $query;
  }
   
  function get_class_name($val)
   {
   	$val=$this->db->escape($val);
   	$sql="SELECT class_name FROM classes where class_code = $val LIMIT 1";
   	return $this->db->query($sql);
   }
   
  function get_teachers()
   {
   	$sql="SELECT teachers.NIK,teachers.teacher_name,teachers.teacher_photo,teachers.teaching, teacher_details.teacher_phone_number, subject.subject_name FROM teachers 
   		LEFT JOIN teacher_details ON teachers.NIK=teacher_details.NIK LEFT JOIN subject ON subject.subject_code=teachers.teaching";
   	return $this->db->query($sql);
   }
   
  function get_friends($user)
   {
   	$user=$this->db->escape($user);
   	$sql="SELECT * FROM students where username != $user and activated = 1";
   	return $this->db->query($sql);
   }
   
  function get_left_content($user)
   {
   	$user=$this->db->escape($user);
   	$sql="SELECT students.NIM, students.student_name, students.student_class, student_photo FROM students 
   	LEFT JOIN student_details ON students.NIM=student_details.NIM where username = $user ";
   	return $this->db->query($sql);
   }
   
  function get_major($maj)
   {
   	$major=$this->db->escape($maj);
   	$sql="SELECT major_name FROM majors where major_code = $major ";
   	return $this->db->query($sql)->result();
   }
   
  function get_teacher_where($find)
  {
  	$find=$this->db->escape('%'.$find.'%');
  	$where = " NIK LIKE $find OR teacher_name LIKE $find OR teaching LIKE $find";
  	$sql="SELECT NIK,teacher_name,teacher_photo FROM teachers WHERE $where LIMIT 30";
  	return $this->db->query($sql);
  }
  
  function get_teacher_profile($nik)
  {
  	$nik=$this->db->escape($nik);
  	$sql="SELECT * FROM teachers WHERE NIK = $nik LIMIT 1";
  	return $this->db->query($sql);
  }
   
  function get_username_from_NIK($code)
   {
   	$nik=$this->db->escape($code);
   	$sql="SELECT username FROM teachers where NIK = $nik LIMIT 1";
   	$q=$this->db->query($sql)->result();
   	$username='';
   	foreach($q as $r){$username=$r->username;}
   	if ($username != ''){$u=$username;}else{$u='';}
   	return $u;
   }
   
  function get_chats_unread($val=0,$user)
   {
  	$user=$this->db->escape($user);
  	if($val==1)$g="GROUP BY user_from";else $g='';
  	$sql="SELECT * FROM user_chats WHERE user_to=$user and state_to = 0 $g";
  	return $this->db->query($sql);
   }
   
  function get_all_chats($user)
   {
  	$user=$this->db->escape($user);
  	$sql="SELECT * FROM user_chats WHERE user_to=$user GROUP BY user_from ORDER BY date_time DESC";
  	return $this->db->query($sql);
   }
   
  function get_chats($user,$to)
   {
   	$user=$this->db->escape($user);
   	$to=$this->db->escape($to);
   	$sql="SELECT user_chats.*, student_details.student_photo FROM user_chats 
   	LEFT JOIN students ON students.username=user_chats.user_from 
   	LEFT JOIN student_details ON students.NIM=student_details.NIM
   	where user_from = $user and user_to = $to order by date_time DESC";
   	$q=$this->db->query($sql)->result();
   	return $q;
   }
   
   function get_chats_groupFrom($from,$to)
    {
   	$from=$this->db->escape($from);
   	$to=$this->db->escape($to);
   	$wh1="user_from = $from and user_to = $to";
   	$wh2="user_from = $to and user_to = $from";
   	$sql="SELECT * FROM user_chats WHERE $wh1 OR $wh2";
   	return $this->db->query($sql);
    }
   
  function update_chats_state($from,$to)
   {
   	$from=$this->db->escape($from);
   	$to=$this->db->escape($to);
   	$wh1="user_from = $from and user_to = $to";
   	$wh2="user_from = $to and user_to = $from";
   	$sql="UPDATE user_chats SET state_to=1 WHERE $wh1 OR $wh2";
   	$q1=$this->db->query($sql);
   }
   
  function get_all_user($clue,$user)
  {
  	$c=$this->db->escape('%'.$clue.'%');
  	$user=$this->db->escape($user);
  	$where="students.student_name LIKE $c AND `users_account`.username != $user OR teachers.teacher_name LIKE $c AND `users_account`.username != $user";
  	$sql="SELECT t.username, t.sn,t.tn,t.type FROM (SELECT `users_account`.username,LEFT(`users_account`.redirect_path,LOCATE('/',`users_account`.redirect_path)-1) as type,
  		`students`.student_name as sn , `teachers`.teacher_name as tn FROM `users_account` 
		 LEFT JOIN `students` ON `students`.username=`users_account`.username 
		 LEFT JOIN `teachers` ON `teachers`.username=`users_account`.username  WHERE $where) t";
	$q1=$this->db->query($sql);
	foreach($q1->result() as $r){
		$s=$r->sn;
		$t=$r->tn;
		if($s==NULL)$s=$t;
		$data[]=['name'=>$s.' :: '.$r->type,'id'=>$r->username];
	}
	return $data;
  }
  
  function get_userTeacher_from_nik($nik)
  {
  	$nik=$this->db->escape($nik);
  	$sql="SELECT username,teacher_name FROM teachers WHERE NIK=$nik LIMIT 1";
  	$q=$this->db->query($sql);
  	$user='';$name='';
  	foreach($q->result() as $r){
  	  $user=$r->username;
  	  $name=$r->teacher_name;
  	}
  	return $user.':'.$name;
  }
  
  function insert_new_message($user,$userTo,$content)
  {
  	$user=$this->db->escape($user);
  	$userTo=$this->db->escape($userTo);
  	$content=$this->db->escape($content);
  	$sql="INSERT INTO user_chats (`date_time`,`user_from`,`user_to`,`chat_content`,`state_from`) 
  		VALUES (NOW(),$user,$userTo,$content,1)";
  	$this->db->query($sql);
  }
  
  function get_TeacherNama_from_user($userTo)
  {
  	$user=$this->db->escape($userTo);
  	$sql="SELECT teacher_name FROM teachers WHERE username=$user LIMIT 1";
  	$q=$this->db->query($sql);
  	$name='';
  	foreach($q->result() as $r){
  	  $name=$r->teacher_name;
  	}
  	return $name;
  }
  
  function get_StudentNama_from_user($userTo)
  {
  	$user=$this->db->escape($userTo);
  	$sql="SELECT student_name FROM students WHERE username=$user LIMIT 1";
  	$q=$this->db->query($sql);
  	$name='';
  	foreach($q->result() as $r){
  	  $name=$r->student_name;
  	}
  	return $name;
  }
  
  function get_outbox($user)
  {
  	$user=$this->db->escape($user);
  	$sql="SELECT * FROM user_chats WHERE user_from=$user";
  	return $this->db->query($sql);
  }
  
  function get_StudentUser_from_nim($nim)
  {
  	$nim=$this->db->escape($nim);
  	$sql="SELECT username,student_name FROM students WHERE NIM = $nim LIMIT 1";
  	$q= $this->db->query($sql);
  	$user='';$name='';
  	foreach($q->result() as $r){
  	  $user=$r->username;
  	  $name=$r->student_name;
  	}
  	return $user.':'.$name;
  }
  
 function insert_new_compose($to,$from,$content)
  {
 	$to=$this->db->escape($to);
 	$from=$this->db->escape($from);
 	$content=$this->db->escape($content);
 	$sql="INSERT INTO user_chats (`date_time`,`user_to`,`user_from`,`chat_content`,`state_from`) 
 		VALUES (NOW() , $to , $from, $content,1)";
 	$this->db->query($sql);
  }
  
  function get_chats_where($id)
   {
   	$id=$this->db->escape($id);
   	$sql="SELECT * FROM user_chats WHERE ID_chat=$id LIMIT 1";
   	return $this->db->query($sql); 
   }
  function get_data()
   {
   	$sql="SELECT * FROM students where 1 ";
  	return $this->db->query($sql);
   }
   
  function select_all_class()
   {
   	$sql="SELECT class_code,class_name FROM classes where activated=1 ";
  	return $this->db->query($sql);
   }
   
  function select_all_jurusan()
   {
   	$sql="SELECT major_code,major_name FROM majors where activated=1 ";
  	return $this->db->query($sql);
   }
   
  function update_student_info($NIM, $nama ,$jenis_kelamin, $email, $agama, 
  				$no_telp, $kota, $kode_pos, $info, $siswa_alamat ,
  				$nama_ortu, $agama_ortu, $jk_ortu, $kota_ortu, $alamat_ortu, $kode_post_ortu,$parent_number)
   {
     //student
     $NIM=$this->db->escape($NIM);     		$nama=$this->db->escape($nama);
     $jenis_kelamin=$this->db->escape($jenis_kelamin);     $email=$this->db->escape($email);
     $agama=$this->db->escape($agama);     $no_telp=$this->db->escape($no_telp);
     $kota=$this->db->escape($kota);     $kode_pos=$this->db->escape($kode_pos);
     $info=$this->db->escape($info);     $alamat=$this->db->escape($siswa_alamat);
     //parent
     $nama_ortu=$this->db->escape($nama_ortu);
     $agama_ortu=$this->db->escape($agama_ortu);
     $jk_ortu=$this->db->escape($jk_ortu);
     $kota_ortu=$this->db->escape($kota_ortu);
     $alamat_ortu=$this->db->escape($alamat_ortu);
     $kode_post_ortu=$this->db->escape($kode_post_ortu);
     $parent_number=$this->db->escape($parent_number);
     
     $sql="UPDATE students SET student_name=$nama,
     		student_email=$email, religion=$agama, student_gender=$jenis_kelamin, student_address=$alamat, 
     		student_city=$kota, student_postal_code=$kode_pos, student_phone_number=$no_telp, student_info=$info, 
     		parent_name=$nama_ortu, parent_gender=$jk_ortu, parent_religion=$agama_ortu, parent_address=$alamat_ortu, 
     		parent_city=$kota_ortu, parent_post=$kode_post_ortu, parent_number= $parent_number
     	   WHERE NIM=$NIM LIMIT 1 ";
     	   
     $this->db->query($sql);
   }
  
  

}
//end of file 


