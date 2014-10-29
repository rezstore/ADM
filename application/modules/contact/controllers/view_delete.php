<?php
foreach($q->result()as $r){
 $nama=$r->nama_kota;
 $prof=$r->profinsi;

}

 echo form_open('contact/insert');
echo"<tr>
		
		<td>".form_input('nama',$nama)."</td>
		<td>".form_input('profinsi',$prof)."</td>
		<td>".form_submit('submit','kirim')."</td>
	</tr>";
echo form_close();
	echo"</table>";

?>