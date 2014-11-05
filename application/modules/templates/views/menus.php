
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
		
	}elseif($type == "activity"){
		echo anchor(get_site_url('view_activity'),'Aktivitas Saya').$sptr.
	        	anchor(get_site_url('new_activity'),'Tambah Aktivitas');
	}elseif($type == "fanpage"){
		echo anchor(get_site_url('facebook'),'Facebook').$sptr.
			 anchor(get_site_url('twitter'),'Twitter').$sptr.
			 anchor(get_site_url('googleP'),'Google<sup>+</sup>').$sptr.
			 anchor(get_site_url('log'),'Log Activity').$sptr.
			 anchor(get_site_url('settings'),'Settings').$sptr.
			 anchor(get_site_url('report'),'Report');
	}elseif($type == "contact"){
		echo anchor(get_site_url('view_kota'),'Daftar Kota').$sptr.
			 anchor(get_site_url('new_kota'),'Input Kota').$sptr.
			 anchor(get_site_url('contacts'),'Daftar Kontak').$sptr.
			 anchor(get_site_url('insert_contacts'),'Input Kontak');
	}

}
?>
<hr>
