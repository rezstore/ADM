<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembukuan extends CI_Controller {
var $user;

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('html','url','pembukuan'));//	,'date'
		$this->load->model('model_pembukuan');
		$this->user=$this->get_username();
	}
	
	function get_username(){
		$this->load->library("session");
		$user=$this->session->userdata('user_account');
		if($user=="")redirect ('login');
		return $user;
	}
	
	function index()
	{
	 $this->view_perkiraan();
	}
	
	function load_header($data){
		$data['type']='pembukuan';
		$this->load->view('templates/adm_header',$data);
		$this->load->view('templates/menus',$data);
	}
	
	function load_footer(){
		$this->load->view('templates/adm_footer');
	}
	
	function add_perkiraan()
	{
	     $this->load->helper('form');
	     $data['type']=$this->input->get('type');
	     $data['dropdwn']=$this->model_pembukuan->get_nama_akun();
	     $data['title'] = 'add perkiraan';
 		$this->load_header($data);
 		$this->load->view('perkiraan_operation',$data);
 		$this->load_footer();
	}
	
	function add_jurnal()
	{
	     $this->load->helper('form');
	     $data['title'] = 'add jurnal';
 		$this->load_header($data);
		//$data['typ']=0;
 		$this->load->view('jurnal_operation',$data);
 		$this->load_footer();
	}
	
	function tambah_akun()
	{
	  if($_POST)
	  {
	  echo var_dump($_POST);
	   $tgl=$this->input->post('tgl');
	   $ket=$this->input->post('ket');
	   $a=$this->input->post('akun');
	   $dbt=$this->input->post('debet');
	   $krt=$this->input->post('kredit');

	   if ($tgl != ''){
	       $ex=explode('-',$tgl);
	       $tgl= $ex[2].'-'.$ex[1].'-'.$ex[0];
	    }
	    
	    $in=$this->model_pembukuan->insert_new_jurnal($tgl,$ket);
	    if ($in){
	     $id=$this->model_pembukuan->select_last_id();
	     foreach($id as $i){$ID=$i->ID_jurnal;}
	    }
#==================================================
          $c=0;
          foreach ($a as $r){if ($r != ''){$c += 1;}}
          $c;
                for($x=0; $x<=$c-1;$x++)
                {
                   $this->model_pembukuan->insert_new_jurnal_detail($ID,str_replace(',','',$a[$x]),$dbt[$x],$krt[$x]);
                }
	    redirect('add_jurnal');
	  }else{echo 'POST not Defined';}
	}
	
	function get_perkiraan()
	{
	 $get=$this->input->get('q');
	 if ($get<>"")
	  {
	        $get = addslashes($this->input->get('q', TRUE));
	          $q=$this->model_pembukuan->get_perkiraan($get);
	          $qres=$q->result();
	          foreach($qres as $ovj) {
                        $arr[] = array('id'=>$ovj->ID,'name'=>$ovj->nama_akun);
                    }
                    $json_response = json_encode($arr);
                    echo $json_response;
	  }
	}
	
	function view_perkiraan()
	{
	 $parent=0;
	 $data['query']=$this->model_pembukuan->select_perkiraan($parent);
	 $data['title'] = 'perkiraan';
	 $data['ctrl'] = $this;
 	  $this->load_header($data);
	  $this->load->view('perkiraan_view',$data);
	  $this->load_footer();
	}
	
	function tambah_akun_perkiraan()
	{
	  if($_POST)
	  {
	    $nama=ucfirst($this->input->post('nama_akun'));
	    $kode=$this->input->post('kode');
	    $induk=$this->input->post('induk');
	    $query=$this->model_pembukuan->new_akun($nama,$kode,$induk);
	    if ($query){redirect ('add_perkiraan');}
	  }
	}
	
	function view_jurnal()
	 {
	     $this->set_timezone();
	     $this->load->helper('form');
	     if($_GET){
                   $m=$this->input->get('cmb_bulan');
                   $y=$this->input->get('cmb_tahun');
                   if (strlen($m) == 1){$m ='0'.$m;}
                        if(strlen($m) <> 2 or strlen($y) <> 4)
                        {
                           $m='';
                           $y='';
                           $bln=date('Y-m');
                        }else{$bln=$y.'-'.$m;}
                  }else{
                   $m='';
                   $y='';
	           $bln=date('Y-m');
                  }
             $data['bulan']=$bln;
	     $data['query']=$this->model_pembukuan->select_jurnal($bln);
	     $data['title'] = 'jurnal';
 		$this->load_header($data);
	     $this->load->view('jurnal_view',$data);
             $this->load_footer();
	 }
	 
	function delete_jurnal()
	 {
	   $id=$this->input->get('id');
	     $qry=$this->model_pembukuan->delete_jurnal($id);
	     if ($qry == 1){redirect('view_jurnal');}
	 }
        
        function delete_perkiraan()
	 {
	   $id=$this->input->get('id');
	     $qry=$this->model_pembukuan->delete_perkiraan($id);
	     if ($qry == 1){redirect('view_perkiraan');}
	 }
	 
	function neraca()
	 {
	     $data['controller']=$this;
	     $this->set_timezone();
	     $dy=date('Y');
	     if($_GET){
                   $m=$this->input->get('cmb_bulan');
                   $y=$this->input->get('cmb_tahun');
                   if($m < 1 or $m > 13 or !is_numeric($m))$m=1;
                   if($y < $dy-10 or $y > $dy or !is_numeric($y))$y=$dy;
                   if (strlen($m) == 1){$m ='0'.$m;}
                        if(strlen($m) <> 2 or strlen($y) <> 4)
                        {
                           $m=date('m');
                           $y=$dy;
                           $data['now']=date('Y-m');
                        }else{$data['now']=$y.'-'.$m;}
                  }else{
                   $m=date('m');
                   $y=$dy;
	           $data['now']=date('Y-m');
                  }
                   $data['b']=$m-1;$data['y']=$y;
	     $this->load->helper(array('form'));
	     $data['qry']=$this->model_pembukuan->select_perkiraan_0();
	     $data['last']=$this->get_last_month($m,$y);
	     $data['title'] = 'neraca';
	     $this->load_header($data);
 	     $this->load->view('view_neraca',$data);
 	     $this->load_footer();
	 }
	 
        function update_perkiraan()
	 {
	     if($_GET)
	      {$id=$this->input->get('id');}else{$id='';}
	     if ($id !=''){
	      if(!$_POST){echo "post not defined";}else{
	        $nama=ucfirst($this->input->post('nama_akun'));
	        $kode=$this->input->post('kode');
	        $induk=$this->input->post('induk');
	        $qry=$this->model_pembukuan->update_perkiraan($id,$nama,$kode,$induk);
	        if($qry == 1){redirect('view_perkiraan');}else{echo "gagal update";}
	      }
	     }
	 }
	 
	 function get_last_month($month,$year)
	 {
	   //echo $month;
	   $this->set_timezone();
	   if ($month == '' or $year == ''){
               $month = date('mm');
               $year = date('Y');
	   }
           $last_month = $month-1%12;
           if ($last_month <= 9)$last_month = '0'.$last_month;
           $last= ($last_month==0?($year-1):$year)."-".($last_month==0?'12':$last_month);
           return $last;
	 }
	 
	function set_timezone()
	 {
	   date_default_timezone_set('Asia/Jakarta');
	 }
	 
	function laba_rugi()
	 {
	   $this->set_timezone();
	   $dy=date('Y');
	   $this->load->helper(array('form'));
          if($_GET){
           $m=$this->input->get('cmb_bulan');
           $y=$this->input->get('cmb_tahun');
           if (strlen($m) == 1){$m ='0'.$m;}
                if(strlen($m) <> 2 or strlen($y) <> 4)
                {
                   $m=1;
                   $y=$dy;
                   $data['now']=date('Y-m');
                }else{$data['now']=$y.'-'.$m;}
          }else{
           $m=date('m');
           $y=$dy;
	   $data['now']=date('Y-m');
          }
           $data['b']=$m-1;$data['y']=$y;
	   $data['last']=$this->get_last_month($m,$y);
	   $data['s']=$this->model_pembukuan->select_lr($data['now'],$data['last']);
	   $data['title'] = 'Laba rugi';
 		$this->load_header($data);
 	   $this->load->view('laba_rugi',$data);
 	   $this->load_footer();
	 }
	 
	 function perubahan_modal()
	 {
	   $this->set_timezone();
	   $dy=date('Y');
	   $mm=date('m');
	   if($_GET){
	     $m=$this->input->get('cmb_bulan');
             $y=$this->input->get('cmb_tahun');
             if (strlen($m) == 1){$m ='0'.$m;}
                if(strlen($m) <> 2 or strlen($y) <> 4)
                {
                   $m=$mm;
                   $y=$dy;
                   $data['now']=date('Y-m');
                }else{$data['now']=$y.'-'.$m;}
	   }else{$m=$mm; 		$y=$dy; 	$data['now']=$dy.'-'.$m;}
	   $data['b']=$m-1;	$data['y']=$y;
	   $data['ctrl']=$this->model_pembukuan;
	   $data['last']=$this->get_last_month($m,$y);
	   $this->load->helper(array('form'));
	   $this->load_header($data);
 	   $this->load->view('perubahan_modal',$data);
 	   $this->load_footer();
	 }
	
	function detail()
	{
          $id=$this->uri->segment(4);
          $this->set_timezone();
           $m=date('m');
           $y=date('Y');
           $data['now']=date('Y-m');
	   $data['b']=$m-1;$data['y']=$y;
	   $data['last']=$this->get_last_month($m,$y);
           if ($id != ''){
             $data['qry']=$this->model_pembukuan->detail($id,$data['now']);
             $data['title'] = 'details';
 		$this->load_header($data);
 	     $this->load->view('view_neraca_detail',$data);
 	     $this->load_footer();
           }else{echo "data tidak valid";}
	}
	
	
	function convert_akun_perkiraan()
	{$this->set_timezone();
	 $this->load->helper('file');
	 $this->load->library('cezpdf');
		$this->load->helper('pdf');
		$data['model']=$this->model_pembukuan;
		
		prep_pdf(); // creates the footer for the document we are creating.

		$qry=$this->model_pembukuan->get_akun_per();
		foreach($qry as $r){
			$db_data[] = array('id' => $r->ID, 'nama' => $r->nama_akun, 'kode' => $r->kode);
		}
		
		$col_names = array(
			'id' => 'ID',
			'nama' => 'Nama_akun',
			'kode' => 'Kode',
		);
		
		$this->cezpdf->ezTable($db_data, $col_names, "Laporan akun perkiraan", array('width'=>550));
		$this->cezpdf->ezStream(array('Content-Disposition'=>'laporan-akun-perkiraan'));
	}
	
	function convert_perubahan_modal()
	{
	 $this->set_timezone();
	 $this->load->helper('file');
	 $this->load->library('cezpdf');
		$this->load->helper('pdf');
		$now=$this->uri->segment(3);
		prep_pdf(); // creates the footer for the document we are creating.

			$modal_k = 0;$modal_d = 0;
			  $pm=array('Modal Awal','Laba/Rugi','Prive','(+/-)Modal');
			  for ($a=0;$a<=3;$a++)
			  {
			    if ($a == 0){$akun=$this->model_pembukuan->get_modal_awal($now);}elseif($a == 1){$akun=$this->model_pembukuan->get_laba_rugi($now);}elseif($a == 2){$akun=$this->model_pembukuan->get_prive($now);}
			    	elseif($a == 3){$akun=$this->model_pembukuan->get_penambahan_m($now);}else{$akun='';}
			    	if ($akun != '' and $akun->num_rows()){
			    	  $akn_res=$akun->result();
				    foreach ($akn_res as $r){
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
			    	//echo $pm[$a].' : '.$debet.' : '.$kredit.br();
				$db_data[] = array('id' => ($a + 1), 'nama' => $pm[$a], 'debet' => $debet, 'kredit' =>$kredit );
			  }
	
				$db_data[] = array('id' => ($a + 1), 'nama' => 'Modal Akhir', 'debet' => 0,00, 'kredit' => number_format(($modal_d + $modal_k),2,',','.'));
		
		$col_names = array(
			'id' => 'ID',
			'nama' => 'Nama_akun',
			'debet' => 'Debet',
			'kredit' => 'Kredit',
		);
		
		$this->cezpdf->ezTable($db_data, $col_names, "Laporan Perubahan Modal Tanggal ".$now, array('width'=>550));
		$this->cezpdf->ezStream(array('Content-Disposition'=>'laporan-perubahan_modal '.$now));
	}
	
	function convert_jurnal()
	{
	 $this->set_timezone();
	 $bln=$this->uri->segment(4);
	 $this->load->helper('file');
	 $this->load->library('cezpdf');
		$this->load->helper('pdf');
		
		prep_pdf(); // creates the footer for the document we are creating.

		$qry=$this->model_pembukuan->select_jurnal($bln);
		$qryress=$qry->result();
		foreach($qryress as $r){
			$t=$r->tanggal;
			$jvt=$this->model_pembukuan->jurnal_view_tree($t,0);
			if ($jvt->num_rows() > 0)
			{
			 $tmp_id=0;$n=1;
			 $hvtres=$jvt->result();
				foreach ($jvtres as $data){
					if($tmp_id != $data->ID_jurnal){
						$db_data[] = array('id' => $t, 'nama' => '"'.$data->keterangan.'"', 'debet' => '', 'kredit' => '');
					}
					$db_data[] = array('id' => '', 'nama' => $data->nama_akun, 'debet' => 'Rp. '.number_format($data->debet,2,',','.'), 'kredit' => 'Rp. '.number_format($data->kredit,2,',','.'));
				}
			}
		}
		$col_names = array(
			'id' => 'ID',
			'nama' => 'Tanggal',
			'debet' => 'Debet',
			'kredit' => 'Kredit',
		);
		
		$this->cezpdf->ezTable($db_data, $col_names, "Laporan Junal".$bln, array('width'=>550));
		$this->cezpdf->ezStream(array('Content-Disposition'=>'laporan-jurnal '.$bln));
	}
	
	function convert_neraca()
	 {
	 $this->load->helper('file');
	 $this->load->library('cezpdf');
	 $this->load->helper('pdf');
	 prep_pdf();$dt=array();
	 	$qry=$this->model_pembukuan->select_perkiraan_0();
	 	$now=$this->uri->segment(4);
	 	$ex=explode('-',$now);
	 	$y=$ex[0];	$m=$ex[1];
		$total_k1=0;$total_d1=0;
		$total_k2=0;$total_d2=0;
	 	$last=$this->get_last_month($m,$y);
	 	$qryres=$qry->result();
	 	foreach($qryres as $row)
	 	{
			  $q1=$this->model_pembukuan->get_detail($row->ID,$last);
			  $q2=$this->model_pembukuan->get_detail($row->ID,$now);
			  $res1=$q1->result();$res2=$q2->result();
			    foreach($res1 as $key => $row): $row2 = $res2[$key];
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

				    $nol=number_format(0,2,',','.');
				     if ($dbt1<>''){
				       //echo $dbt1;
				       if($parent == 'A' or $parent == 'B' or $parent == 'R'){
				           $debit1 =$dbt1 - $kdt1;
				           $nf_d1=number_format($debit1,2,',','.');
				           $total_d1 += $debit1;
				           $nf_k1=$nol;
				         }else{
				           $kredit1 =$kdt1 - $dbt1;
				           $nf_k1=number_format($kredit1,2,',','.');
				           $total_k1 += $kredit1;
				           $nf_d1=$nol;
				         } 
				     }else{$nf_k1=$nol;$nf_d1=$nol;} 
				    
				    if ($dbt2<>''){
				     //echo $dbt2;
				     if($parent == 'A' or $parent == 'B' or $parent == 'R'){
				           $debit2 =$dbt2 - $kdt2;
				           $nf_d2=number_format($debit2,2,',','.');
				           $total_d2 += $debit2;
				           $nf_k2=$nol;
				         }else{
				           $kredit2 =$kdt2 - $dbt2;
				           $nf_k2=number_format($kredit2,2,',','.');
				           $total_k2 += $kredit2;
				           $nf_d2=$nol;
				         } 
				    }else{$nf_k2=$nol;$nf_d2=$nol;}
				    //echo $kode.'::'.$name.'::'.$nf_k1.'::'.$nf_d1.$nf_k2.'::'.$nf_d2.br();
				    $db_data[] = array('id' => $kode,'nama' => $name, 'debet1' => $nf_d1,'kredit1' => $nf_k1, 'debet2' => $nf_d2, 'kredit2' => $nf_k2,);
				    //$db_data[] = array('id' => 'a','nama' => '$name', 'debet1' => '$nf_d1','kredit1' => '$nf_k1', 'debet2' => '$nf_d2', 'kredit2' => '$nf_k2',);
				}
			    endforeach;	 		
	 	}
	 	$col_names = array(
			'id' => 'Kode',
			'nama' => 'Nama Perkiraan',
			'debet1' => 'Debet',
			'kredit1' => 'Kredit',
			'debet2' => 'Debet',
			'kredit2' => 'Kredit',
		);
		    $db_data[] = array('id' => '','nama' => 'Jumlah', 'debet1' => number_format($total_d1,2,',','.'),'kredit1' => number_format($total_k1,2,',','.'), 'debet2' => number_format($total_d2,2,',','.'), 'kredit2' => number_format($total_k2,2,',','.'),);
		$tgl_name=$last.' sampai '.$now;
		$this->cezpdf->ezTable($db_data, $col_names, "Laporan Neraca Per bln ".$tgl_name, array('width'=>550));
		$this->cezpdf->ezStream(array('Content-Disposition'=>'laporan-neraca '.$tgl_name));
	 }
	 
	 function get_pdf_lr()
	 {
	 $this->load->helper('file');
	 $this->load->library('cezpdf');
	 $this->load->helper('pdf');
	 prep_pdf();$db_data=array();
	   $now=$this->uri->segment(3);
	   $last=$this->uri->segment(4);
	   $q=$this->model_pembukuan->select_lr($now,$last);
	   $totald1 = 0;$totald2 = 0;$totalk1 = 0;$totalk2 = 0;
	   $qres=$q->result();
	   foreach($qres as $r){
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
		     	 $db_data[] = array('id' => $r1->kode,'nama' => $r1->nama_akun, 'debet1' => '0.00','kredit1' => '0.00', 
		     	 'debet2' => number_format($r1->debet,2,',','.'), 'kredit2' => number_format($r1->kredit,2,',','.'),);
		       }
		    }elseif($jml1 == 0 and $jml2 > 0)
		    { 
		    $d2res=$d2->result();
		      foreach($d2res as $r2)
		       {
			 $r2debet=$r2->debet;	$r2kredit=$r2->kredit;	$r1debet=0;	$r1kredit=0;
		     	 $db_data[] = array('id' => $r2->kode,'nama' => $r2->nama_akun, 'debet1' => number_format($r2->debet,2,',','.'),'kredit1' => number_format($r2->kredit,2,',','.'), 
		     	 'debet2' => '0.00', 'kredit2' => '0.00',);
		       }
		    }else{
		    $d2res=$d2->result();$d1res=$d1->result();
		     foreach($d2res as $ro=>$r2): $r1=$d1res[$ro];
		       $r2debet=$r2->debet;	$r2kredit=$r2->kredit;	$r1debet=$r1->debet;	$r1kredit=$r1->kredit;
		     	 $db_data[] = array('id' => $r2->kode,'nama' => $r2->nama_akun, 'debet1' => number_format($r2->debet,2,',','.'),'kredit1' => number_format($r2->kredit,2,',','.'), 
		     	 'debet2' => number_format($r1->debet,2,',','.'), 'kredit2' => number_format($r1->kredit,2,',','.'),);
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
	   $sisa2=$totalk2-$totald2;
	   $sisa1=$totalk1-$totald1;
	   $db_data[] = array('id' => '','nama' => "", 
		'debet1' => number_format($totald2,2,',','.'),'kredit1' => number_format($totalk2,2,',','.'), 
				     	 'debet2' => number_format($totald1,2,',','.'), 'kredit2' => number_format($totalk1,2,',','.'),);
	   $db_data[] = array('id' => '','nama' => "_______________________________________", 
		'debet1' => number_format($sisa2,2,',','.'),'kredit1' => "____(-)____", 
		'debet2' => number_format($sisa1,2,',','.'),'kredit2' => " ____(-)____",);
	   
	   $hasil1=$sisa1 + $totald1;
	   $hasil2=$sisa2 + $totald2;
		$db_data[] = array('id' => '','nama' => "", 'debet1' => number_format($hasil2,2,',','.')
		,'kredit1' => number_format($totalk2,2,',','.'), 'debet2' => number_format($hasil1,2,',','.'),'kredit2' => number_format($totalk1,2,',','.'));
	$col_names = array(
			'id' => 'Kode',
			'nama' => 'Nama Perkiraan',
			'debet1' => 'Debet',
			'kredit1' => 'Kredit',
			'debet2' => 'Debet',
			'kredit2' => 'Kredit',
		);
		$tgl_name=$last.' sampai '.$now;
		$this->cezpdf->ezTable($db_data, $col_names, "Laporan Laba Rugi Per bln ".$tgl_name, array('width'=>550));
		$this->cezpdf->ezStream(array('Content-Disposition'=>'laporan-Laba Rugi '.$tgl_name));
	 }
	 
	 
}

