<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fanpage extends CI_Controller {

	var $appId = "";
	var $appSecret = "";
	var $return_url = ""; 
	var $homeurl = "";  
	var $fbPermissions = ""; 
	var $token = ""; 
	var $page = ""; 
	var $fbuser = "";
	var $caption_post = ""; 
	var $twt_appId = "";
	var $twt_appSecret = "";
	var $twt_token = "";
	var $twt_token_secret = "";
	var $userdata = "";
	
	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html','fanpage'));
		$this->load->model('m_fanpage');
		$this->get_session();
	 }
	 
	function post($post){
	 return $this->input->post($post);
	}
	 
	function get($get){
	 return $this->input->get($get);
	}
	 
	function initials(){
	 	$this->initial_fb();
	 	//$this->initial_twitter();
	 }
	
	function initial_fb(){
		$init=$this->m_fanpage->get_app_properties('facebook');
		foreach($init->result() as $r){
			$this->appId = $r->appId; //Facebook App ID
			$this->appSecret = $r->appSecret; // Facebook App Secret
			$this->return_url = $r->return_url;  //return url (url to script)
			$this->homeurl = $r->homeurl;  //return to home
			$this->fbPermissions = $r->fbPermissions;  //Required facebook permissions
			$this->token=$r->token;
			$this->caption_post="Perusahaan Pembuat Website Dynamic";
		}
	}
	
	function initial_twitter($id=''){
		$init=$this->m_fanpage->get_app_properties('twitter',$id);
		foreach($init->result() as $r){
			$this->twt_appId = $r->appId; //Facebook App ID
			$this->twt_appSecret = $r->appSecret; // Facebook App Secret
			$this->twt_token = $r->token;  //return url (url to script)
			$this->twt_token_secret = $r->token_secret;  //return to token secret
		}
	}
	
	function get_session(){
		$this->load->library('session');
		$user=$this->session->userdata('user_account');
		if ($user == ""){
			redirect('login');
		}
		$this->userdata=$user;
	}
	 
	function index(){
		$this->initials();
		$this->facebook();
	}
	
	function load_header($data){
		$this->load->view('header',$data);
	}
	
	function insert_activity($param){
		$user=$this->userdata;
		$text=$param['message'];
		$type=$param['type'];
		$this->m_fanpage->insert_new_activity($user,$text,$type);
	}
	
	function facebook(){
		$data['title']="Facebook";
		$data['active']="f";
		$data['posting']=$this->m_fanpage->get_all_facebook_posting();
		$this->load_header($data);
		$this->load->view('view_posting',$data);
	}
	
	function twitter(){
		$data['title']="Twitter";
		$data['active']="t";
		$data['posting']=$this->m_fanpage->get_all_twitter_posting();
		$this->load_header($data);
		$this->load->view('view_posting',$data);
	}
	
	function googlep(){
		$data['title']="Google Plus";
		$data['active']="g";
		$data['posting']=$this->m_fanpage->get_all_googleP_posting();
		$this->load_header($data);
		$this->load->view('view_posting',$data);
	}
	
	# EDITING DATAS #
	
	function edit($type,$id){
	 if ($_FILES){
	 	$date=$this->post('date_post');
		 	$dt=new DateTime($date);
		 	$date=date_format($dt,'Y-m-d');
		 $pageid=$this->post('page_id');
		 $text=$this->post('messages');
		 $url=$this->post('url');
		 //echo var_dump($_POST);
		 $filename=$this->post('image');
		 if ($filename == ""){$filename=date('sgid');}
		 $file=str_replace(array('.','jpg','png','gif','bmp'),'',$filename);
		 if($date != ""){
		  if ($_FILES["userfile"]["name"] != ""){
			 $path=get_image_post('','basedir');
			 $config=$this->initialing_upload_files($path,'jpg|png|gif|bmp','500','1200','750',$file,'TRUE');
			 $filename=$this->uploading_file($config);
		  }
		 	 #SAVE TO DB #
		 	 if($text !== ''){
		 	 	if ($type== "facebook"){
			 	   $this->m_fanpage->update_fb_post($id,$date,$pageid,$text,$url,$filename);
				 }elseif($type== "googlep"){
				 }else{
					$this->m_fanpage->update_twitter_post($id,$date,$pageid,$text,$url,$filename);
				 }
				 $param=array('message'=>'mengubah record dengan ID='.$id,'type'=>$type);
				 $this->insert_activity($param);
		 	   redirect(get_url($type));
		 	 }
		 }
	 }
	 # IF NOT POST 
	 if ($type== "facebook"){
	 	$active="f";
	 	$edit_post=$this->m_fanpage->select_fbpost_forEdit($id);
	 }elseif($type== "googlep"){
	 	$active="g";
	 	$edit_post=$this->m_fanpage->select_gppost_forEdit($id);
	 }else{
	 	$active="t";
	 	$edit_post=$this->m_fanpage->select_twtpost_forEdit($id);
	 }
	 
	 $this->load->helper('form');
	 $data['title']="Edit $type";
	 $data['active']=$active;
	 $data['edit_post']=$edit_post;
	 $this->load_header($data);
	 $this->load->view('edit_post',$data);
	}
	
	function delete($type,$id){
		$image=$this->m_fanpage->get_image_from_post($type,$id);
		$this->m_fanpage->delete_posting($type,$id);
		if (file_exists(get_image_post($image,"basedir"))){
			unlink(get_image_post($image,"basedir"));
		}
		if ($type== "t"){
			$uri="twitter";
	  	}elseif($type== "f"){
	  		$uri="facebook";
	  	}else{
	  	}
	  	redirect(get_url($uri));
	}
	
	# FUNCTION FOR UPDATE TO WALL #
	function post_to_fb_fanpage(){
		$q=$this->m_fanpage->get_facebook_posting();
		foreach($q->result() as $res){
			$ID=$res->ID_post;
			$fbuser=$res->UID;
			$page=$res->page_id;
			$message=$res->messages;
			$url=$res->url;
			$image=get_image_post($res->image);
			$this->send_message_to_fb($ID,$fbuser,$page,$message,$url,$image);
		}
	}
	
	function post_to_twt_fanpage(){
		$q=$this->m_fanpage->get_twitter_posting();
		foreach($q->result() as $res){
			$ID=$res->ID_post;
			$page_id=$res->page_id;
				# SETTING APP #
				$this->initial_twitter($page_id);
			$message=$res->messages;
			$url=$res->url;
			$image=$res->image;
			$this->send_message_to_twitter($ID,$message,$url,$image);
		}
	}
	
	# INSERT NEW FACEBOOK #
	function insert_new_facebook(){
		$data['title']="Insert New Facebook";
		$data['active']="f";
		if($_FILES){
		 $date=$this->post('date_post');
		 	$dt=new DateTime($date);
		 	$date=date_format($dt,'Y-m-d');
		 $pageid=$this->post('page_id');
		 $text=$this->post('messages');
		 $url=$this->post('url');
		 if($date != ""){
			 $path=get_image_post('','basedir');
			 $config=$this->initialing_upload_files($path,'jpg|png|gif|bmp','500','1200','750',date('sgid'));
			 $filename=$this->uploading_file($config);
		 	 #SAVE TO DB #
		 	 if ($text !==""){
		 	 	$this->m_fanpage->insert_new_fb_post($date,$pageid,$text,$url,$filename);
			 }
			 $param=array('message'=>'menambah record baru dengan tgl post='.$date,'type'=>"facebook");
			 $this->insert_activity($param);
			 redirect(get_url('facebook'));	
		 }
		}
		$this->load->helper('form');
		$this->load_header($data);
		$this->load->view('new_post',$data);
	}
	
	function insert_new_twitter(){
		$data['title']="Insert New Twitter";
		$data['active']="t";
		if($_FILES){
		 $date=$this->post('date_post');
		 	$dt=new DateTime($date);
		 	$date=date_format($dt,'Y-m-d');
		 $pageid=$this->post('page_id');
		 $text=$this->post('messages');
		 $url=$this->post('url');
		 $filename='';
		 $file=$_FILES["userfile"]["name"];
		 if($date != "" and $file != ''){
			 $path=get_image_post('','basedir');
			 $config=$this->initialing_upload_files($path,'jpg|png|gif|bmp','500','1200','750',date('sgid'));
			 $filename=$this->uploading_file($config);

		 	 #SAVE TO DB #
		 	 if ($text !==""){
		 	 	$this->m_fanpage->insert_new_twitter_post($date,$pageid,$text,$url,$filename);
			 }
			 $param=array('message'=>'menambah record baru dengan tgl post='.$date,'type'=>"twitter");
			 $this->insert_activity($param);
		 }
			 redirect(get_url('twitter'));	
		}
		$this->load->helper('form');
		$this->load_header($data);
		$this->load->view('new_post',$data);
	}
	
	# CONFIG TO UPLOAD IMAGE #
	
	function initialing_upload_files($path,$types,$size,$width,$height,$filename,$overwrite='FALSE'){
		$config['upload_path'] = $path;
		$config['allowed_types'] = $types;
		$config['max_size']	= $size;
		$config['max_width'] = $width;
		$config['max_height'] = $height;
		$config['file_name']=$filename;
		$config['overwrite']=$overwrite;

		return $config;
	}
	
	function uploading_file($config){
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload()){
			$error = $this->upload->display_errors();
			echo var_dump($error);
			return "";
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			echo var_dump($data);
			return $data['upload_data']['orig_name'];
		}
	}
	
	function log(){
		$user=$this->userdata;
		$data['title']="Log Activity";
		$data['active']="l";
		$data['datas']=$this->m_fanpage->select_log($user);
		$this->load_header($data);
		$this->load->view('log_data_activity',$data);
	}
	
	#######################################################################################################
	# FACEBOOK #
	function send_message_to_fb($ID,$fbuser,$page,$message,$url,$image_source){
		$param=array(
			  'appId'  => $this->appId,
			  'secret' => $this->appSecret
			);
		$this->load->library('facebook/facebook',$param);
		$userPageId 	= $page;
		$userMessage 	= $message;
	
		if(strlen($userMessage) < 1)
		{
			//message is empty
			$userMessage = 'No message was entered!';
		}
	
			//HTTP POST request to PAGE_ID/feed with the publish_stream
			$post_url = '/'.$userPageId.'/feed';
			
			$this->facebook->setFileUploadSupport(true);
			$path=str_replace('http://localhost/','/home/public_html/',$image_source);
			echo $img = realpath($path);
			
			//posts message on page statues 
			$msg_body = array(
			'access_token' => $this->token,
			'message' => $userMessage,
			'image' => $img,
			'link'=>$url,
			'caption' => $this->caption_post,
			);
	
		if ($fbuser) {
		  try {
				$postResult = $this->facebook->api($post_url, 'post', $msg_body );
				//$this->m_fanpage->update_facebook_posting_status($ID);
			} catch (FacebookApiException $e) {
				echo $e->getMessage();
		  }
		}
	}
	
	# TWITTER #
	function send_message_to_twitter($ID,$message,$url,$image){
		$this->load->library('twitter/twitterpost');
		# INIT #
		$appid=$this->twt_appId;
		$appsc=$this->twt_appSecret;
		$token=$this->twt_token;
		$token_sc=$this->twt_token_secret;
		
		 if ($appid != null and $message != ""){
			 try {
			  if ($image != ""){
				$do=$this->twitterpost->post_message_with_image($appid,$appsc,$token,$token_sc,$message,get_image_post($image));
			  }else{
			  	$do=$this->twitterpost->post_message($appid,$appsc,$token,$token_sc,$message);
			  }
			  if ($do == 1){
			  	//$this->m->update_state_post($r->id);
			  }
//			   redirect("fanpage/");
			 }catch (Exception $e){
			 	echo $e->getMessage();
			 }
		 }
	}
	
	
}
//end of file
