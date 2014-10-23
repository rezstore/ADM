<?php
       $nama_bulan=array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
       ?>
<center><br>
   <table width="60%" id="item" style='margin-bottom:20px;' class="table">
        <tr>
             <td colspan="7"><center><?php echo '<form method="get">'.'Bulan: '.combo_bulan($b+1).' tahun: '.combo_tahun('2','2013').form_submit('submit','filter').form_close(); ?></center></td>
        </tr>
        <tr>
             <td class="td-head" colspan="6">Laporan Laba Rugi <?php echo $nama_bulan[$b].' '.$y; ?></td>
        </tr>
        <?php
		$ex1=explode('-',$last);
	       $ex2=explode('-',$now);
	       $exres1=$ex1[1];
	       $exres2=$ex2[1];
	       $bln1=$nama_bulan[$exres1-1];
	       $bln2=$nama_bulan[$exres2-1];
        ?>
        <tr rowspan=2>
             <td rowspan=2><b>ID</b></td>
              <!--<td rowspan=2 width=100px><b>Tanggal </b></td>-->
             <td rowspan=2><b>Nama Perkiraan</b></td>
             <td colspan=2><center><b><?php echo $bln1;//$nama_bulan[explode('-',$last)[1]-1]; ?></b></center></td>
             <td colspan=2><center><b><?php echo $bln2;//$nama_bulan[explode('-',$now)[1]-1]; ?></b></center></td>
        </tr>
        <tr>
             <td><b>Debit</b></td>
             <td><b>Kredit</b></td>
             <td><b>Debit</b></td>
             <td><b>Kredit</b></td>
             
        </tr>
        <?php
         $d=1;
	    $totald1 = 0;$totald2 = 0;$totalk1 = 0;$totalk2 = 0;
	   foreach($s->result() as $r){
	   //echo $r->ID.'['.$r->nama_akun.']';
	    $d1=$this->model_pembukuan->select_perkiraan_laba_rugi($now,$r->ID);
	    $d2=$this->model_pembukuan->select_perkiraan_laba_rugi($last,$r->ID);
	    $jml1=$d1->num_rows();
	    $jml2=$d2->num_rows();
	   if ($r->ID != ''){
	    if ($jml1 > 0 and $jml2 == 0){
		 echo "<tr>";
		 $d1res=$d1->result();
	      foreach($d1res as $r1)
	       {
	         $r2debet=0;	$r2kredit=0;	$r1debet=$r1->debet;	$r1kredit=$r1->kredit;
	         echo "<td> $r1->kode </td>";
	  	 echo "<tdwidth='350'> $r1->nama_akun </td>";
              	 echo "<td style='text-align:right;'></td>";
             	 echo "<td style='text-align:right;'></td>";
	      	 echo "<td style='text-align:right;'>". number_format($r1->debet,2,',','.') ."</td>";
             	 echo "<td style='text-align:right;'>". number_format($r1->kredit,2,',','.') ."</td>";
	       }
	    }elseif($jml1 == 0 and $jml2 > 0)
	    {
	      $d2res=$d2->result();
	      foreach($d2res as $r2)
	       {
	         $r2debet=$r2->debet;	$r2kredit=$r2->kredit;	$r1debet=0;	$r1kredit=0;
	         echo "<td> $r2->kode </td>";
	  	 echo "<tdwidth='350'> $r2->nama_akun </td>";
              	 echo "<td style='text-align:right;'>". number_format($r2->debet,2,',','.')." </td>";
             	 echo "<td style='text-align:right;'>". number_format($r2->kredit,2,',','.') ."</td>";
	      	 echo "<td style='text-align:right;'>0.00</td>";
             	 echo "<td style='text-align:right;'>0.00</td>";
	       }
	    }else{
	     $d1res=$d1->result();
	     $d2res=$d2->result();
	     foreach($d2res as $ro=>$r2): $r1=$d1res[$ro];
	       $r2debet=$r2->debet;	$r2kredit=$r2->kredit;	$r1debet=$r1->debet;	$r1kredit=$r1->kredit;
	         echo "<td> $r2->kode </td>";
	  	 echo "<tdwidth='350'> $r2->nama_akun </td>";
              	 echo "<td style='text-align:right;'>". number_format($r2->debet,2,',','.') ."</td>";
             	 echo "<td style='text-align:right;'>". number_format($r2->kredit,2,',','.') ."</td>";
	      	 echo "<td style='text-align:right;'>". number_format($r1->debet,2,',','.') ."</td>";
             	 echo "<td style='text-align:right;'>". number_format($r1->kredit,2,',','.') ."</td>";
	     endforeach;
	    }
	    $totald2 += $r2debet;
	    $totalk2 += $r2kredit;
	    $totald1 += $r1debet;
	    $totalk1 += $r1kredit;
	     echo "</tr>";
	     //echo $d;$d++;
	   }
	 }
	?>
	<tr>
             <td class="td_kecil"><?php echo ""; ?></td>
             <td class="td_kecil" rowspan=3><?php echo "<b>___________________________________________________________</b>"; ?></td>
             <td style='text-align:right;'><?php echo number_format($totald2,2,',','.'); ?></td>
             <td style='text-align:right;'><?php echo number_format($totalk2,2,',','.'); ?></td>
             <td style='text-align:right;'><?php echo number_format($totald1,2,',','.'); ?></td>
             <td style='text-align:right;'><?php echo number_format($totalk1,2,',','.'); ?></td>
             
        </tr>
        <tr>
             <td class="td_kecil"><?php echo ""; ?></td>
             <td style='text-align:right;'><?php $sisa2=$totalk2-$totald2; echo number_format($sisa2,2,',','.'); ?></td>
             <td class="td_kecil" style='text-align:right;'><b><?php echo "____(-)____"; ?><b></td>
             <td style='text-align:right;'><?php $sisa1=$totalk1-$totald1; echo number_format($sisa1,2,',','.'); ?></td>
             <td class="td_kecil" style='text-align:right;'><b><?php echo " ____(-)____"; ?><b></td>
             
        </tr>
        <tr>
             <td class="td_kecil"><?php echo ""; ?></td>
             <td style='text-align:right;'><?php echo "<b>___(+)____ <br>";$hasil2=$sisa2 + $totald2; echo number_format($hasil2,2,',','.').'</b>'; ?></td>
             <td style='text-align:right;'><?php echo '<br><b>'.number_format($totalk2,2,',','.'); ?></b></td>
             <td style='text-align:right;'><?php echo "<b> ____(+)______ <br>";$hasil1=$sisa1 + $totald1; echo number_format($hasil1,2,',','.').'</b>'; ?></td>
             <td style='text-align:right;'><?php echo '<br><b>'.number_format($totalk1,2,',','.'); ?></b></td>
        </tr>
        <tr>
             <td class="td_kecil"></td>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <td><a href="<?php echo site_url('pembukuan/get_pdf_lr/'.$now.'/'.$last); ?>"><button>Preview PDF</button></a></td>
        </tr>
   </table>
</center>

