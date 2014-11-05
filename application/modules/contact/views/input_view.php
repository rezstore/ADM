<?php
	echo "<table class='table'>";
	echo "<tr>  <th>nama_kota</th> <th>profinsi</th> </tr>";

 echo form_open('contact/new_kota');
echo"<tr>
		
		<td>".form_input('nama')."</td>
		<td>".form_input('profinsi')."</td>
		<td>".form_submit('submit','kirim')."</td>
	</tr>";
echo form_close();
	echo"</table>";

?>