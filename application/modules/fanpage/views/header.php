    <hr>
<?php
if($this->uri->segment(1)=="pembukuan"){
	echo anchor(get_site_url('view_perkiraan'),"view perkiraan");
	 echo " | ";
	echo anchor(get_site_url('view_jurnal'),"view jurnal");
	 echo " | ";
	echo anchor(get_site_url('add_perkiraan'),"add perkiraan");
	 echo " | ";
	echo anchor(get_site_url('add_jurnal'),"add jurnal");
	 echo " | ";
	echo anchor(get_site_url('neraca'),"Neraca Saldo");
	 echo " | ";
	echo anchor(get_site_url('laba_rugi'),"Laba/Rugi");
	 echo " | ";
	echo anchor(get_site_url('perubahan_modal'),"Perubahan Modal");
}

if($this->uri->segment(1)=="fanpage"){
	echo anchor(get_site_url('googleP'),"Google Posting");
	 echo " | ";
	echo anchor(get_site_url('twitter'),"Twitter Posting");
	 echo " | ";
	echo anchor(get_site_url('facebook'),"Facebook Posting");
	 echo " | ";
	echo anchor(get_site_url('report'),"Report");
	 echo " | ";
	echo anchor(get_site_url('gallery'),"Gallery");
	 echo " | ";
	echo anchor(get_site_url('log'),"Aktivitas");
	 echo " | ";
	echo anchor(get_site_url('settings'),"Settings");/**/
}

?>
    <hr>
