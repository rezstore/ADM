<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contact extends CI_Controller {

	function __construct()
	 {
		parent::__construct();
		$this->load->helper(array('url','html'));
		$this->load->model('m_contacts');
	 }
	
	function index()
	{
	  $data['q']=$this->m_contacts->select();
	  $this->load->view('view_contacts',$data);
	  
	
	}

	
}
//end of file
