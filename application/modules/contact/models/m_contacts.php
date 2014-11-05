<?php 
define('T_KOTA','daftar_kota');

class m_contacts extends CI_model {

	function daftar_kota(){
		 $sql=" SELECT * FROM  daftar_kota WHERE 1";
		 $qwr=$this->db->query($sql);
		return $qwr;
	}
	
	function insert($nama,$profinsi){

		$nama=$this->db->escape($nama);
		$profinsi=$this->db->escape($profinsi);
		$sql="INSERT INTO ".T_KOTA." (`ID_kota`, `nama_kota`, `profinsi`, `posis`) 
				VALUES ('', $nama, $profinsi, '')";
		$qwr=$this->db->query($sql);
		return $qwr;
	}
	
	function update($id,$nama,$profinsi){
		$id=$this->db->escape($id);
		$nama=$this->db->escape($nama);
		$profinsi=$this->db->escape($profinsi);
		$sql="UPDATE ".T_KOTA." SET nama_kota = $nama, 
				profinsi = $profinsi, posis = '' 
				WHERE ".T_KOTA.".ID_kota = $id";
		$qwr=$this->db->query($sql);
	}

	function select_kota_where($id){
		$id=$this->db->escape($id);
		$sql=" SELECT * FROM ".T_KOTA." WHERE id_kota=$id limit 1 ";
		$qwr=$this->db->query($sql);
		return $qwr;
	}
	
	function delete($id){
		$id=$this->db->escape($id);
		$sql="DELETE FROM ".T_KOTA." WHERE `ID_kota` = $id";
		$qwr=$this->db->query($sql);
		return $qwr;
	}

	function view_contacts(){
		$sql="SELECT * FROM contacts WHERE 1";
		$qwr=$this->db->query($sql);
		return $qwr;	
	}
	function input_db($nama,$alamat,$kota,$kode,$notlp1,$notlp2,$notlp3,$email){
	$nama=$this->db->escape($nama);
	$alamat=$this->db->escape($alamat);
	$kota=$this->db->escape($kota);
	$kode=$this->db->escape($kode);
	$notlp1=$this->db->escape($notlp1);
	$notlp2=$this->db->escape($notlp2);
	$notlp3=$this->db->escape($notlp3);
	$email=$this->db->escape($email);
	$sql="INSERT INTO `contacts` (`ID_contact`, `nama`, `alamat`, `kota`, `kode_pos`, `nomor_telp1`, `nomor_telp2`, `nomor_telp3`, `email`, `status`)
		VALUES (NULL, $nama, $alamat, $kota, $kode,$notlp1, $notlp2,$notlp3,$email, '')";
	$qwr=$this->db->query($sql);
	return $qwr;
	}
	function edit_contacts($id,$nama,$alamat,$kota,$kode,$notlp1,$notlp2,$notlp3,$email){
	
	$nama=$this->db->escape($nama);
	$alamat=$this->db->escape($alamat);
	$kota=$this->db->escape($kota);
	$kode=$this->db->escape($kode);
	$notlp1=$this->db->escape($notlp1);
	$notlp2=$this->db->escape($notlp2);
	$notlp3=$this->db->escape($notlp3);
	$email=$this->db->escape($email);
	$sql="UPDATE `contacts` SET `nama` = $nama, `alamat` = $alamat, `kota` = $kota, `kode_pos` = $kode,
	`nomor_telp1` = $notlp1, `nomor_telp2` = $notlp2, `nomor_telp3` = $notlp3, `email` = $email
	WHERE `contacts`.`ID_contact` = $id";
	$qwr=$this->db->query($sql);
	}
function select_contact($id){
	$id=$this->db->escape($id);
	$sql="SELECT * FROM contacts WHERE ID_contact=$id limit 1";
	$qwr=$this->db->query($sql);
	return $qwr;
	}
	
function delete_kontak($id){
	$id=$this->db->escape($id);
	$sql="DELETE FROM `contacts` WHERE `contacts`.`ID_contact` = $id";
	$qwr=$this->db->query($sql);
	return $qwr;

}
	
	
	
}



?>