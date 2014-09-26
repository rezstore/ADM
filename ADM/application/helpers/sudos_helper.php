<?php
#______________get_attribute___________________________
function get_school_name()
 {
   return "SMK 03 Pancasila";
 }

#______________ getting info __________________________
function get_jk($val='')
{
 if ($val == 1 or $val == '1'){$jk="Laki-Laki";}else{$jk="Perempuan";}
 return $jk;
}

function get_message_count($username,$model)
{
 $msg=$model->get_message_count($username);
 return $msg;
}

function get_typeOfPost($type,$model){
 $q=$model->get_typeOfPost($type);
 foreach($q->result() as $r){
   return $r->categories_name;
 }
}
#________________ form ____________________________

function dropdown($name,$arr,$val='',$attr=""){
	$class='class="dropdown"'.$attr;
	return form_dropdown($name,$arr,$val,$class);
}

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

function dropdown_gender($name,$val,$style='')
 {
   $class='class="dropdown" '.$style;
   $array=array('0'=>'Perempuan','1'=>'Laki-Laki');
   return form_dropdown($name,$array,$val,$class);
 }
 
function dropdown_agama($name,$val='',$model,$attr='')
 {
   $class='class="dropdown"'.$attr;
   $array=array('i'=>'Islam','k'=>'Kristen','kl'=>'Katolik','h'=>'Hindu','b'=>'Budha');
   return form_dropdown($name,$array,$val,$class);
 }
 
function dropdown_class($name,$val='',$m,$attr='')
 {
   $class='class="dropdown" '.$attr;
   $hasil=$m->get_all_active_class();
   foreach($hasil->result() as $r){
     $opt_kelas[$r->class_code]=$r->class_name;
   }
   return form_dropdown($name,$opt_kelas,$val,$class);
 }
 
 
function dropdown_class_filter($name,$val,$m,$attr="")
 {
   $class='class="dropdown" style="margin-top:-4px"'.$attr;
   $hasil=$m->get_all_active_class();
   foreach($hasil->result() as $r){
     $opt_kelas[$r->class_code]=$r->class_name;
   }
   return form_dropdown($name,$opt_kelas,$val,$class);
 } 
 
function dropdown_subject_filter($name,$val="",$m,$attr="")
 {
  if ($val=='')$val='none';
   $class='class="dropdown" style="margin-top:-4px"'.$attr;
   $hasil=$m->get_all_active_subject();
   foreach($hasil->result() as $r){
     $opt_kelas["none"]="None";
     $opt_kelas[$r->subject_code]=$r->subject_name;
   }
   return form_dropdown($name,$opt_kelas,$val,$class);
 }
 
function dropdown_major($name,$major="",$m,$style='')
{
  $arr=$m->get_all_major();// jika nilai activated =1 
  $opt=array();
  $class='class="dropdown" '.$style;
  foreach($arr->result() as $r){$opt[$r->major_code]=$r->major_name;}
  $form=form_dropdown($name,$opt,$major,$class);
 return $form;
}
 
function dropdown_categories($name,$val="",$m)
{
  $arr=$m->get_all_categories();
  $class='class="dropdown"';
  $opt=array();
  foreach($arr->result() as $r){$opt[$r->categories_code]=$r->categories_name;}
  $form=form_dropdown($name,$opt,$val,$class);
 return $form;
}

function text_input($name,$val='',$style='')
 {
   $class='class="input" '.$style;
   return form_input($name,$val,$class);
 }

function auto_input($name,$val='')
 {
   $class='id="autocomplete"';
   return form_input($name,$val,$class='');
 }
 
function input_number($name,$val='')
 {
   $array=array('name'=>$name,'value'=>$val,'class'=>"input",'maxlength'=>'3');
   return form_input($array);
 }
 
function textarea($name,$val='')
 {
   $class='class="textarea"';
   return form_textarea($name,$val='',$class='');
 }
 
function get_subject_name($value='',$model)
 {
   $name="undefined";
   $q=$model->get_subject_name($value);
   foreach($q->result() as $a){
     $name=$a->subject_name;
   }
   return $name;
 }

function select_class($val='',$m)
{
 $data=$m->get_class_name($val);
 $kelas='...';
 foreach($data->result() as $r){$kelas=$r->class_name;}
 return $kelas;
}

function get_agama($val='')
{
 if ($val == 'i'){$ag="Islam";}elseif($val == 'k'){$ag="Kristen";}elseif($val == 'ka'){$ag="Katholik";}
  elseif($val == 'h'){$ag="Hindhu";}else{$ag="Budha";}
 return $ag;
}


function get_major($val='',$con)
{
 $jurusan=$con->get_major($val);
 if($jurusan == ''){$jurusan='undefined';}
 return $jurusan;
}

function form_class_home($name,$class='',$m)
{
  $arr=$m->get_class();
  $opt=array();
  foreach($arr->result() as $r){$opt[$r->class_code]=$r->class_name;}
  $form=form_dropdown($name,$opt,$class,'id="input-text" style="width:100px;"');
 return $form;
}

function pagging($jmlRec,$pagePosition,$jmlPerpage,$url){
	//echo $pagePosition.br().$jmlPerpage.br();
	$loc=$pagePosition + 1;
	$pageP=(($pagePosition-1) /$jmlPerpage)+1;
	$nextp= $pageP+1;	$prevp= $pageP-1;
	$jml=ceil($jmlRec/$jmlPerpage);
	$first=anchor(admin_site_url($url,'p=1'),"<div class='pagging' style='width:auto;'> First </div>");
	$last=anchor(admin_site_url($url,'p='.$jml),"<div class='pagging' style='width:auto;'> Last </div>");
	if ($pageP < $jml) $next=anchor(admin_site_url($url,'p='.$nextp),"<div class='pagging' style='width:auto;'> next </div>"); else $next="";
	if ($pageP > 1) $prev=anchor(admin_site_url($url,'p='.$prevp),"<div class='pagging' style='width:auto;'> prev </div>"); else $prev="";
	$jump=anchor(admin_site_url($url."#"),"<div class='pagging'>...</div>");
	//jika posisi record pada page kurang dari 7 maka default
	 $pagging = $first;
	 $pagging .= $prev;
	  for($a=1;$a<=$jml;$a++){
	//echo "|".($pagePosition + $a)."-";
		if ($pageP > 7 and $pagePosition + $a == $loc) {$pagging .= $jump; $a = $pageP-4;}
		if (strlen($a) >= 3)$style="style='width:auto;'";else $style='';
	  	$pagging .= anchor(admin_site_url($url,'p='.$a),"<div class='pagging' $style>".$a."</div>");
//	  	echo ($a + 5)."  | $jml | ".($jml-1).br();
//echo "$pageP == " .($a+1)."%" .$a.br();
		if ($jml > 20 and $a+5 <= $jml and $pageP == $a){$a += 1;
		$pagging .= anchor(admin_site_url($url,'p='.$a ),"<div class='pagging' $style>". $a ."</div>");}
		if ($jml > 20 and $a+5 <= $jml and $a >= 20 ) {$pagging .= $jump; $a=$jml-1;}
	  }
	 $pagging .= $next;
	 $pagging .= $last;
	return $pagging;
}


?>
