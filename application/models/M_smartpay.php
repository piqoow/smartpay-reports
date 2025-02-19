<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_smartpay extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAllSystem() {
        $query = $this->db->get('smartpay_system');
        return $query->result_array();
    }

    public function addSystem($data) {
        return $this->db->insert('smartpay_system', $data);
    }
}
