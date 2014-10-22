


<?php 
echo "<table class='table' style='width:70%'>";
foreach ($q->result()as $r){
$id=$r->activity_ID;
echo "<tr>
				<td>".$r->username."</td> 
				<td>".$r->date_post."</td> 
				<td>".$r->actifity_list ."</td> 
				<td>".anchor(get_site_url('edit/'.$id),' edit' ,'class="btn btn-primary"')."</td>
		</tr> ";


}
echo "</table>";



?>