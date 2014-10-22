<?php
foreach ($q->result()as $r){
echo "<table>";
echo "<tr><td>".$r->ID_kota."</td> <td>".$r->nama_kota."</td> <td></td></tr>";
echo"</table>";


}





?>