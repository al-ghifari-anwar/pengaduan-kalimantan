<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Surat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pengaduan');
        $this->load->model('m_global');
        $this->load->library('pdf');
        $this->load->helper('format_indo');
        $user = $this->session->userdata('userdata_desa');

        if ($this->session->userdata('userdata_desa') == null) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['judul']         = 'Surat >> Data Surat';
        $data['aktif']         = 'surat';
        $data['surat'] = $this->db->get('surat')->result_array();
        $this->load->view('surat/index', $data);
    }

    public function tambah_proses()
    {
        $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Nomor Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Tujuan Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('objek', 'Objek', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Objek Tidak Boleh Kosong.</div>'));
        if ($this->form_validation->run() == false) {
            redirect('surat');
        } else {
            $data = [
                'nomor_surat' => $this->input->post('nomor_surat'),
                'jenis_surat' => $this->input->post('jenis'),
                'tujuan' => $this->input->post('tujuan'),
                'objek' => $this->input->post('objek'),
                'tanggal_surat' => date('Y-m-d')
            ];
            $this->db->insert('surat', $data);
            $this->session->set_flashdata('sukses_tambah', '1');
            redirect('surat');
        }
    }

    public function edit_proses($id)
    {
        $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Nomor Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Tujuan Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('objek', 'Objek', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Objek Tidak Boleh Kosong.</div>'));
        if ($this->form_validation->run() == false) {
            redirect('surat');
        } else {
            $data = [
                'nomor_surat' => $this->input->post('nomor_surat'),
                'jenis_surat' => $this->input->post('jenis'),
                'tujuan' => $this->input->post('tujuan'),
                'objek' => $this->input->post('objek'),
                'tanggal_surat' => date('Y-m-d')
            ];
            $this->db->update('surat', $data, ['id_surat' => $id]);
            $this->session->set_flashdata('sukses_tambah', '1');
            redirect('surat');
        }
    }

    public function cetak($id)
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
                'surat' => $this->db->get_where('surat', ['id_surat' => $id])->row_array()
            );
            $this->pdf->setPaper('A4', 'Portrait');
            $this->pdf->setFileName('Surat.pdf');
            $this->pdf->loadView('surat/cetak', $data);
        }
    }

    public function hapus($id_surat)
    {
        $this->db->where('id_surat', $id_surat);
        $this->db->delete('surat');

        $this->session->set_flashdata('sukses_tambah', '1');
        redirect('surat');
    }

    public function konfirmasi($id_surat)
    {
        $this->db->where('id_surat', $id_surat);
        $this->db->update('surat', ['status_surat' => 1]);

        $this->session->set_flashdata('sukses_hapus', '1');
        redirect('surat');
    }

    public function laporansurat()
    {
        $user = $this->session->userdata('userdata_desa');
        $tgl = date('Y-m-d');
        if ($user['akses'] == 'admin') {
            $akses = 'ADMIN';
            $nama = $user['nama_admin'];
            $data = array(
                'title' => '',
                'tgl' => tgl_indo($tgl),
                'akses' => $akses,
                'nama' => $nama,
                'judul' => 'LAPORAN DATA SURAT',
                'pemerintah' => 'PEMERINTAH KOTA BANJARMASIN',
                'kantor' => 'DINAS LINGKUNGAN HIDUP',
                'alamat' => 'Jalan R.E. Martadinata No. 1 Gedung Blok D Lt.2 Banjarmasin 70111',
                'telp_fax' => 'Telepon. (0511) 3363792-4368145-3363811, Faksimile. (0511) 3363811',
                'email' => 'dlh.banjarmasin@gmail.com',
                'surat' => $this->db->get('surat')->result_array(),
            );
            $this->pdf->setPaper('A4', 'Portrait');
            $this->pdf->setFileName('LAPORAN DATA SURAT.pdf');
            $this->pdf->loadView('surat/laporan_surat', $data);
        }
    }
}
