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

$nama=array('name'=>'nama_akun','placeholder'=>'Nama Perkiraan','maxlength'=>'30','value'=>$value_nm,"style"=>'height:30px;');
$kode=array('name'=>'kode','placeholder'=>'Kode','maxlength'=>'5','value'=>$value_kd,"style"=>'height:30px;');
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
		<td>Nama Akun</td>
		<td>:</td>
		<td><?php echo form_input($nama); ?></td>
	</tr>
	<tr>
		<td>Kode</td>
		<td>:</td>
		<td><?php echo form_input($kode); ?></td>
	</tr>
	<!--<tr>
		<td>Jenis</td>
		<td>:</td>
		<td><?php echo form_input($jenis); ?></td>
	</tr>-->
	<tr>
		<td>Induk</td>
		<td>:</td>
		<td><?php echo form_dropdown('induk',$dropdown_induk,$selected); ?></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></br><?php echo form_submit('submit',$submit,'class="btn btn-primary"').' '.
				form_button('button','Batalkan','class="btn btn-warning"'); ?></td>
	</tr>
<?php echo form_close(); ?>
</table>
</canter>
