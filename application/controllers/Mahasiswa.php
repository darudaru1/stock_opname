<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the session library
        $this->load->model('Mahasiswa_model'); // Load model
        $this->load->model('Laboratorium_model'); // Load model
        $this->load->library('session');
        $this->load->helper('form'); // Memuat helper form
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['mahasiswa'] = $this->Mahasiswa_model->get_all_mahasiswa_with_labs(); // Ambil data mahasiswa dari model
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/mahasiswa/viewmahasiswa'; // Menentukan tampilan yang akan dimuat di dalam template
        $this->load->view('templates/template_picasset', $data);
    }

    public function add()
    {
        $data['mahasiswa'] = $this->Mahasiswa_model->get_all_Mahasiswa(); // Ambil data mahasiswa dari model
        $data['laboratorium'] = $this->Laboratorium_model->get_all_Laboratorium();
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/mahasiswa/addmahasiswa'; // Menentukan tampilan yang akan dimuat di dalam template
        $this->load->view('templates/template_picasset', $data);
    }

    public function store()
    {
        // Mengambil data dari form
        $labid = $this->input->post('lab_id');
        $mhsnim = $this->input->post('mhs_nim');
        $mhsnama = $this->input->post('mhs_nama');

        // Validasi input
        $this->form_validation->set_rules('lab_id', 'User', 'required');
        $this->form_validation->set_rules('mhs_nim', 'Lab No', 'required');
        $this->form_validation->set_rules('mhs_nama', 'Lab Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan data input ke form
            $data['usr_nama'] = $this->session->userdata('usr_nama');
            $data['role'] = $this->session->userdata('role');
            $data['content'] = 'master/mahasiswa/addmahasiswa'; // Menentukan tampilan
            $data['mahasiswa_input'] = [
                'lab_id' => $labid,
                'mhs_nim' => $mhsnim,
                'mhs_nama' => $mhsnama
            ];
            $this->load->view('templates/template_picasset', $data); // Tampilkan kembali form dengan data yang telah diisi
        } else {
            // Simpan data ke database
            $data = [
                'lab_id' => $labid,
                'mhs_nim' => $mhsnim,
                'mhs_nama' => $mhsnama
            ];
            $this->Mahasiswa_model->insert_mahasiswa($data); // Panggil metode untuk menyimpan data
            redirect('mahasiswa'); // Arahkan kembali ke halaman mahasiswa
        }
    }

    public function edit($id)
    {
        $data['mahasiswa'] = $this->Mahasiswa_model->get_mahasiswa_by_id($id); // Ambil data berdasarkan ID
        $data['laboratorium'] = $this->Laboratorium_model->get_all_Laboratorium();
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/mahasiswa/updatemahasiswa'; // Menentukan tampilan form edit
        $this->load->view('templates/template_picasset', $data);
    }

    public function update($id)
    {
        // Validasi input
        // Validasi input
        $this->form_validation->set_rules('lab_id', 'Laboratorium', 'required');
        $this->form_validation->set_rules('mhs_nim', 'NIM Mahasiswa', 'required');
        $this->form_validation->set_rules('mhs_nama', ' Nama Mahasiswa', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan ke form edit
            $data['mahasiswa'] = $this->Mahasiswa_model->get_mahasiswa_by_id($id);
            $data['content'] = 'master/mahasiswa/updatemahasiswa';
            $this->load->view('templates/template_picasset', $data);
        } else {
            // Mengambil data dari form
            $data = [
                'lab_id' => $this->input->post('lab_id'),
                'mhs_nim' => $this->input->post('mhs_nim'),
                'mhs_nama' => $this->input->post('mhs_nama')
            ];

            // Memperbarui data berdasarkan ID
            $this->Mahasiswa_model->update_mahasiswa($id, $data);
            redirect('mahasiswa'); // Arahkan kembali ke halaman mahasiswa
        }
    }

    public function delete($id)
    {
        $this->Mahasiswa_model->delete_mahasiswa($id); // Panggil metode hapus data
        redirect('mahasiswa'); // Arahkan kembali ke halaman mahasiswa
    }
}
