<?php 
$action="insert_contacts";
$nama="";$alamat="";$kota="";$kode="";$notlp1="";$notlp2="";$notlp3="";$email="";
if(isset ($q)){
	foreach($q->result()as $r){
	$nama=$r->nama;
	$alamat=$r->alamat;
	$kota=$r->kota;
	$kode=$r->kode_pos;
	$notlp1=$r->nomor_telp1;
	$notlp2=$r->nomor_telp2;
	$notlp3=$r->nomor_telp3;
	$email=$r->email;
	$action="edit_contact";
	}
}
echo "<table class='table'>";
echo form_open(get_site_url($action));
echo "<tr>
		<td>nama</td> <td>".input('name',$nama)."</td>
	</tr>
	<tr>
	<td>alamat</td> <td>".textarea('alamat',$alamat,'style="height:100px; "')."</td>
	</tr>
	<tr>
		<td>kota</td> <td>".input('kota',$kota)."</td>
	</tr>
	<tr>
		<td>kode_pos</td> <td>".input('kode_pos',$kode)."</td>
	</tr>
	<tr>
		<td>notlp1</td> <td>".input('notlp1',$notlp1)."</td>
	</tr>
	<tr>
		<td>notlp2</td> <td>".input('notlp2',$notlp2)."</td>
	</tr>
	<tr>
		<td>notlp3</td> <td>".input('notlp3',$notlp3)."</td>
	</tr>
	<tr>
		<td>email</td> <td>".input('email',$email)."</td>
	</tr><tr>
		<td></td><td>".form_submit('submit','kirim')."</td>
		
	</tr>";
	echo form_close();
echo "</table>";









?>