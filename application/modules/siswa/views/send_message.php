<!doctype html>
<html lang="en">

<?php 
if(!isset($title))$title="";
$controller->get_head($title); ?>

<script src="<?php echo tinymce_url('tinymce.min.js');?>"></script>
<script>
	 tinymce.init({selector:'textarea'});
</script>
<body>
	<?php  $controller->get_header();?>
	
	<?php  $controller->get_leftside();?>
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Selamat Datang Di <?php echo get_school_name(); ?></h4>
		<article class="module width_full">
		<?php
		if(!isset($user_to)) $user_to='';
		$u=explode(':',$user_to);
		$userTo=$u[0];
		$name=$u[1];
		?>
			<header><h3>Kirim Pesan Ke <?php echo '" '.$name.' "'; ?></h3></header>
			<div id="students-container">
			  <?php
			  $url=student_site_url('send','to='.$type);
			  echo form_open($url);
			  echo "<table>";
			  echo form_hidden('id',$userTo);
			  echo "<tr> <td>Tujuan</td> <td>:</td> <td>".form_input('Nama',$name,'disabled="true"')."</td> </tr>";
			  echo "<tr style='vertical-align:top;'> <td>Content</td> <td>:</td> <td>".form_textarea('content','','class="input_textarea"')."</td> </tr>";
			  echo "<tr> <td colspan='3' style='text-align:right;'>".form_submit('submit','Kirim')."</td </tr>";
			  echo "</table>";
			  echo form_close();
			  ?>
			</div>
		</article><!--module width_full-->
		
	</section>


</body>

</html>
