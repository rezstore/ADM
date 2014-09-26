<?php
#______________get_attribute___________________________
function get_school_name()
 {
   return "SMK 03 Pancasila";
 }

#______________ getting info __________________________
function get_jk($val)
{
 if ($val == 1 or $val == '1'){$jk="Laki-Laki";}else{$jk="Perempuan";}
 return $jk;
}

function get_message_count($username,$model)
{
 $msg=$model->get_message_count($username);
 return $msg;
}

#________________ form ____________________________

function dropdown_subject($name,$value,$class,$m)
{
  if(empty($class)){
  $class='class="dropdown"';
  }
  $arr=$m->get_subject();
  $opt=array();
  foreach($arr->result() as $r){$opt[$r->subject_code]=$r->subject_name;}
  $form=form_dropdown($name,$opt,$value,$class);
 return $form;
}

function dropdown_gender($name,$val)
 {
   $class='class="dropdown"';
   $array=array('0'=>'Perempuan','1'=>'Laki-Laki');
   return form_dropdown($name,$array,$val,$class);
 }
 
function dropdown_agama($name,$val)
 {
   $class='class="dropdown"';
   $array=array('i'=>'Islam','k'=>'Kristen','kl'=>'Katolik','h'=>'Hindu','b'=>'Budha');
   return form_dropdown($name,$array,$val,$class);
 }
 
function dropdown_class($name,$val,$m)
 {
   $class='class="dropdown"';
   $hasil=$m->get_all_active_class();
   foreach($hasil->result() as $r){
     $opt_kelas[$r->class_code]=$r->class_name;
   }
   return form_dropdown($name,$opt_kelas,$val,$class);
 }
 
 
function dropdown_class_filter($name,$val,$m)
 {
   $class='class="dropdown" style="margin-top:-4px"';
   $hasil=$m->get_all_active_class();
   foreach($hasil->result() as $r){
     $opt_kelas[$r->class_code]=$r->class_name;
   }
   return form_dropdown($name,$opt_kelas,$val,$class);
 }
 
function dropdown_major($name,$major,$m)
{
  $arr=$m->get_all_major();// jika nilai activated =1 
  $opt=array();
  $class='class="dropdown"';
  foreach($arr->result() as $r){$opt[$r->major_code]=$r->major_name;}
  $form=form_dropdown($name,$opt,$major,'id="input-text"');
 return $form;
}
 
function dropdown_categories($name,$val,$m)
{
  $arr=$m->get_all_categories();
  $class='class="dropdown"';
  $opt=array();
  foreach($arr->result() as $r){$opt[$r->categories_code]=$r->categories_name;}
  $form=form_dropdown($name,$opt,$val,$class);
 return $form;
}

function text_input($name,$val,$array='')
 {
   $class='class="input"';
   return form_input($name,$val,$class);
 }

function auto_input($name,$val)
 {
   $class='id="autocomplete"';
   return form_input($name,$val,$class);
 }
 
function input_number($name,$val)
 {
   $array=array('name'=>$name,'value'=>$val,'class'=>"input",'maxlength'=>'3');
   return form_input($array);
 }
 
function textarea($name,$val)
 {
   $class='class="textarea"';
   return form_textarea($name,$val,$class);
 }
 
function get_subject_name($value,$model)
 {
   $name="undefined";
   $q=$model->get_subject_name($value);
   foreach($q->result() as $a){
     $name=$a->subject_name;
   }
   return $name;
 }

function select_class($val,$m)
{
 $data=$m->get_class_name($val);
 $kelas='...';
 foreach($data->result() as $r){$kelas=$r->class_name;}
 return $kelas;
}

function get_agama($val)
{
 if ($val == 'i'){$ag="Islam";}elseif($val == 'k'){$ag="Kristen";}elseif($val == 'ka'){$ag="Katholik";}
  elseif($val == 'h'){$ag="Hindhu";}else{$ag="Budha";}
 return $ag;
}


function get_major($val,$con)
{
 $jurusan=$con->get_major($val);
 if($jurusan == ''){$jurusan='undefined';}
 return $jurusan;
}

function form_class_home($name,$class,$m)
{
  $arr=$m->get_class();
  $opt=array();
  foreach($arr->result() as $r){$opt[$r->class_code]=$r->class_name;}
  $form=form_dropdown($name,$opt,$class,'id="input-text" style="width:100px;"');
 return $form;
}



?>
