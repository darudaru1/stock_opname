<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laboratorium_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Fungsi untuk mengambil semua data laboratorium dari tabel 'laboratorium'
    public function get_all_Laboratorium()
    {
        $query = $this->db->get('laboratorium'); // Nama tabel di database
        return $query->result_array(); // Mengembalikan data dalam bentuk array
    }

    public function get_all_laboratorium_with_users()
    {
        $this->db->select('laboratorium.*, user.usr_nama as usr_nama'); // Select laboratorium fields and the user name
        $this->db->from('laboratorium');
        $this->db->join('user', 'laboratorium.usr_id = user.usr_id', 'left'); // Join with the users table
        $query = $this->db->get();
        return $query->result_array(); // Return results as an array
    }


    public function get_laboratorium_by_id($id)
    {
        $this->db->where('lab_id', $id);
        $query = $this->db->get('laboratorium');
        return $query->row_array(); // Mengembalikan satu baris data sebagai array
    }

    public function insert_laboratorium($data)
    {
        return $this->db->insert('laboratorium', $data); // Menyimpan data ke tabel laboratorium
    }

    public function update_laboratorium($id, $data)
    {
        $this->db->where('lab_id', $id);
        return $this->db->update('laboratorium', $data); // Memperbarui data di tabel laboratorium
    }

    public function delete_laboratorium($id)
    {
        $this->db->where('lab_id', $id);
        return $this->db->delete('laboratorium'); // Menghapus data dari tabel laboratorium
    }
}
