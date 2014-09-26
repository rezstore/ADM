<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>Dashboard I Admin Panel</title>
	
	<link rel="stylesheet" href="<?php echo student_css_url('layout.css'); ?>" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="<?php echo jquery_url('jquery-1.5.2.min.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo student_script_url('hideshow.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo student_script_url('jquery.tablesorter.min.js'); ?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo student_script_url('jquery.equalHeight.js'); ?>"></script>
	<script type="text/javascript">
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>

	<?php  $controller->get_header();?>
	
	<?php  $controller->get_leftside();?>
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Selamat Datang Di <?php echo get_school_name(); ?></h4>
<!-- =================================-->		
		<article class="module width_full">
	<header><h3 style="width:200px">Report Kesalahan</h3>
	<ul class="tabs">
		<li><a href="#tab1">Laporkan</a></li>
		<li><a href="#tab2">Detail</a></li>
	</ul>
	</header>
	<div class="module_content">

	<div class="tab_container">
			<div id="tab1" class="tab_content">
				<div class="tab_container">
					<div id="tab1" class="tab_content">
					</div><!-- end of id=tab2 -->
					<?php echo form_open(''); ?>
						<table style="text-indent:30px;">
						 <tr>
							<td>Subject</td>	<td><?php echo dropdown_report_subject('subject',''); ?></td>
						 </tr> 
						 <tr>
							<td valign="top">Penjelasan</td>	<td><?php echo textarea_report_penjelasan('penjelasan',$value); ?></td>
						 </tr> 
						 <tr>
							<td></td>	<td><?php echo form_submit('submit','Kirim'); ?></td>
						 </tr> 
						</table>
						<?php echo form_close(); ?>
				</div><!-- end of .tab_container -->				
			</div><!-- end of #tab1 -->
	
			<div id="tab2" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
				<th width="30">No</th> 
    				<th width="180">Tanggal</th> 
   				<th width="120">Subject</th> 
    				<th>Penjelasan</th>
    				<th>Status</th>
    				<th></th><th></th> 
				</tr> 
			</thead> 
			<tbody> 
			<?php 
			$no=1;
			foreach($problem->result() as $r){ 
			  $id=$r->ID_report;
			  $tgl=$r->date;
			  $sub=$r->subject;
			  $desc=$r->content;
			  $s=$r->state;
			  if ($s==0)$state="Terkirim";else $state="Terbaca";
			?>
				<tr> 
				 <td><?php echo $no; ?></td> 
				 <td><?php echo $tgl; ?></td> 
				 <td><?php echo 'Masalah '.$sub; ?></td> 
    				 <td><?php echo $desc; ?></td>
    				 <td><?php echo $state; ?></td>
    				 <td><button onclick="document.location='<?php echo student_site_url('lihat_problem','id='.$id); ?>'">Lihat</button></td>
    				 <td><button onclick="document.location='<?php echo student_site_url('delete_problem','id='.$id); ?>'">Hapus</button></td>
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

<!-- ==============================-->		

	</section>


</body>

</html>
