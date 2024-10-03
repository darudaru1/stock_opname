<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periode_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Fungsi untuk mengambil semua data periode dari tabel 'periode'
    public function get_all_periode()
    { 
        $query = $this->db->get('periode'); // Nama tabel di database
        return $query->result_array(); // Mengembalikan data dalam bentuk array
    }

    public function get_periode_by_id($id)
    {
        $this->db->where('prd_id', $id);
        $query = $this->db->get('periode');
        return $query->row_array(); // Mengembalikan satu baris data sebagai array
    }

    public function insert_periode($data)
    {
        return $this->db->insert('periode', $data); // Menyimpan data ke tabel periode
    }

    public function update_periode($id, $data)
    {
        $this->db->where('prd_id', $id);
        return $this->db->update('periode', $data); // Memperbarui data di tabel periode
    }

    public function delete_periode($id)
    {
        $this->db->where('prd_id', $id);
        return $this->db->delete('periode'); // Menghapus data dari tabel periode
    }
}
