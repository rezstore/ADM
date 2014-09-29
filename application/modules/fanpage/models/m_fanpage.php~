<?php
class M_fanpage extends CI_Model
{
  
  function escape($str){
   return $this->db->escape($str);
  }
  
  function get_app_properties($type){
   if ($type== "facebook"){
   	$sql="SELECT * FROM fb_applications WHERE 1 LIMIT 1";
   }elseif($type== "twitter"){
   	$sql="SELECT * FROM twitter_applications WHERE status=1 LIMIT 1";
   }else{
   	$sql="SELECT * FROM google_applications WHERE 1 LIMIT 1";
   }
   $q=$this->db->query($sql);
   return $q;
  }
  
  # SELECT DEFAULT APP FB #
  function select_default_fb_app(){
	$sql="SELECT app_name,appId FROM fb_applications WHERE status=1 LIMIT 1";
	$q=$this->db->query($sql);
	return $q;
  }
  
  function select_all_fb_app(){
	$sql="SELECT app_name,appId FROM fb_applications WHERE 1";
	$q=$this->db->query($sql);
	return $q;
  }
  
  function set_dafault_app($app){
	$app=$this->escape($app);
	$sql="UPDATE fb_applications SET status=0 where 1";
	$this->db->query($sql);
	$sql2="UPDATE fb_applications SET status=1 where appid=$app";
	$this->db->query($sql2);
  }
  
  # INSERT NEW APP#
  function insert_new_fb_application($app_name,$appid,$appsc,$return_url,$home_url,$permisions,$token){
	$app_name=$this->escape($app_name);
	$appid=$this->escape($appid);
	$appsc=$this->escape($appsc);
	$return_url=$this->escape($return_url);
	$home_url=$this->escape($home_url);
	$permisions=$this->escape($permisions);
	$token=$this->escape($token);
	$sql="INSERT INTO fb_applications (`app_name`,`appId`,`appSecret`,`return_url`,`homeurl`,`fbPermissions`,`token`)
		VALUES ($app_name,$appid,$appsc,$return_url,$home_url,$permisions,$token)";
	$this->db->query($sql);
  }
  # GALLERY #
  function select_image_from_postings(){
	$sql="SELECT image FROM fb_messages_post UNION SELECT image FROM twitter_messages_post";
	$q=$this->db->query($sql);
	return $q;
  }
  # GET ALL FANPAGE DATAS #
  
  function get_all_facebook_posting(){
  	$sql="SELECT fb_messages_post.*,fb_fanpages.pagename 
  		FROM fb_messages_post LEFT JOIN fb_fanpages 
  		ON fb_messages_post.page_id=fb_fanpages.page_id WHERE 1";
  	$q=$this->db->query($sql);
  	return $q;  	
  }
  
  function get_all_twitter_posting(){
  	$sql="SELECT twitter_messages_post.*,twitter_uid.UID 
  		FROM twitter_messages_post LEFT JOIN twitter_uid 
  		ON twitter_messages_post.page_id=twitter_uid.UID WHERE 1";
  	$q=$this->db->query($sql);
  	return $q;  	
  }
  
  function get_all_googleP_posting(){
  	$sql="SELECT fb_messages_post.*,fb_fanpages.pagename 
  		FROM fb_messages_post LEFT JOIN fb_fanpages 
  		ON fb_messages_post.page_id=fb_fanpages.page_id WHERE 1";
  	$q=$this->db->query($sql);
  	return $q;  	
  }
  
  # SELECT FOR POSTING TO WALL #
  
  function get_facebook_posting(){
  	$sql="SELECT fb_messages_post.*,fb_fanpages.UID FROM fb_messages_post 
  		LEFT JOIN fb_fanpages ON fb_fanpages.page_id=fb_messages_post.page_id
  		WHERE fb_messages_post.status = 0 AND fb_messages_post.date_post <= CURDATE() LIMIT 1";
  	$q=$this->db->query($sql);
  	return $q;
  }
  
  function get_twitter_posting(){
  	$sql="SELECT twitter_messages_post.*
  		FROM twitter_messages_post 
  		WHERE twitter_messages_post.date_post <= CURDATE() LIMIT 1";
  	$q=$this->db->query($sql);
  	return $q;
  }
  
  # DELETE RECORD #
  
  function delete_posting($type,$id){
  	$id=$this->escape($id);
  	if ($type== "t"){
  	 $sql="DELETE FROM twitter_messages_post WHERE ID_post=$id LIMIT 1";
  	}elseif($type== "f"){
  	 $sql="DELETE FROM fb_messages_post WHERE ID_post=$id LIMIT 1";
  	}else{
  	 $sql="";
  	}
  	
  	if ($sql != ""){
  		$this->db->query($sql);
  	}
  }
  
  # UPDATE STATUS POSTING #
  
  function update_facebook_posting_status($ID){
  	$ID=$this->escape($ID);
  	$sql="UPDATE fb_messages_post SET status=1 WHERE ID_post = $ID LIMIT 1";
  	return $this->db->query($sql);
  }
  
  # GETTING PAGE OF FANPAGE #
  function get_fb_page(){
  	$sql="SELECT page_id,pagename FROM fb_fanpages WHERE 1";
  	$q=$this->db->query($sql);
  	return $q;
  }
  
  function get_twitter_page(){
  	$sql="SELECT `UID` as page_id, `user_name` as pagename FROM `twitter_uid` WHERE `status`=1";
  	$q=$this->db->query($sql);
  	return $q;
  }
  
  # INSERT NEW RECORD POSTING#
  
  function insert_new_fb_post($date,$pageid,$text,$url,$filename){
  	$date=$this->escape($date);
  	$pageid=$this->escape($pageid);
  	$text=$this->escape($text);
  	$url=$this->escape($url);
  	$filename=$this->escape($filename);
  	$sql="INSERT INTO fb_messages_post (`date_post`,`page_id`,`messages`,`url`,`image`) 
  		VALUES ($date,$pageid,$text,$url,$filename)";
  	$this->db->query($sql);
  }
  
  function insert_new_twitter_post($date,$pageid,$text,$url,$filename){
  	$date=$this->escape($date);
  	$pageid=$this->escape($pageid);
  	$text=$this->escape($text);
  	$url=$this->escape($url);
  	$filename=$this->escape($filename);
  	$sql="INSERT INTO twitter_messages_post (`date_post`,`page_id`,`messages`,`url`,`image`) 
  		VALUES ($date,$pageid,$text,$url,$filename)";
  	$this->db->query($sql);
  }
  
  # SELECT FOR EDIT #
  
  function select_fbpost_forEdit($id){
  	$id=$this->escape($id);
  	$sql="SELECT * FROM fb_messages_post WHERE ID_post= $id LIMIT 1";
  	$q=$this->db->query($sql);
  	return $q;
  }
  
  function select_twtpost_forEdit($id){
  	$id=$this->escape($id);
  	$sql="SELECT * FROM twitter_messages_post WHERE ID_post= $id LIMIT 1";
  	$q=$this->db->query($sql);
  	return $q;
  }
  
  # UPDATE POST 
  function update_fb_post($id,$date,$pageid,$text,$url,$filename){
  	$id=$this->escape($id);
  	$date=$this->escape($date);
  	$pageid=$this->escape($pageid);
  	$text=$this->escape($text);
  	$url=$this->escape($url);
  	$filename=$this->escape($filename);
  	$sql="UPDATE fb_messages_post 
  		SET date_post=$date,page_id=$pageid,messages=$text,url=$url,image=$filename 
  			WHERE ID_post=$id";
  	$this->db->query($sql);
  }
  
  function update_twitter_post($id,$date,$pageid,$text,$url,$filename){
  	$id=$this->escape($id);
  	$date=$this->escape($date);
  	$pageid=$this->escape($pageid);
  	$text=$this->escape($text);
  	$url=$this->escape($url);
  	$filename=$this->escape($filename);
  	$sql="UPDATE twitter_messages_post 
  		SET date_post=$date,page_id=$pageid,messages=$text,url=$url,image=$filename 
  			WHERE ID_post=$id";
  	$this->db->query($sql);
  }
  
  # GET IMAGE #
  function get_image_from_post($type,$id){
  	$id=$this->escape($id);
  	if ($type== "t"){
  	 $sql="SELECT image FROM twitter_messages_post WHERE ID_post = $id LIMIT 1";
  	}elseif($type== "f"){
  	 $sql="SELECT image FROM fb_messages_post WHERE ID_post = $id LIMIT 1";
  	}else{
  	 $sql="";
  	}
  	$q=$this->db->query($sql);
  	$image='';
  	foreach($q->result() as $r){
  		$image=$r->image;
  	}
  	return $image;
  }
  
  # INSERT ACTIVITIES #
  function insert_new_activity($user,$text,$type){
  	$user=$this->escape($user);
  	$text=$this->escape($text);
  	$type=$this->escape($type);
  	$sql="INSERT INTO user_activities (`user`,`date_time`,`type`,`message`) 
  		VALUES ($user,NOW(),$type,$text)";
  	$this->db->query($sql);
  }
  
  # SELECT LOG #
  function select_log($user){
	$user=$this->escape($user);
	$sql="SELECT * FROM user_activities WHERE user=$user";
	$q=$this->db->query($sql);
	return $q;
  }
  
  ## 
  function get_activity_chart($username){
  	$user=$this->escape($username);
  	$sql="SELECT count(`p`.`date`)as `jumlah`,p.* FROM (SELECT `user`,DATE(`date_time`) as date,`type`,`message` 
		FROM `user_activities` WHERE `user`=$user)p 
		 WHERE 1 GROUP BY date";
	$q=$this->db->query($sql);
	return $q;
  }
  
}
//end of file 


