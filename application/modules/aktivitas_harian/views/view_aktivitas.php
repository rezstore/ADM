<?php 

echo "<table class='table table-striped' style='width:70%'>";
echo "<tr>
	<th>No</th>	<th>Tanggal</th>	<th>Aktivitas</th>	<th></th>	
	</tr>";
$n=1;
foreach ($q->result()as $r){
$id=$r->ID;
echo "<tr>
		<td>".$n."</td> 
		<td>".$r->date_time."</td> 
		<td>".ucfirst($r->message) ."</td> 
		<td>".anchor(get_site_url('edit/'.$id),' edit' ,'class="btn btn-default"')."</td>
	</tr> ";

$n++;
}
echo "</table>";



?>
