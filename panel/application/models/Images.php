<?php

class Images extends CI_Model
{
	
	public function set($body, $idUser, $title, $info)
	{
		$this->db->set('info', $info);
		$this->db->set('title', $title);
		$this->db->set('idUser', $idUser);
		$this->db->set('body', $body);
		$this->db->insert('panelFiles');
		
	}
	
	public function get($id)
	{
		$this->db->select('body');
		$this->db->from('panelFiles');
		$this->db->where('id', $id);
		$this->db->limit(1); 
		$query = $this->db->get();
		return $query->row()->body;
	}
	
	public function get4user($idUser)
	{
		$this->db->select('id');
		$this->db->select('title');
		$this->db->select('info');
		$this->db->from('panelFiles');
		$this->db->where('idUser', $idUser); 
		$query = $this->db->get();
		return $query->result();
	}
	
	public function createMiniPic($picString , $percent = 0.5)
	{
		$source = imagecreatefromstring($picString);
		$width  = ImageSX($source);
		$height = ImageSY($source);
		
		$newwidth = $width * $percent;
		$newheight = $height * $percent;
		
		$thumbnail = ImageCreateTrueColor(
			$newwidth,
			$newheight);
		
		imagecopyresized($thumbnail, $source, 0, 0, 0, 0, 
			$newwidth, $newheight, $width,  $height);
		
		ImageDestroy($source);
		
		ob_start();
		imagejpeg($thumbnail);
		$imageString = ob_get_clean();
		
		ImageDestroy($thumbnail);
		
		return $imageString;
	}
	
	public function del($idUser, $id)
	{
		$this->db->where('idUser', $idUser);
		$this->db->where('id', $id);
		$this->db->limit(1);
		$this->db->delete('panelFiles');
	}
}