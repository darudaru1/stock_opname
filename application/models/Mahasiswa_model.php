<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Fungsi untuk mengambil semua data Mahasiswa dari tabel 'mahasiswa'
    public function get_all_Mahasiswa()
    {
        $query = $this->db->get('mahasiswa'); // Nama tabel di database
        return $query->result_array(); // Mengembalikan data dalam bentuk array
    }

    public function get_all_mahasiswa_with_labs()
    {
        $this->db->select('mahasiswa.*, laboratorium.lab_nomor as lab_nomor'); // Select laboratorium fields and the user name
        $this->db->from('mahasiswa');
        $this->db->join('laboratorium', 'mahasiswa.lab_id = laboratorium.lab_id', 'left'); // Join with the users table
        $query = $this->db->get();
        return $query->result_array(); // Return results as an array
    }

    public function get_mahasiswa_by_id($id)
    {
        $this->db->where('mhs_id', $id);
        $query = $this->db->get('mahasiswa');
        return $query->row_array(); // Mengembalikan satu baris data sebagai array
    }

    public function insert_mahasiswa($data)
    {
        return $this->db->insert('mahasiswa', $data); // Menyimpan data ke tabel mahasiswa
    }

    public function update_mahasiswa($id, $data)
    {
        $this->db->where('mhs_id', $id);
        return $this->db->update('mahasiswa', $data); // Memperbarui data di tabel mahasiswa
    }

    public function delete_mahasiswa($id)
    {
        $this->db->where('mhs_id', $id);
        return $this->db->delete('mahasiswa'); // Menghapus data dari tabel mahasiswa
    }
}
