<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_global extends CI_Model 
{
	public function InsertData($table_name,$data)
	{
		return $this->db->insert($table_name,$data);
	}

	public function UpdateData($table_name,$data,$where)
	{
		$this->db->update($table_name,$data,$where);
	}

	public function DeleteData($table_name,$where)
	{
		$this->db->delete($table_name,$where);
	}
}

