<!doctype html>
<html lang="en">

<?php 
if(!isset($title))$title="~";
$controller->get_head($title); ?>


<body>

	<?php  $controller->get_header();?>
	
	<?php  $controller->get_leftside();?>
	
	<section id="main" class="column">
		
		<h4 class="alert_info">Selamat Datang Di <?php echo get_school_name(); ?></h4>
		
		<article class="module width_full">
			<header><h3 style="max-width:400px">Pesan Singkat</h3>
			<ul class="tabs">
	   			<li><a href="#tab1">Inbox</a></li>
	   			<li><a href="#tab2">Outbox</a></li>
		    		<li><a href="#tab3">Compose</a></li>
			</ul>
			
			</header>
		  <div class="tab_container">
			<div id="tab1" class="tab_content">
			 <div id="students-container">
			  <div class="chat-content">
			  <?php 
			  $site=site_url('siswa/student/detail_messages');
			  if(isset($detail)){
			  	$user='';
				  foreach($detail->result() as $object){
				  	$user=$object->user_from;
				  	$to=$object->user_to;
				  	if($u==$user)$usr="Me";else $usr=$user;
				  	$content=ucwords($object->chat_content);
				    echo  "<div class='students-chat-content'> Dari: <i style='font-weight:bold;'>".$usr.'</i> To: '.$to.$content."</div>";
				  }
				  ?>
				 </div><!-- chat contain-->
				<div class="chat-form">
				  <?php 
				   if($usr=="Me")$usr=$to;
				   $style='style="height:50px;float:right;"';
				   echo form_open(student_site_url('show_unread_messages'));
				   echo form_hidden('tujuan',$usr);
				   echo form_textarea(array('name'=>'text','placeholder'=>'Masukkan Pesan Disini','class'=>'input_textarea'
				   		,'style'=>'max-width:340px;max-height:200px;'));
				   echo form_submit('submit','Kirim',$style);
				   echo form_close();
				  ?>
				</div>
			  <?php
			  }else{
			  foreach($messages->result() as $object){
			  	$user=$object->user_from;
			  	$content=ucwords($object->chat_content);
			    echo anchor($site.'?id='.$object->ID_chat,"<div class='students-chat-content'>Dari: "
			  	.$user. $content
			    . "</div>");
			  }?>
			 </div><!-- chat contain-->
			<?php
			}
			?>
			</div>
			</div>
			<div id="tab2" class="tab_content">
			 <div id="students-container">
			  <div class="chat-content" style="width:70%">
			  <?php
			  if (isset($outbox)){
			  	foreach($outbox->result() as $mOut){
			  	 $from=$mOut->user_from;
			  	 $to=ucwords($mOut->user_to);
			  	 $content=$mOut->chat_content;
			  	 echo "<div class='students-chat-content'><b>Kepada:</b> "
					  .$to." <font color='green'>Status ( Terkirim )</font>". $content
					    . "</div>";
			  	}
			  }
			  ?>
			   </div>
			  </div>
			</div><!-- end of tab2-->
			<script src="<?php echo tinymce_url('tinymce.min.js');?>"></script>
			<script>
       				 tinymce.init({selector:'textarea'});
			</script>
			<div id="tab3" class="tab_content">
			<form method="POST" name="f1" action ="<?php echo student_site_url('show_unread_messages'); ?>">
			<table style="width:600px;margin-left:100px;" cellspacing="0"> 
				<tr> 
				 <td>Tujuan</td> 
    				 <td>:</td> 
   				 <td>
   				  	<input type="text" id="demo-input-facebook-theme" name="tujuan" />
   				  	<link rel="stylesheet" href="<?php echo tokenInput_url('token-input.css');?>" type="text/css" />
					<link rel="stylesheet" href="<?php echo tokenInput_url('token-input-facebook.css');?>" type="text/css" />
   				  	<script type="text/javascript" src="<?php echo tokenInput_url('tokeninput.js');?>"></script>
					<script type="text/javascript">
					$(document).ready(function() {
					    $("#demo-input-facebook-theme").tokenInput("<?php echo student_site_url('token_input/user_all'); ?>", {
						theme: "facebook"
					    });
					});
					</script>
   				 </td> 
   				</tr>
   				<tr style="vertical-align:top;">
    				 <td>Pesan</td> 
    				 <td>:</td>
    				 <td><textarea name='text'></textarea></td> 
				</tr> 
   				<tr>
    				 <td></td> 
    				 <td></td>
    				 <td><br><input type="submit" value="Kirim"></td> 
				</tr> 
			</table>
			</form>

		</div><!-- end of #tab3 -->
			</div>
		</article><!--module width_full-->
		
	</section>


</body>

</html>
