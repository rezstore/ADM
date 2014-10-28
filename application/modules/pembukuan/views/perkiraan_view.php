<center><br>
<table width="60%" id="item" style='margin-bottom:20px;width:60%' class="table">
		        <tr>
		             <th colspan="2"><h2>Akun Perkiraan</h2> </th>
		             <th><?php echo anchor(get_site_url('add_perkiraan'),'Perkiraan Baru','class="btn btn-primary"'); ?></th>
		        </tr>
		        <tr>
		             <th>Perkiraan</th>
		             <th>Kode</th>
		             <th></th>
		        </tr>
<?php mulai(0,0,$ctrl); ?>
			<tr>
		             <!--<td>NO</td>-->
		             <td></td>
		             <td></td>
		             <td>
		             	<a href="<?php echo get_site_url('convert_akun_perkiraan'); ?>" class="btn btn-primary">
		             		Download PDF
		             	</a>
		             </td>
		        </tr>
		   </table>
</center>
<?php
function mulai($parent,$spc,$ctrl)
 {
 $n=1;
   $q=$ctrl->model_pembukuan->get_akun_perkiraan($parent);
	if ($q->num_rows() > 0){
		foreach ($q->result() as $data){
			echo "<tr>";
				$spasi = str_repeat(nbs(5),$spc);
				$q2=$ctrl->model_pembukuan->get_akun_perkiraan($data->ID);
				$q3=$ctrl->model_pembukuan->select_id_from_jurnal_detail($data->ID);
				//echo $data->id_parent;
				if($q3->num_rows() > 0 or $data->id_parent == 0){
				     $hps='';$edt='';
				}else{
				     $hps=anchor(get_site_url('delete_perkiraan?id='.$data->ID),'Hapus','class="btn btn-danger"');
				     $edt=anchor(get_site_url('edit_perkiraan?id='.$data->ID),'Edit','class="btn btn-default"');
				}
				?>
		                        <td><?php echo $spasi.$data->nama_akun . '<br>'; ?></td>
		                        <td><?php echo $data->kode; ?></td>
		                        <td><?php echo $hps.nbs(4).$edt; ?></td>
		                <?php
				mulai($data->ID,$spc + 1,$ctrl);
		        echo "</tr>";
			$n++;
		}
	}
 }

?>

