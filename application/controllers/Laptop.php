<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laptop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the session library
        $this->load->model('Laptop_model'); // Load model
        $this->load->model('Laboratorium_model'); // Load model
        $this->load->library('session');
        $this->load->helper('form'); // Memuat helper form
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['laptop'] = $this->Laptop_model->get_all_laptop_with_labs(); // Ambil data Laptop dari model
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/laptop/viewlaptop'; // Menentukan tampilan yang akan dimuat di dalam template
        $this->load->view('templates/template_picasset', $data);
    }

    public function add()
    {
        $data['laptop'] = $this->Laptop_model->get_all_Laptop(); // Ambil data Laptop dari model
        $data['laboratorium'] = $this->Laboratorium_model->get_all_Laboratorium();
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/laptop/addlaptop'; // Menentukan tampilan yang akan dimuat di dalam template
        $this->load->view('templates/template_picasset', $data);
    }

    public function store()
    {
        // Mengambil data dari form
        $labid = $this->input->post('lab_id');
        $ltpnomor = $this->input->post('ltp_nomor');
        $ltpsn = $this->input->post('ltp_serialnumber');
        $ltptipe = $this->input->post('ltp_tipe');
        $stas = $this->input->post('status_tas');
        $scharger = $this->input->post('status_charger');
        $ltpstatus = $this->input->post('ltp_status');

        // Validasi input
        $this->form_validation->set_rules('lab_id', 'Laboratorium', 'required');
        $this->form_validation->set_rules('ltp_nomor', 'Nomor Laptop', 'required');
        $this->form_validation->set_rules('ltp_serialnumber', 'Serial Number Laptop', 'required');
        $this->form_validation->set_rules('ltp_tipe', 'Tipe Laptop', 'required');
        $this->form_validation->set_rules('status_tas', 'Status Tas Laptop', 'required');
        $this->form_validation->set_rules('status_charger', 'Status Charger Laptop', 'required');
        $this->form_validation->set_rules('ltp_status', 'Status Laptop', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan data input ke form
            $data['usr_nama'] = $this->session->userdata('usr_nama');
            $data['role'] = $this->session->userdata('role');
            $data['content'] = 'master/laptop/addlaptop'; // Menentukan tampilan
            $data['laptop_input'] = [
                'lab_id' => $labid,
                'ltp_nomor' => $ltpnomor,
                'ltp_serialnumber' => $ltpsn,
                'ltp_tipe' => $ltptipe,
                'status_tas' => $stas,
                'status_charger' => $scharger,
                'ltp_status' => $ltpstatus
            ];
            $this->load->view('templates/template_picasset', $data); // Tampilkan kembali form dengan data yang telah diisi
        } else {
            // Simpan data ke database
            $data = [
                'lab_id' => $labid,
                'ltp_nomor' => $ltpnomor,
                'ltp_serialnumber' => $ltpsn,
                'ltp_tipe' => $ltptipe,
                'status_tas' => $stas,
                'status_charger' => $scharger,
                'ltp_status' => $ltpstatus
            ];
            $this->Laptop_model->insert_laptop($data); // Panggil metode untuk menyimpan data
            redirect('laptop'); // Arahkan kembali ke halaman Laptop
        }
    }

    public function edit($id)
    {
        $data['laptop'] = $this->Laptop_model->get_laptop_by_id($id); // Ambil data berdasarkan ID
        $data['laboratorium'] = $this->Laboratorium_model->get_all_Laboratorium();
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/laptop/updatelaptop'; // Menentukan tampilan form edit
        $this->load->view('templates/template_picasset', $data);
    }

    public function update($id)
    {
        // Validasi input
        $this->form_validation->set_rules('lab_id', 'Laboratorium', 'required');
        $this->form_validation->set_rules('ltp_nomor', 'Nomor Laptop', 'required');
        $this->form_validation->set_rules('ltp_serialnumber', 'Serial Number Laptop', 'required');
        $this->form_validation->set_rules('ltp_tipe', 'Tipe Laptop', 'required');
        $this->form_validation->set_rules('status_tas', 'Status Tas Laptop', 'required');
        $this->form_validation->set_rules('status_charger', 'Status Charger Laptop', 'required');
        $this->form_validation->set_rules('ltp_status', 'Status Laptop', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan ke form edit
            $data['laptop'] = $this->Laptop_model->get_all_Laptop_by_id($id);
            $data['content'] = 'master/laptop/updatelaptop';
            $this->load->view('templates/template_picasset', $data);
        } else {
            // Mengambil data dari form
            $data = [
                'lab_id' => $this->input->post('lab_id'),
                'ltp_nomor' => $this->input->post('ltp_nomor'),
                'ltp_serialnumber' => $this->input->post('ltp_serialnumber'),
                'ltp_tipe' => $this->input->post('ltp_tipe'),
                'status_tas' => $this->input->post('status_tas'),
                'status_charger' => $this->input->post('status_charger'),
                'ltp_status' => $this->input->post('ltp_status')
            ];

            // Memperbarui data berdasarkan ID
            $this->Laptop_model->update_laptop($id, $data);
            redirect('laptop'); // Arahkan kembali ke halaman Laptop
        }
    }

    public function delete($id)
    {
        $this->Laptop_model->delete_laptop($id); // Panggil metode hapus data
        redirect('laptop'); // Arahkan kembali ke halaman Laptop
    }
}
