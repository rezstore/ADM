<header id="header">
	<hgroup>
		<h1 class="site_title"><a href="index.html">Siswa</a></h1>
		<h2 class="section_title"><?php echo get_school_name();?></h2><div class="btn_view_site"><a href="#">My page</a></div>
	</hgroup>
</header> <!-- end of header bar -->

<section id="secondary_bar">
	<div class="user">
		<p><?php echo $this->session->userdata('userdata') . ' ('. $controller->get_chats_unread($this->session->userdata('userdata')) .')';?></p>
		<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
	</div>
	<div class="breadcrumbs_container">
		<article class="breadcrumbs"><a href="#">Website Admin</a> <div class="breadcrumb_divider"></div> <a class="current">Profile</a></article>
	</div>
</section><!-- end of secondary bar -->
