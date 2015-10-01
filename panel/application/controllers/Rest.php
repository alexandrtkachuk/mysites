<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rest extends CI_Controller {
	
	public function __construct()
	{
			parent::__construct();
			
			$this->load->database();
			
	}
	
	public function index()
	{
		
	}
	
	public function page($user = 0 ,$num = 0)
	{
		$data = array();
		
		$this->load->model('Page', 'pages');
		
		if(is_numeric($user) && is_numeric($num))
		{
			$data['pages'] = $this->pages->get($user,$num);
		}
		
		$this->load->view('rest_page', $data);
		//print $user; 	
	}
	
}

