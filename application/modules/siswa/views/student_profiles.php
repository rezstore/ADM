<!doctype html>
<html lang="en">

<?php $controller->get_head($title); ?>


<body>

	<?php  $controller->get_header();?>
	
	<?php  $controller->get_leftside();?>
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Selamat Datang Di <?php echo get_school_name(); ?></h4>
		
		<article class="module width_full">
			<header><h3>Daftar Teman</h3></header>
			<div id="students-container">
			  <?php 
			  foreach($siswa->result() as $object){
			  	$nim=$object->NIM;
			  	$name=ucwords($object->student_name);
			  	$kelas=strtoupper($object->student_class).get_kelas($object->student_class,$model);
			  	$jurusan=get_major_name($object->student_major,$controller);
			  	$alamat=$object->student_address;
			  	$notelp=$object->student_phone_number;
			  	$email=$object->student_email;
			  	$agama=get_agama($object->religion);
			  	$foto=$object->student_photo;
			  	$arr_img=anchor('siswa/stdent/student_profiles/'.$nim,"<img src=".student_image_upload($foto,'')." width='100%' height='100%'>");
			  }
			  echo "<table>";
			  echo "<tr>	<td rowspan=10> <photo class='student_image_preview'>".$arr_img."</photo> </td>	<td colspan=3 bgcolor='#dffg'> Info Siswa </td>	</tr>";
			  echo "<tr>	<td>Nama</td> <td>:</td> <td>".$name."</td>	</tr>";
			  echo "<tr>	<td>Kelas</td> <td>:</td> <td>".$kelas."</td>	</tr>";
			  echo "<tr>	<td>Jurusan</td> <td>:</td> <td>".$jurusan."</td>	</tr>";
			  echo "<tr>	<td>Agama</td> <td>:</td> <td>".$agama."</td>	</tr>";
			  echo "<tr>	<td>Alamat</td> <td>:</td> <td>".$alamat."</td>	</tr>";
			  echo "<tr>	<td>No Hp</td> <td>:</td> <td>".$notelp."</td>	</tr>";
			  echo "<tr>	<td>Email</td> <td>:</td> <td>".$email."</td>	</tr>";
			  echo "<tr>	<td> </td> <td></td> <td></td>	</tr>";
			  $img_pesan=array('src'=>'assets/img/send_message.png', 'width'=>'80', 'height'=>'80', 'title'=>'Kirim Pesan');
			  $img_lihat_n=array('src'=>'assets/img/reports.gif', 'width'=>'80', 'height'=>'80', 'title'=>'Lihat Nilai');
			  $url=student_site_url('send_friend_message','id='.$nim);
			  echo "<tr>	<td>".anchor($url,img($img_pesan))."</td> <td></td> 
			  	<td>".anchor('siswa/student/view_student_score/'.$nim,img($img_lihat_n))."</td>	</tr>";
			  echo "</table>";
			  
			  ?>
			</div>
		</article><!--module width_full-->
		
	</section>


</body>

</html>
