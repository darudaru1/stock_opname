<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the session library
        $this->load->model('User_model'); // Load model
        $this->load->library('session');
        $this->load->helper('form'); // Memuat helper form
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['user'] = $this->User_model->get_active_users(); // Ambil data user dari model
        $data['inactive'] = false; // Set inactive ke false karena menampilkan pengguna aktif
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/user/viewuser'; // Menentukan tampilan yang akan dimuat di dalam template
        $this->load->view('templates/template_picasset', $data);
    }

    public function inactive_users()
    {
        $data['user'] = $this->User_model->get_inactive_users(); // Ambil pengguna yang statusnya 'Tidak Aktif'
        $data['inactive'] = true; // Set inactive ke true karena menampilkan pengguna tidak aktif
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/user/viewuser'; // Menampilkan template yang sama
        $this->load->view('templates/template_picasset', $data);
    }


    public function add()
    {
        $data['user'] = $this->User_model->get_all_user(); // Ambil data user dari model
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/user/adduser'; // Menentukan tampilan yang akan dimuat di dalam template
        $this->load->view('templates/template_picasset', $data);
    }

    public function store()
    {
        // Mengambil data dari form
        $nomoruser = $this->input->post('usr_no');
        $namauser = $this->input->post('usr_nama');
        $roleuser = $this->input->post('role');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Validasi input
        $this->form_validation->set_rules('usr_no', 'Nomor User', 'required');
        $this->form_validation->set_rules('usr_nama', 'Nama User', 'required');
        $this->form_validation->set_rules('role', 'Role User', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, kembalikan data input ke form
            $data['usr_nama'] = $this->session->userdata('usr_nama');
            $data['role'] = $this->session->userdata('role');
            $data['content'] = 'master/user/adduser'; // Menentukan tampilan
            $data['user_input'] = [
                'usr_no' => $nomoruser,
                'usr_nama' => $namauser,
                'role' => $roleuser,
                'username' => $username,
                'password' => $password,
            ];
            $this->load->view('templates/template_picasset', $data); // Tampilkan kembali form dengan data yang telah diisi
        } else {
            // Simpan data ke database
            $data = [
                'usr_no' => $nomoruser,
                'usr_nama' => $namauser,
                'role' => $roleuser,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT), // Hash password sebelum disimpan
                'status' => 'Aktif'
            ];
            $this->User_model->insert_user($data); // Panggil metode untuk menyimpan data
            redirect('user'); // Arahkan kembali ke halaman user
        }
    }

    public function edit($id)
    {
        $data['user'] = $this->User_model->get_user_by_id($id); // Ambil data berdasarkan ID
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');
        $data['content'] = 'master/user/updateuser'; // Menentukan tampilan form edit
        $this->load->view('templates/template_picasset', $data);
    }

    public function update($id)
    {
        // Validasi input
        $this->form_validation->set_rules('usr_no', 'Nomor User', 'required');
        $this->form_validation->set_rules('usr_nama', 'Nama User', 'required');
        $this->form_validation->set_rules('role', 'Role User', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['user'] = $this->User_model->get_user_by_id($id);
            $data['role'] = $this->session->userdata('role');
            $data['content'] = 'master/user/updateuser';
            $this->load->view('templates/template_picasset', $data);
        } else {
            // Mengambil data dari form
            $data = [
                'usr_no' => $this->input->post('usr_no'),
                'usr_nama' => $this->input->post('usr_nama'),
                'role' => $this->input->post('role'),
            ];

            // Memperbarui data berdasarkan ID
            $this->User_model->update_user($id, $data);
            redirect('user'); // Arahkan kembali ke halaman user
        }
    }

    public function delete($id)
    {
        // Ubah status menjadi "Tidak Aktif"
        $data = [
            'status' => 'Tidak Aktif'
        ];

        // Memperbarui data berdasarkan ID
        $this->User_model->update_user($id, $data);

        // Redirect ke halaman user setelah pengubahan status
        redirect('user');
    }
}
