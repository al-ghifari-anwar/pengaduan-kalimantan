<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_master');
        $this->load->model('m_global');

        $user = $this->session->userdata('userdata_desa');

        if ($this->session->userdata('userdata_desa') == null) {
            redirect('login');
        }
    }

    public function agama()
    {
        $data['judul']         = 'Keluhan Masyarakat >> Data Penduduk';
        $data['aktif']         = 'agama';
        $data['agama']         = $this->m_master->getagama()->result_array();
        $this->load->view('master/index_agama', $data);
    }

    public function actionagama()
    {
        $id_agama = $this->input->post('id_agama');
        $nama_agama = $this->input->post('nama_agama');
        $status = $this->input->post('status');
        $statusdata = $this->input->post('statusdata');
        if ($statusdata == "Tambah Data") {
            $data = array(
                'nama_agama' => $nama_agama,
                'status' => $status,
            );
            $this->m_global->InsertData('agama', $data);
            $this->session->set_flashdata('sukses_tambah', '1');
            redirect('master/agama');
        }
        if ($statusdata == "Edit Data") {
            $data = array(
                'nama_agama' => $nama_agama,
                'status' => $status,
            );
            $this->m_global->UpdateData('agama', $data, array('id_agama' => $id_agama));
            $this->session->set_flashdata('sukses_edit', '1');
            redirect('master/agama');
        }
    }

    public function actionhapusagama($id_agama)
    {
        $this->m_global->DeleteData('agama', array('id_agama' => $id_agama));
        $this->session->set_flashdata('sukses_hapus', '1');
        redirect('master/agama');
    }

    public function kategori()
    {
        $data['judul']         = 'Keluhan Masyarakat >> Data Penduduk';
        $data['aktif']         = 'kategori';
        $data['kategori']     = $this->m_master->getkategori()->result_array();
        $this->load->view('master/index_kategori', $data);
    }

    public function actionkategori()
    {
        $id_kategori = $this->input->post('id_kategori');
        $nama_kategori = $this->input->post('nama_kategori');
        $statusdata = $this->input->post('statusdata');
        if ($statusdata == "Tambah Data") {
            $data = array(
                'nama_kategori' => $nama_kategori,
            );
            $this->m_global->InsertData('kategori', $data);
            $this->session->set_flashdata('sukses_tambah', '1');
            redirect('master/kategori');
        }
        if ($statusdata == "Edit Data") {
            $data = array(
                'nama_kategori' => $nama_kategori,
            );
            $this->m_global->UpdateData('kategori', $data, array('id_kategori' => $id_kategori));
            $this->session->set_flashdata('sukses_edit', '1');
            redirect('master/kategori');
        }
    }

    public function actionhapuskategori($id_kategori)
    {
        $this->m_global->DeleteData('kategori', array('id_kategori' => $id_kategori));
        $this->session->set_flashdata('sukses_hapus', '1');
        redirect('master/kategori');
    }

    public function eksekutor()
    {
        $data['judul']         = 'Keluhan Masyarakat >> Data Penduduk';
        $data['aktif']         = 'eksekutor';
        $data['eksekutor']     = $this->m_master->geteksekutor()->result_array();
        $this->load->view('master/index_eksekutor', $data);
    }

    public function actioneksekutor()
    {
        $id_eksekutor = $this->input->post('id_eksekutor');
        $nama_eksekutor = $this->input->post('nama_eksekutor');
        $statusdata = $this->input->post('statusdata');
        if ($statusdata == "Tambah Data") {
            $data = array(
                'nama_eksekutor' => $nama_eksekutor,
            );
            $this->m_global->InsertData('eksekutor', $data);
            $this->session->set_flashdata('sukses_tambah', '1');
            redirect('master/eksekutor');
        }
        if ($statusdata == "Edit Data") {
            $data = array(
                'nama_eksekutor' => $nama_eksekutor,
            );
            $this->m_global->UpdateData('eksekutor', $data, array('id_eksekutor' => $id_eksekutor));
            $this->session->set_flashdata('sukses_edit', '1');
            redirect('master/eksekutor');
        }
    }

    public function actionhapuseksekutor($id_eksekutor)
    {
        $this->m_global->DeleteData('eksekutor', array('id_eksekutor' => $id_eksekutor));
        $this->session->set_flashdata('sukses_hapus', '1');
        redirect('master/eksekutor');
    }
}
