<?php
foreach ($q->result()as $r){
$id=$r->ID_kota;
 $nama=$r->nama_kota;
 $pro=$r->profinsi;
}
	echo "<table class='table'>";
	echo "<tr>  <th>nama_kota</th> <th>profinsi</th> </tr>";

 echo form_open('contact/edit/'.$id);
echo"<tr>
		
		<td>".form_input('nama',$nama)."</td>
		<td>".form_input('profinsi',$pro)."</td>
		<td>".form_submit('submit','kirim')."</td>
	</tr>";
echo form_close();
	echo"</table>";

?>