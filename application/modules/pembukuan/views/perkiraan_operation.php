<center><br>
<?php
if ($type==1)
{
        foreach ($qry->result() as $row)
        {
          $id=$row->ID;
          $nm=$row->nama_akun;
          $kd=$row->kode;
          $jn=$row->jenis;
          $id_p=$row->id_parent;
        }
  $value_nm=$nm;
  $value_kd=$kd;
  $value_jn=$jn;
  $selected=$id_p;
  $action='pembukuan/update_perkiraan?id='.$id;
  $submit='Save';
}else{
  $value_nm='';$value_kd='';$value_jn='';$selected='';$action='pembukuan/tambah_akun_perkiraan';$submit='Tambahkan';
}

$nama=array('name'=>'nama_akun','placeholder'=>'Nama Perkiraan','maxlength'=>'30','value'=>$value_nm);
$kode=array('name'=>'kode','placeholder'=>'Kode','maxlength'=>'5','value'=>$value_kd);
//$jenis=array('name'=>'jenis','placeholder'=>'Jenis','maxlength'=>'5',$value_jn,'disabled'=>'disabled');
$dropdown_induk=array();
foreach($dropdwn as $drp)
 {
   $dropdown_induk[$drp->ID]=$drp->nama_akun;
 }
?>
<table border="0" width=700>
<?php echo form_open($action); ?>
	<tr>
		<td class="td-head" colspan="3">Form Akun Perkiraan</td>
	</tr>
	<tr>
		<td class="td-kecil">Nama Akun</td>
		<td class="td-kecil">:</td>
		<td class="td-kecil"><?php echo form_input($nama); ?></td>
	</tr>
	<tr>
		<td class="td-kecil">Kode</td>
		<td class="td-kecil">:</td>
		<td class="td-kecil"><?php echo form_input($kode); ?></td>
	</tr>
	<!--<tr>
		<td class="td-kecil">Jenis</td>
		<td class="td-kecil">:</td>
		<td class="td-kecil"><?php echo form_input($jenis); ?></td>
	</tr>-->
	<tr>
		<td class="td-kecil">Induk</td>
		<td class="td-kecil">:</td>
		<td class="td-kecil"><?php echo form_dropdown('induk',$dropdown_induk,$selected); ?></td>
	</tr>
	<tr>
		<td class="td-kecil"></td>
		<td class="td-kecil"></td>
		<td class="td-kecil"><?php echo form_submit('submit',$submit).form_button('button','Batalkan'); ?></td>
	</tr>
<?php echo form_close(); ?>
</table>
</canter>
