<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
        $this->load->model('m_global');
        $this->load->model('m_agama');
    }

    public function index()
    {
        if ($this->session->userdata('userdata_desa') != null) {
            redirect('home');
        }
        $this->load->view('login/index_user');
    }

    public function admin()
    {
        $this->load->view('login/index');
    }

    public function register()
    {
        $data['agama'] = $this->m_agama->get_all()->result();
        $this->load->view('login/register', $data);
    }

    public function proses_user()
    {
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim',
            array(
                'required' => '<div class="alert alert-danger">Gagal! Username Tidak Boleh Kosong.</div>'
            )
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim',
            array(
                'required' => '<div class="alert alert-danger">Gagal! Password Tidak Boleh Kosong.</div>'
            )
        );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/index_user');
        } else {
            $u      = $this->input->post('username');
            $p      = md5($this->input->post('password'));
            $cek    = $this->M_login->cek_user($u, $p);

            if ($cek->num_rows() > 0) {
                $user_data              = $cek->row_array();
                $session['id_user']     = $user_data['id_user'];
                $session['nik']         = $user_data['nik'];
                $session['nama']        = $user_data['nama'];
                $session['pict']        = $user_data['pict'];
                $session['username']    = $user_data['username'];
                $session['password']    = $user_data['password'];
                $session['level']           = 'user';
                $session['akses']       = 'user';
                $this->session->set_userdata('userdata_desa', $session);
                redirect('home/dashboard');
            } else {
                $this->session->set_flashdata('gagal_login', '1');
                redirect('login');
            }
        }
    }

    public function proses()
    {
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim',
            array(
                'required' => '<div class="alert alert-danger">Gagal! Username Tidak Boleh Kosong.</div>'
            )
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim',
            array(
                'required' => '<div class="alert alert-danger">Gagal! Password Tidak Boleh Kosong.</div>'
            )
        );

        //jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/index');
        } else {
            $u         = $this->input->post('username');
            $p         = md5($this->input->post('password'));
            $cek     = $this->M_login->cek($u, $p);

            // echo $cek->row_array();
            // die;
            if ($cek->num_rows() > 0) {
                $user_data    = $cek->row_array();
                $session['id_admin']         = $user_data['id_admin'];
                $session['nama_admin']         = $user_data['nama_admin'];
                $session['username']         = $user_data['username'];
                $session['password']        = $user_data['password'];
                $session['pict']        = $user_data['pict'];
                $session['akses']             = 'admin';
                $session['level']           = $user_data['level_admin'];
                $session['eksekutor']          = $user_data['eksekutor'];
                $this->session->set_userdata('userdata_desa', $session);
                redirect('home');
            } else {
                $this->session->set_flashdata('gagal_login', '1');
                redirect('login/admin');
            }
        }
    }

    public function register_proses()
    {
        $valid = $this->form_validation;
        $valid->set_rules(
            'nik',
            'NIK',
            'required|is_unique[penduduk.nik]',
            array('is_unique' => 'NIK <strong>' .
                $this->input->post('no_whatsapp') . '</strong>. sudah terdaftar. silahkan daftar dengan nik baru!')
        );

        $valid->set_rules(
            'nohp',
            'No Hp',
            'required',
            array('required' => 'No Hp tidak boleh kosong')
        );

        $valid->set_rules(
            'nama',
            'Nama',
            'required',
            array('required' => 'Nama tidak boleh kosong')
        );

        $valid->set_rules(
            'tempat_lahir',
            'Tempat Lahir',
            'required',
            array('required' => 'Tempat Lahir tidak boleh kosong')
        );

        $valid->set_rules(
            'alamat',
            'Alamat',
            'required',
            array('required' => 'Alamat tidak boleh kosong')
        );

        $valid->set_rules(
            'username',
            'Username',
            'required',
            array('required' => 'Username tidak boleh kosong')
        );

        $valid->set_rules(
            'password',
            'Password',
            'required',
            array('required' => 'Password tidak boleh kosong')
        );

        $valid->set_rules(
            'confirm_password',
            'Confirm Password',
            'required|matches[password]',
            array('required' => 'Confirm Password tidak boleh kosong')
        );

        $nik = $this->input->post('nik');
        $nohp = $this->input->post('nohp');
        $nama = $this->input->post('nama');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tanggal_lahir = $this->input->post('tanggal_lahir');
        $agama = $this->input->post('agama');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $alamat = $this->input->post('alamat');
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        if ($valid->run()  == FALSE) {
            $data['agama'] = $this->m_agama->get_all()->result();
            $this->load->view('login/register', $data);
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
                $data = array(
                    'nik' => $nik,
                    'nohp' => $nohp,
                    'nama' => $nama,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'id_agama' => $agama,
                    'jk' => $jenis_kelamin,
                    'alamat' => $alamat,
                    'username' => $username,
                    'password' => $password,
                    'pict' => $new_name
                );
                $this->m_global->InsertData('penduduk', $data);
                $this->session->set_flashdata('success', 'Berhasil Buat akun, silahkan login!!');
                redirect(base_url('login/register'));
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */