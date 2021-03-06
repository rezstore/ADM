<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
define('PREFIX','pembukuan_');
define('AKP_PER',PREFIX.'akun_perkiraan');
define('JURNAL',PREFIX.'jurnal');
define('JUR_DET',PREFIX.'jurnal_detail');
class Model_pembukuan extends CI_Model
 {

     function get_nama_akun()
      {
        return $this->db->query("select ID,nama_akun from ".AKP_PER." where 1")->result();
      }
      
     function escape($str){
     	return $this->db->escape($str);
     }
      
     function get_akun_per()
      {
        return $this->db->query("select * from ".AKP_PER." where 1")->result();
      }
      
     function new_akun($nama,$kode,$induk)
      {
       $n=$this->escape($nama);
       $k=$this->escape($kode);
       $i=$this->escape($induk);
       return $this->db->query("INSERT INTO `".AKP_PER."` (`nama_akun`,`id_parent`,`kode`) VALUES ($n,$i,$k)");
      }
      
      function get_perkiraan($get)
      {
        return $this->db->query("select ID ,nama_akun from ".AKP_PER." where nama_akun like '%$get%' and id_parent <> 0");
      }
      
      function insert_new_jurnal($tgl,$ket)
      {
       $tgl=$this->escape($tgl);
       $ket=$this->escape($ket);
       return $this->db->query("INSERT INTO ".JURNAL." (`tanggal`,`keterangan`) VALUES ($tgl,$ket)");
      }
      
      function insert_new_jurnal_detail($ID,$akun,$debet,$kredit)
      {
      if ($debet==''){$debet='0';} if ($kredit==''){$kredit='0';}
        $ID=$this->escape($ID);
        $akun=$this->escape($akun);
        $debet=$this->escape($debet);
        $kredit=$this->escape($kredit);
        //-----$this->db->query("INSERT INTO ".JUR_DET." (`ID_jurnal`,`id_akuns_perkiraan`,`debet`,`kredit`) VALUES ($ID,$akun,$debet,$kredit)");
      }
      
      function select_last_id()
      {
       return $this->db->query("SELECT ID_jurnal FROM ".JURNAL." order by ID_jurnal DESC LIMIT 1")->result();
      }
      
      function select_perkiraan($parent)
      {
        return $this->db->query("select * from ".AKP_PER." where id_parent='$parent'");
      }
      
      function select_perkiraan_laba_rugi($tgl,$id)
      {
       $tgl=$this->escape($tgl.'%');
       $id=$this->escape($id);
       $sql="select ".JURNAL.".tanggal,".AKP_PER.".nama_akun,".AKP_PER.".kode,".AKP_PER.".ID,".JUR_DET.".id_akun_perkiraan as ID_perkiraan,
	SUM(".JUR_DET.".debet) as debet,SUM(".JUR_DET.".kredit) as kredit
	from (select ID from ".AKP_PER." where jenis='B' or jenis='P') ap 
	LEFT JOIN ".AKP_PER." ON ".AKP_PER.".id_parent=ap.id 
	RIGHT JOIN ".JUR_DET." ON ".JUR_DET.".id_akun_perkiraan=".AKP_PER.".ID
	LEFT JOIN ".JURNAL." ON ".JURNAL.".ID_jurnal=".JUR_DET.".ID_jurnal
	where ".JURNAL.".tanggal LIKE $tgl and ".AKP_PER.".ID=$id
	GROUP BY ".AKP_PER.".ID";
	//echo $sql.'<p>';
        return $this->db->query($sql);
      }
      
      function select_perkiraan_laba_rugi_last($tgl,$id)
      {
       $tgl=$this->escape($tgl.'%');
       $id=$this->escape($id);
       $sql="select ".JURNAL.".tanggal,".AKP_PER.".nama_akun,".AKP_PER.".kode,".AKP_PER.".ID,".JUR_DET.".id_akun_perkiraan as ID_perkiraan,
	SUM(".JUR_DET.".debet) as debet,SUM(".JUR_DET.".kredit) as kredit
	from (select ID from ".AKP_PER." where jenis='B' or jenis='P') ap 
	LEFT JOIN ".AKP_PER." ON ".AKP_PER.".id_parent=ap.id 
	RIGHT JOIN ".JUR_DET." ON ".JUR_DET.".id_akun_perkiraan=".AKP_PER.".ID
	LEFT JOIN ".JURNAL." ON ".JURNAL.".ID_jurnal=".JUR_DET.".ID_jurnal
	where ".JURNAL.".tanggal LIKE $tgl and ".AKP_PER.".ID=$id
	GROUP BY ".AKP_PER.".ID";
	//echo $sql.'<p>';
        return $this->db->query($sql);
      }
      
      function select_jurnal($tgl)
      {
        $tgl=$this->escape($tgl."%");
        $sql="SELECT * from ".JURNAL." where `tanggal` LIKE $tgl group by tanggal ";
        return $this->db->query($sql);
      }
      
      function delete_jurnal($id)
      {
        $j=$this->db->query("delete from ".JURNAL." where ID_jurnal=$id limit 1 ");
        $dt=$this->db->query("delete from ".JUR_DET." where ID_jurnal=$id ");
        if ($j and $dt){return 1;}
      }
      
      function delete_perkiraan($id)
      {
        $dt=$this->db->query("delete from ".AKP_PER." where ID=$id ");
        if ($dt){return 1;}
      }

      function select_perkiraan_0()
      {
        return $dt=$this->db->query("SELECT ID from ".AKP_PER." where ID <> 0 ORDER BY kode");
      }

      function select_perkiraan_id($id)
      {
       $ID=$this->escape($id);
        return $dt=$this->db->query("SELECT * from ".AKP_PER." where `ID` =$ID LIMIT 1 ");
      }

      function update_perkiraan($id,$nama,$kode,$induk)
      {
       $ID=$this->escape($id);
       $nama=$this->escape($nama);
       $kode=$this->escape($kode);
       $induk=$this->escape($induk);
        return $dt=$this->db->query("UPDATE ".AKP_PER." SET `nama_akun`=$nama,`id_parent`=$induk,`kode`=$kode where `ID` =$ID LIMIT 1 ");
      }
      
      function get_detail($id,$bln)
         {
           $sql="SELECT  `".JUR_DET."`.`id_akun_perkiraan`,`".JURNAL."`.`ID_jurnal` , `".JURNAL."`.`tanggal`, `".AKP_PER."`.`nama_akun` , `".AKP_PER."`.`kode` , SUM(`".JUR_DET."`.`debet`)as debet ,
            SUM(`".JUR_DET."`.`kredit`)as kredit , `".JURNAL."`.`keterangan`
                FROM `".JURNAL."`
                LEFT JOIN `".JUR_DET."` ON  `".JURNAL."`.`ID_jurnal` =  `".JUR_DET."`.`ID_jurnal` 
                LEFT JOIN `".AKP_PER."` ON  `".JUR_DET."`.`id_akun_perkiraan` = `".AKP_PER."`.`ID`
                WHERE `".JUR_DET."`.`id_akun_perkiraan`=$id and ".JURNAL.".tanggal LIKE '$bln-%'";
                //echo $sql.br(2);
           return $q=$this->db->query($sql);
         }
         
       function get_parent($id1,$id2)
         {
          if ($id1=='' and $id2 <> ''){$id=$id2;}elseif($id1 <> '' and $id2 == ''){$id=$id1;}else{$id=$id1;}
           $sql="SELECT ".AKP_PER.".jenis ,a.nama_akun from (select id_parent,jenis,nama_akun from ".AKP_PER." where ID=$id LIMIT 1) a
		LEFT JOIN ".AKP_PER." ON ".AKP_PER.".ID=a.id_parent";
                //echo $sql.br(2);
           $q=$this->db->query($sql);
           foreach($q->result() as $data)
           {
                   return $data->jenis;
           }
         }  
	 
	 function jurnal_view_tree($t,$a)
	  {
	    $n=1;
            //echo $tanggal;
            $sql="SELECT * FROM ".JURNAL." LEFT JOIN `".JUR_DET."` ON ".JURNAL.".ID_jurnal=`".JUR_DET."`.`ID_jurnal` LEFT JOIN ".AKP_PER." ON `".JUR_DET."`.id_akun_perkiraan=".AKP_PER.".ID where tanggal='$t' order by ".JURNAL.".ID_jurnal,debet DESC";
	   return $this->db->query($sql);
	  }
	  
	 function select_lr($now,$last)
	  {
	    $now=$this->escape($now.'%');
	    $last=$this->escape($last.'%');
            $sql="SELECT ".JURNAL.".tanggal,ak2.ID,ak2.nama_akun,".JUR_DET.".debet,".JUR_DET.".kredit FROM
		(SELECT ".AKP_PER.".ID,".AKP_PER.".nama_akun FROM (SELECT ID FROM `".AKP_PER."` WHERE jenis='B' or jenis='P') ak
		LEFT JOIN ".AKP_PER."
		ON ak.ID=".AKP_PER.".id_parent) ak2
		LEFT JOIN ".JUR_DET." ON ".JUR_DET.".id_akun_perkiraan=ak2.ID
		LEFT JOIN ".JURNAL." ON ".JUR_DET.".ID_jurnal=".JURNAL.".ID_jurnal
		where ".JURNAL.".tanggal LIKE $now OR ".JURNAL.".tanggal LIKE $last
		GROUP BY ak2.ID";
	   return $q=$this->db->query($sql);
	  }
	  
	 function detail($ID,$TGL)
	 {
	   $id=$this->escape($ID);
	   $tgl=$this->escape($TGL.'%');
	   $sql="SELECT ".JURNAL.".*,".AKP_PER.".nama_akun,".JUR_DET.".debet,".JUR_DET.".kredit FROM ".JURNAL." LEFT JOIN ".JUR_DET." ON ".JURNAL.".ID_jurnal=".JUR_DET.".ID_jurnal 
		LEFT JOIN ".AKP_PER." ON ".JUR_DET.".id_akun_perkiraan=".AKP_PER.".ID
		WHERE ".JUR_DET.".id_akun_perkiraan=$id and ".JURNAL.".tanggal LIKE $tgl";
	   $qry=$this->db->query($sql);
           return $qry;
	 }
	 
	 function get_modal_awal($tgl)
	 {
	  $tgl=$this->escape($tgl.'%');
	   $sql="SELECT ".JURNAL.".ID_jurnal, 	".JURNAL.".tanggal,		".JUR_DET.".id_akun_perkiraan,	SUM(".JUR_DET.".debet) as debet,
	   	SUM(".JUR_DET.".kredit)as kredit FROM (select ".AKP_PER.".ID,".AKP_PER.".nama_akun 
	   	FROM (select id from ".AKP_PER." where jenis='MA') n
		LEFT JOIN ".AKP_PER." ON n.id=".AKP_PER.".ID) n2
		LEFT JOIN ".JUR_DET." ON ".JUR_DET.".id_akun_perkiraan=n2.ID 
		LEFT JOIN ".JURNAL." ON ".JURNAL.".ID_jurnal=".JUR_DET.".ID_jurnal
		where ".JURNAL.".tanggal LIKE $tgl";
	   return $this->db->query($sql);
	 }
	 
	 function get_laba_rugi($tgl)
	 {
	   $tgl=$this->escape($tgl.'%');
	   $sql="SELECT (am.kredit) - (am.debet) as debet FROM (select ".JURNAL.".tanggal,".AKP_PER.".nama_akun,".AKP_PER.".ID,".JUR_DET.".id_akun_perkiraan as ID_perkiraan,
			SUM(".JUR_DET.".debet) as debet,SUM(".JUR_DET.".kredit) as kredit
			from (select ID from ".AKP_PER." where jenis='B' or jenis='P') ap 
			LEFT JOIN ".AKP_PER." ON ".AKP_PER.".id_parent=ap.id 
			LEFT JOIN ".JUR_DET." ON ".JUR_DET.".id_akun_perkiraan=".AKP_PER.".ID
			LEFT JOIN ".JURNAL." ON ".JURNAL.".ID_jurnal=".JUR_DET.".ID_jurnal
		WHERE ".JURNAL.".tanggal LIKE $tgl) am";
	   return $this->db->query($sql);

	 }
	 
	 function get_prive($tgl)
	 {
	   $tgl=$this->escape($tgl.'%');
	   $sql="SELECT ap.nama_akun,".JUR_DET.".ID_jurnal,SUM(".JUR_DET.".debet) as debet,SUM(".JUR_DET.".kredit) as kredit FROM (SELECT ".AKP_PER.".* from 
		(SELECT ID FROM ".AKP_PER." where jenis='R') a
		LEFT JOIN ".AKP_PER." ON ".AKP_PER.".id_parent=a.ID) ap
		LEFT JOIN ".JUR_DET." ON ".JUR_DET.".id_akun_perkiraan=ap.ID
		LEFT JOIN ".JURNAL." ON ".JURNAL.".ID_jurnal=".JUR_DET.".ID_jurnal
		WHERE ".JURNAL.".tanggal LIKE $tgl";
	  return $this->db->query($sql);
	 }
	 
	 function get_penambahan_m($tgl)
	 {
	  $tgl=$this->escape($tgl.'%');
	    $sql="SELECT n2.jenis,".JURNAL.".ID_jurnal, ".JURNAL.".tanggal,
				 ".JUR_DET.".id_akun_perkiraan,
				 	SUM(".JUR_DET.".debet) as debet,
				 	 SUM(".JUR_DET.".kredit)as kredit 
			FROM (
				select ".AKP_PER.".ID,".AKP_PER.".nama_akun ,".AKP_PER.".jenis
				  FROM (select id from ".AKP_PER." where jenis='M') n 
				   LEFT JOIN ".AKP_PER." ON n.id=".AKP_PER.".id_parent) n2 
				     LEFT JOIN ".JUR_DET." ON ".JUR_DET.".id_akun_perkiraan=n2.ID 
				       LEFT JOIN ".JURNAL." ON ".JURNAL.".ID_jurnal=".JUR_DET.".ID_jurnal 
			where ".JURNAL.".tanggal LIKE $tgl and n2.jenis!='MA'
			GROUP BY n2.jenis";
	   return $this->db->query($sql);
	 }
	  
	 function select_where_id_parent($parent)
	 {
	   $sql="select * from ".AKP_PER." where id_parent='$parent'";
	   return $this->db->query($sql);
	 }
	  
	 function select_where_id_akun_perkiraan($id)
	 {
	   $sql="SELECT `ID` FROM `".JUR_DET."` WHERE `id_akun_perkiraan`='$id'";
	   return $this->db->query($sql);
	 }
	 
	 function get_akun_perkiraan($parent){
	 	$parent=$this->escape($parent);
	 	$sql="select * from ".AKP_PER." where id_parent=$parent";
	 	return $this->db->query($sql);
	 }
	 
	 function select_id_from_jurnal_detail($ID){
	 	$ID=$this->escape($ID);
	 	$sql="SELECT `ID` FROM `".JUR_DET."` WHERE `id_akun_perkiraan`=$ID";
	 	return $this->db->query($sql);
	 }

 }
//end of file
