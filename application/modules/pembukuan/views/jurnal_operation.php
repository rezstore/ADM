<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_jquery_css('jquery-ui.css');?>" />
<script src="<?php echo get_js_family('jquery-1.5.2.min.js');?>"></script>
<script src="<?php echo get_js_family('jquery-ui.js');?>"></script>
<script src="<?php echo get_js('token_input/tokeninput.js',true); ?>"></script>
<link rel="stylesheet" href="<?php echo get_css('token-input-facebook.css'); ?>" />
<?php
if(!isset($typ))$typ=0;
if ($typ == 1)
{
        foreach ($d->result() as $row)
        {
          $tgl=$row->tanggal;
          $akun=$row->id_akun_perkiraan;
          if($row->debet == "")
          {
           $dk=$row->kredit;
          }else{
           $dk=$row->debet;
          }
        }
  $value_nm="'value'=>'$nm'";
  $value_kd="'value'=>'$kd'";
  $selected=$id_p;
  $action=get_site_url('update_akun');
  $value_nom=$dk;
  $value_ket='';
  
}else{$value_nm='';$value_kd='';$selected='';$action=get_site_url('tambah_akun');$value_nom='';$value_ket='';}

$tgl=array('name'=>'tgl','id'=>'datepicker','placeholder'=>'Tanggal','maxlength'=>'30',$value_nm,'class'=>'form-control');
$a_p=array('name'=>'a_p','id'=>'ap','placeholder'=>'Akun','maxlength'=>'5',$value_kd,'class'=>'form-control');
$nominal=array('name'=>'nominal','placeholder'=>'Nominal','maxlength'=>'5',$value_nom,'class'=>'form-control');
$ket=array('name'=>'ket','placeholder'=>'Keterangan',$value_ket,'class'=>'form-control','style'=>'max-width: 436px; max-height: 68px;border:0px;');
$dropdown_dk=array('1'=>'Debet','2'=>'Kredit');
$f='id="myform"';
?>

<?php echo form_open($action,$f); ?>
<table border="0" width=700 style='margin:50px;' id='f'>
	<tr id='f1'>
		<td class="td-head" colspan="4"><h2>Form Input Jurnal</h2><br /></td>
	</tr>
	<tr>
		<td>Tanggal</td>
		<td>:</td>
		<td><?php echo input('tgl','','id="datepicker" class="form-control" style="width:200px;"'); ?></td>
	</tr>
	<tr>
		<td>Keterangan</td>
		<td>:</td>
		<td><?php echo form_textarea($ket); ?></td>
	</tr>
	<tr>
		<td colspan=3>
		  <div class="load">
		    <table width="100%" id="item">
		        <tr>
		             <td>Akun Perkiraan</td>
		             <td>Debet</td>
		             <td>Kredit</td>
		        <tr>
		   </table>
		  </div>
		</td>
	</tr>
        <tr>
             <td class="" colspan=3>
             <input type="button" id='button' value="+" class="btn btn-default"> 
             <?php echo submit('submit','Tambahkan','class="btn btn-default"').' '.
             	form_button('button','Batalkan','class="btn btn-warning"'); ?></td>
        <tr>
	
	</table>
	</form>
<script type="text/javascript">
ad();

function ad(){
	for (var i=1;i <= 5; i++)
	{ 
	       add_itm();
	}
}

     function add_itm() {
	    var tr = $('<tr></tr>');
	    var td = $('<td></td>');
	    var td_d = $('<td></td>');
	    var td_k = $('<td></td>');
	    var debet = $("<input type='text' name='debet[]' placeholder='Rp. xxx' style='width:200px;' class='form-control'>");//<input type='text' name='debet[]' placeholder='Rp. xxx'>
	    var kredit = $("<input type='text' name='kredit[]' placeholder='Rp. xxx' style='width:200px;' class='form-control'>");
	    var fb = $("<input class='token_fb' name='akun[]'>");
	    
	        $('#item').append(tr);
	        $(tr).append(td);
	    	$(td).append(fb);

		$(fb).tokenInput("<?php echo get_site_url('get_perkiraan'); ?>", {
			hintText:"Type name from your contacts",
			noResultsText:"No results",
			searchingText: "Searching...",
			tokenLimit:1,

			method: "GET",
			minChars : 1,
			classes: {
			    tokenList: "token-input-list-facebook",
			    token: "token-input-token-facebook",
			    tokenDelete: "token-input-delete-token-facebook",
			    selectedToken: "token-input-selected-token-facebook",
			    highlightedToken: "token-input-highlighted-token-facebook",
			    dropdown: "token-input-dropdown-facebook",
			    dropdownItem: "token-input-dropdown-item-facebook",
			    dropdownItem2: "token-input-dropdown-item2-facebook",
			    selectedDropdownItem: "token-input-selected-dropdown-item-facebook",
			    inputToken: "token-input-input-token-facebook"
			}
		});
	            $(tr).append(td_d);
	            $(tr).append(td_k);
	            $(td_d).append(debet);
	            $(td_k).append(kredit);
	};
</script>
	
	<script>
	$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	</script>
