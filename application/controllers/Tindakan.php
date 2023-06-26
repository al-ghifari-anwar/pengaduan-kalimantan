<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Tindakan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pengaduan');
        $this->load->model('m_global');
        $this->load->library('pdf');
        $user = $this->session->userdata('userdata_desa');

        if ($this->session->userdata('userdata_desa') == null) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['judul']         = 'Pengaduan Masyarakat >> Data Tindakan';
        $data['aktif']         = 'tindakan';
        $data['tindakan'] = $this->m_pengaduan->gettindakan()->result_array();
        $data['pengaduan'] = $this->m_pengaduan->get_all()->result_array();
        $this->load->view('tindakan/index', $data);
    }

    public function tindakan_proses()
    {
        $id_tindakan = $this->input->post('id_tindakan');
        $bentuk_tindakan = $this->input->post('bentuk_tindakan');
        $tim_eksekutor = $this->input->post('tim_eksekutor');
        $hasil = $this->input->post('hasil');

        //setting config untuk library upload
        $config['upload_path']      = './upload/tindakan';
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']         = 1000000000;
        $config['max_width']        = 1024000;
        $config['max_height']       = 768000;

        //pemanggilan librabry upload
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('bukti')) {
            $bukti = $this->upload->data();
            $data = array(
                'bentuk_tindakan' => $bentuk_tindakan,
                'tim_eksekutor' => $tim_eksekutor,
                'hasil' => $hasil,
                'bukti' => $bukti['file_name']
            );
            $this->m_global->UpdateData('tindakan', $data, array('id_tindakan' => $id_tindakan));
            $this->session->set_flashdata('sukses_tambah', '1');
            redirect('tindakan');
        } else {
            $data = array(
                'bentuk_tindakan' => $bentuk_tindakan,
                'tim_eksekutor' => $tim_eksekutor,
                'hasil' => $hasil
            );
            $this->m_global->UpdateData('tindakan', $data, array('id_tindakan' => $id_tindakan));
            $this->session->set_flashdata('sukses_tambah', '1');
            redirect('tindakan');
        }
    }

    public function hapus($id_tindakan)
    {
        $this->db->where('id_tindakan', $id_tindakan);
        $this->db->delete('tindakan');

        $this->session->set_flashdata('sukses_hapus', '1');
        redirect('tindakan');
    }
}
