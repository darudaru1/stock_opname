<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laboratorium extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the session library
        $this->load->model('Laboratorium_model'); // Load model
        $this->load->model('User_model'); // Load model
        $this->load->library('session');
        $this->load->helper('form'); // Memuat helper form
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['laboratorium'] = $this->Laboratorium_model->get_all_laboratorium_with_users(); // Ambil data laboratorium dari model
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/laboratorium/viewlaboratorium'; // Menentukan tampilan yang akan dimuat di dalam template
        $this->load->view('templates/template_picasset', $data);
    }

    public function add()
    {
        $data['laboratorium'] = $this->Laboratorium_model->get_all_laboratorium(); // Ambil data laboratorium dari model
        $data['user'] = $this->User_model->get_active_users(); // Fetch users (Assuming you have a User_model)
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/laboratorium/addlaboratorium'; // Menentukan tampilan yang akan dimuat di dalam template
        $this->load->view('templates/template_picasset', $data);
    }

    public function store()
    {
        // Mengambil data dari form
        $userid = $this->input->post('usr_id');
        $labnomor = $this->input->post('lab_nomor');
        $labnama = $this->input->post('lab_nama');

        // Validasi input
        $this->form_validation->set_rules('usr_id', 'User', 'required');
        $this->form_validation->set_rules('lab_nomor', 'Nomor Laboratorium', 'required');
        $this->form_validation->set_rules('lab_nama', 'Nama Laboratorium', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan data input ke form
            $data['usr_nama'] = $this->session->userdata('usr_nama');
            $data['role'] = $this->session->userdata('role');
            $data['content'] = 'master/laboratorium/addlaboratorium'; // Menentukan tampilan
            $data['laboratorium_input'] = [
                'usr_id' => $userid,
                'lab_nomor' => $labnomor,
                'lab_nama' => $labnama
            ];
            $this->load->view('templates/template_picasset', $data); // Tampilkan kembali form dengan data yang telah diisi
        } else {
            // Simpan data ke database
            $data = [
                'usr_id' => $userid,
                'lab_nomor' => $labnomor,
                'lab_nama' => $labnama
            ];
            $this->Laboratorium_model->insert_laboratorium($data); // Panggil metode untuk menyimpan data
            redirect('laboratorium'); // Arahkan kembali ke halaman laboratorium
        }
    }

    public function edit($id)
    {
        $data['laboratorium'] = $this->Laboratorium_model->get_laboratorium_by_id($id); // Ambil data berdasarkan ID
        $data['user'] = $this->User_model->get_active_users(); // Fetch users
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/laboratorium/updatelaboratorium'; // Menentukan tampilan form edit
        $this->load->view('templates/template_picasset', $data);
    }

    public function update($id)
    {
        // Validasi input
     // Validasi input
     $this->form_validation->set_rules('usr_id', 'User', 'required');
     $this->form_validation->set_rules('lab_nomor', 'Lab No', 'required');
     $this->form_validation->set_rules('lab_nama', 'Lab Nama', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan ke form edit
            $data['laboratorium'] = $this->Laboratorium_model->get_laboratorium_by_id($id);
            $data['content'] = 'master/laboratorium/updatelaboratorium';
            $this->load->view('templates/template_picasset', $data);
        } else {
            // Mengambil data dari form
            $data = [
                'usr_id' => $this->input->post('usr_id'),
                'lab_nomor' => $this->input->post('lab_nomor'),
                'lab_nama' => $this->input->post('lab_nama')
            ];

            // Memperbarui data berdasarkan ID
            $this->Laboratorium_model->update_laboratorium($id, $data);
            redirect('laboratorium'); // Arahkan kembali ke halaman Laboratorium_model
        }
    }

    public function delete($id)
{
    $this->Laboratorium_model->delete_laboratorium($id); // Panggil metode hapus data
    redirect('laboratorium'); // Arahkan kembali ke halaman Laboratorium_model
}

}
