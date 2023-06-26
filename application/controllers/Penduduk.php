<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penduduk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_penduduk');
        $this->load->model('m_agama');
        $this->load->model('m_pengaduan');
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
        $data['judul']         = 'Pengaduan Masyarakat >> Data Penduduk';
        $data['aktif']         = 'penduduk';
        $data['penduduk']    = $this->m_penduduk->get_all()->result_array();
        $data['agama']         = $this->m_agama->get_all()->result();
        $this->load->view('penduduk/index', $data);
    }

    public function tambah_data()
    {
        $valid = $this->form_validation;
        $valid->set_rules(
            'nik',
            'NIK',
            'required|is_unique[penduduk.nik]',
            array('is_unique' => 'NIK <strong style="color:#ff0000;">' .
                $this->input->post('nik') . '</strong>. sudah terdaftar. daftar dengan nik baru!')
        );
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tanggal_lahir = $this->input->post('tanggal_lahir');
        $jk = $this->input->post('jk');
        $id_agama = $this->input->post('id_agama');
        $nohp = $this->input->post('nohp');
        $alamat    = $this->input->post('alamat');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        if ($valid->run()  == FALSE) {
            $data['judul']         = 'Pengaduan Masyarakat >> Data Penduduk';
            $data['aktif']         = 'penduduk';
            $data['agama']         = $this->m_agama->get_all()->result();
            $this->load->view('penduduk/tambah', $data);
        } else {
            $old_name    = $_FILES["pict"]["name"];
            $ext         = pathinfo($old_name, PATHINFO_EXTENSION);
            $new_name    = time() . '.' . $ext;
            $config = array(
                'upload_path'         => './upload/penduduk',
                'allowed_types'     => 'jpg|png|jpeg',
                'file_name'            => $new_name,
                'image_library'        => 'gd2',
                'source_image'        => './upload/penduduk' . $new_name,
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
                    'nik' => $nik,
                    'nama' => $nama,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'jk' => $jk,
                    'id_agama' => $id_agama,
                    'nohp' => $nohp,
                    'alamat' => $alamat,
                    'pict' => $new_name,
                    'username' => $username,
                    'password' => $password,
                );
                $this->m_global->InsertData('penduduk', $data_insert);
                $this->session->set_flashdata('sukses_tambah', '1');
                redirect('penduduk');
            }
        }
    }

    public function aktifasi($id)
    {
        $this->db->update('penduduk', ['is_active' => 1], ['id_user' => $id]);
        $this->session->set_flashdata('sukses_edit', '1');
        redirect('penduduk');
    }

    public function edit_data($id_user = '')
    {
        $penduduk = $this->m_penduduk->get_all("where id_user='$id_user' ")->result_array();
        $data = array(
            'judul' => 'Pengaduan Masyarakat >> Data Penduduk',
            'aktif' => 'penduduk',
            'agama' => $this->m_agama->get_all()->result(),
            'id_user' => $penduduk[0]['id_user'],
            'nik' => $penduduk[0]['nik'],
            'nama' => $penduduk[0]['nama'],
            'tempat_lahir' => $penduduk[0]['tempat_lahir'],
            'tanggal_lahir' => $penduduk[0]['tanggal_lahir'],
            'jk' => $penduduk[0]['jk'],
            'id_agama' => $penduduk[0]['id_agama'],
            'nohp' => $penduduk[0]['nohp'],
            'alamat' => $penduduk[0]['alamat'],
            'username' => $penduduk[0]['username'],
            'pict' => $penduduk[0]['pict'],
        );
        $this->load->view('penduduk/edit', $data);
    }

    public function edit_proses()
    {
        $id_user = $this->input->post('id_user');
        $nama = $this->input->post('nama');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tanggal_lahir = $this->input->post('tanggal_lahir');
        $jk = $this->input->post('jk');
        $id_agama = $this->input->post('id_agama');
        $nohp = $this->input->post('nohp');
        $alamat    = $this->input->post('alamat');
        $username = $this->input->post('username');
        $old_name    = $_FILES["pict"]["name"];
        $ext         = pathinfo($old_name, PATHINFO_EXTENSION);
        $new_name    = time() . '.' . $ext;
        $config = array(
            'upload_path'         => './upload/penduduk',
            'allowed_types'     => 'jpg|png|jpeg',
            'file_name'            => $new_name,
            'image_library'        => 'gd2',
            'source_image'        => './upload/penduduk' . $new_name,
            'create_thumb'        => true,
            'maintain_ratio'    => true,
            'thumb_marker'         => '',
        );
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('pict')) {
            $upload_data = array('uploads' => $this->upload->data());
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $data_update = array(
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'jk' => $jk,
                'id_agama' => $id_agama,
                'nohp' => $nohp,
                'alamat' => $alamat,
                'username' => $username,
            );
            $id = $this->db->where('id_user', $id_user);
            $query = $this->db->get('penduduk');
            $row = $query->row();
            $this->m_global->UpdateData('penduduk', $data_update, array('id_user' => $id_user));
            $this->session->set_flashdata('sukses_edit', '1');
            redirect(base_url('penduduk'));
        } else {
            $upload_data = array('uploads' => $this->upload->data());
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $data_update = array(
                'nama' => $nama,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => $tanggal_lahir,
                'jk' => $jk,
                'id_agama' => $id_agama,
                'nohp' => $nohp,
                'alamat' => $alamat,
                'pict' => $new_name,
                'username' => $username,
                'password' => $password,
            );
            $id = $this->db->where('id_user', $id_user);
            $query = $this->db->get('penduduk');
            $row = $query->row();
            unlink("./upload/penduduk/$row->pict");
            $this->m_global->UpdateData('penduduk', $data_update, array('id_user' => $id_user));
            $this->session->set_flashdata('sukses_edit', '1');
            redirect(base_url('penduduk'));
        }
    }

    public function hapus($id_user)
    {
        $id = $this->db->where('id_user', $id_user);
        $query = $this->db->get('penduduk');
        $row = $query->row();

        unlink("./upload/penduduk/$row->pict");
        $this->m_global->DeleteData('penduduk', array('id_user' => $id_user));
        $this->session->set_flashdata('sukses_hapus', '1');
        redirect(base_url('penduduk'));
    }

    public function laporanpengadu()
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
                'judul' => 'LAPORAN DATA PENGADU',
                'pemerintah' => 'PEMERINTAH KOTA BANJARMASIN',
                'kantor' => 'DINAS LINGKUNGAN HIDUP',
                'alamat' => 'Jalan R.E. Martadinata No. 1 Gedung Blok D Lt.2 Banjarmasin 70111',
                'telp_fax' => 'Telepon. (0511) 3363792-4368145-3363811, Faksimile. (0511) 3363811',
                'email' => 'dlh.banjarmasin@gmail.com',
                'pengadu' => $this->m_penduduk->get_all()->result_array(),
            );
            $this->pdf->setPaper('A4', 'Portrait');
            $this->pdf->setFileName('LAPORAN DATA PENGADU.pdf');
            $this->pdf->loadView('penduduk/laporan_pengadu', $data);
        }
    }
}

/* End of file penduduk.php */
/* Location: ./application/controllers/penduduk.php */
