<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_master extends CI_Model
{

	public function getagama()
	{
		return $this->db->get('agama');
	}

	public function getkategori()
	{
		return $this->db->get('kategori');
	}
	public function geteksekutor()
	{
		return $this->db->get('eksekutor');
	}
}
