<aside id="sidebar" class="column">
		<div class="animated">Server Monitor</div>
		<hr/>
		<h3>Profile</h3>
		<ul class="toggle">
			<li class="icn_view_users"><?php echo anchor(student_site_url('profile'),'Lihat Profile');?></a></li>
		</ul>
		<h3>Berita dan kegiatan</h3>
		<ul class="toggle">
			<li class="icn_new_article"><?php echo anchor(student_site_url('add_activities'),'Tambah Tugas');?></li>
			<li class="icn_edit_article"><?php echo anchor(student_site_url('activities'),'Data Tugas');?></li>
			<li class="icn_categories"><?php echo anchor(student_site_url('notices'),'Pengumuman');?></li>
			<li class="icn_tags"><?php echo anchor(student_site_url('students'),'Teman');?></li>
			<li class="icn_teach"><?php echo anchor(student_site_url('teachers'),'Guru');?></li>
		</ul>
		<h3>nilai / raport</h3>
		<ul class="toggle">
			<li class="icn_folder"><?php echo anchor(student_site_url('score'),'Nilai Saya');?></li>
			<li class="icn_photo"><?php echo anchor(student_site_url('transkrip'),'Nilai Transkrip');?></li>
			<li class="icn_video"><?php echo anchor(student_site_url('print_score'),'Cetak Nilai');?></li>
			<li class="icn_audio"><?php echo anchor(student_site_url('problem_report'),'Laporkan Masalah');?></li>
		</ul>
		<h3>Account</h3>
		<ul class="toggle">
			<!--<li class="icn_settings"><a href="#">Pengaturan</a></li>
			<li class="icn_security"><a href="#">Privasi</a></li>-->
			<li class="icn_jump_back"><?php echo anchor(student_site_url('logout'),'Logout');?></li>
		</ul>
		
		<footer>
			<hr />
			<p><strong>Created by rezstore.com</strong></p>
			<p>Theme by MediaLoot</p>
		</footer>
	</aside><!-- end of sidebar -->
