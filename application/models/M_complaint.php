<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_complaint extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function saveComplaint($data) {
        return $this->db->insert('tb_complaint', $data);
    }

    public function getComplaintById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('tb_complaint');
        
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
        return $this->db->update('tb_complaint', ['status' => $status]);
    }

    public function updateCategory($id, $newCategory) {
        $this->db->where('id', $id);
        return $this->db->update('tb_complaint', ['category' => $newCategory]);
    }

    public function generateIdTicket() {
        $query = $this->db->query("SELECT MAX(id)+1 AS last_id FROM tb_complaint");
        $row = $query->row();
        $id_ticket = 'HD-' . $row->last_id;
        return $id_ticket;
    }
}
