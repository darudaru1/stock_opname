<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PicAsset extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the session library

        $this->load->library('session');
    }

    public function index()
    {

        // Retrieve user name from session
        $data['usr_nama'] = $this->session->userdata('usr_nama');
        $data['role'] = $this->session->userdata('role');

        // Cek apakah session berisi data user_name
        if (!$data['usr_nama']) {
            echo "Data usr_nama tidak ditemukan di session.";
            return;
        }

        // Muat template dan kirim nama view konten
        $data['content'] = 'dashboard/picasset'; // Menentukan tampilan yang akan dimuat di dalam template
        $this->load->view('templates/template_picasset', $data);
    }
}
