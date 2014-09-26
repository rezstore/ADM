<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title><?php if (!isset($title))$title="~"; echo "Pengajar :: ".$title; ?></title>
	
	<link rel="stylesheet" href="<?php echo teacher_css_url('layout.css'); ?>" type="text/css" >
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="<?php echo jquery_url('jquery-1.5.2.min.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo teacher_script_url('hideshow.js'); ?>" type="text/javascript"></script>
	<script src="<?php echo teacher_script_url('jquery.tablesorter.min.js'); ?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo teacher_script_url('jquery.equalHeight.js'); ?>"></script>
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
<header id="header">
	<hgroup>
		<h1 class="site_title"><a href="#">Pengajar</a></h1>
		<h2 class="section_title"><?php echo get_school_name(); ?></h2><div class="btn_view_site"><a href="#">View Site</a></div>
	</hgroup>
</header> <!-- end of header bar -->

<section id="secondary_bar">
	<div class="user">
		<p><?php  echo $profile." (".anchor(teacher_site_url('inbox'),get_message_count($profile,$model)." Messages").")";?></p>
		<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
	</div>
	<div class="breadcrumbs_container">
		<article class="breadcrumbs"><a href="#">Guru</a> <div class="breadcrumb_divider"></div> <a class="current"><?php  echo 'Page Info'; ?></a></article>
	</div>
</section><!-- end of secondary bar -->
