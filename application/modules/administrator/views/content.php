<table border="0" class="nilai-siswa">
 <tr class='form-siswa'>
  <td colspan="10">
   <?php
    echo form_open();
    echo "NIM : <input type='text' name='nim' id='autocomplete' class='input'>";
    echo " <input type='submit' value='Cari' class='button'>";
    echo "pencarian pada nim : ".$nim;
    echo form_close();
   ?>
  </td>
 </tr>
  <tr class='siswa-t'>
  <td class='siswa'>No</td>
  <td class='siswa'>NIM</td>
  <td class='siswa'>Nama Siswa</td>
  <td class='siswa'>Mapel</td>
  <td class='siswa'>mid(smt1)</td>
  <td class='siswa'>Smt1</td>
  <td class='siswa'>mid(smt2)</td>
  <td class='siswa'>Smt2</td>
  <td class='siswa'>Nilai Akhir</td>
  <td class='siswa'>Rata-rata</td>
 </tr>
 
 <?php
 $nim=$this->session->userdata('NIM');
 $score=$this->m_student->get_score($nim);
 $a=1;
 foreach($score->result() as $scr){
 if ($a%2 == 0) {$bg="#C0C0C0";}else{$bg="";}
	echo "<tr class='data' bgcolor=$bg>";?>
	 <td class='siswa'><?php echo $a ?></td>
	 <td class='siswa'><?php echo $scr->NIM;  ?></td>
	 <td class='siswa'><?php echo $scr->student_name; ?></td>
	 <td class='siswa'><?php echo $scr->subject_name; ?></td>
	 <td class='siswa'><?php echo $ms1=$scr->mid_semester1; ?></td>
	 <td class='siswa'><?php echo $s1=$scr->semester1; ?></td>
	 <td class='siswa'><?php echo $ms2=$scr->mid_semester1; ?></td>
	 <td class='siswa'><?php echo $s2=$scr->semester2; ?></td>
	 <td class='siswa'><?php echo $lt=$scr->last_test; ?></td>
	 <td class='siswa'><?php echo ($ms1 + $s1 + $ms2 + $s2) / 4 ; ?></td> 
	</tr>
 <?php
 $a++;
 }
 ?>
</table>
