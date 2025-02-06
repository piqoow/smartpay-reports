<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assigment extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('M_assigment');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $data['title'] = 'Assigment';
        $data['active_page'] = 'assigment';
        $data['dashboard_data_teams'] = $this->M_assigment->get_dashboard_data_teams();
        $data['count_all_data_teams'] = $this->M_assigment->getAllTickets_teams();
        $data['count_data_progress_teams'] = $this->M_assigment->getTicketsInProgress_teams();
        $data['count_data_closed_teams'] = $this->M_assigment->getClosedTickets_teams();
        $data['count_data_cancelled_teams'] = $this->M_assigment->getCancelledTickets_teams();
        $data['content'] = 'assigment/index';

        $this->load->view('templates/main', $data);
        $this->load->view('templates/v_footer');
        $this->load->view('templates/v_header');
    }
}
