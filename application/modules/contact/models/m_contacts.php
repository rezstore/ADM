<?php 
class m_contacts extends CI_model {

function select (){
 $sql=" SELECT * FROM  daftar_kota WHERE 1";
 $qwr=$this->db->query($sql);
return $qwr;
}




}


?>