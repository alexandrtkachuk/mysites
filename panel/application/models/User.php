<?php

class User extends CI_Model 
{	
		public $name;
		public $id;

        public function __construct()
        {
                parent::__construct();
        }
		
		public function login($result, $realm)
		{
			if(empty($result)) 
			{
				return;
			}
			$data = $this->http_digest_parse($result); //parse data Digest
			
			//var_dump($data);
			
			$this->db->select('id, name, pass');
			$this->db->from('panelUsers');
			$this->db->where('name', $data['username']);
			$this->db->limit(1); 
			$query = $this->db->get();
			
			if($query->num_rows() < 1)
			{
				return false;
			}
			
			$res  = $query->result()[0];
			$pass = $res->pass;
			// генерируем корректный ответ
			//$A1 = md5($data['username'] . ':' . $realm . ':' . 'test');
			
			$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
			$valid_response = md5($pass.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);
			
			
			
			if ($data['response'] != $valid_response)
			{
				return false;
			}
			
			$this->id = $res->id;
			$this->name = $res->name;
			
			return true;
		}
		
		
		// функция разбора заголовка http auth
		private function http_digest_parse($txt)
		{
			// защита от отсутствующих данных
			$needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
			$data = array();
			$keys = implode('|', array_keys($needed_parts));

			preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

			foreach ($matches as $m) {
				$data[$m[1]] = $m[3] ? $m[3] : $m[4];
				unset($needed_parts[$m[1]]);
			}

			return $needed_parts ? false : $data;
		}
		
		public function getInfo($id = 0)
		{
			if($id === 0 )
			{
				$id = $this->id;
			}
			$this->db->select('var, info');
			$this->db->from('panelUsers2Info');
			$this->db->where('idUser', $id);
			$query = $this->db->get();
			
			return $query->result();
		}
		
		public function addInfo($var,$info)
		{
			if(!isset($var) || !isset($info))
			{
				return false;
			}
			
			$this->db->select();
			$this->db->from('panelUsers2Info');
			$this->db->where('var', $var);
			$this->db->where('idUser', $this->id);
			$this->db->limit(1); 
			$query = $this->db->get();
			
			if($query->num_rows() > 0)
			{
				return false;
			}
			
			$data = array(
					'idUser' => $this->id,
					'var' => $var,
					'info' => $info
			);
						
			$this->db->insert('panelUsers2Info', $data);
			
			return true;
		}
}