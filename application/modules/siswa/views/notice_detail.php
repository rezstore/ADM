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
			<header><h3 style="width:200px;">Daftar Nilai Saya</h3>
				<ul class="tabs">
		   			<li><a href="#tab1">Pengumuman</a></li>
				</ul>
			</header>
			<div class="module_content">
				<article class="stats_graph">

			<div class="tab_container">
				<div id="tab1" class="tab_content">
					<table class="tablesorter" cellspacing="0"> 
					<tbody> 
					 <?php 
					 foreach($post_detail->result() as $r){
					  $title=$r->post_title;
					  $content=$r->post_content;
					  $author=$r->created_by;
					  $time=$r->date_time;
					 ?>
						<tr> 
						<th colspan = "4" class="content"><?php echo strtoupper($title)."<p class='content'>".$content."</p>"; ?></th> 
						</tr>
						 
						<tr> 
						<td width="200"><?php echo $time; ?></th> 
		    				<td></td> 
		   				<td></td> 
		    				<td width="100"><button class="read_more" onclick="history.back();">Back</button></td> 
						</tr> 
					<?php } ?>
					</tbody> 
					</table>
					</div><!-- end of #tab1 -->

					<div id="tab2" class="tab_content">
					<table class="tablesorter" cellspacing="0"> 
					<thead> 
						<tr> 
						<th>No</th> 
		    				<th>Tahun Ajaran</th> 
		   				<th>Kode pelajaran</th> 
		    				<th>Nama Pelajaran</th> 
						</tr> 
					</thead> 
					<tbody> 
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