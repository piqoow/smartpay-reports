<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_request extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function saveRequest($data) {
        return $this->db->insert('tb_request', $data);
    }

    public function getRequestById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('tb_request');
        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function getLastInsertedId() {
        return $this->db->insert_id();
    }

    public function updateStatus($id, $status) {
        $this->db->where('id', $id);
        return $this->db->update('tb_request', ['status' => $status]);
    }

    public function updateCategory($id, $newCategory) {
        $this->db->where('id', $id);
        return $this->db->update('tb_request', ['category' => $newCategory]);
    }

    public function generateIdTicket() {
        $query = $this->db->query("SELECT MAX(id)+1 AS last_id FROM tb_request");
        $row = $query->row();
        $id_ticket = 'HD-' . $row->last_id;
        return $id_ticket;
    }
}
