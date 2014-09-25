<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php if (!isset($title)){echo "title";}else{echo $title;} ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo get_css('960.css');?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_css('reset.css');?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_css('text.css');?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_css('blue.css');?>" />
	<link type="text/css" href="<?php echo get_css('smoothness/ui.css');?>" rel="stylesheet" />  
</head>

<body>
<!-- WRAPPER START -->
<div class="container_16" id="wrapper">	
<!-- HIDDEN COLOR CHANGER -->      
  	<!--LOGO-->
	<div class="grid_8" id="logo">REZSTORE</div>
    <div class="grid_8">
<!-- USER TOOLS START -->
      <div id="user_tools"><span><a href="<?php echo get_url('fanpage'); ?>"class="mail">(1)</a> Welcome <a href="#">Admin Username</a>  |  <a class="dropdown" href="#">Change Theme</a>  |  <a href="#">Logout</a></span></div>
    </div>
<!-- USER TOOLS END -->    
<div class="grid_16" id="header">
<!-- MENU START -->
<?php
$g="";$t="";$f="";$r="";$u="";$s="";
if (isset($active)){

 if ($active == "g"){ //googleP
 	$g="current";
 }elseif($active == "t"){ //twitter
 	$t="current";
 }elseif($active == "f"){ //facebook
 	$f="current";
 }elseif($active == "r"){ //report
 	$r="current";
 }elseif($active == "u"){ //users
 	$u="current";
 }elseif($active == "s"){ //setting
 	$s="current";
 }
}
?>
	<div id="menu">
		<ul class="group" id="menu_group_main">
			<li class="item first" id="one">
				<a href="<?php echo get_url('fanpage/googleP/'); ?>"class="main <?php echo $g;?>">
				 <span class="outer">
				  <span class="inner dashboard">Google+</span>
				 </span>
				</a>
			</li>
		
			<li class="item middle" id="two">
				<a href="<?php echo get_url('fanpage/twitter/'); ?>" class="main <?php echo $t;?>">
				 <span class="outer">
				  <span class="inner content">Twitter</span>
				 </span>
				</a>
			</li>    
			   
			<li class="item middle" id="seven">
				<a href="<?php echo get_url('fanpage/facebook/'); ?>"class="main <?php echo $f;?>">
				 <span class="outer">
				  <span class="inner newsletter">Facebook</span>
				 </span>
				</a>
			</li>  
		
			<li class="item middle" id="three">
				<a href="<?php echo get_url('fanpage'); ?>"class="main <?php echo $r;?>">
				 <span class="outer">
				  <span class="inner reports png">Reports</span>
				  </span>
				</a>
			</li>
		
			<li class="item middle" id="four">
				<a href="<?php echo get_url('fanpage'); ?>"class="main <?php echo $u;?>">
				 <span class="outer">
				  <span class="inner users">Users</span>
				  </span>
				</a>
			</li>
		
			<li class="item middle" id="five">
				<a href="<?php echo get_url('fanpage'); ?>"class="main <?php echo '';?>">
				 <span class="outer">
				  <span class="inner media_library">Media Library</span>
				 </span>
				</a>
			</li>
		
			<li class="item middle" id="six">
				<a href="<?php echo get_url('fanpage'); ?>"class="main <?php echo '';?>">
				 <span class="outer">
				  <span class="inner event_manager">Event Manager</span>
				 </span>
				</a>
			</li>       
			<li class="item last" id="eight">
				<a href="<?php echo get_url('fanpage'); ?>"class="main <?php echo $s;?>">
				 <span class="outer">
				  <span class="inner settings">Settings</span>
				 </span>
				</a>
			</li>        
	    </ul>
	</div>
<!-- MENU END -->
</div>

