<?php 
$tgl="";$activity='';
if(isset($edit)){
	foreach($edit->result() as $r){
		$tgl=substr($r->date_time,0,10);
		$activity=$r->message;
	}
}
echo "<table class='table'>";
echo form_open();

	echo "<tr>
		<td>Tanggal</td> 
		<td>".form_input('tanggal',$tgl,'id=date placeholder=" Tanggal"')."</td> 
	</tr>";
	echo "<tr>
		<td valign='top'>Aktivitas</td> 
		<td>".form_textarea('text',$activity)."</td>
	</tr>";
	echo "<tr>
		<td style='text-align:right' colspan=2>".form_submit('submit','kirim','class="btn btn-primary" ')."</td>				
	</tr>";
echo form_close();
echo "</table>";

?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_jquery_css('jquery-ui.css');?>">
<script src="<?php echo get_js_family('jquery-1.5.2.min.js');?>"></script>

<script src="<?php echo get_js_family('jquery-ui.js');?>"></script>
<script src="<?php echo get_js_tinymce('tinymce.min.js');?>"></script>
<script >
$( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });
tinymce.init({
    selector: "textarea",theme: "modern",width: 680,height: 250,
    
 });
</script>
