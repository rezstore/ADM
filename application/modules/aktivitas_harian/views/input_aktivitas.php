<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_jquery_css('jquery-ui.css');?>">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_jquery_css('style.css');?>">
<script src="<?php echo get_js_family('jquery-1.5.2.min.js');?>"></script>

<script src="<?php echo get_js_family('jquery-ui.js');?>"></script>
<script src="<?php echo get_js_tinymce('tinymce.min.js');?>"></script>


<?php 
$this->load->library("session");
echo "<table>";
echo form_open(get_site_url('tambah/'));

echo "<tr>
				<td>tanggal</td> <td>".form_input('tanggal','','id=date')."</td> 
		</tr>";
echo "<tr>
				<td valign='top'>aktifitas</td> <td>".form_textarea('text',' textarea')."</td>
		</tr>";
echo "<tr>
				<td style='text-align:right' colspan=2>".form_submit('submit','kirim','class="btn btn-primary" ')."</td>				
		</tr>";
echo form_close();
echo "</table>";

?>
<script >
$( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });
tinymce.init({
    selector: "textarea",theme: "modern",width: 680,height: 300,
    
 });
</script>
