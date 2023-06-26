<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_penduduk extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_all($where = '')
	{
		return $this->db->query("SELECT * FROM penduduk LEFT JOIN agama ON penduduk.id_agama = agama.id_agama $where;");	
	}

	public function get_nik($nik)
	{
		$q = $this->db->query("SELECT DISTINCT penduduk.id_user,penduduk.nik,penduduk.nama,penduduk.tempat_lahir,penduduk.tanggal_lahir,penduduk.jk,penduduk.id_agama,penduduk.alamat,penduduk.nohp,penduduk.pict,agama.nama_agama FROM penduduk
			LEFT JOIN agama ON penduduk.id_agama = agama.id_agama
			WHERE penduduk.id_agama = agama.id_agama
			AND penduduk.nik = '$nik'
		");	
		return $q;
	}

	public function edit($id_user)
	{
		$data = array(
			'nik' 			=> $this->input->post('nik'),
			'nama' 			=> $this->input->post('nama'),
			'tempat_lahir' 	=> $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'jk' 			=> $this->input->post('jk'),
			'id_agama' 		=> $this->input->post('id_agama'),
		);

		$this->db->where('id_user', $id_user);
		$this->db->update('penduduk', $data);
	}

}

/* End of file M_penduduk.php */
/* Location: ./application/models/M_penduduk.php */ 