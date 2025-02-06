<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_task extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->locations = $this->load->database('locations', TRUE);
    }

    public function get_daily_task() {
        $this->db->select('*');
        $this->db->from('smartpay_task');
        $this->db->order_by('created_at', 'ASC'); 
        $query = $this->db->get();
        return $query->result();
    }

    public function get_dashboard_task() {
        $this->db->select('*');
        $this->db->from('smartpay_task');
        $this->db->order_by('created_at', 'ASC'); 
        $query = $this->db->get();
        return $query->result();
    }

    public function get_locations() {
        $this->locations->order_by('nama_Lokasi', 'ASC');
        $query = $this->locations->get('ms_lokasi');
        return $query->result();
    }

    public function saveData($data) {
        $this->db->insert('smartpay_task', $data);
        return $this->db->insert_id();
    }

    public function get_all_issues() {
        $query = $this->db->get('iot_system');
        return $query->result();
    }

    public function deleteData($id) {
        $this->db->where('id_iot', $id);
        return $this->db->delete('iot_system');
    }

    //======================================= PGS =======================================// 
}
