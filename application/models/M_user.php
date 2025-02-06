<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getUserByUsername($username) {
        $query = $this->db->get_where('tb_user', ['username' => $username]);
        return $query->row_array();
    }

    public function getAllUsers() {
        $query = $this->db->get('tb_user');
        return $query->result_array();
    }

    public function addUser($data) {
        return $this->db->insert('tb_user', $data);
    }

    public function updateUser($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('tb_user', $data);
    }

    public function deleteUser($id) {
        $this->db->where('id', $id);
        return $this->db->delete('tb_user');
    }
}
