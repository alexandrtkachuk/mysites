<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	

	
	public function __construct()
	{
			parent::__construct();
			
			$this->load->database();
			$this->load->model('User', 'user');
	}
	
	public function index()
	{
		
		
		$this->load->view('welcome_message');
	}
	
	
	public function logout()
	{
		header('HTTP/1.1 401 Unauthorized');
		return true;
	}
	
	public function login()
	{
		
		
		$realm = $this->config->item('realm');
		
		//unset($_SERVER['PHP_AUTH_DIGEST']);
		$data = $this->input->server('PHP_AUTH_DIGEST');
		
		if (empty($data)) 
		{
			header('HTTP/1.1 401 Unauthorized');
			header('WWW-Authenticate: Digest realm="'.$realm.
			   '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');
			
			
			
			return false;
			die('Текст, отправляемый в том случае, если пользователь нажал кнопку Cancel');
		}
		
		if( $this->user->login($data,$realm))
		{
			echo 'good';
		}
		else
		{
				echo 'err';
		}
		
	}
	
		
}
