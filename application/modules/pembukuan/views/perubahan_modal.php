<center><br>
<?php      $nama_bulan=array('Januari','Ferbuari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');?>
   <table width="60%" id="item" style='margin-bottom:20px;' class="table">
        <tr>
             <td colspan="7"><center><?php echo '<form method="get">'.
				'<label style="float:left;">Bulan: </label>'.
				combo_bulan($b+1).'<label style="float:left;"> Tahun: </label>'.
				combo_tahun('2','2013').'<label style="float:left;">&nbsp;</label>'.form_submit('submit','filter','class="btn btn-default" style="float:left;"').form_close(); ?></center></td>
        </tr>
        <tr>
             <td colspan="7">Laporan Perubahan Modal : <?php//echo date('t').' '.$nama_bulan[$b].' '.$y; ?></td>
        </tr>
        <?php
	       $ex=explode('-',$now);
	       $exres=$ex[1];
	       $bln=$nama_bulan[$exres-1];
        ?>
        <tr rowspan=2>
             <td rowspan=2><b>ID</b></td>
             <td rowspan=2><b>Nama Perkiraan</b></td>
             <td colspan=2><center><b><?php echo $bln; ?></b></center></td>
        </tr>
        <tr>
             <td><b>kiri</b></td>
             <td><b>kanan</b></td>
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
	     echo "<td class='td-kecil'>".anchor(get_site_url('convert_perubahan_modal/'.$now),'Download PDF','class="btn btn-warning"') . "</td>";
    echo "</tr>";
?>

        
        
        
    </table>
