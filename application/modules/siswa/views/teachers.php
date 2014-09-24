<!doctype html>
<html lang="en">

<?php 
if(!isset($title))$title="";
$controller->get_head($title); ?>

<body>

	<?php  $controller->get_header();?>
	
	<?php  $controller->get_leftside();?>
	
	<section id="main" class="column">
		<?php 
		if (!isset($err))$pesan= "Selamat Datang Di ". get_school_name();  else $pesan= $err; 
		if (!isset($err))$style="";else $style="style='background:#E5EEB3'"; 
		?>
		<h4 class="alert_info" <?php echo $style; ?>><?php if (!isset($err))echo "Selamat Datang Di ". get_school_name();else echo $err; ?></h4>
		
		<article class="module width_full">
			<header><h3>Daftar Guru/Pengajar</h3></header>
			<?php
			  echo form_open();
			  echo nbs().input_text('find','');
			  echo form_submit('submit','Cari');
			  echo form_close();
			  ?>
			<div id="students-container">
			  <?php 
			  foreach($siswa->result() as $object){
			  	$nik=$object->NIK;
			  	$foto=$object->teacher_photo;
			  	$name=ucwords($object->teacher_name);
			  	if(strlen($name) > 14){$name=substr($name,0,12).'...';}
			  	$arr_img=anchor(student_site_url('teacher_profile/'.$nik),"<img src=".teacher_image_upload($foto,'')." width='100%' height='100%'>");
			    echo "<p class='students-main-content'>";
			  	echo "<photo class='student_image'>".$arr_img."</photo>";
			  	echo "<photo class='student_name'>".$name."</photo>";
			    echo "</p>";
			  }?>
			</div>

		</article><!--module width_full-->
		
	</section>


</body>

</html>
