<link rel="stylesheet" href="<?php echo get_bootstrap_css(); ?>">
<?php
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

?>
