<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_assetmanagement extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

// ======================================= STOCK ASSET =======================================  
    public function getAllCategoryAsset() {
        $query = $this->db->query('SELECT 
        id_category,
        nama_barang
        FROM asset_category');
        return $query->result_array();
    }

    public function getStockByIdCategory($id_category)
    {
        return $this->db->get_where('asset_stock', ['id_category' => $id_category])->row_array();
    }
    
    public function updateAssetStock($id_category, $data)
    {
        $this->db->where('id_category', $id_category);
        return $this->db->update('asset_stock', $data);
    }

    public function insertAssetStock($data)
    {
        return $this->db->insert('asset_stock', $data);
    }

    public function insertAssetCategory($data)
    {
        return $this->db->insert('asset_category', $data);
    }

    public function getAllStockAsset() {
        $query = $this->db->query('SELECT 
        id_st,
        id_category,
        nama_barang,
        jumlah,
        tanggal_update,
        jumlah_keluar,
        jumlah_pinjam,
        jumlah_pinjam+jumlah as total,
        created_at
        FROM asset_stock');
        return $query->result_array();
    }

    public function addStockIncoming($data) {
        return $this->db->insert('asset_incoming', $data);
    }

    public function addStockAsset($data_stock) {
        return $this->db->insert('asset_stock', $data_stock);
    }

    public function getStockIncoming() {
        $query = $this->db->query('SELECT 
        id_in,
        nama_barang,
        jumlah,
        keperluan,
        tanggal,
        penerima,
        bukti_terima,
        user_input,
        created_at
        FROM asset_incoming');
        return $query->result_array();$data_stock = [
            'id_category' => $this->input->post('id_category'),
            'nama_barang' => $this->input->post('nama_barang'),
            'jumlah' => $this->input->post('jumlah'),
            'jumlah_keluar' => $this->input->post('jumlah_keluar'),
            'jumlah_pinjam' => $this->input->post('jumlah'),
            'tanggal_update' => $datenow,
        ];
    }

    public function outStockAsset($data) {
        return $this->db->insert('asset_outgoing', $data);
    }

    public function getStockOutgoing() {
        $query = $this->db->query('SELECT 
        id_out,
        nama_barang,
        tujuan,
        jumlah,
        status,
        tanggal,
        pengirim,
        bukti_terima,
        penerima_pengembalian,
        bukti_pengembalian,
        tanggal_pengembalian,
        user_input,
        created_at,
        updated_at
        FROM asset_outgoing');
        return $query->result_array();
    }
    
    public function updateOutgoing($id_out, $data) {
        $this->db->where('id_out', $id_out);
        $this->db->update('asset_outgoing', $data);

        return $this->db->affected_rows() > 0;
    }
}
