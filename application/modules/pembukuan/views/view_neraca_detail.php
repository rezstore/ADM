<center><br>
<?       $nama_bulan=array('Januari','Ferbuari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');?>
   <table width="60%" id="item" style='margin-bottom:20px;'>
        <tr>
             <td class="td-head" colspan="7">Transaksi Detail Sampai <? echo date('t').' '.$nama_bulan[$b].' '.$y; ?></td>
        </tr>
<?php
       //$now=date('Y-m');
       ?>
        <tr rowspan=2>
             <td class="td-kecil" rowspan=2><b>ID</b></td>
             <td class="td-kecil" rowspan=2><b>Tanggal</b></td>
             <td class="td-kecil" rowspan=2><b>Nama Perkiraan</b></td>
             <td class="td-kecil" colspan=2><center><b><?  echo $nama_bulan[explode('-',$now)[1]-1]; ?></b></center></td>
        </tr>
        <tr>
             <td class="td-kecil"><b>Debit</b></td>
             <td class="td-kecil"><b>Kredit</b></td>
        </tr>
     <?php 
       $total_k=0;$total_d=0;
       $style='style="text-align:right;"';
          $n=1;
        foreach ($qry->result() as $row)
         {
             $kd=$row->ID_jurnal;
             $nama=$row->nama_akun;
             $tanggal=$row->tanggal;
             $dbt=$row->debet;
             $kdt=$row->kredit;
            if ($kd <> ''){
       echo "<tr>";
            ?>
            
                 <?php echo "<td class='td-kecil'> $kd </td>";
                 echo "<td class='td-kecil'>".$tanggal."</td>";
                 echo "<td class='td-kecil'>".$nama."</td>";
                 ?>
                 <td class="td-kecil" <?php echo  $style; ?>>
                    <?php 
                    $nol=number_format(0,2,',','.');
                     if ($dbt<>''){
                       //echo $dbt1;
                           echo number_format($dbt,2,',','.');
                           $total_d += $dbt;
                           $kredit=$nol;
                     }else{echo $nol;} 
                    
                    ?>
                 </td>
                 <td class="td-kecil" <?php echo  $style; ?>>
                    <?php 
                     if ($kdt <> ''){
                      //echo $kdt1;
                           echo number_format($kdt,2,',','.');
                           $total_k += $kdt;
                           $debit=$nol;
                     }else{echo $nol;} 
                    ?>
                 </td>
<?php
             $n++;
                }
       echo "</tr>";
         }
echo "<tr>";
echo "<td class='td-kecil'>---</td>";
echo "<td class='td-kecil'></td>";
echo "<td class='td-kecil'><b>Jumlah</b></td>";
echo "<td class='td-kecil' $style><b>".number_format($total_d,2,',','.')."</b></td>";
echo "<td class='td-kecil' $style><b>".number_format($total_k,2,',','.')."</b></td>";
echo "</tr>";
     ?>
   </table>
</center>

