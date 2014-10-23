<br>
<?php      $nama_bulan=array('Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');?>
   <table width="60%" id="item" style='margin-bottom:20px;' class="table">
		<tr>
		     <td colspan="7" style="height:20px;text-align:center;"><?php 
		     	echo '<form method="get">'.'Bulan: '.
		     		combo_bulan($b+1).' tahun: '.
		     		combo_tahun('2','2013').' '.
		     		form_submit('submit','filter','class="btn btn-primary"').
		     	form_close(); ?></td>
		</tr>
		<tr>
		     <td class="td-head" colspan="7">Neraca Saldo : <?php echo /*date('t').' '.*/$nama_bulan[$b].' '.$y; ?></td>
		</tr>
	<?php
	       //$now=date('Y-m');
	       $ex1=explode('-',$last);
	       $ex2=explode('-',$now);
	       $exres1=$ex1[1];
	       $exres2=$ex2[1];
	       $bln1=$nama_bulan[$exres1-1];
	       $bln2=$nama_bulan[$exres2-1];
	       ?>
		<tr rowspan=2 class="activate">
		     <td rowspan=2><b>ID</b></td>
		     <td rowspan=2><b>Nama Perkiraan</b></td>
		     <td colspan=2><center><b><?php echo $bln1; ?></b></center></td>
		     <td colspan=2><center><b><?php echo $bln2; ?></b></center></td>
		</tr>
		<tr>
		     <td><b>Debit</b></td>
		     <td><b>Kredit</b></td>
		     
		     <td><b>Debit</b></td>
		     <td><b>Kredit</b></td>
		</tr>
	     <?php 
	       $total_k1=0;$total_d1=0;
	       $total_k2=0;$total_d2=0;
	       $style='style="text-align:right;"';
		  $n=1;
		  $qryres=$qry->result();
		foreach ($qryres as $row)
		 {
		  $q1=$this->model_pembukuan->get_detail($row->ID,$last);
		  $q2=$this->model_pembukuan->get_detail($row->ID,$now);
		  $q1res=$q1->result();
		  $q2res=$q2->result();
		    foreach($q1res as $key => $row): $row2 =$q2res[$key];
		     $kd1=$row->kode;                     $kd2=$row2->kode;
		     $d1=$row->nama_akun;                $d2=$row2->nama_akun;
		     $dbt1=$row->debet;                  $dbt2=$row2->debet;
		     $kdt1=$row->kredit;                 $kdt2=$row2->kredit;
		     $id_akn1=$row->id_akun_perkiraan;    $id_akn2=$row2->id_akun_perkiraan;
		    if ($d1 <> '' or $d2 <> ''){
		     if ($d1<>'' and $d2<>''){
		       $name=$d1;}elseif($d1<>'' and $d2==''){
		         $name=$d1;}elseif($d1=='' and $d2<>''){
		            $name=$d2;}
		     if ($kd1<>'' and $kd2<>''){
		       $kode=$kd1;}elseif($kd1<>'' and $kd2==''){
		         $kode=$kd1;}elseif($kd1=='' and $kd2<>''){
		            $kode=$kd2;}
		            //echo $kode;
		      $parent=$this->model_pembukuan->get_parent($id_akn1,$id_akn2);
		      if ($id_akn1 != '' and $id_akn2 == ''){$i_akn=$id_akn1;}elseif($id_akn1 == '' and $id_akn2 != ''){$i_akn=$id_akn2;}else{$i_akn=$id_akn1;}
	       echo "<tr>";
		    ?>
		    
		         <?php echo "<td> $kode </td>";?>
		         <?php echo "<td>".anchor('pembukuan/pembukuan/detail/'.$i_akn,$name)."</td>";?>
		         <td <?php echo  $style; ?>>
		            <?php 
		            $nol=number_format(0,2,',','.');
		             if ($dbt1<>''){
		               //echo $dbt1;
		               if($parent == 'A' or $parent == 'B' or $parent == 'R'){
		                   $debit1 =$dbt1 - $kdt1;
		                   echo number_format($debit1,2,',','.');
		                   $total_d1 += $debit1;
		                   $kredit1=$nol;
		                 }else{echo $nol;} 
		             }else{echo $nol;} 
		            
		            ?>
		         </td>
		         <td <?php echo  $style; ?>>
		            <?php 
		             if ($kdt1 <> ''){
		              //echo $kdt1;
		              if($parent <> 'A' and $parent <> 'B' and $parent <> 'R'){
		                   $kredit1 =$kdt1 - $dbt1;
		                   echo number_format($kredit1,2,',','.');
		                   $total_k1 += $kredit1;
		                   $debit1=$nol;
		                 }else{echo $nol;} 
		             }else{echo $nol;} 
		            ?>
		         </td>
		         
		         <td <?php echo  $style; ?>>
		           <?php
		            if ($dbt2<>''){
		             //echo $dbt2;
		             if($parent == 'A' or $parent == 'B' or $parent == 'R'){
		                   $debit2 =$dbt2 - $kdt2;
		                   echo number_format($debit2,2,',','.');
		                   $total_d2 += $debit2;
		                   $kredit2=$nol;
		                 }else{echo $nol;} 
		            }else{echo $nol;}
		           ?>
		         </td>
		         <td <?php echo  $style; ?>>
		           <?php
		            if ($kdt2<>''){
		            // echo $kdt2;
		             if($parent <> 'A' and $parent <> 'B' and $parent <> 'R'){
		                   $kredit2 =$kdt2 - $dbt2;
		                   echo number_format($kredit2,2,',','.');
		                   $total_k2 += $kredit2;
		                   $debit2=$nol;
		                 }else{echo $nol;} 
		            }else{echo $nol;} 
		           ?>
		         </td>
	<?php
		     $n++;
		        }
		    endforeach;
	       echo "</tr>";
		 }
	echo "<tr>";
	echo "<td>-~-</td>";
	echo "<td><b>Jumlah</b></td>";
	echo "<td $style><b>".number_format($total_d1,2,',','.')."</b></td>";
	echo "<td $style><b>".number_format($total_k1,2,',','.')."</b></td>";

	echo "<td $style><b>".number_format($total_d2,2,',','.')."</b></td>";
	echo "<td $style><b>".number_format($total_k2,2,',','.')."</b></td>";
	echo "</tr>";

	echo "<tr>";
	echo "<td colspan=5></td>";
	echo "<td><a href=".site_url('pembukuan/pembukuan/convert_neraca/'.$now)." class='btn btn-primary'>Download PDF</a></td>";
	echo "</tr>";
	     ?>
   </table>

