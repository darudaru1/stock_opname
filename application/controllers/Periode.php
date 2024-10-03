<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periode extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the session library
        $this->load->model('Periode_model'); // Load model
        $this->load->library('session');
        $this->load->helper('form'); // Memuat helper form
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['periode'] = $this->Periode_model->get_all_periode(); // Ambil data periode dari model
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/periode/viewperiode'; // Menentukan tampilan yang akan dimuat di dalam template
        $this->load->view('templates/template_picasset', $data);
    }

    public function add()
    {
        $data['periode'] = $this->Periode_model->get_all_periode(); // Ambil data periode dari model
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/periode/addperiode'; // Menentukan tampilan yang akan dimuat di dalam template
        $this->load->view('templates/template_picasset', $data);
    }

    public function store()
    {
        // Mengambil data dari form
        $tahun = $this->input->post('prd_tahun');
        $tgl_awal = $this->input->post('prd_tgl_awal');
        $tgl_akhir = $this->input->post('prd_tgl_akhir');

        // Validasi input
        $this->form_validation->set_rules('prd_tahun', 'Tahun', 'required');
        $this->form_validation->set_rules('prd_tgl_awal', 'Tanggal Awal', 'required');
        $this->form_validation->set_rules('prd_tgl_akhir', 'Tanggal Akhir', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan data input ke form
            $data['usr_nama'] = $this->session->userdata('usr_nama');
            $data['role'] = $this->session->userdata('role');
            $data['content'] = 'master/periode/addperiode'; // Menentukan tampilan
            $data['periode_input'] = [
                'prd_tahun' => $tahun,
                'prd_tgl_awal' => $tgl_awal,
                'prd_tgl_akhir' => $tgl_akhir
            ];
            $this->load->view('templates/template_picasset', $data); // Tampilkan kembali form dengan data yang telah diisi
        } else {
            // Simpan data ke database
            $data = [
                'prd_tahun' => $tahun,
                'prd_tgl_awal' => $tgl_awal,
                'prd_tgl_akhir' => $tgl_akhir
            ];
            $this->Periode_model->insert_periode($data); // Panggil metode untuk menyimpan data
            redirect('periode'); // Arahkan kembali ke halaman periode
        }
    }

    public function edit($id)
    {
        $data['periode'] = $this->Periode_model->get_periode_by_id($id); // Ambil data berdasarkan ID
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/periode/updateperiode'; // Menentukan tampilan form edit
        $this->load->view('templates/template_picasset', $data);
    }

    public function update($id)
    {
        // Validasi input
        $this->form_validation->set_rules('prd_tahun', 'Tahun', 'required');
        $this->form_validation->set_rules('prd_tgl_awal', 'Tanggal Awal', 'required');
        $this->form_validation->set_rules('prd_tgl_akhir', 'Tanggal Akhir', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan ke form edit
            $data['periode'] = $this->Periode_model->get_periode_by_id($id);
            $data['content'] = 'master/periode/updateperiode';
            $this->load->view('templates/template_picasset', $data);
        } else {
            // Mengambil data dari form
            $data = [
                'prd_tahun' => $this->input->post('prd_tahun'),
                'prd_tgl_awal' => $this->input->post('prd_tgl_awal'),
                'prd_tgl_akhir' => $this->input->post('prd_tgl_akhir')
            ];

            // Memperbarui data berdasarkan ID
            $this->Periode_model->update_periode($id, $data);
            redirect('periode'); // Arahkan kembali ke halaman periode
        }
    }

    public function delete($id)
{
    $this->Periode_model->delete_periode($id); // Panggil metode hapus data
    redirect('periode'); // Arahkan kembali ke halaman periode
}

}
