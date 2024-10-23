<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    // Fungsi untuk memasukkan data kas
    public function insert_kas($data)
    {
        $this->db->insert('tb_kas', $data);
    }

    public function delete_data($id_kas)
    {
        $this->db->where('id_kas', $id_kas);
        $this->db->delete('tb_kas');
        
    }
    
    
    // Fungsi untuk mengambil id_kas terakhir dan membuat kode urut baru
    public function generateKasCode($prefix = 'KS') {
        // Ambil id_kas terakhir dari tabel tb_kas
        $this->db->select('id_kas');
        $this->db->order_by('id_kas', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_kas');

        if ($query->num_rows() > 0) {
            $lastId = $query->row()->id_kas;
            // Mengambil urutan angka dari id terakhir
            $lastNumber = (int)substr($lastId, 2); // Ambil angka dari karakter ketiga
            $newNumber = $lastNumber + 1; // Tambah 1 ke nomor terakhir
        } else {
            // Jika belum ada id_kas, set nilai urutan menjadi 1
            $newNumber = 1;
        }

        // Buat format kode dengan prefix dan tambahkan leading zero jika perlu
        $newId = $prefix . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        
        return $newId;
    }

    // Fungsi untuk menghasilkan nomor bukti kas masuk (MSK)
    public function generateNoBuktiKasMasuk() {
        // Ambil no_bukti terakhir dari tabel tb_kas_masuk (atau tabel yang relevan)
        $this->db->select('no_bukti');
        $this->db->order_by('no_bukti', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_kas');
    
        if ($query->num_rows() > 0) {
            $lastNoBukti = $query->row()->no_bukti;
            $lastNumber = (int)substr($lastNoBukti, 3); // Ambil angka setelah karakter ketiga
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
    
        // Buat format nomor bukti baru dengan prefix 'MSK'
        $newNoBukti = 'MSK' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    
        return $newNoBukti;
    }
    

    // Fungsi untuk menghasilkan nomor bukti kas keluar (KLR)
    public function generateNoBuktiKasKeluar() {
       // Ambil no_bukti terakhir dari tabel tb_kas_masuk (atau tabel yang relevan)
       $this->db->select('no_bukti');
       $this->db->order_by('no_bukti', 'DESC');
       $this->db->limit(1);
       $query = $this->db->get('tb_kas');
   
       if ($query->num_rows() > 0) {
           $lastNoBukti = $query->row()->no_bukti;
           $lastNumber = (int)substr($lastNoBukti, 3); // Ambil angka setelah karakter ketiga
           $newNumber = $lastNumber + 1;
       } else {
           $newNumber = 1;
       }
   
       // Buat format nomor bukti baru dengan prefix 'MSK'
       $newNoBukti = 'KLR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
   
       return $newNoBukti;
    }

    public function getKasById($id_kas)
    {
        return $this->db->get_where('tb_kas', ['id_kas' => $id_kas])->row_array(); 
    }

    public function ubahKas()
    {
        $data = [
            'tanggal' => $this->input->post('tanggal'),   
            'no_bukti' => $this->input->post('no_bukti'),
            'uraian' => $this->input->post('uraian'),
            'kas_masuk' => $this->input->post('kas_masuk')
        ];

        $this->db->where('id_kas', $this->input->post('id_kas')); //ini bukan $id tp ngambil dr input hidden
        $this->db->update('tb_kas', $data);
          
    }
    
    public function ubah()
    {
        $data = [
            'tanggal' => $this->input->post('tanggal'),   
            'no_bukti' => $this->input->post('no_bukti'),
            'uraian' => $this->input->post('uraian'),
            'kas_keluar' => $this->input->post('kas_keluar')
        ];

        $this->db->where('id_kas', $this->input->post('id_kas')); //ini bukan $id tp ngambil dr input hidden
        $this->db->update('tb_kas', $data);
          
    }

        public function getdataKas($limit, $start)
    {
        $this->db->limit($limit, $start);
        return $this->db->get('tb_kas')->result_array();
    }


   
   
}