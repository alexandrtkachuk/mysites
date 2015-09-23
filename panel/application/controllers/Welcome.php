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
	
	protected $access;
	
	public function __construct()
	{
			parent::__construct();
			
			$this->access = false;
			
			$this->load->database();
			$this->load->model('User', 'user');
			
	}
	
	public function index()
	{
		if(!$this->isLogin()) 
		{
			return false;
		}
		$data['title'] = 'home';
		$this->view('welcome_message',$data);

	}
	
	//enter page
	private function enter()
	{
		$this->load->view('header');
		$this->load->view('enter_page');
		$this->load->view('footer');
	}
	
	public function logout()
	{
		header('HTTP/1.1 401 Unauthorized');
		$this->load->view('logout_page');
		return true;
	}
	
	private function login()
	{
		$realm = $this->config->item('realm');
		
		$data = $this->input->server('PHP_AUTH_DIGEST');
		
		if (empty($data) || !$this->user->login($data,$realm)) 
		{
			header('HTTP/1.1 401 Unauthorized');
			header('WWW-Authenticate: Digest realm="'.$realm.
			   '",qop="auth",nonce="'.uniqid().'",opaque="'.md5($realm).'"');
			
			return false;
		}
		
		if( $this->user->login($data,$realm))
		{
			return true;
		}
		
		return false;
	}
	
	
	protected function isLogin()
	{
		if(isset($this->user->id) && $this->user->id > 0)
		{
			return true;
		}
		
		if(!$this->login())
		{
			$this->enter();
		}
		else
		{
			return true;
		}	
		
		return false;
	}
	
	protected function view($page, $data)
	{
		$this->load->view('header',$data);
		$this->load->view('menu');
		$this->load->view($page);
		$this->load->view('footer');
	}
	
	public function info()
	{
		if(!$this->isLogin()) 
		{
			return false;
		}
		
		
		
		//var_dump($_POST);
		$data['error'] = 0; //
		
		if($this->input->post('add') === 'add')
		{
		
			if(!$this->user->addInfo(
					$this->input->post('var'),$this->input->post('info') ))
			{
				$data['error'] = 2;
			}
			else
			{
				$data['error'] = 1;
			}
		}
		elseif ($this->input->post('edit') == 1)
		{
			$this->user->updateInfo($this->input->post('oldVar'),
					$this->input->post('var'), 
					$this->input->post('info'));
		}
		elseif ($this->input->post('del') == 1)
		{
			$this->user->delInfo($this->input->post('oldVar'));
		}
		
		
		$data['title'] = 'info';
		
		$data['info'] = $this->user->getInfo();
		$this->view('info_page',$data);
	}
	
	//list pages
	public function pages()
	{
		if(!$this->isLogin()) 
		{
			return false;
		}
		
		$this->load->model('Page', 'pages');
		$data['title'] = 'Pages';
		//print $this->user->id;
		//$this->pages->add($this->user->id,'name', 'bodyyyyyyyyy');
		//$this->pages->edit($this->user->id,4,'nameNew', 'bodyyyyyyyyy',true);
		//$this->pages->del($this->user->id, 1);
		
		$data['pages'] = $this->pages->get($this->user->id);
		$this->view('pages_page',$data);
	}
	
	public function editPage()
	{
		if(!$this->isLogin())
		{
			return false;
		}
		
		$this->load->model('Page', 'pages');
		
		if($this->input->post('edit') == 1)
		{
			$data['page'] = $this->pages->get(
					$this->user->id ,
					 $this->input->post('id'));
		}
		elseif ($this->input->post('edit') == 1)
		{
			$this->pages->del($this->user->id, 
					$this->input->post('id'));
			$this->pages();
			return true;
		}
		
		$data['title'] = 'add page';
		
		$this->view('pages_edit_page',$data);
	}
	
	
}
