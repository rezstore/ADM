<?php
class M_fanpage extends CI_Model
{
  
  function escape($str){
   return $this->db->escape($str);
  }
  
  function get_app_properties($type){
   if ($type== "facebook"){
   	$sql="SELECT * FROM fb_applications WHERE 1";
   }elseif($type== "twitter"){
   	$sql="SELECT * FROM twitter_applications WHERE 1";
   }else{
   	$sql="SELECT * FROM google_applications WHERE 1";
   }
   $q=$this->db->query($sql);
   return $q;
  }
  
  function get_all_facebook_posting(){
  	$sql="SELECT fb_messages_post.*,fb_fanpages.pagename 
  		FROM fb_messages_post LEFT JOIN fb_fanpages 
  		ON fb_messages_post.page_id=fb_fanpages.page_id WHERE 1";
  	$q=$this->db->query($sql);
  	return $q;  	
  }
  
  function get_all_twitter_posting(){
  	$sql="SELECT twitter_messages_post.*,twitter_UID.pagename 
  		FROM twitter_messages_post LEFT JOIN twitter_UID 
  		ON twitter_messages_post.page_id=twitter_UID.page_id WHERE 1";
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
  
  function get_facebook_posting(){
  	$sql="SELECT fb_messages_post.*,fb_fanpages.UID FROM fb_messages_post 
  		LEFT JOIN fb_fanpages ON fb_fanpages.page_id=fb_messages_post.page_id
  		WHERE fb_messages_post.status = 0 AND fb_messages_post.date_post <= CURDATE() LIMIT 1";
  	$q=$this->db->query($sql);
  	return $q;
  }
  
  function update_facebook_posting_status($ID){
  	$ID=$this->escape($ID);
  	$sql="UPDATE fb_messages_post SET status=1 WHERE ID_post = $ID LIMIT 1";
  	return $this->db->query($sql);
  }
  
  function get_fb_page(){
  	$sql="SELECT page_id,pagename FROM fb_fanpages WHERE 1";
  	$q=$this->db->query($sql);
  	return $q;
  }
  
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
  
  # SELECT FOR EDIT #
  
  function select_fbpost_forEdit($id){
  	$id=$this->escape($id);
  	$sql="SELECT * FROM fb_messages_post WHERE ID_post= $id LIMIT 1";
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
  
  
}
//end of file 


