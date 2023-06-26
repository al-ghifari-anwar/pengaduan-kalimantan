<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_home');
		$this->load->model('m_pengaduan');
		$this->load->helper('format_indo');
		if ($this->session->userdata('userdata_desa') == null) {
			redirect('login');
		}
	}

	public function index()
	{
		$user = $this->session->userdata('userdata_desa');

		if ($user['akses'] == 'admin' || $user['akses'] == 'petugas' || $user['akses'] == 'kepala') {
			redirect('home/dashboard_admin');
		} else if ($user['akses'] == 'user') {
			redirect('home/dashboard');
		}
	}

	public function dashboard_admin()
	{
		$data['judul'] 	= 'Sistem Informasi Pengaduan Masyarakat';
		$data['aktif'] 	= 'home';
		$data['count_all'] = $this->m_pengaduan->countpengaduan()->row();
		$data['verif'] = $this->m_pengaduan->countpengaduan("where pengaduan.status='0' ")->row();
		$data['not_verif'] = $this->m_pengaduan->countpengaduan("where pengaduan.status='1' ")->row();
		$data['tindak_lanjut'] = $this->m_pengaduan->countpengaduan("where pengaduan.status='2' ")->row();
		$data['not_verif'] = $this->m_pengaduan->countpengaduan("where pengaduan.status='1' ")->row();
		$data['total'] = $this->m_pengaduan->countpengaduan("where pengaduan.status <> '0' ")->row();

		$this->load->view('home/index', $data);
	}

	public function dashboard()
	{
		$user = $this->session->userdata('userdata_desa');
		$data['judul'] 	= 'Sistem Informasi Pengaduan Masyarakat';
		$data['aktif'] 	= 'home';
		$data['count_all'] = $this->m_pengaduan->countpengaduan('where penduduk.id_user="' . $user['id_user'] . '" ')->row();
		$data['verif'] = $this->m_pengaduan->countpengaduan('where pengaduan.status="0" and penduduk.id_user="' . $user['id_user'] . '" ')->row();
		$data['not_verif'] = $this->m_pengaduan->countpengaduan('where pengaduan.status="1" and penduduk.id_user="' . $user['id_user'] . '" ')->row();
		$data['tindak_lanjut'] = $this->m_pengaduan->countpengaduan('where pengaduan.status="2" and penduduk.id_user="' . $user['id_user'] . '""" ')->row();
		$this->load->view('home/index', $data);
	}

	public function grafik()
	{
		if (!$this->input->post('month')) {
			$month = date('m');
		} else {
			$month = $this->input->post('month');
		}
		// echo $month;
		// die;
		$data['month'] = $month;
		$data['judul'] 	= 'Sistem Informasi Pengaduan Masyarakat';
		$data['aktif'] 	= 'grafik';
		$data['count_all'] = $this->m_pengaduan->countpengaduan()->row();
		$data['verif'] = $this->m_pengaduan->countpengaduan("where status='0' and MONTH(tanggal)='$month' ")->row();
		$data['not_verif'] = $this->m_pengaduan->countpengaduan("where status='1' and MONTH(tanggal)='$month' ")->row();
		$data['tindak_lanjut'] = $this->m_pengaduan->countpengaduan("where status='2' and MONTH(tanggal)='$month' ")->row();
		$data['grafik_pengaduan'] = 'GRAFIK BERDASARKAN PENGADUAN';
		$data['grafik_kategori'] = 'GRAFIK BERDASARKAN KATEGORI';
		$data['penyaranan'] = $this->m_pengaduan->countkategori("where kategori.nama_kategori='Penyaranan' and MONTH(pengaduan.tanggal)='$month' ")->row();
		$data['perusakan'] = $this->m_pengaduan->countkategori("where kategori.nama_kategori='Perusakan' and MONTH(pengaduan.tanggal)='$month' ")->row();
		$data['pencemaran'] = $this->m_pengaduan->countkategori("where kategori.nama_kategori='Pencemaran' and MONTH(pengaduan.tanggal)='$month' ")->row();
		$data['pelayanan'] = $this->m_pengaduan->countkategori("where kategori.nama_kategori='Pelayanan' and MONTH(pengaduan.tanggal)='$month' ")->row();
		$data['pelayanan'] = $this->m_pengaduan->countkategori("where kategori.nama_kategori='Pelayanan' and MONTH(pengaduan.tanggal)='$month' ")->row();
		$data['pengaduan_kat'] = $this->m_pengaduan->countkategori("where kategori.nama_kategori='Pengaduan' and MONTH(pengaduan.tanggal)='$month' ")->row();
		// echo json_encode($data);
		// die;
		$this->load->view('home/index_grafik', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
