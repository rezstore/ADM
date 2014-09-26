<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>Siswa :: Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
        <meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/login.css');?>" />
    </head>
    <body>
    <?php
     if(isset($error)){
       $user_log=$user;
       $error_message=$error;
       $bg="#D3D3D3";
     }else{
       $user_log="";
       $error_message="";
       $bg="transparent";
     }
    ?>
	<div class="wrapper">
	  <div class="content">
	   <div class='error' style="background:<?php echo $bg; ?>;"><?php echo $error_message; ?></div>
		<div id="form_wrapper" class="form_wrapper">
		  <form class="login active" action="<?php echo site_url('login/check_login'); ?>" method="POST">
			<h3>Login</h3>
			<div>
				<label>Username:</label>
				<input type="text" name='user' autocomplete="off" value="<?php echo $user_log; ?>" />
			</div>
			<div>
				<label>Password: <a href="#" rel="forgot_password" class="forgot linkform">Lupa password?</a></label>
				<input type="password" name='pass' autocomplete="off" />
			</div>
			<div>
				<label>Code Data:</label>
				<input type="text" name="auth_code" maxlength="10" autocomplete="off" />
			</div>
			<div>
				<label>Jabatan: </label>
				<select name='type'>
				 <option value='swa'>Siswa</option>
				 <option value='gr'>Guru</option>
				 <option value='pgw'>Karyawan</option>
				 <option value='adm'>Admin</option>
				</select>
			</div>
			<div class="bottom">
				<input type="submit" value="Login"></input>
				<div class="clear"></div>
			</div>
		  </form>
		</div>
	   </div>
	</div>
    </body>
</html>