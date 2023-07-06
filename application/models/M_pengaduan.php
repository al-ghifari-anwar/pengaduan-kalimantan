<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pengaduan extends CI_Model
{

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}

	public function countpengaduan($where = '')
	{
		return $this->db->query("SELECT penduduk.id_user,pengaduan.tanggal,pengaduan.status, COUNT(pengaduan.id_pengaduan) as pengaduan FROM pengaduan 
		LEFT JOIN penduduk ON pengaduan.nik=penduduk.nik
		$where;");
	}

	public function counttindakan($where = '')
	{
		return $this->db->query("SELECT tindakan.tanggal, COUNT(tindakan.id_tindakan) as tindakan FROM tindakan $where;");
	}

	public function countkategori($where = '')
	{
		$q = $this->db->query("SELECT DISTINCT pengaduan.tanggal,kategori.nama_kategori, count(pengaduan.id_pengaduan) as kategori FROM pengaduan 
			LEFT JOIN kategori ON pengaduan.id_kategori=kategori.id_kategori
		$where;");
		return $q;
	}

	public function get_all($where = '')
	{
		$q = $this->db->query("SELECT DISTINCT penduduk.id_user,penduduk.nama,pengaduan.id_pengaduan,pengaduan.nik,pengaduan.nama_laporan,pengaduan.tanggal,pengaduan.tempat,pengaduan.status,kategori.id_kategori,kategori.nama_kategori, pengaduan.lat, pengaduan.long FROM pengaduan 
			LEFT JOIN penduduk ON pengaduan.nik=penduduk.nik
			LEFT JOIN kategori ON pengaduan.id_kategori=kategori.id_kategori
		$where;");
		return $q;
	}

	public function get_nik($nik)
	{
		$q = $this->db->query("SELECT DISTINCT penduduk.nama,pengaduan.id_pengaduan,pengaduan.nama_laporan,pengaduan.tanggal,pengaduan.tempat,pengaduan.status,pengaduan.pict,pengaduan.status,kategori.id_kategori,kategori.nama_kategori FROM pengaduan 
			LEFT JOIN penduduk ON pengaduan.nik=penduduk.nik
			LEFT JOIN kategori ON pengaduan.id_kategori=kategori.id_kategori
			WHERE penduduk.nik = pengaduan.nik AND penduduk.nik = '$nik'
		");
		return $q;
	}

	public function get_id($where = '')
	{
		$q = $this->db->query("SELECT DISTINCT admin.nama_admin,pengaduan.id_pengaduan,pengaduan.nama_laporan,pengaduan.tanggal,pengaduan.tempat,pengaduan.status,pengaduan.pict,pengaduan.status,pengaduan.id_kategori,admin.id_admin,kategori.id_kategori,penduduk.nik,pengaduan.id_admin FROM pengaduan
			LEFT JOIN kategori ON pengaduan.id_kategori=kategori.id_kategori
			LEFT JOIN penduduk ON pengaduan.nik=penduduk.nik
			LEFT JOIN admin ON pengaduan.id_admin=admin.id_admin
			$where;");
		return $q;
	}

	public function gettindakan($where = '')
	{
		$user = $this->session->userdata('userdata_desa');
		if ($user['level'] == 'admin' || $user['level'] == 'kepala') {
			$q = $this->db->query("SELECT DISTINCT tindakan.id_tindakan,tindakan.tanggal,pengaduan.nama_laporan,tindakan.bentuk_tindakan,tindakan.tim_eksekutor,tindakan.hasil,tindakan.penjadwalan, tindakan.bukti, nama_eksekutor, tindakan.lat, tindakan.long FROM tindakan LEFT JOIN pengaduan ON tindakan.id_pengaduan=pengaduan.id_pengaduan LEFT JOIN eksekutor ON tindakan.tim_eksekutor = eksekutor.id_eksekutor $where;");
		} else {
			$eksekutor = $user['eksekutor'];
			$q = $this->db->query("SELECT DISTINCT tindakan.id_tindakan,tindakan.tanggal,pengaduan.nama_laporan,tindakan.bentuk_tindakan,tindakan.tim_eksekutor,tindakan.hasil,tindakan.penjadwalan, tindakan.bukti, nama_eksekutor, tindakan.lat, tindakan.long FROM tindakan LEFT JOIN pengaduan ON tindakan.id_pengaduan=pengaduan.id_pengaduan LEFT JOIN eksekutor ON tindakan.tim_eksekutor = eksekutor.id_eksekutor WHERE tindakan.tim_eksekutor = '$eksekutor';");
		}
		return $q;
	}

	public function tambah($file)
	{
		$user 		= $this->session->userdata('userdata_desa');
		$nik 		= $user['nik'];
		$id_user 		= $user['id_user'];
		$nama_laporan 	= $this->input->post('nama_laporan');
		$kategori 	= $this->input->post('kategori');
		$tempat 	= $this->input->post('tempat');
		$status 	= 1;

		$data = array(
			'nik'    	=> $nik,
			'tanggal'   => date('Y-m-d'),
			'nama_laporan'	=> $nama_laporan,
			'id_kategori'	=> $kategori,
			'id_user'	=> $id_user,
			'pict'		=> $file,
			'tempat'	=> $tempat,
			'status' 	=> $status
		);
		$this->db->insert('pengaduan', $data);
	}

	public function edit_proses($id_pengaduan, $file)
	{
		$nama_laporan 	= $this->input->post('nama_laporan');
		$id_kategori 	= $this->input->post('id_kategori');
		$tempat 	= $this->input->post('tempat');
		$data = array(
			'nama_laporan' => $nama_laporan,
			'id_kategori' => $id_kategori,
			'tempat' => $tempat,
			'pict' => $file
		);

		$this->db->where('id_pengaduan', $id_pengaduan);
		$this->db->update('pengaduan', $data);
	}
}

/* End of file M_pengaduan.php */
/* Location: ./application/models/M_pengaduan.php */
