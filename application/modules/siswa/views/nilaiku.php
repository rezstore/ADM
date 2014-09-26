<article class="module width_full">
	<header><h3>Daftar Nilai Saya</h3></header>
	<div class="module_content">
		<article class="stats_graph">
			<header><h3 class="tabs_involved" style="margin: 3px 0px;"><?php echo form_open().dropdown_kelas_filter('kelas',$kelas,$model).form_submit('cari','Cari').form_close(); ?></h3>
		<ul class="tabs">
   			<li><a href="#tab1">Harian</a></li>
    		<li><a href="#tab2">Semester</a></li>
		</ul>
	</header>

	<div class="tab_container">
		<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   				<th>No</th> 
   				<th>Kelas</th> 
    				<th>Nama Pelajaran</th> 
    				<th>UH 1</th> 
    				<th>UH 2</th>
    				<th>UH 3</th>
    				<th>UH 4</th>
    				<th>UH 5</th>
    				<th>UH 6</th>
    				<th>UH 7</th>
    				<th>UH 8</th>
    				<th>UH 9</th>
    				<th>UH 10</th>
    				<th>RR</th>
    				<th></th>
				</tr> 
			</thead> 
			<tbody> 
			<?php 
			$no=1;
			foreach($score->result() as $r){ 
			//echo var_dump($r);
			  $ID=$r->ID_test;
			  $kelas=$r->class;
			  $nama=$r->subject_name;
			  $n1=$r->u1;
			  $n2=$r->u2;
			  $n3=$r->u3;
			  $n4=$r->u4;
			  $n5=$r->u5;
			  $n6=$r->u6;
			  $n7=$r->u7;
			  $n8=$r->u8;
			  $n9=$r->u9;
			  $n10=$r->u10;
			?>
				<tr> 
    				<td><?php echo $no; ?></td> 
    				<td><?php echo $kelas; ?></td> 
    				<td><?php echo $nama; ?></td> 
    				<td><?php echo $n1; ?></td> 
    				<td><?php echo $n2; ?></td>
    				<td><?php echo $n3; ?></td>
    				<td><?php echo $n4; ?></td>
    				<td><?php echo $n5; ?></td>
    				<td><?php echo $n6; ?></td>
    				<td><?php echo $n7; ?></td>
    				<td><?php echo $n8; ?></td>
    				<td><?php echo $n9; ?></td>
    				<td><?php echo $n10; ?></td>
    				<td><?php echo substr(($n1+$n2+$n3+$n4+$n5+$n6+$n7+$n8+$n9+$n10)/10,0,4); ?></td>
    				<td><?php echo anchor(student_site_url('problem_report/'.$ID.'/1/index'),'<div class="error_report" title="Laporkan Kesalahan"></div>'); ?></td>
				</tr> 
			<?php  
			$no++;
			} ?>
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
	
			<div id="tab2" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
				<th>No</th> 
    				<th>Tahun Ajaran</th> 
   				<th>Kelas</th> 
    				<th>Nama Pelajaran</th> 
    				<th>Mid Semester 1</th> 
    				<th>Semester 1</th>
    				<th>Mid Semester 2</th> 
    				<th>Semester 2</th>
    				<th>RR</th>
				</tr> 
			</thead> 
			<tbody> 
			<?php 
			$no=1;
			foreach($score->result() as $r){ 
			  $kode=$r->subject_code;
			  $nama=$r->subject_name;
			  $kelas=$r->class;
			  $ms1=$r->mid_semester1;
			  $s1=$r->semester1;
			  $ms2=$r->mid_semester2;
			  $s2=$r->semester2;
			?>
				<tr> 
				<td><?php echo $no; ?></td> 
				<td><?php echo $kelas; ?></td> 
				<td><?php echo substr(md5($kode),2,6); ?></td> 
    				<td><?php echo $nama; ?></td>
    				<td><?php echo $ms1; ?></td>
    				<td><?php echo $s1; ?></td>
    				<td><?php echo $ms2; ?></td> 
    				<td><?php echo $s2; ?></td>
    				<td><?php echo substr(($ms1+$ms2+$s1+$s2)/4,0,4); ?></td>
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