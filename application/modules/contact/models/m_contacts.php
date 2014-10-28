<?php 
class m_contacts extends CI_model {

function select(){
	 $sql=" SELECT * FROM  daftar_kota WHERE 1";
	 $qwr=$this->db->query($sql);
	return $qwr;
}
function insert($nama,$profinsi){

	$nama=$this->db->escape($nama);
	$profinsi=$this->db->escape($profinsi);
	$sql="INSERT INTO `daftar_kota` (`ID_kota`, `nama_kota`, `profinsi`, `posis`) 
			VALUES ('', $nama, $profinsi, '')";
	$qwr=$this->db->query($sql);
	return $qwr;
}
function update($id,$nama,$profinsi){
	$id=$this->db->escape($id);
	$nama=$this->db->escape($nama);
	$profinsi=$this->db->escape($profinsi);
$sql="UPDATE daftar_kota SET nama_kota = $nama, 
	profinsi = $profinsi, posis = '' 
	WHERE daftar_kota.ID_kota = $id";
	$qwr=$this->db->query($sql);
	
}
function select_db($id){
$id=$this->db->escape($id);
$sql=" SELECT * FROM  daftar_kota WHERE id_kota=$id limit 1 ";
$qwr=$this->db->query($sql);
return $qwr;

}


}


?>