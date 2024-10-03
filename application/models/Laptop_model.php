<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laptop_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Fungsi untuk mengambil semua data Laptop dari tabel 'Laptop'
    public function get_all_Laptop()
    {
        $query = $this->db->get('laptop'); // Nama tabel di database
        return $query->result_array(); // Mengembalikan data dalam bentuk array
    }

    public function get_all_laptop_with_labs()
    {
        $this->db->select('laptop.*, laboratorium.lab_nomor as lab_nomor'); // Select laboratorium fields and the user name
        $this->db->from('laptop');
        $this->db->join('laboratorium', 'laptop.lab_id = laboratorium.lab_id', 'left'); // Join with the users table
        $query = $this->db->get();
        return $query->result_array(); // Return results as an array
    }

    public function get_laptop_by_id($id)
    {
        $this->db->where('ltp_id', $id);
        $query = $this->db->get('laptop');
        return $query->row_array(); // Mengembalikan satu baris data sebagai array
    }

    public function insert_laptop($data)
    {
        return $this->db->insert('laptop', $data); // Menyimpan data ke tabel Laptop
    }

    public function update_laptop($id, $data)
    {
        $this->db->where('ltp_id', $id);
        return $this->db->update('laptop', $data); // Memperbarui data di tabel Laptop
    }

    public function delete_laptop($id)
    {
        $this->db->where('ltp_id', $id);
        return $this->db->delete('laptop'); // Menghapus data dari tabel Laptop
    }
}
