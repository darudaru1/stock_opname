<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Fungsi untuk mengambil semua data User dari tabel 'user'
    public function get_all_user()
    {
        $query = $this->db->get('user'); // Nama tabel di database
        return $query->result_array(); // Mengembalikan data dalam bentuk array
    }

    public function get_inactive_users()
    {
        // Ambil hanya pengguna yang statusnya 'Tidak Aktif'
        $this->db->where('status', 'Tidak Aktif');
        return $this->db->get('user')->result_array();
    }

    public function get_active_users()
    {
        // Mengambil data pengguna dengan status "Aktif" dari database
        $this->db->where('status', 'Aktif');
        $query = $this->db->get('user');
        return $query->result_array();
    }


    public function get_user_by_id($id)
    {
        $this->db->where('usr_id', $id);
        $query = $this->db->get('user');
        return $query->row_array(); // Mengembalikan satu baris data sebagai array
    }

    public function insert_user($data)
    {
        return $this->db->insert('user', $data); // Menyimpan data ke tabel user
    }

    public function update_user($id, $data)
    {
        $this->db->where('usr_id', $id);
        return $this->db->update('user', $data); // Memperbarui data di tabel user
    }

    public function delete_user($id)
    {
        $this->db->where('usr_id', $id);
        return $this->db->delete('user'); // Menghapus data dari tabel user
    }
}
