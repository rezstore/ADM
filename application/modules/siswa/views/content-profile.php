
<article class="module width_full">
	<header><h3 style="width:200px;">Informasi Profile Saya</h3>
		<ul class="tabs">
   			<li><a href="#tab1">Pribadi</a></li>
    			<li><a href="#tab2">Ortu/wali</a></li>
    			<li><a href="#tab3">Edit</a></li>
		</ul>
	</header>
	  <div class="module_content">
		<article class="stats_graph">

		<?php 
		foreach ($data_profile->result() as $s)
		 {
			$nim=$s->NIM;
			$nama_s=ucwords($s->student_name);
			$kelas=$s->student_class;
			$jurusan=$s->student_major;
			$jk=$s->student_gender;
			$agama=$s->religion;
			$alamat=ucfirst($s->student_address);
			$email=$s->student_email;
			$kota=ucwords($s->student_city);
			$pos=$s->student_postal_code;
			$notelp=$s->student_phone_number;
			$info=$s->student_info;
			$nama_ortu=ucwords($s->parent_name);
			$jk_ortu=$s->parent_gender;
			$ag_ortu=$s->parent_religion;
			$almt_ortu=ucfirst($s->parent_address);
			$kota_ortu=ucfirst($s->parent_city);
			$post_ortu=$s->parent_post;	
			$no_tlp_ortu=$s->parent_number;	
		 }
		?>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
				<table class="tablesorter" cellspacing="0" style="width:100%;"> 
				<thead> 
					<tr> 
	   				<th colspan=4> Informasi Umum Saya</th> 
					</tr> 
				</thead> 
				<tbody> 
					<tr> 
	    				<td width="100">NIM</td> <td width="10">:</td> <td><?php echo $nim; ?></td> <td> </td>
					</tr> 
					<tr> 
	    				<td>Nama</td> <td>:</td> <td><?php echo $nama_s; ?></td> <td></td>
					</tr>
					<tr> 
	    				<td>Kelas</td> <td>:</td> <td><?php echo strtoupper($kelas).get_kelas($kelas,$model); ?></td> <td></td>
					</tr>
					<tr> 
	    				<td>Jurusan</td> <td>:</td> <td><?php echo get_major_name($jurusan,$model); ?></td> <td></td>
					</tr> 
					<tr> 
	    				<td>Alamat Email</td> <td>:</td> <td><?php echo ucfirst($email); ?></td> <td></td>
					</tr> 
				</tbody> 
			
				<thead> 
					<tr> 
	   				<th colspan=4> Informasi Detail Saya</th> 
					</tr> 
				</thead> 
				<tbody> 
					<tr> 
	    				<td>Jenis Kelamin</td> <td>:</td> <td><?php echo get_jenis_kelamin($jk); ?></td> <td></td>
					</tr>
					<tr> 
	    				<td>Alamat</td> <td>:</td> <td><?php echo $alamat; ?></td> <td></td>
					</tr> 
					<tr> 
	    				<td>Agama</td> <td>:</td> <td><?php echo get_agama($agama); ?></td> <td></td>
					</tr> 
					<tr> 
	    				<td>Kota</td> <td>:</td> <td><?php echo $kota; ?></td> <td></td>
					</tr>
					<tr> 
	    				<td>Kode Pos</td> <td>:</td> <td><?php echo $pos; ?></td> <td></td>
					</tr> 
					<tr> 
	    				<td>Nomor Telp</td> <td>:</td> <td><?php echo $notelp; ?></td> <td></td>
					</tr> 
					<tr> 
	    				<td>Info Saya</td> <td>:</td> <td><?php echo $info; ?></td> <td></td>
					</tr> 
				</tbody> 
			
				</table>
			</div><!-- end of #tab1 -->
	
			<div id="tab2" class="tab_content">
				<table class="tablesorter" cellspacing="0"> 
				<thead> 
					<tr> 
	   				<th colspan=4> Informasi Orangtua / Wali</th> 
					</tr> 
				</thead> 
				<tbody> 
					<tr> 
	    				<td width="100">Nama Ortu/Wali</td> <td width="10">:</td> <td><?php echo $nama_ortu; ?></td> <td></td>
					</tr>
					<tr> 
	    				<td>Alamat</td> <td>:</td> <td><?php echo $almt_ortu; ?></td> <td></td>
					</tr>
					<tr> 
	    				<td>Jenis Kelamin</td> <td>:</td> <td><?php echo get_jenis_kelamin($jk_ortu); ?></td> <td></td>
					</tr> 
					<tr> 
	    				<td>Agama</td> <td>:</td> <td><?php echo get_agama($ag_ortu); ?></td> <td></td>
					</tr> 
					<tr> 
	    				<td>Kota</td> <td>:</td> <td><?php echo $kota_ortu; ?></td> <td></td>
					</tr>
					<tr> 
	    				<td>Kode Pos</td> <td>:</td> <td><?php echo $post_ortu; ?></td> <td></td>
					</tr> 
					<tr> 
	    				<td>No telp</td> <td>:</td> <td><?php echo $no_tlp_ortu; ?></td> <td></td>
					</tr> 
				</tbody> 
				</table>

			</div><!-- end of #tab2 -->
		
			<div id="tab3" class="tab_content">
			  <?php echo form_open(student_site_url('update_student_info'));?>	
				<table class="tablesorter" cellspacing="0"> 
				<thead> 
					<tr> 
	   				<th colspan=4> Informasi Umum Saya</th> 
					</tr> 
				</thead> 
				<tbody> 
					<tr> 
	    				<td width="100">NIM</td> <td width="300"><?php echo input_text('nama',$nim); ?></td> 
	    				<td>Kelas</td> 		 <td><?php echo dropdown_kelas('kelas',$kelas,$model); ?></td>
					</tr> 
					<tr> 
	    				<td>Nama</td>		 <td><?php echo input_text('nama',$nama_s); ?></td>
	    				<td>Jurusan</td> 	 <td><?php echo dropdown_jurusan('jurusan',$jurusan,$model); ?></td>
					</tr>
				</tbody> 
			
				<thead> 
					<tr> 
	   				<th colspan=4> Informasi Detail Saya</th> 
					</tr> 
				</thead> 
				<tbody> 
					<tr> 
		    				<td>Jenis Kelamin</td> <td><?php echo dropdown_jenis_kelamin('jenis_kelamin',$jk); ?></td>
		    				<td>Agama</td>  	<td><?php echo dropdown_agama('agama',$agama); ?></td>
					</tr>
					<tr> 
		    				<td>Alamat Email</td> 	 <td><?php echo input_text('email',$email); ?></td>
		    				<td>Nomor Telp</td>  	<td><?php echo input_text('no_telp',$notelp); ?></td>
					</tr> 
					<tr> 
		    				<td>Kota</td>  		<td><?php echo input_text('kota',$kota); ?></td> 
		    				<td>Kode Pos</td>  	<td><?php echo input_text('kode_pos',$pos); ?></td>
					</tr>
					<tr> 
		    				<td>Info Saya</td> 	 <td><?php echo textarea('info',$info); ?></td>
		    				<td>Alamat</td>  	<td><?php echo textarea('siswa_alamat',$alamat); ?></td> 
					</tr> 
				</tbody> 
				<thead> 
					<tr> 
	   				<th colspan=4> Informasi Orangtua / Wali</th> 
					</tr> 
				</thead> 
				<tbody> 
					<tr> 
		    				<td width="100">Nama Ortu/Wali</td> 	<td><?php echo input_text('nama_ortu',$nama_ortu); ?></td>
		    				<td>Agama</td>	 <td> <?php echo dropdown_agama('agama_ortu',$ag_ortu); ?></td>
					</tr>
					<tr> 
		    				<td>Jenis Kelamin</td>			<td><?php echo dropdown_jenis_kelamin('jk_ortu',$jk_ortu); ?></td>
		    				<td>Kota</td>	 <td><?php echo input_text('kota_ortu',$kota_ortu); ?> </td>
					</tr> 
					<tr> 
		    				<td>Nomor Telp</td> 			<td><?php echo input_text('parent_number',$no_tlp_ortu); ?></td>
		    				<td>Kode Pos</td>	 <td><?php echo input_text('kode_post_ortu',$post_ortu); ?> </td>
					</tr>
					<tr>
		    				<td>Alamat</td> 			<td><?php echo textarea('alamat_ortu',$almt_ortu); ?></td>
					</tr>
					<tr> 
		    				<td></td> 			<td></td>
		    				<td></td>	 <td><?php echo form_submit('submit',"Simpan",'class="input_submit"'); ?> </td>
					</tr>
				</tbody> 
				</table>
			  <?php echo form_close(); ?>
			</div><!-- end of #tab2 -->
	
		    </div><!-- end of .tab_container -->
		</article><!-- end of stats article -->
		
		<div class="clear"></div>
	</div>
</article><!--module width_full-->
