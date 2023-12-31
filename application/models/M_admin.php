<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_admin extends CI_Model
{

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all()
	{
		return $this->db->get('admin');
	}

	public function get_id($id_admin)
	{
		$this->db->where('id_admin', $id_admin);
		return $this->db->get('admin');
	}

	public function tambah()
	{
		$data = array(
			'nama_admin' => $this->input->post('nama_admin'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'jk' => $this->input->post('jk'),
			'nohp' => $this->input->post('nohp'),
			'alamat' => $this->input->post('alamat'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'level_admin' => $this->input->post('level_admin'),
			'divisi' => $this->input->post('divisi')
		);
		$this->db->insert('admin', $data);
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */
