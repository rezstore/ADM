<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Post to user Page Wall</title>
		<link href="<?php echo get_css('facebook.style.css');?>" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div class="fbpagewrapper">
			<div id="fbpageform" class="pageform">
				<form id="form" name="form" method="post" action="process.php">
					<h1>Post to Facebook Page Wall</h1>
					<p>Choose a page to post.

					</p>
					<label>Pages
						<span class="small">Select a Page</span>
					</label>
					<select name="userpages" id="upages">
						<option value='rez'>Rez</option>
					</select>
					<label>Message
						<span class="small">Write something to post!</span>
					</label>
						<textarea name="message"></textarea>
						<button type="submit" class="button" id="submit_button">Send Message</button>
					<div class="spacer"></div>
				</form>
			</div>
		</div>
	</body>
</html>

