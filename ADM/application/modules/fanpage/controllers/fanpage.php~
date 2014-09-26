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
	
	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html','fanpage'));
		$this->load->model('m_fanpage');
		$this->initials();
	 }
	 
	function post($post){
	 return $this->input->post($post);
	}
	 
	function get($get){
	 return $this->input->get($get);
	}
	 
	function initials(){
	 	$this->initial_fb();
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
	
	function initial_twitter(){
		$init=$this->m_fanpage->get_app_properties('twitter');
		foreach($init->result() as $r){
			$this->appId = $r->appId; //Facebook App ID
			$this->appSecret = $r->appSecret; // Facebook App Secret
			$this->token = $r->token;  //return url (url to script)
			$this->token_secret = $r->token_secret;  //return to token secret
		}
	}
	 
	function index(){
		$this->facebook();
	}
	
	function load_header($data){
		$this->load->view('header',$data);
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
		 
		 $file=str_replace(array('.','jpg','png','gif','bmp'),'',$filename);
		 if($date != ""){
		  if ($_FILES["userfile"]["name"] != ""){
			 $path=get_image_post('','basedir');
			 $config=$this->initialing_upload_files($path,'jpg|png|gif|bmp','500','1200','750',$file,'TRUE');
			 $filename=$this->uploading_file($config);
		  }
		 	 
		 	 #SAVE TO DB #
		 	 $this->m_fanpage->update_fb_post($id,$date,$pageid,$text,$url,$filename);
		 }
		 exit();	 
	 }
	 # IF NOT POST 
	 if ($type== "facebook"){
	 	$edit_post=$this->m_fanpage->select_fbpost_forEdit($id);
	 }elseif($type== "googlep"){
	 	$edit_post=$this->m_fanpage->select_gppost_forEdit($id);
	 }else{
	 	$edit_post=$this->m_fanpage->select_twtpost_forEdit($id);
	 }
	 $this->load->helper('form');
	 $data['title']="Edit $type";
	 $data['active']="f";
	 $data['edit_post']=$edit_post;
	 $this->load_header($data);
	 $this->load->view('edit_post',$data);
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
			 echo $filename=$this->uploading_file($config);
		 	 #SAVE TO DB #
		 	 
		 	 $this->m_fanpage->insert_new_fb_post($date,$pageid,$text,$url,$filename);
		 }
		 exit();
		}
		$this->load->helper('form');
		$this->load_header($data);
		$this->load->view('new_post',$data);
	}
	
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
	
	#######################################################################################################
	
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
	
}
//end of file
