<?php
define('T_TWT_APP','fp_twitter_applications');
define('T_TWT_POST','fp_twitter_messages_post');
define('T_TWT_UID','fp_twitter_uid');
define('T_FB_APP','fp_fb_applications');
define('T_FB_FANPAGE','fp_fb_fanpages');
define('T_FB_POST','fp_fb_messages_post');
define('T_FB_UID','fp_fb_uid');
class M_fanpage extends CI_Model
{
  
  function escape($str){
   return $this->db->escape($str);
  }
  
  function get_app_properties($type){
   if ($type== "facebook"){
   	$sql="SELECT * FROM ".T_FB_APP." WHERE status=1 LIMIT 1";
   }elseif($type== "twitter"){
   	$sql="SELECT * FROM ".T_TWT_APP." WHERE status=1 LIMIT 1";
   }else{
   	$sql="SELECT * FROM google_applications WHERE 1 LIMIT 1";
   }
   $q=$this->db->query($sql);
   return $q;
  }
  
  # SELECT DEFAULT APP FB #
  function select_default_fb_app(){
	$sql="SELECT app_name,appId FROM ".T_FB_APP." WHERE status=1 LIMIT 1";
	$q=$this->db->query($sql);
	return $q;
  }
  
  function select_all_fb_app(){
	$sql="SELECT app_name,appId FROM ".T_FB_APP." WHERE 1";
	$q=$this->db->query($sql);
	return $q;
  }
  
  function set_dafault_app($app){
	$app=$this->escape($app);
	$sql="UPDATE ".T_FB_APP." SET status=0 where 1";
	$this->db->query($sql);
	$sql2="UPDATE ".T_FB_APP." SET status=1 where appid=$app";
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
	$sql="INSERT INTO ".T_FB_APP." (`app_name`,`appId`,`appSecret`,`return_url`,`homeurl`,`fbPermissions`,`token`)
		VALUES ($app_name,$appid,$appsc,$return_url,$home_url,$permisions,$token)";
	$this->db->query($sql);
  }
  # GALLERY #
  function select_image_from_postings(){
	$sql="SELECT image FROM ".T_FB_POST." UNION SELECT image FROM ".T_TWT_POST."";
	$q=$this->db->query($sql);
	return $q;
  }
  # GET ALL FANPAGE DATAS #
  
  function get_all_facebook_posting(){
  	$sql="SELECT  ".T_FB_POST." .*,".T_FB_FANPAGE.".pagename 
  		FROM ".T_FB_POST." LEFT JOIN ".T_FB_FANPAGE." 
  		ON  ".T_FB_POST." .page_id=".T_FB_FANPAGE.".page_id WHERE 1";
  	$q=$this->db->query($sql);
  	return $q;  	
  }
  
  function get_all_twitter_posting(){
  	$sql="SELECT ".T_TWT_POST.".*,".T_TWT_UID.".UID 
  		FROM ".T_TWT_POST." LEFT JOIN ".T_TWT_UID." 
  		ON ".T_TWT_POST.".page_id=".T_TWT_UID.".UID WHERE 1";
  	$q=$this->db->query($sql);
  	return $q;  	
  }
  
  function get_all_googleP_posting(){
  	$sql="SELECT ".T_FB_POST.".*,".T_FB_FANPAGE.".pagename 
  		FROM ".T_FB_POST." LEFT JOIN ".T_FB_FANPAGE." 
  		ON ".T_FB_POST.".page_id=".T_FB_FANPAGE.".page_id WHERE 1";
  	$q=$this->db->query($sql);
  	return $q;  	
  }
  
  # SELECT FOR POSTING TO WALL #
  
  function get_facebook_posting($id=""){
  	$id=$this->escape($id);
  	if($id !== ""){
  	$sql="SELECT ".T_FB_POST.".*,".T_FB_FANPAGE.".UID FROM ".T_FB_POST." 
  		LEFT JOIN ".T_FB_FANPAGE." ON ".T_FB_FANPAGE.".page_id=".T_FB_POST.".page_id
  		WHERE ".T_FB_POST.".status = 0 AND ".T_FB_POST.".date_post <= CURDATE() LIMIT 1";
  	}else{
  	$sql="SELECT ".T_FB_POST.".*,".T_FB_FANPAGE.".UID FROM ".T_FB_POST." 
  		LEFT JOIN ".T_FB_FANPAGE." ON ".T_FB_FANPAGE.".page_id=".T_FB_POST.".page_id
  		WHERE ".T_FB_POST.".status = 0 AND ".T_FB_POST.".ID_post = $id LIMIT 1";
  	}
  	$q=$this->db->query($sql);
  	
  	return $q;
  }
  
  function get_twitter_posting($id=''){
  	$id=$this->escape($id);
  	if($id == ''){
	  	$sql="SELECT ".T_TWT_POST.".*
	  		FROM ".T_TWT_POST." 
	  		WHERE ".T_TWT_POST.".date_post <= CURDATE() LIMIT 1";
  	}else{
	  	$sql="SELECT ".T_TWT_POST.".*
	  		FROM ".T_TWT_POST." 
	  		WHERE ".T_TWT_POST.".ID_post=$id LIMIT 1";  	
  	}
  	$q=$this->db->query($sql);
  	return $q;
  }
  
  # DELETE RECORD #
  
  function delete_posting($type,$id){
  	$id=$this->escape($id);
  	if ($type== "t"){
  	 $sql="DELETE FROM ".T_TWT_POST." WHERE ID_post=$id LIMIT 1";
  	}elseif($type== "f"){
  	 $sql="DELETE FROM ".T_FB_POST." WHERE ID_post=$id LIMIT 1";
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
  	$sql="UPDATE ".T_FB_POST." SET status=1 WHERE ID_post = $ID LIMIT 1";
  	return $this->db->query($sql);
  }
  
  # GETTING PAGE OF FANPAGE #
  function get_fb_page(){
  	$sql="SELECT page_id,pagename FROM ".T_FB_FANPAGE." WHERE 1";
  	$q=$this->db->query($sql);
  	return $q;
  }
  
  function get_twitter_page(){
  	$sql="SELECT `UID` as page_id, `user_name` as pagename FROM `".T_TWT_UID."` WHERE `status`=1";
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
  	$sql="INSERT INTO ".T_FB_POST." (`date_post`,`page_id`,`messages`,`url`,`image`) 
  		VALUES ($date,$pageid,$text,$url,$filename)";
  	$this->db->query($sql);
  }
  
  function insert_new_twitter_post($date,$pageid,$text,$url,$filename){
  	$date=$this->escape($date);
  	$pageid=$this->escape($pageid);
  	$text=$this->escape($text);
  	$url=$this->escape($url);
  	$filename=$this->escape($filename);
  	$sql="INSERT INTO ".T_TWT_POST." (`date_post`,`page_id`,`messages`,`url`,`image`) 
  		VALUES ($date,$pageid,$text,$url,$filename)";
  	$this->db->query($sql);
  }
  
  # SELECT FOR EDIT #
  
  function select_fbpost_forEdit($id){
  	$id=$this->escape($id);
  	$sql="SELECT * FROM ".T_FB_POST." WHERE ID_post= $id LIMIT 1";
  	$q=$this->db->query($sql);
  	return $q;
  }
  
  function select_twtpost_forEdit($id){
  	$id=$this->escape($id);
  	$sql="SELECT * FROM ".T_TWT_POST." WHERE ID_post= $id LIMIT 1";
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
  	$sql="UPDATE ".T_FB_POST." 
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
  	$sql="UPDATE ".T_TWT_POST." 
  		SET date_post=$date,page_id=$pageid,messages=$text,url=$url,image=$filename 
  			WHERE ID_post=$id";
  	$this->db->query($sql);
  }
  
  # GET IMAGE #
  function get_image_from_post($type,$id){
  	$id=$this->escape($id);
  	if ($type== "t"){
  	 $sql="SELECT image FROM ".T_TWT_POST." WHERE ID_post = $id LIMIT 1";
  	}elseif($type== "f"){
  	 $sql="SELECT image FROM ".T_FB_POST." WHERE ID_post = $id LIMIT 1";
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
  
  # CHART # 
  function get_tgl_chart($username){
  	$user=$this->escape($username);
  	$sql="SELECT DATE(`date_time`) as date
		FROM `user_activities` WHERE `user`=$user GROUP BY date";
	$q=$this->db->query($sql);
	return $q;
  } 
  function get_activity_chart($username,$date){
  	$user=$this->escape($username);
  	$date=$this->escape($date);
  	$sql="SELECT count(`p`.`date`)as `jumlah`,p.* FROM (SELECT `user`,DATE(`date_time`) as date,`type`,`message` 
		FROM `user_activities` WHERE `user`=$user AND DATE(`date_time`)=$date)p 
		 WHERE 1 GROUP BY type";
	$q=$this->db->query($sql);
	return $q;
  }
  
}
//end of file 


