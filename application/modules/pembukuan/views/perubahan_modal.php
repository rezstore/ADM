<center><br>
<?php      $nama_bulan=array('Januari','Ferbuari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');?>
   <table width="60%" id="item" style='margin-bottom:20px;' class="table">
        <tr>
             <td colspan="7"><center><?php echo '<form method="get">'.'Bulan: '.combo_bulan($b+1).' tahun: '.combo_tahun('2','2013').form_submit('submit','filter').form_close(); ?></center></td>
        </tr>
        <tr>
             <td class="td-head" colspan="7">Laporan Perubahan Modal : <?php//echo date('t').' '.$nama_bulan[$b].' '.$y; ?></td>
        </tr>
        <?php
	       $ex=explode('-',$now);
	       $exres=$ex[1];
	       $bln=$nama_bulan[$exres-1];
        ?>
        <tr rowspan=2>
             <td class="td-kecil" rowspan=2><b>ID</b></td>
             <td class="td-kecil" rowspan=2><b>Nama Perkiraan</b></td>
             <td class="td-kecil" colspan=2><center><b><?php echo $bln; ?></b></center></td>
        </tr>
        <tr>
             <td class="td-kecil"><b>kiri</b></td>
             <td class="td-kecil"><b>kanan</b></td>
        </tr>
<?php
  $modal_k = 0;$modal_d = 0;
  $pm=array('Modal Awal','Laba/Rugi','Prive','(+/-)Modal');
  for ($a=0;$a<=3;$a++)
  {
    if ($a == 0){$akun=$ctrl->get_modal_awal($now);}elseif($a == 1){$akun=$ctrl->get_laba_rugi($now);}elseif($a == 2){$akun=$ctrl->get_prive($now);}
    	elseif($a == 3){$akun=$ctrl->get_penambahan_m($now);}else{$akun='';}
    	if ($akun != '' and $akun->num_rows()){
    	  $akunres=$akun->result();
	    foreach ($akunres as $r){
	      if ($a==2){
	      	$debet=number_format($r->debet,2,',','.').' (-)'; 
	      	$kredit=number_format($r->kredit,2,',','.');
	      	$modal_d -= $r->debet;	$modal_k -= $r->kredit;
	      }elseif($a==1){
	        $debet=number_format($r->debet,2,',','.');
	        $kredit=number_format(0,2,',','.');
	        $modal_d += $r->debet;	$modal_k += 0;
	      }else{
	        $debet=number_format($r->debet,2,',','.');
	        $kredit=number_format($r->kredit,2,',','.');
	        $modal_d += $r->debet;	$modal_k += $r->kredit;
	      }
	    }
    	}else{$debet=number_format(0,2,',','.');$kredit=number_format(0,2,',','.');}
    	$akun='';
    echo "<tr>";
	     echo "<td class='td-kecil'>".($a + 1)."</td>";
	     echo "<td class='td-kecil'>".$pm[$a]."</td>";
	     
	     echo "<td class='td-kecil'>".$debet."</td>";
	     echo "<td class='td-kecil'>".$kredit."</td>";
    echo "</tr>";
  }
  
    echo "<tr>";
	     echo "<td class='td-kecil'>".($a + 1)."</td>";
	     echo "<td class='td-kecil'>Modal Akhir</td>";
	     
	     echo "<td class='td-kecil'>0,00</td>";
	     echo "<td class='td-kecil'><b> Rp. ".number_format(($modal_d + $modal_k),2,',','.')."</b></td>";
    echo "</tr>";
    
    echo "<tr>";
	     echo "<td class='td-kecil'></td>";
	     echo "<td class='td-kecil'></td>";
	     
	     echo "<td class='td-kecil'></td>";
	     echo "<td class='td-kecil'><a href=".site_url('pembukuan/convert_perubahan_modal/'.$now)."><button>Download PDF</button></a></td>";
    echo "</tr>";
?>

        
        
        
    </table>
