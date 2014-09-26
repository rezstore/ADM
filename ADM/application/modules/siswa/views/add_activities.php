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
		
		<article class="module width_full">
			<header><h3 style="width:200px">Input Tugas Baru</h3>
			 <ul class="tabs">
	   			<li><a href="#tab1">Tugas Ku</a></li>
			 </ul>
			</header>
			<div class="module_content">
				<article class="stats_graph">

			<div class="tab_container">
				<div id="tab1" class="tab_content">
					<table class="tablesorter" cellspacing="0"> 
					  <tbody> 
					    <?php
					    if(isset($edit)){
					      foreach($edit->result() as $a){
					        $action=student_site_url("update_activities",'id='.$a->ID_activity);
					        $title=$a->title;
					        $subject=$a->subject;
					        $desc=$a->descriptions;
					      }
					    }else{
					    	$action=student_site_url("add_new_activities");
					    	$title='Judul';
					        $subject='Pelajaran';
					        $desc='Deskripsi';
					    }
					      echo form_open($action); ?>
						<tr> 
						 <td width="200">Judul Tugas</th> 
		    				 <td><?php echo input_text('judul',$title); ?></td> 
						</tr> 
						<tr> 
						 <td width="200">Pelajaran</th> 
		    				 <td><?php echo dropdown_subject('subject',$subject,$model); ?></td> 
						</tr> 
						<tr> 
						 <td width="200" style="vertical-align:top">Deskripsi</th> 
		    				 <td><?php echo textarea('deskripsi',$desc); ?></td> 
						</tr> 
						<tr> 
						 <td></th> 
		    				 <td><?php echo form_submit('submit','Simpan'); ?></td> 
						</tr> 
					    <?php echo form_close(); ?>
					  </tbody>
					</table>

				</div><!-- end of #tab2 -->
	
			    </div><!-- end of .tab_container -->
				</article><!-- end of stats article -->
		
				<div class="clear"></div>
			</div>
		</article><!--module width_full-->
		
	</section>


</body>

</html>
