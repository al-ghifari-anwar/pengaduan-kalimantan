<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pengaduan');
        $this->load->model('m_global');
        $this->load->helper('format_indo');
        $this->load->library('pdf');
        $this->load->library('PDF_Diag');
        $user = $this->session->userdata('userdata_desa');

        if ($this->session->userdata('userdata_desa') == null) {
            redirect('login');
        }
    }

    public function pengaduan()
    {
        $data['judul']         = 'Pengaduan Masyarakat >> Laporan Pengaduan';
        $data['aktif']         = 'laporanpengaduan';
        $this->load->view('laporan/index_pengaduan', $data);
    }

    public function laporanpengaduan()
    {
        $user = $this->session->userdata('userdata_desa');
        $tgl = date('Y-m-d');
        $year = date('Y');
        $bulan = $this->input->post('bulan');
        if ($user['akses'] == 'admin') {
            $akses = 'ADMIN';
            $nama = $user['nama_admin'];
            $username = $user['username'];
            $data = array(
                'title' => '',
                'tgl' => tgl_indo($tgl),
                'year' => $year,
                'akses' => $akses,
                'nama' => $nama,
                'username' => $username,
                'bulan' => bulan_panjang($bulan),
                'judul' => 'LAPORAN PENGADUAN',
                'pemerintah' => 'PEMERINTAH KOTA BANJARMASIN',
                'kantor' => 'DINAS LINGKUNGAN HIDUP',
                'alamat' => 'Jalan R.E. Martadinata No. 1 Gedung Blok D Lt.2 Banjarmasin 70111',
                'telp_fax' => 'Telepon. (0511) 3363792-4368145-3363811, Faksimile. (0511) 3363811',
                'email' => 'dlh.banjarmasin@gmail.com',
                'pengaduan' => $this->m_pengaduan->get_all("where penduduk.nik = pengaduan.nik AND kategori.id_kategori=pengaduan.id_kategori AND MONTH(pengaduan.tanggal)='$bulan' ")->result_array(),
            );
            $this->pdf->setPaper('A4', 'Portrait');
            $this->pdf->setFileName('LAPORAN PENGADUAN.pdf');
            $this->pdf->loadView('laporan/laporan_pengaduan', $data);
        }
    }

    public function tindakan()
    {
        $data['judul']         = 'Pengaduan Masyarakat >> Laporan Tindakan';
        $data['aktif']         = 'laporantindakan';
        $this->load->view('laporan/index_tindakan', $data);
    }

    public function laporantindakan()
    {
        $user = $this->session->userdata('userdata_desa');
        $tgl = date('Y-m-d');
        $year = date('Y');
        $bulan = $this->input->post('bulan');
        if ($user['akses'] == 'admin') {
            $akses = 'ADMIN';
            $nama = $user['nama_admin'];
            $username = $user['username'];
            $data = array(
                'title' => '',
                'tgl' => tgl_indo($tgl),
                'year' => $year,
                'akses' => $akses,
                'nama' => $nama,
                'username' => $username,
                'bulan' => bulan_panjang($bulan),
                'judul' => 'LAPORAN TINDAK LANJUT',
                'pemerintah' => 'PEMERINTAH KOTA BANJARMASIN',
                'kantor' => 'DINAS LINGKUNGAN HIDUP',
                'alamat' => 'Jalan R.E. Martadinata No. 1 Gedung Blok D Lt.2 Banjarmasin 70111',
                'telp_fax' => 'Telepon. (0511) 3363792-4368145-3363811, Faksimile. (0511) 3363811',
                'email' => 'dlh.banjarmasin@gmail.com',
                'tindak_lanjut' => $this->m_pengaduan->gettindakan("where MONTH(tindakan.tanggal)='$bulan' ")->result_array()
            );
            $this->pdf->setPaper('A4', 'Portrait');
            $this->pdf->setFileName('LAPORAN TINDAK LANJUT.pdf');
            $this->pdf->loadView('laporan/laporan_tindak_lanjut', $data);
        }
    }
}
