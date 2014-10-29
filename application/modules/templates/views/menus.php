
<?php
$sptr=" | ";
if (isset($type)){
	if($type =="home"){
		
	}elseif($type == "pembukuan"){
		echo anchor(get_site_url('view_perkiraan'),'Akun Perkiraan').$sptr.
	        	 anchor(get_site_url('neraca'),'Neraca Saldo').$sptr.
	        	 anchor(get_site_url('view_jurnal'),'Jurnal').$sptr.
	        	 anchor(get_site_url('laba_rugi'),'Laba Rugi').$sptr.
	        	 anchor(get_site_url('perubahan_modal'),'Perubahan Modal');
		
	}elseif($type == ""){
		
	}elseif($type == "pembukuan"){
		
	}elseif($type == "pembukuan"){
		
	}

}
?>
