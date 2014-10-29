<?php
	echo "<table class='table'>";
	echo "<tr> <th>id_kota</th> <th>nama_kota</th> <th>profinsi</th> <th> <th> </tr>";
foreach ($q->result()as $r){
$id=$r->ID_kota;

	echo "<tr>    
			 <td>".$r->ID_kota ."</td> 
			 <td>".$r->nama_kota ."</td> 
			 <td>".$r->profinsi ."</td>
			 <td>".anchor(get_site_url('edit/'.$id),'edit')."</td>
			 <td>".anchor(get_site_url('delete/'.$id),'delete')."</td>
		</tr>";
}
	echo"</table>";




?>