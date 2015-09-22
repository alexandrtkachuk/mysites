<?php

class Page extends CI_Model
{
	public function add($idUser, $name, $body, $active = false)
	{
		$this->db->set('idUser', $idUser);
		$this->db->set('name', $name);
		$this->db->set('body', $body);
		$this->db->set('createTime', 'NOW()', false);
		$this->db->set('modTime', 'NOW()', false);
		$this->db->set('active', $active);
		$this->db->insert('panelPosts');
	}
	
	public function get($idUser, $id = 0)
	{
		$this->db->select('id, name, active, createTime, modTime');
		$this->db->from('panelPosts');
		if($id !==0)
		{
			$this->db->select('body');
			$this->db->where('id', $id);
			$this->db->limit(1); 
		}
		$this->db->where('idUser', $idUser);
		$query = $this->db->get();
			
		return $query->result();
	}
	
	public function edit($idUser, $id , $name, $body, $active )
	{
		$this->db->set('name', $name);
		$this->db->set('body', $body);
		$this->db->set('active', $active);
		$this->db->set('modTime', 'NOW()', false);
		$this->db->where('idUser', $idUser);
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->update('panelPosts');
	}
	
	public function del($idUser, $id)
	{
		$this->db->where('idUser', $idUser);
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('panelPosts');
	}
	
}