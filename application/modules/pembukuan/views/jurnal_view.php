<center><br>
<?php
$n=explode('-',$bulan);
$b=$n[1];
?>
<table width="60%" class="table" style='margin-bottom:20px;'>
        <tr>
             <td colspan="5"><?php /*echo '<form method="get">'.
             				'Bulan: '.combo_bulan($b).
             				' tahun: '.combo_tahun('2','2013').
             				form_submit('submit','filter').
             				form_close(); */?></td>
        </tr>
        <tr style="height:100px;">
             <td colspan="4"><h2>Jurnal View</h2></td>
             <td valign='top'><?php echo anchor(get_site_url('add_jurnal'),'Tambah Jurnal','class ="btn btn-default"'); ?></td>
        </tr>
        <tr style='text-align:center;'>
             <td colspan=2>Tanggal</td>
             <td>Keterangan</td>
             <td>debit</td>
             <td>kredit</td>
        </tr>
<?php
foreach($query->result() as $row)
 {
    $t=$row->tanggal;
         if ($t != ''){
           $expr=explode('-',"$t");
                 $y=$expr[0];
                 $m=$expr[1];
                 $d=$expr[2];
                 $dt=$d.'-'.$m.'-'.$y;
         }else{$thn='';$t='';}?>
		        <tr>
		             <!--<td>NO</td>-->
		             <td colspan=5><?php echo '<b>'.$dt.'</b>'; ?></td>
		        </tr>
     <?php 
       $jvt=$this->model_pembukuan->jurnal_view_tree($t,0);
       if ($jvt->num_rows() > 0)
        {
         $tmp_id=0;$n=1;
         $jvtres=$jvt->result();
		foreach ($jvtres as $data){
		if($tmp_id != $data->ID_jurnal){?>
		          <td><?php echo ''; ?></td>
                          <td><?php echo ''; ?></td>
                          <td style="font-style:italic; color:grey;"><?php echo ucwords($data->keterangan); ?></td>
                          <td colspan=2><?php echo anchor("pembukuan/delete_jurnal?id=".$data->ID_jurnal,"Delete"); ?></td>
<?php		}

                $tmp_id=$data->ID_jurnal;
		echo "<tr>";
		if ($data->kredit > '0'){$spasi = str_repeat(nbs(5),1);}else{$spasi = '';}
			?>
                          <td><?php echo ''; ?></td>
                          <td><?php echo ''; ?></td>
                          <td><?php echo $spasi.$data->nama_akun; ?></td>
                          <td style="text-align:right;"><?php echo number_format($data->debet); ?></td>
                          <td style="text-align:right;"><?php echo number_format($data->kredit); ?></td>
                        <?php
                echo "</tr>";
		$n++;
		}
	} else {
		echo '';
	}
 }
 
?>
			<tr style='text-align:center;'>
			     <td colspan=4></td>
			     <td><?php echo anchor(get_site_url('convert_jurnal/'.$bulan),'Download PDF','class="btn btn-warning"');?></td>
			</tr>
		        
		   </table>
</center>
