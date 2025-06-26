<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_administration extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->locations = $this->load->database('locations', TRUE);
    }

    public function get_locations() {
        $this->locations->order_by('nama_Lokasi', 'ASC');
        $query = $this->locations->get('ms_lokasi');
        return $query->result();
    }

    public function get_all_rekening() {
        $query = $this->db->get('mst_rekening');
        return $query->result_array();
    }

    public function addRekening($data) {
        return $this->db->insert('mst_rekening', $data);
    }
// ======================================= PETTY CASH =======================================  
    public function getAllPettyCash() {
        $query = $this->db->query('SELECT 
        id_pc,
        location_name, 
        po_number,
        request_date,
        request_dana,
        nominal_finance,
        (request_dana - nominal_finance) AS difference,
        rekening_tujuan,
        category_request,
        category_detail,
        bukti_nota,
        status,
        bukti_transfer,
        transfer_date,
        created_at,
        status_finance,
        bukti_finance,
        finance_date
        FROM petty_cash ORDER BY status, status_finance ASC');
        return $query->result_array();
    }


    public function addPettyCash($data) {
        return $this->db->insert('petty_cash', $data);
    }

    public function updateTransfer($id_pc, $data) {
        $this->db->where('id_pc', $id_pc);
        return $this->db->update('petty_cash', $data);
    }

    public function updateTransferFinance($id_pc, $data) {
        $this->db->where('id_pc', $id_pc);
        return $this->db->update('petty_cash', $data);
    }

    public function updatePettyCash($id, $data) {
        $this->db->where('id_pc', $id);
        return $this->db->update('petty_cash', $data);
    }

    public function deletePettyCash($id) {
        $this->db->where('id_pc', $id);
        return $this->db->delete('petty_cash');
    }
    
// ======================================= ADD ONS =======================================  

// ======================================= STOCK ASSET =======================================  
    public function getAllStockAsset() {
        $query = $this->db->query('SELECT 
        id_asset,
        serialnumber_asset,
        model_asset,
        merk_asset,
        id_cat,
        qty,
        asal_barang,
        tujuan_lokasi,
        tgl_masuk_asset,
        tgl_keluar_asset,
        status_asset,
        keperluan_asset,
        nama_penyerahan,
        nama_penerima,
        bukti_tandaterima,
        created_at
        FROM stock_asset');
        return $query->result_array();
    }

    public function addStockAsset($data) {
        return $this->db->insert('stock_asset', $data);
    }

// ======================================= STOCK ASSET =======================================  
    public function getAllDataModem() {
        $query = $this->db->query('SELECT 
        kode_modem,
        lokasi,
        terdaftar,
        user_email,
        password,
        status
        FROM modem_transaction');
        return $query->result_array();
    }

    public function getAllDataLogModem() {
        $query = $this->db->query('SELECT
        id_log,
        kode_modem,
        lokasi,
        tanggal_pinjam,
        tanggal_kembali,
        bukti_pinjam,
        bukti_kembali,
        user_update_kembali
        FROM log_modem_transaction');
        return $query->result_array();
    }

    public function insertMasterData($data)
    {
        return $this->db->insert('modem_transaction', $data);
    }

    public function getModemBySN($sn) {
        $this->db->where('kode_modem', $sn);
        $query = $this->db->get('modem_transaction');
        return $query->row_array();
    }

    public function getLogModemByID($id) {
        $this->db->where('id_log', $id);
        $query = $this->db->get('log_modem_transaction');
        return $query->row_array();
    }

    public function UpdateModemLog($id, $data){
        $this->db->where('id_log', $id);
        return $this->db->update('log_modem_transaction', $data);
    }

    public function insertLogModemTransaction($data){
        return $this->db->insert('log_modem_transaction', $data);
    }
    
    public function updateModemStatus($kode_modem, $status)
    {
        $this->db->where('kode_modem', $kode_modem);
        return $this->db->update('modem_transaction', ['status' => $status]);
    }
}
