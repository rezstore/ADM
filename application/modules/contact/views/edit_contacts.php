<?php
foreach($q->result()as $r){
echo "<tr>
		<td>".$r->nama."</td>
		<td>".$r->alamat."</td>
		<td>".$r->kota."</td>
		<td>".$r->kode."</td>
		<td>".$r->nomor_tlp1."</td>
		<td>".$r->nomor_tlp2."</td>
		<td>".$r->nomor_tlp3."</td>
		<td>".$r->email."</td>
	</tr>";



}


?>