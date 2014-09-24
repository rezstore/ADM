<?php

function get_jenis_kelamin($val)
{
 if ($val == 1 or $val == '1'){$jk="Laki-Laki";}else{$jk="Perempuan";}
 return $jk;
}

function get_kelas($val,$m)
{
 $data=$m->get_class_name($val);
 $kelas='Undefined';
 foreach($data->result() as $r){$kelas=$r->class_name;}
 return ' ( '.ucfirst($kelas).' )';
}

function get_agama($val)
{
 if ($val == 'i'){$ag="Islam";}elseif($val == 'k'){$ag="Kristen";}elseif($val == 'ka'){$ag="Katholik";}
  elseif($val == 'h'){$ag="Hindhu";}else{$ag="Budha";}
 return $ag;
}

function get_subject_name($val,$m)
{
 $q=$m->get_subject_name($val);
 $subject='-';
 foreach($q->result() as $r){
 	$subject=$r->subject_name;
 }
 return $subject;
}

function get_major_name($val,$con)
{
 $jurusan=$con->get_major($val);
 if(is_array($jurusan)){
 foreach($jurusan as $j)
  {
    $jurusan = $j->major_name;
  }
 }
 if($jurusan == ''){$jurusan='undefined';}
 return $jurusan;
}


function get_school_name()
 {
  return "SMK 03 PANCASILA AMBULU";
 }

######################################### FORM ################
function dropdown_kelas($name,$value,$m)
 {
 	$kelas=$m->select_all_class();
 	$class_dropdown='class="input_dropdown"';
 	foreach($kelas->result() as $r){
 	  $opt_kelas[$r->class_code]=$r->class_name;
 	}
 	return form_dropdown($name,$opt_kelas,$value,$class_dropdown);
 }

function dropdown_kelas_filter($name,$value,$m)
 {
 	$kelas=$m->select_all_class();
 	$class_dropdown='class="input_dropdown"';
 	$opt_kelas['']="Filter Kelas";
 	foreach($kelas->result() as $r){
 	  $opt_kelas[$r->class_code]=$r->class_name;
 	}
 	return form_dropdown($name,$opt_kelas,$value,$class_dropdown);
 }
 
function dropdown_jurusan($name,$value,$m)
 {
 	$jurusan=$m->select_all_jurusan();
 	$class_dropdown='class="input_dropdown"';
 	foreach($jurusan->result() as $r){
 	  $opt_jurusan[$r->major_code]=$r->major_name;
 	}
 	return form_dropdown($name,$opt_jurusan,$value,$class_dropdown);
 }
 
function dropdown_jenis_kelamin($name,$value)
 {
	$opt_jk=array('1'=>'Laki-Laki','0'=>'Perempuan');
	$class_dropdown='class="input_dropdown"';
 	return form_dropdown($name,$opt_jk,$value,$class_dropdown);
 }
 
function dropdown_subject($name,$value,$m)
 {
	$class_dropdown='class="input_dropdown"';
 	$q=$m->select_all_subject();
 	foreach($q->result() as $res){
 		$opt_sub[$res->subject_code]=$res->subject_name;
 	}
 	return form_dropdown($name,$opt_sub,$value,$class_dropdown);
 }
 
function dropdown_agama($name,$value)
 {
	$opt_agama=array('i'=>'Islam','k'=>'Kristen','kl'=>'Katolik','h'=>'Hindu','b'=>'Budha');
	$class_dropdown='class="input_dropdown"';
 	return form_dropdown($name,$opt_agama,$value,$class_dropdown);
}

function dropdown_report_subject($name,$value='')
 {
	$subject=array('nilai'=>'Masalah Nilai','Absensi'=>'Masalah Absensi','Pengajar'=>'Masalah Pengajar',
			'Fasilitas'=>'Masalah Fasilitas','Sistem pembelajaran'=>'Sistem Pembelajaran',
			'Antar siswa'=>'Antar Siswa','Lain-lain'=>'Lain-Lain');
	$class_dropdown='class="input_dropdown"';
 	return form_dropdown($name,$subject,$value,$class_dropdown);
}
 
function input_text($name,$value)
 {
 	$class_input='class="input_form"';
 	return form_input($name,$value,$class_input);
 }
 
function input_find($name,$value)
 {
 	$class_input='class="input_find"';
 	return form_input($name,$value,$class_input);
 }
 
function textarea($name,$value)
 {
 	$class_textarea='class="input_textarea"';
 	return form_textarea($name,$value,$class_textarea);
}
 
function textarea_report_penjelasan($name,$value)
 {
 	$class_textarea='class="input_textarea" ';
 	return "<textarea name=$name class='input_textarea' style='min-width:600px;min-height:300px;'>$value</textarea>";
 }

function get_indo_date_format($date)
 {
   if (strlen($date) == 10){
     $d=explode('-',$date);
     $y='-'.$d[0];$m='-'.$d[1];$day=$d[2];
     $indo_date=$day.$m.$y;
     return $indo_date;
   }
 }






?>
