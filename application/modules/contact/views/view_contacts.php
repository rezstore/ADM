


<?php
	echo "<table class='table'>";
	echo "<tr> <th>id_kota</th> <th>nama_kota</th> <th>profinsi</th> </tr>";
foreach ($q->result()as $r){

	echo "<tr>    
			 <td>".$r->ID_kota."</td> 
			 <td>".$r->nama_kota."</td> 
			 <td>".$r->profinsi."</td>
		</tr>";
}
	echo"</table>";




?>