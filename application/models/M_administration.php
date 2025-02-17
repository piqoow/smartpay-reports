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
        $query = $this->db->get('petty_cash');
        return $query->result_array();
    }

    public function addPettyCash($data) {
        return $this->db->insert('petty_cash', $data);
    }

    public function updateTransfer($id_pc, $data) {
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
}
