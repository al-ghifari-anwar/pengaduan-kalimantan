<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_global');
        $this->load->model('m_admin');

        $user = $this->session->userdata('userdata_desa');

        if ($this->session->userdata('userdata_desa') == null) {
            redirect('Login');
        }
    }

    public function index()
    {
        $data['judul']         = 'Pengaduan Masyarakat >> Data Admin';
        $data['aktif']         = 'admin';
        $data['admin']        = $this->m_admin->get_all()->result();
        $data['eksekutor']     = $this->db->get('eksekutor')->result_array();
        $this->load->view('admin/index', $data);
    }

    public function tambah_proses()
    {
        $this->form_validation->set_rules('nama_admin', 'Nama Admin', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Nama Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Tempat Lahir Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Tanggal Lahir Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Jenis Kelamin Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('nohp', 'No Hp', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> No Hp Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Alamat Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[admin.username]|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Username Tidak Boleh Kosong.</div>', 'is_unique' => '<div class="alert alert-danger"><strong>Error!</strong> Username Sudah Digunakan.</div>',));
        $this->form_validation->set_rules('password', 'Password', 'required|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Password Tidak Boleh Kosong.</div>'));
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]|trim', array('required' => '<div class="alert alert-danger"><strong>Error!</strong> Konfirmasi Password Tidak Boleh Kosong.</div>', 'matches' => '<div class="alert alert-danger"><strong>Error!</strong> Password Tidak Sama.</div>',));
        //jika validasi gagal
        $nama_admin = $this->input->post('nama_admin');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tanggal_lahir = $this->input->post('tanggal_lahir');
        $jk = $this->input->post('jk');
        $nohp = $this->input->post('nohp');
        $alamat = $this->input->post('alamat');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $level_admin = $this->input->post('level_admin');
        $eksekutor = $this->input->post('eksekutor');
        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = 'Pengaduan Masyarakat >> Data Admin';
            $data['aktif']      = 'admin';
            $data['admin']      = $this->m_admin->get_all()->result();
            $data['modal_show'] = "$('#modal-fade').modal('show');";
            $this->load->view('admin/index', $data);
        } else {
            $old_name    = $_FILES["pict"]["name"];
            $ext         = pathinfo($old_name, PATHINFO_EXTENSION);
            $new_name    = time() . '.' . $ext;
            $config = array(
                'upload_path'         => './upload/admin',
                'allowed_types'     => 'jpg|png|jpeg',
                'file_name'            => $new_name,
                'image_library'        => 'gd2',
                'source_image'        => './upload/admin' . $new_name,
                'create_thumb'        => true,
                'maintain_ratio'    => true,
                'thumb_marker'         => '',
            );
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('pict')) {
                $data_insert = array(
                    'nama_admin' => $nama_admin,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => date('Y-m-d', strtotime($tanggal_lahir)),
                    'jk' => $jk,
                    'nohp' => $nohp,
                    'alamat' => $alamat,
                    'username' => $username,
                    'password' => $password,
                    'level_admin' => $level_admin,
                    'eksekutor' => $eksekutor
                );
                $this->m_global->InsertData('admin', $data_insert);
                $this->session->set_flashdata('sukses_tambah', '1');
                redirect('admin');
            } else {
                $upload_data = array('uploads' => $this->upload->data());

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $data_insert = array(
                    'nama_admin' => $nama_admin,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => date('Y-m-d', strtotime($tanggal_lahir)),
                    'jk' => $jk,
                    'nohp' => $nohp,
                    'alamat' => $alamat,
                    'pict' => $new_name,
                    'username' => $username,
                    'password' => $password,
                    'level_admin' => $level_admin,
                    'eksekutor' => $eksekutor
                );
                $this->m_global->InsertData('admin', $data_insert);
                $this->session->set_flashdata('sukses_tambah', '1');
                redirect('admin');
            }
        }
    }

    public function detail($id_admin)
    {
        $data['judul']      = 'Pengaduan Masyarakat >> Edit Data admin';
        $data['aktif']      = 'admin';
        $data['admin']      = $this->m_admin->get_id($id_admin)->row_array();
        $this->load->view('admin/detail', $data);
    }

    public function edit($id_admin)
    {
        $data['judul']      = 'Pengaduan Masyarakat >> Edit Data admin';
        $data['aktif']      = 'admin';
        $data['admin']      = $this->m_admin->get_id($id_admin)->row_array();
        $data['eksekutor']     = $this->db->get('eksekutor')->result_array();
        $this->load->view('admin/edit', $data);
    }

    public function edit_proses()
    {
        $id_admin = $this->input->post('id_admin');
        $nama_admin = $this->input->post('nama_admin');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tanggal_lahir = $this->input->post('tanggal_lahir');
        $jk = $this->input->post('jk');
        $nohp = $this->input->post('nohp');
        $alamat = $this->input->post('alamat');
        $level_admin = $this->input->post('level_admin');
        $eksekutor = $this->input->post('eksekutor');
        $old_name    = $_FILES["pict"]["name"];
        $ext         = pathinfo($old_name, PATHINFO_EXTENSION);
        $new_name    = time() . '.' . $ext;
        $config = array(
            'upload_path'         => './upload/admin',
            'allowed_types'     => 'jpg|png|jpeg',
            'file_name'            => $new_name,
            'image_library'        => 'gd2',
            'source_image'        => './upload/admin' . $new_name,
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
                'nama_admin' => $nama_admin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => date('Y-m-d', strtotime($tanggal_lahir)),
                'jk' => $jk,
                'nohp' => $nohp,
                'alamat' => $alamat,
                'level_admin' => $level_admin,
                'eksekutor' => $eksekutor
            );
            $id = $this->db->where('id_admin', $id_admin);
            $query = $this->db->get('admin');
            $row = $query->row();
            $this->m_global->UpdateData('admin', $data_update, array('id_admin' => $id_admin));
            $this->session->set_flashdata('sukses_edit', '1');
            redirect(base_url('admin'));
        } else {
            $upload_data = array('uploads' => $this->upload->data());
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
            $data_update = array(
                'nama_admin' => $nama_admin,
                'tempat_lahir' => $tempat_lahir,
                'tanggal_lahir' => date('Y-m-d', strtotime($tanggal_lahir)),
                'jk' => $jk,
                'nohp' => $nohp,
                'alamat' => $alamat,
                'pict' => $new_name,
                'level_admin' => $level_admin,
                'eksekutor' => $eksekutor
            );
            $id = $this->db->where('id_admin', $id_admin);
            $query = $this->db->get('admin');
            $row = $query->row();
            unlink("./upload/admin/$row->pict");
            $this->m_global->UpdateData('admin', $data_update, array('id_admin' => $id_admin));
            $this->session->set_flashdata('sukses_edit', '1');
            redirect('admin');
        }
    }

    public function hapus($id_admin)
    {
        $id = $this->db->where('id_admin', $id_admin);
        $query = $this->db->get('admin');
        $row = $query->row();

        unlink("./upload/admin/$row->pict");
        $this->m_global->DeleteData('admin', array('id_admin' => $id_admin));
        $this->session->set_flashdata('sukses_hapus', '1');
        redirect(base_url('admin'));
    }
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
