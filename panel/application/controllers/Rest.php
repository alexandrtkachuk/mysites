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
		
		if(is_numeric($user) && is_numeric($num) && $user > 0  && $num > 0)
		{
			$data['pages'] = $this->pages->get($user,$num);
		}
		
		$this->load->view('rest_page', $data);
		//print $user; 	
	}
	
	public function info($user = 0)
	{
		$data = array();
		
		if(is_numeric($user) && $user > 0  )
		{
			$this->load->model('User', 'user');
			
			$data['info'] = $this->user->getInfo($user);
		}
		
		$this->load->view('rest_page', $data);
	}
	
	
	public function upload()
	{
		if(isset($_FILES['userfile']['tmp_name'] )===true)
		{
			$f=fopen($_FILES['userfile']['tmp_name'],"rb");
			$upload=fread($f,filesize($_FILES['userfile']['tmp_name'])); // считали файл в переменную
			fclose($f); // закрыли файл, можно опустить
			
			$rez = gzencode($upload, 6);
			
			unset($upload);
			
			$this->db->set('body', $rez);
			$this->db->insert('panelFiles');
		}
		
		$this->load->view('upload_test');
	}
	
	public function images($id = 0)
	{
		if(!is_numeric($id) && $user === 0  )
		{
			return;
		}
		
		$this->db->select('body');
		$this->db->from('panelFiles');
		$this->db->where('id', $id);
		$this->db->limit(1); 
		$query = $this->db->get();
		header('Content-Encoding: gzip');
		header("Content-type: image/jpg");
		print $query->row()->body;
		//var_dump($query->row()->body);
	}
}

