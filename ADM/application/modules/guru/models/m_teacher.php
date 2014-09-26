<?php
class M_teacher extends CI_Model
{
  function get_user_details()
   {
   	$sql="SELECT * FROM user_type";
  	return $this->db->query($sql);
   }
  
  function get_nik($user)
   {
   	$user=$this->db->escape($user);
   	$sql="SELECT NIK FROM teachers where username = $user";
  	return $this->db->query($sql);
   }  
   
  function get_student_info($NIM)
  {
  		$NIM=$this->db->escape($NIM);	
  		$sql="SELECT * FROM students WHERE NIM=$NIM LIMIT 1";
  		return $this->db->query($sql);
  }
  
  function update_message_state($user,$to){
  	$user=$this->db->escape($user);
  	$to=$this->db->escape($to);
  	$where="user_from=$to AND user_to=$user ";
  	$sql="UPDATE user_chats SET state_to=1 WHERE $where";
  	$this->db->query($sql);
  }
   
  function get_teacher_info($NIK)
  {
	$NIK=$this->db->escape($NIK);
	$sql="SELECT * FROM teachers WHERE NIK=$NIK LIMIT 1";
	return $this->db->query($sql);
  }
  
  function insert_new_posting($user,$category,$title,$content){
  	$user=$this->db->escape($user);
  	$category=$this->db->escape($category);
  	$title=$this->db->escape($title);
  	$content=$this->db->escape($content);
  	$sql="INSERT INTO posting_pages (`date_time`,`post_title`,`post_content`,`post_categories`,`created_by`) 
  		VALUES (NOW(),$title,$content,$category,$user)";
  	$this->db->query($sql);
  }
  
  function add_new_complaint($user,$content){
  	$user=$this->db->escape($user);
  	$content=$this->db->escape($content);
  	$sql="INSERT INTO complaints (`date_complaint`,`complaint_from`,`complaint_to`,`complaint_content`)
  		 VALUES (NOW(),$user,'admin',$content)";
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
   
  function update_teacher_info($NIK,$nama,$email,$gender,$teach,$alamat,$kota,$post,$phone,$info)
   {
     $NIK=$this->db->escape($NIK);
     $nama=$this->db->escape($nama);
     $email=$this->db->escape($email);
     $gender=$this->db->escape($gender);
     $teach=$this->db->escape($teach);
     $alamat=$this->db->escape($alamat);
     $kota=$this->db->escape($kota);
     $post=$this->db->escape($post);
     $phone=$this->db->escape($phone);
     $info=$this->db->escape($info);
     $sql="UPDATE teachers SET teacher_name=$nama, teaching=$teach, teacher_gender=$gender, 
     teacher_address=$alamat, teacher_city=$kota, teacher_postal_code=$post,
     teacher_phone_number=$phone, teacher_email=$email, teacher_info=$info
     WHERE NIK=$NIK LIMIT 1";
     $this->db->query($sql);
   }
   
  function get_message_count($user)
   {
     $user=$this->db->escape($user);
     $sql="SELECT ID_chat FROM user_chats WHERE user_to= $user and state_to=0";
     $query=$this->db->query($sql);
     return $query->num_rows();
   }
   
  function insert_new_message_send($user,$userto,$content)
  {
  	$user=$this->db->escape($user);
  	$userto=$this->db->escape($userto);
  	$content=$this->db->escape($content);
  	$sql="INSERT INTO user_chats (`date_time`,`user_from`,`user_to`,`chat_content`,`state_from`) VALUES (NOW(),$user,$userto,$content,1)";
  	$this->db->query($sql);
  }
  
  function select_user_fromUsername($username){
  	$user=$this->db->escape($username);
  	$sql="SELECT username FROM users_account WHERE username=$user LIMIT 1";
  	return $this->db->query($sql);
  }
  
  function select_chats_fromCurrentuser($user,$me)
  {
    $from=$this->db->escape($user);
    $user=$this->db->escape($me);
    $where ="user_from = $user and user_to= $from OR user_from = $from and user_to=$user";
    $sql="SELECT * FROM user_chats WHERE $where ORDER BY date_time DESC";
    return $this->db->query($sql);
  }
  
  function sendReport($user,$content,$subject){
  	$user=$this->db->escape($user);
  	$content=$this->db->escape($content);
  	$subject=$this->db->escape($subject);
  	$sql="INSERT INTO report_problem (`date`,`from`,`subject`,`content`) VALUES (NOW(),$user,$subject,$content)";
  	$this->db->query($sql);
  }
   
  function get_messages($user)
   {
     $user=$this->db->escape($user);
     $sql="SELECT * FROM (SELECT * FROM user_chats WHERE user_to= $user ORDER BY state_to ASC) t1 GROUP BY user_from";
     $query=$this->db->query($sql);
     return $query;
   }
   
  function get_student_score_where($user,$kelas)
   {
   	$user=$this->db->escape($user);
   	$kelas=$this->db->escape($kelas);
   	$sql="SELECT * FROM student_test_report WHERE user=$user and class = $kelas ";
   	return $this->db->query($sql);	
   }
   
  function get_all_active_class()
   {
     $sql="SELECT * FROM classes WHERE activated = 1 ORDER BY class_code ASC";
     return $this->db->query($sql);
   }
   
   function select_fromMessageID($id){
     $id=$this->db->escape($id);
     $sql="SELECT * FROM user_chats WHERE ID_chat=$id LIMIT 1";
     return $this->db->query($sql);
   }
   
   function get_student_scoreByNIM($nim){
     $nim=$this->db->escape($nim);
     $sql="SELECT student_test_report.*,subject.subject_name FROM student_test_report 
     LEFT JOIN subject ON  subject.subject_code=student_test_report.subject_code WHERE student_test_report.NIM=$nim ";
     return $this->db->query($sql);
   }
   
  function insert_student_score($user,$nim,$kelas,$subject,$u1,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10,$user){
  	//$user=$this->db->escape($user);
  	$nim=$this->db->escape($nim);
  	$kelas=$this->db->escape($kelas);
  	$subject=$this->db->escape($subject);
  	$u1=$this->db->escape($u1);
  	$u2=$this->db->escape($u2);
  	$u3=$this->db->escape($u3);
  	$u4=$this->db->escape($u4);
  	$u5=$this->db->escape($u5);
  	$u6=$this->db->escape($u6);
  	$u7=$this->db->escape($u7);
  	$u8=$this->db->escape($u8);
  	$u9=$this->db->escape($u9);
  	$u10=$this->db->escape($u10);
  	$user=$this->db->escape($user);
  	$sql="INSERT INTO student_test_report(`user`,`NIM`,`class`,`subject_code`,`u1`,`u2`,`u3`,`u4`,`u5`,`u6`,`u7`,`u8`,`u9`,`u10`) 
  	VALUES ($user,$nim,$kelas,$subject,$u1,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10)";
  	$this->db->query($sql);
  }
  
  function update_score($type,$id,$kelas,$u1,$u2,$u3,$u4,$u5,$u6,$u7,$u8,$u9,$u10,$m1,$s1,$m2,$s2)
  {
  	$id=$this->db->escape($id);
  	$kelas=$this->db->escape($kelas);
  	if($type=="ulangan_harian"){
	  	$u1=$this->db->escape($u1);
	  	$u2=$this->db->escape($u2);
	  	$u3=$this->db->escape($u3);
	  	$u4=$this->db->escape($u4);
	  	$u5=$this->db->escape($u5);
	  	$u6=$this->db->escape($u6);
	  	$u7=$this->db->escape($u7);
	  	$u8=$this->db->escape($u8);
	  	$u9=$this->db->escape($u9);
	  	$u10=$this->db->escape($u10);
		$sql="UPDATE student_test_report SET `u1`=$u1,`u2`=$u2,`u3`=$u3,`u4`=$u4,`u5`=$u5,`u6`=$u6,`u7`=$u7,`u8`=$u8,`u9`=$u9,`u10`= $u10
			WHERE `ID_test`=$id AND `class`=$kelas LIMIT 1";	
  	}elseif($type=="ulangan_smtr"){
	  	$m1=$this->db->escape($m1);
	  	$m2=$this->db->escape($m2);
	  	$s1=$this->db->escape($s1);
	  	$s2=$this->db->escape($s2);
	  	$sql="UPDATE student_test_report SET `mid_semester1`=$m1,`mid_semester2`=$m2,`semester1`=$s1, `semester2`=$s2
			WHERE nim=$nim and class=$kls ";  
  	}
  	if(!empty($sql))$this->db->query($sql);
  }
  
  function delete_score_where_id($id)
  {
  	$id=$this->db->escape($id);
  	$sql="DELETE FROM student_test_report WHERE ID_test=$id LIMIT 1";
  	$this->db->query($sql);
  }
  
  function get_chat_from_id($id){
  	$id=$this->db->escape($id);
  	$sql="SELECT user_to,user_from FROM user_chats WHERE ID_chat=$id";
  	return $this->db->query($sql);
  }
  
  function delete_messages_from_user($user,$user2){
  	$user=$this->db->escape($user);
  	$user2=$this->db->escape($user2);
  	$where="user_to=$user AND user_from=$user2 OR user_to=$user2 AND user_from=$user ";
  	$sql="DELETE FROM user_chats WHERE $where";
  	$this->db->query($sql);
  }
  
  function update_smtr($state,$nim,$user,$kls,$m1,$m2,$s1,$s2)
  {
  	$nim=$this->db->escape($nim);
  	$user=$this->db->escape($user);
  	$kls=$this->db->escape($kls);
  	$m1=$this->db->escape($m1);
  	$m2=$this->db->escape($m2);
  	$s1=$this->db->escape($s1);
  	$s2=$this->db->escape($s2);
  	if($state==1){
		$sql="UPDATE student_test_report SET `mid_semester1`=$m1,`mid_semester2`=$m2,`semester1`=$s1, `semester2`=$s2
				WHERE nim=$nim and user=$user and class=$kls ";  		
  		}else{
  			$sql="INSERT INTO student_test_report (`NIM`,`user`,`class`,`mid_semester1`,`mid_semester2`,`semester1`, `semester2`) 
  			VALUES($nim,$user,$kls,$m1,$m2,$s1,$s2)";
  			}
  		$this->db->query($sql);
  	}
   
  function get_nim_nama()
   {
   	$sql="SELECT NIM,student_name FROM students where 1";
  	return $this->db->query($sql);
   }
   
  function get_duplicate_score($nim,$kelas,$subject)
   {
   	$nim=$this->db->escape($nim);
   	$kelas=$this->db->escape($kelas);
   	$subject=$this->db->escape($subject);
   	$sql="SELECT NIM FROM student_test_report WHERE NIM=$nim AND class=$kelas AND subject_code=$subject LIMIT 1";
   	$q=$this->db->query($sql);
   	return $q->num_rows();
   }
  
  function get_scores($nim)
   {
   	$NIM=$this->db->escape($nim);
   	$sql="SELECT student_test_report.*, students.student_name, subject.subject_name FROM student_test_report LEFT JOIN students 
   		ON students.NIM = student_test_report.NIM LEFT JOIN subject ON subject.subject_code = student_test_report.subject_code
   		where student_test_report.NIM = $NIM";
  	return $this->db->query($sql);
   }
  
  function get_subject_name($value)
   {
   	$value=$this->db->escape($value);
   	$sql="SELECT subject_name FROM subject WHERE subject_code=$value LIMIT 1";
   	return $this->db->query($sql);
   }
   
  function get_subject()
   {
     $sql="SELECT subject_code,subject_name FROM subject WHERE activated=1";
     $query=$this->db->query($sql);
     return $query;
   }
  
  function get_siswa_information($user)
   {
   	$user=$this->db->escape($user);
   	$sql="SELECT * FROM students where username= $user LIMIT 1";
  	return $this->db->query($sql);
   }
   
  function get_all_categories()
   {
     $sql="SELECT categories_code,categories_name FROM post_categories WHERE 1";
     return $this->db->query($sql);
   }
  
  function get_total_notifications()
   {
  	$sql="SELECT ID_post as num FROM posting_pages where post_categories='notif' and activated=1";
  	$q=$this->db->query($sql);
  	$num=1;
  	$n=$q->num_rows();
	if($n>6){
		$num=$n/6;
		if (strpos($num,'.')!=0)$num=substr($num,0,1)+1;
	}
	return $num;
   }
  
  function get_notifications($awal,$akhir)
   {
   	//$awal=$this->db>escape($awal);
   	//$akhir=$this->db>escape($akhir);
  	$sql="SELECT * FROM posting_pages where post_categories='notif' and activated=1 order by date_time DESC LIMIT $awal,$akhir";
  	return $this->db->query($sql);
   }
   
  function get_all_students_where($class,$jur='')
  {
  	$class=$this->db->escape($class);
  	$jur=$this->db->escape($jur);
  	if($jur == '')$whr_jur="";else $whr_jur="and student_major=$jur";
  	$sql="SELECT NIM,student_name,student_photo,student_major FROM students WHERE student_class = $class $whr_jur and activated = 1 LIMIT 30";
  	return $this->db->query($sql);
  }
   
  function get_all_students()
  {
  	$sql="SELECT NIM,student_name,student_photo,student_major FROM students WHERE student_class = $class $whr_jur and activated = 1 LIMIT 30";
  	return $this->db->query($sql);
  }
   
  function get_all_teacher_where($teach)
  {
  	$teach=$this->db->escape($teach);
  	$sql="SELECT NIK,teacher_name,teacher_photo FROM teachers WHERE teaching=$teach AND activated = 1 LIMIT 30";
  	return $this->db->query($sql);
  }
   
  function get_all_teacher()
  {
  	
  	$sql="SELECT * FROM teachers  WHERE activated = 1";
  	return $this->db->query($sql);
  }
   
  function get_notification_whereID($id)
   {
   $id=$this->db->escape($id);
   $sql="SELECT * FROM posting_pages where ID_post=$id";
  	return $this->db->query($sql);	
   }
   
  function get_complaint_where($userTo)//userto adalah nama user dari tujuan complaint
   {
   $user=$this->db->escape($userTo);
   $sql="SELECT * FROM complaint where complaint_to=$user ORDER BY state ASC";
  	return $this->db->query($sql);	
   }
   
  function get_content_detail($id)
   {
   	$id=$this->db->escape($id);
   	$sql="SELECT * FROM posting_pages where ID_post = $id and activated = 1 LIMIT 1";
   	return $this->db->query($sql);
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
   
  function get_teaching($user)
   {
  		$object='';
  		$user=$this->db->escape($user);
  		$sql="SELECT teachers.teaching,subject.subject_name FROM teachers LEFT JOIN subject ON subject.subject_code=teachers.teaching 
  				WHERE username=$user LIMIT 1";
  		$hasil=$this->db->query($sql);
  		$array="";
  		foreach($hasil->result() as $row){
  			  $array=array($row->subject_name,$row->teaching);
  			}
  		return $array;
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
   
  function get_my_profile($nik)
   {
     $NIK=$this->db->escape($nik);
     $sql="SELECT * FROM teachers where NIK = $NIK LIMIT 1";
     return $this->db->query($sql);
   }
   
  
   
  function get_major($maj)
   {
   	$major=$this->db->escape($maj);
   	$sql="SELECT major_name FROM majors where major_code = $major ";
   	return $this->db->query($sql)->result();
   }
   
  function check_if_exists_score($id,$NIM,$user){
  	$id=$this->db->escape($id);
  	$NIM=$this->db->escape($NIM);
  	$user=$this->db->escape($user);
  	$sql="SELECT * FROM student_test_report WHERE ID_test=$id AND NIM=$NIM AND user=$user LIMIT 1";
  	$query=$this->db->query($sql);
  	return $query->num_rows();
  }
  
  function get_student_score_by_id($id){
  	$id=$this->db->escape($id);
  	$sql="SELECT * FROM student_test_report WHERE ID_test=$id LIMIT 1";
  	return $this->db->query($sql);
  }
   
  function get_all_major()
   {
   	$sql="SELECT major_code,major_name FROM majors where activated=1 ";
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
   
  function get_data()
   {
   	$sql="SELECT * FROM students where 1 ";
  	return $this->db->query($sql);
   }

}
//end of file 


