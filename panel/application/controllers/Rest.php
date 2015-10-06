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
		
		$me  = function_exists('imagecreate');
		var_dump($me);
		$this->load->view('upload_test');
	}
	
	public function images($id = 0 , $percent = 0 )
	{
		if(!is_numeric($id) && $user === 0  )
		{
			return;
		}
		
		header("Content-type: image/jpg");
		header('Content-Encoding: gzip');
		
		
		$this->load->model('Images', 'image');
		
		if(isset($percent) && is_numeric($percent) &&  $percent > 0 && $percent < 100 )
		{
			$image = gzdecode($this->image->get($id));
			print gzencode($this->image->createMiniPic($image,$percent / 100));
		}
		else
		{
			print $this->image->get($id);
		}
		
	}
	
	
	public function __destruct()
	{
		$this->db->close();
		parent::__destruct();
	}
	
	
	
	
}

