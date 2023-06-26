<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_penduduk');
        $this->load->model('M_admin');
        $this->load->model('M_agama');
        $this->load->model('m_global');
        $this->load->library('PHPExcel');

        $user = $this->session->userdata('userdata_desa');

        if ($this->session->userdata('userdata_desa') == null) {
            redirect('login');
        }
    }

    public function profil_user($nik)
    {
        $data['judul']      = 'Pengaduan Masyarakat >> Edit Profil';
        $data['aktif']      = 'profil';
        $data['profil']     = $this->M_penduduk->get_nik($nik)->row_array();
        $data['agama']      = $this->M_agama->get_all()->result();
        $this->load->view('profil/edit', $data);
    }

    public function profil_detail($nik)
    {
        $data['judul']      = 'Pengaduan Masyarakat >> Edit Profil';
        $data['aktif']      = 'profil';
        $data['profil']     = $this->M_penduduk->get_nik($nik)->row_array();
        $data['agama']      = $this->M_agama->get_all()->result();
        $this->load->view('profil/detail', $data);
    }

    public function edit_proses()
    {
        $nik = $this->input->post('nik');
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
            );
            $niks = $this->db->where('nik', $nik);
            $query = $this->db->get('penduduk');
            $row = $query->row();
            $this->m_global->UpdateData('penduduk', $data_update, array('nik' => $nik));
            $this->session->set_flashdata('sukses_edit', '1');
            redirect('profil/profil_user/' . $nik);
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
            );
            $id = $this->db->where('nik', $nik);
            $query = $this->db->get('penduduk');
            $row = $query->row();
            unlink("./upload/penduduk/$row->pict");
            $this->m_global->UpdateData('penduduk', $data_update, array('nik' => $nik));
            $this->session->set_flashdata('sukses_edit', '1');
            redirect('profil/profil_user/' . $nik);
        }
    }

    public function edit_akun($nik)
    {
        $data['judul']      = 'Keluhan Masyarakat >> Edit Akun';
        $data['aktif']      = 'akun';
        $data['profil']     = $this->M_penduduk->get_nik($nik)->row_array();
        $this->load->view('profil/edit_akun', $data);
    }

    public function edit_akun_admin($id_admin)
    {
        $data['judul']      = 'Keluhan Masyarakat >> Edit Akun';
        $data['aktif']      = 'akun';
        $data['profil']     = $this->M_admin->get_id($id_admin)->row_array();
        $this->load->view('profil/edit_akun_admin', $data);
    }

    public function edit_akun_proses($nik)
    {
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim',
            array(
                'required' => '<div class="alert alert-danger"><strong>Error!</strong> Password Tidak Boleh Kosong.</div>'
            )
        );
        $this->form_validation->set_rules(
            'password2',
            'Konfirmasi Password',
            'required|matches[password]|trim',
            array(
                'required' => '<div class="alert alert-danger"><strong>Error!</strong> Konfirmasi Password Tidak Boleh Kosong.</div>',
                'matches' => '<div class="alert alert-danger"><strong>Error!</strong> Password Tidak Sama.</div>',
            )
        );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = 'Keluhan Masyarakat >> Edit Akun';
            $data['aktif']      = 'akun';
            $data['profil']     = $this->M_penduduk->get_nik($nik)->row_array();
            $this->load->view('profil/edit_akun', $data);
        } else {
            $cek_nik        = $this->db->query("SELECT * FROM penduduk WHERE nik = '$nik' ")->row_array();


            $pass_lama_in   = MD5($this->input->post('password_lama'));
            $pass_baru      = MD5($this->input->post('password'));

            if ($cek_nik['password'] == $pass_lama_in) {
                $data = array('password' => $pass_baru);

                $this->db->where('nik', $nik);
                $this->db->update('penduduk', $data);

                $this->session->set_flashdata('sukses_edit', '1');
                redirect('Profil/edit_akun/' . $nik);
            } else {
                $this->session->set_flashdata('gagal_edit', '1');
                redirect('Profil/edit_akun/' . $nik);
            }
        }
    }

    public function edit_akun_admin_proses($id_admin)
    {
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim',
            array(
                'required' => '<div class="alert alert-danger"><strong>Error!</strong> Password Tidak Boleh Kosong.</div>'
            )
        );
        $this->form_validation->set_rules(
            'password2',
            'Konfirmasi Password',
            'required|matches[password]|trim',
            array(
                'required' => '<div class="alert alert-danger"><strong>Error!</strong> Konfirmasi Password Tidak Boleh Kosong.</div>',
                'matches' => '<div class="alert alert-danger"><strong>Error!</strong> Password Tidak Sama.</div>',
            )
        );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = 'Keluhan Masyarakat >> Edit Akun';
            $data['aktif']      = 'akun';
            $data['profil']     = $this->M_admin->get_id($id_admin)->row_array();
            $this->load->view('profil/edit_akun_admin', $data);
        } else {
            $cek_id        = $this->db->query("SELECT * FROM admin WHERE id_admin = '$id_admin' ")->row_array();


            $pass_lama_in   = MD5($this->input->post('password_lama'));
            $pass_baru      = MD5($this->input->post('password'));

            if ($cek_id['password'] == $pass_lama_in) {
                $data = array('password' => $pass_baru);

                $this->db->where('id_admin', $id_admin);
                $this->db->update('admin', $data);

                $this->session->set_flashdata('sukses_edit', '1');
                redirect('Profil/edit_akun_admin/' . $id_admin);
            } else {
                $this->session->set_flashdata('gagal_edit', '1');
                redirect('Profil/edit_akun_admin/' . $id_admin);
            }
        }
    }
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
