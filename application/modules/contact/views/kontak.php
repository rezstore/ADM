<?php
echo "<table class='table'>";
echo "<tr>    
		 <th>No</th> 
		 <th>Nama</th> 
		 <th>Alamat</th>
		 <th>Kota</th>
		 <th>Kode Pos</th>
		 <th>No. Telp1</th>
		 <th>No. Telp2</th>
		 <th>No. Telp3</th>
		 <th>email</th>
		 <th></th>
	 <tr>";
foreach($q->result()as $r){
$id=$r->ID_contact;
	echo "<tr>    
			 <td>".$r->ID_contact."</td> 
			 <td>".$r->nama ."</td> 
			 <td>".$r->alamat."</td>
			 <td>".$r->kota."</td>
			 <td>".$r->kode_pos."</td>
			 <td>".$r->nomor_telp1."</td>
			 <td>".$r->nomor_telp2."</td>
			 <td>".$r->nomor_telp3."</td>
			 <td>".$r->email."</td>
			 <td>".anchor(get_site_url('edit_contact/'.$id),'Edit','class="btn btn-default"').
					' '.anchor(get_site_url('delete_contact/'.$id),'Delete','class="btn btn-danger"').
					"</td>
			 <tr>";


}
echo "</table>";


?>