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
			 <div class="tab_container">
				<div id="tab1" class="tab_content">
					<table class="tablesorter" cellspacing="0"> 
					  <thead>	
						<tr> 
		    				 <th>No </th>
						 <th width="90">Tanggal</th> 
		    				 <th>Judul Tugas</th>
		    				 <th>Pelajaran</th> 
		    				 <th>Deskripsi</th>
		    				 <th></th>
						</tr> 
						<?php 
						$no=1;
						foreach ($activities->result() as $r) {
						?>
					  </thead>
					  <tbody> 
						<tr> 
		    				 <td><?php echo $no; ?></td> 
						 <td><?php echo get_indo_date_format($r->date); ?></th> 
		    				 <td><?php echo $r->title; ?></td>
		    				 <td><?php echo get_subject_name($r->subject,$model); ?></td> 
		    				 <td><?php echo $r->descriptions; ?></td> 
		    				 <td width="100">
		    				  <button class='delete' onclick="document.location='<?php echo student_site_url('activities','delete='.$r->ID_activity); ?>'">Hapus</button>  
		    				  <button class='edit' onclick="document.location='<?php echo student_site_url('activities','edit='.$r->ID_activity); ?>'">Edit</button>
		    				 </td>
						</tr>
						<?php 
						$no++;
						} ?>
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
