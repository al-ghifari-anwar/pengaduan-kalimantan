<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pengaduan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pengaduan');
        $this->load->model('m_master');
        $this->load->model('m_global');
        $this->load->helper('format_indo');
        $this->load->library('pdf');
        $user = $this->session->userdata('userdata_desa');

        if ($this->session->userdata('userdata_desa') == null) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['judul']         = 'Pengaduan Masyarakat >> Data Pengaduan';
        $data['aktif']         = 'pengaduan';
        $data['eksekutor']     = $this->db->get('eksekutor')->result_array();
        $data['pengaduan'] = $this->m_pengaduan->get_all("WHERE penduduk.nik=pengaduan.nik AND kategori.id_kategori=pengaduan.id_kategori ")->result();
        $this->load->view('pengaduan/index', $data);
    }

    public function data()
    {
        $user = $this->session->userdata('userdata_desa');
        $data['judul']      = "Pengaduan Masyarakat >> Data Pengaduan " . $user['nama'];
        $data['aktif']      = 'data';
        $data['pengaduan'] = $this->m_pengaduan->get_nik($user['nik'])->result();
        $this->load->view('pengaduan/index', $data);
    }

    public function tambah()
    {
        $data['judul']      = 'Pengaduan Masyarakat >> Input Data Pengaduan';
        $data['aktif']      = 'input';
        $data['kategori'] = $this->m_master->getkategori()->result_array();
        $this->load->view('pengaduan/input', $data);
    }

    public function tambah_proses()
    {
        $this->form_validation->set_rules('nama_laporan', 'Nama Laporan', 'required|trim', array('required' => '<div class="alert alert-danger">Gagal! Form Nama Laporan Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('tempat', 'Tempat', 'required|trim', array('required' => '<div class="alert alert-danger">Gagal! Form Tempat Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim', array('required' => '<div class="alert alert-danger">Gagal! Form Kategori Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('lat', 'Pilih Lokasi', 'required|trim', array('required' => '<div class="alert alert-danger">Gagal! Form Lokasi Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('long', 'Pilih Lokasi', 'required|trim', array('required' => '<div class="alert alert-danger">Gagal! Form Lokasi Tidak Boleh Kosong.</div>'));
        $user         = $this->session->userdata('userdata_desa');
        $nik         = $user['nik'];
        $nama_laporan     = $this->input->post('nama_laporan');
        $kategori     = $this->input->post('kategori');
        $tempat     = $this->input->post('tempat');
        $status     = 1;
        $lat = $this->input->post('lat');
        $long = $this->input->post('long');
        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = 'Pengaduan Masyarakat >> Input Data Pengaduan';
            $data['aktif']      = 'input';
            $this->load->view('pengaduan/input', $data);
        } else {
            $old_name    = $_FILES["pict"]["name"];
            $ext         = pathinfo($old_name, PATHINFO_EXTENSION);
            $new_name    = time() . '.' . $ext;
            $config = array(
                'upload_path'         => './upload/pengaduan',
                'allowed_types'     => 'jpg|png|jpeg',
                'file_name'            => $new_name,
                'image_library'        => 'gd2',
                'source_image'        => './upload/pengaduan' . $new_name,
                'create_thumb'        => true,
                'maintain_ratio'    => true,
                'thumb_marker'         => '',
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('pict')) {
            } else {
                $upload_data = array('uploads' => $this->upload->data());

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $data_insert = array(
                    'nik'        => $nik,
                    'tanggal'   => date('Y-m-d'),
                    'nama_laporan'    => $nama_laporan,
                    'id_kategori'    => $kategori,
                    'pict'        => $new_name,
                    'tempat'    => $tempat,
                    'status'     => $status,
                    'lat' => $lat,
                    'long' => $long
                );
                $this->m_global->InsertData('pengaduan', $data_insert);
                $this->session->set_flashdata('sukses_tambah', '1');
                redirect('pengaduan/data');
            }
        }
    }

    public function detail($id_pengaduan)
    {
        $data['judul']      = 'Pengaduan Masyarakat >> Pengaduan >> Detail';
        $data['aktif']      = 'data';
        $data['pengaduan']  = $this->m_pengaduan->get_id("WHERE pengaduan.id_admin = admin.id_admin AND pengaduan.nik = penduduk.nik AND pengaduan.id_pengaduan = '$id_pengaduan'")->row_array();
        $this->load->view('pengaduan/detail', $data);
    }

    public function edit($id_pengaduan = '')
    {
        $pengaduan = $this->m_pengaduan->get_id("WHERE pengaduan.id_admin = admin.id_admin AND pengaduan.nik = penduduk.nik AND pengaduan.id_pengaduan = '$id_pengaduan'")->result_array();
        $data = array(
            'judul' => 'Pengaduan Masyarakat >> Edit Data Pengaduan',
            'aktif' => 'data',
            'id_pengaduan' => (isset($pengaduan[0]['id_pengaduan'])) ? $pengaduan[0]['id_pengaduan'] : "",
            'nama_laporan' => (isset($pengaduan[0]['nama_laporan'])) ? $pengaduan[0]['nama_laporan'] : "",
            'tempat' => (isset($pengaduan[0]['tempat'])) ? $pengaduan[0]['tempat'] : "",
            'id_kategori' => (isset($pengaduan[0]['id_kategori'])) ? $pengaduan[0]['id_kategori'] : "",
            'pict' => (isset($pengaduan[0]['pict'])) ? $pengaduan[0]['pict'] : "",
            'nama' => (isset($pengaduan[0]['nama'])) ? $pengaduan[0]['nama'] : "",
            'kategori' => $this->m_master->getkategori()->result()
        );
        $this->load->view('pengaduan/edit', $data);
    }

    public function edit_proses2($id_pengaduan)
    {
        $this->form_validation->set_rules('nama_laporan', 'Nama Laporan', 'required|trim', array('required' => '<div class="alert alert-danger">Gagal! Form Nama Laporan Tidak Boleh Kosong.</div>'));
        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = 'Pengaduan Masyarakat >> Edit Data Pengaduan';
            $data['aktif']      = 'input';
            $data['pengaduan']  = $this->m_pengaduan->get_id($id_pengaduan)->row_array();
            $this->load->view('pengaduan/input', $data);
        } else {
            if ($_FILES["foto"]["name"] == "") {
                $foto_lama = $this->input->post('foto_lama');
                $this->m_pengaduan->edit_proses($id_pengaduan, $foto_lama);
                $this->session->set_flashdata('sukses_edit', '1');
                redirect('pengaduan/data');
            } else {
                //setting config untuk library upload
                $config['upload_path']      = './upload/pengaduan';
                $config['allowed_types']    = 'gif|jpg|png';
                $config['max_size']         = 1000000000;
                $config['max_width']        = 1024000;
                $config['max_height']       = 768000;

                //pemanggilan librabry upload
                $this->load->library('upload', $config);

                //jika upload gagal
                if (!$this->upload->do_upload('foto')) {
                    $data['judul']      = 'Pengaduan Masyarakat >> Edit Data Pengaduan';
                    $data['aktif']      = 'data';
                    $data['pengaduan']  = $this->m_pengaduan->get_id($id_pengaduan)->row_array();
                    $this->load->view('pengaduan/edit', $data);
                    //jika upload berhasil
                } else {
                    $foto_lama = $this->input->post('foto_lama');
                    $q = $this->db->query("SELECT * FROM pengaduan WHERE pict = '$foto_lama' ")->row()->file;
                    $f = './upload/pengaduan/' . $q;
                    unlink($f);

                    $gambar = $this->upload->data();
                    $file   = $gambar['file_name'];
                    $this->m_pengaduan->edit_proses($id_pengaduan, $file);


                    $this->session->set_flashdata('sukses_edit', '1');
                    redirect('pengaduan/data');
                }
            }
        }
    }

    public function edit_proses()
    {
        $id_pengaduan = $this->input->post('id_pengaduan');
        $status = $this->input->post('status');
        $eksekutor = $this->input->post('eksekutor');
        $penjadwalan = $this->input->post('penjadwalan');
        $lat = $this->input->post('lat');
        $long = $this->input->post('long');
        if ($status == 2) {
            $data = array(
                'status' => $status
            );
            $this->m_global->UpdateData('pengaduan', $data, array('id_pengaduan' => $id_pengaduan));
            $data_tindak = array(
                'tanggal' => date('Y-m-d'),
                'id_pengaduan' => $id_pengaduan,
                'tim_eksekutor' => $eksekutor,
                'penjadwalan' => $penjadwalan,
                'lat' => $lat,
                'long' => $long
            );
            $this->m_global->InsertData('tindakan', $data_tindak);
            $this->session->set_flashdata('sukses_verifikasi', '1');
            redirect('pengaduan');
        } else {
            $data = array(
                'status' => $status
            );
            $this->m_global->UpdateData('pengaduan', $data, array('id_pengaduan' => $id_pengaduan));
            $this->session->set_flashdata('sukses_verifikasi', '1');
            redirect('pengaduan');
        }
    }

    public function hapus($id_pengaduan)
    {
        $q = $this->db->query("SELECT * FROM pengaduan WHERE id_pengaduan = '$id_pengaduan' ")->row()->file;
        // $file = base_url('upload/'.$q);
        $file = './upload/' . $q;
        unlink($file);

        $this->db->where('id_pengaduan', $id_pengaduan);
        $this->db->delete('pengaduan');

        $this->session->set_flashdata('sukses_hapus', '1');
        $user = $this->session->userdata('userdata_desa');
        if ($user['akses'] == 'admin') {
            redirect('pengaduan');
        } else {
            redirect('pengaduan/data');
        }
    }

    public function laporanpengaduan()
    {
        $user = $this->session->userdata('userdata_desa');
        $id_user = $user['id_user'];
        $tgl = date('Y-m-d');
        if ($user['akses'] == 'user') {
            $akses = 'USER';
            $nama = $user['nama'];
            $username = $user['username'];
            $data = array(
                'title' => '',
                'tgl' => tgl_indo($tgl),
                'akses' => $akses,
                'nama' => $nama,
                'username' => $username,
                'judul' => 'LAPORAN PENGADUAN',
                'pemerintah' => 'PEMERINTAH KOTA BANJARMASIN',
                'kantor' => 'DINAS LINGKUNGAN HIDUP',
                'alamat' => 'Jalan R.E. Martadinata No. 1 Gedung Blok D Lt.2 Banjarmasin 70111',
                'telp_fax' => 'Telepon. (0511) 3363792-4368145-3363811, Faksimile. (0511) 3363811',
                'email' => 'dlh.banjarmasin@gmail.com',
                'pengaduan' => $this->m_pengaduan->get_all("where penduduk.nik = pengaduan.nik AND kategori.id_kategori=pengaduan.id_kategori and penduduk.id_user='$id_user' ")->result_array(),
            );
            $this->pdf->setPaper('A4', 'Landscape');
            $this->pdf->setFileName('LAPORAN PENGADUAN.pdf');
            $this->pdf->loadView('pengaduan/laporan_pengaduan', $data);
        }
    }
}

/* End of file pengaduan.php */
/* Location: ./application/controllers/pengaduan.php */
