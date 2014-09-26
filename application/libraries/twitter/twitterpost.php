<?php
// Twitter Class
require_once('twitteroauth.php');
 class twitterpost {
 
  function post_message($c_key,$c_sc,$token,$secret,$message){
	// Connect to Twitter
	$connection = new TwitterOAuth($c_key, $c_sc, $token, $secret);
	// Post Update
	$content = $connection->post('statuses/update', array('status' => $message));
	if ($content){
		return 1;
	}else{return 0;}
  }
  
  function post_message_with_image($c_key,$c_sc,$token,$secret,$message,$image){
	$connection = new TwitterOAuth($c_key, $c_sc, $token, $secret);
	$content = $connection->get('account/verify_credentials');
	$status = $connection->upload('statuses/update_with_media', array('status' => $message, 'media[]' => file_get_contents($image)));
	//echo json_encode($status);
}
 }
 
?>
