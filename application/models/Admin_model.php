<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    // Tampil data kas umum
    public function getKasUmum() {
        return $this->db->get('tb_kas')->result_array(); // Ambil semua data kas
    }

    // Tampil jumlah transaksi
    public function getJumlahTransaksi() {
        return $this->db->count_all('tb_kas'); // Menghitung total transaksi
    }

    // Tampil total kas masuk
    public function getTotalKasMasuk() {
        $this->db->select_sum('kas_masuk');
        $result = $this->db->get('tb_kas')->row_array();
        return $result['kas_masuk'];
    }

    // Tampil total kas keluar
    public function getTotalKasKeluar() {
        $this->db->select_sum('kas_keluar');
        $result = $this->db->get('tb_kas')->row_array();
        return $result['kas_keluar'];
    }

    public function getRoleById($id)
    {
        return $this->db->get_where('user_role', ['id' => $id])->row_array(); //where=select * from //field id didalam tabel sama dengan id yg dlkirm di parameter //result array hasilnya array //row hanya sebaris/satu elemen
    }

    public function ubahRole()
    {
        $data = [
            'role' => $this->input->post('role'),
        ];

        $this->db->where('id', $this->input->post('id')); //ini bukan $id tp ngambil dr input hidden
        $this->db->update('user_role', $data);
          
        
    }
    
    public function deleteRole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
        
    }

    public function addRole()
    {
        $data = [
            'role' => $this->input->post('role', true),
        ];

        $this->db->insert('user_role', $data);
    }
    
}
?>