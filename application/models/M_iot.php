<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_iot extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->locations = $this->load->database('locations', TRUE);
    }

    public function get_locations() {
        $query = $this->locations->get('ms_lokasi');
        return $query->result();
    }

    public function insert_issue($data) {
        $this->locations->insert('iot_issues', $data);
        return $this->db->insert_id();
    }

    public function get_all_issues() {
        $query = $this->db->get('iot_issues');
        return $query->result();
    }
}
