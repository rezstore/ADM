<!doctype html>
<html lang="en">

<?php 
if(!isset($title))$title="";
$controller->get_head($title); ?>	


<body>

	<?php  $controller->get_header();?>
	
	<?php  $controller->get_leftside();?>
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Selamat Datang Di <?php echo get_school_name(); ?></h4>
		<?php 
			  foreach($siswa->result() as $object){
			  	$nik=$object->NIK;
			  	$name=ucwords($object->teacher_name);
			  	$teach=get_subject_name($object->teaching,$model);
			  	$alamat=$object->teacher_address;
			  	$notelp=$object->teacher_phone_number;
			  	$email	=$object->teacher_email;
			  	$agama=get_agama($object->teacher_religion);
			  	$foto=$object->teacher_photo;
			  	$arr_img=anchor('siswa/student/teacher_profiles/'.$nik,"<img src=".teacher_image_upload($foto,'')." width='100%' height='100%'>");
			  }?>
		<article class="module width_full">
			<header><h3>Info Detail Dari <?php echo '" '.$name.' "'; ?></h3></header>
			<div id="students-container">
			  <?php
			  echo "<table>";
			  echo "<tr>	<td rowspan=10> <photo class='student_image_preview'>".$arr_img."</photo> </td>	<td colspan=3 bgcolor='#dffg'> Info Siswa </td>	</tr>";
			  echo "<tr>	<td>Nama</td> <td>:</td> <td>".$name."</td>	</tr>";
			  echo "<tr>	<td>Mengajar</td> <td>:</td> <td>".$teach."</td>	</tr>";
			  echo "<tr>	<td>Agama</td> <td>:</td> <td>".$agama."</td>	</tr>";
			  echo "<tr>	<td>Alamat</td> <td>:</td> <td>".$alamat."</td>	</tr>";
			  echo "<tr>	<td>No Hp</td> <td>:</td> <td>".$notelp."</td>	</tr>";
			  echo "<tr>	<td>Email</td> <td>:</td> <td>".$email."</td>	</tr>";
			  echo "<tr>	<td> </td> <td></td> <td></td>	</tr>";
			  $url=student_site_url('send_teacher_message','id='.$nik);
			  $img_pesan=array('src'=>'assets/img/send_message.png', 'width'=>'80', 'height'=>'80', 'title'=>'Kirim Pesan');
			  echo "<tr>	<td>".anchor($url,img($img_pesan))."</td> <td></td> 
			  		<td></td>	</tr>";
			  echo "</table>";
			  
			  ?>
			</div>
		</article><!--module width_full-->
		
	</section>


</body>

</html>
