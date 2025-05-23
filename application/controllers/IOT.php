<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IOT extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library(['email', 'form_validation']);
        $this->load->model('M_iot');
    }

    
    //======================================= SERVER IOT =======================================// 

    public function indexServer() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $data['dashboard'] = $this->M_iot->get_dashboard_data(); 
        $data['locations'] = $this->M_iot->get_locations(); 
        $data['title'] = 'IOT Form';
        $data['content'] = 'iot/index-server';
        $this->load->view('templates/main', $data);
        $this->load->view('templates/v_footer');
        $this->load->view('templates/v_header');
    }

    public function addServer() {
        date_default_timezone_set('Asia/Jakarta');
        $datenow = new \DateTime();
        
        $data = array(
            'location_name' => $this->input->post('location_name'),
            'os_server' => $this->input->post('os_server'),
            'ip_address' => $this->input->post('ip_address'),
            'port' => $this->input->post('port'),
            'iot_category' => $this->input->post('iot_category'),
            'database_username' => $this->input->post('database_username'),
            'database_password' => $this->input->post('database_password'),
            'database_name' => $this->input->post('database_name'),
            'ssh_username' => $this->input->post('ssh_username'),
            'ssh_password' => $this->input->post('ssh_password'),
            'anydesk_id' => $this->input->post('anydesk_id'),
            'anydesk_password' => $this->input->post('anydesk_password'),            
            'implementation_date' => $this->input->post('implementation_date'),      
            'created_at' => $datenow->format('Y-m-d H:i:s'),
            'updated_at' => $datenow->format('Y-m-d H:i:s'),      
        );

        if ($this->M_iot->saveData($data)) {
            $this->session->set_flashdata('success', 'Server IoT Added Successfully');
        } else {
            $this->session->set_flashdata('error', 'Server IoT Failed to Add');
        }
        redirect('iot-server');
    }

    public function delete() {
        $id = $this->input->post('id');
        
        if ($id) {
            if ($this->M_iot->deleteData($id)) {
                $this->session->set_flashdata('success', 'IOT data has been successfully deleted');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete IOT data');
            }
        }
        
        // Redirect kembali ke halaman IOT
        redirect('iot-server');
    }
    //======================================= DDS =======================================// 
    
    //======================================= TDS =======================================// 
    
    //======================================= EB =======================================// 
    
    //======================================= EV =======================================// 

    public function indexEV() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $data['dashboard'] = $this->M_iot->get_dashboard_data_ev(); 
        $data['locations'] = $this->M_iot->get_locations(); 
        $data['title'] = 'IOT Form';
        $data['content'] = 'iot/index-ev';
        $this->load->view('templates/main', $data);
        $this->load->view('templates/v_footer');
        $this->load->view('templates/v_header');
    }

    public function addEV() {
        date_default_timezone_set('Asia/Jakarta');
        $datenow = new \DateTime();
        
        $data = array(
            'location_name' => $this->input->post('location_name'),
            'operation_system' => $this->input->post('os_server'),
            'ip_address' => $this->input->post('ip_address'),
            'port' => $this->input->post('port'),
            'category' => $this->input->post('iot_category'),
            'database_username' => $this->input->post('database_username'),
            'database_password' => $this->input->post('database_password'),
            'database_name' => $this->input->post('database_name'),
            'ssh_username' => $this->input->post('ssh_username'),
            'ssh_password' => $this->input->post('ssh_password'),
            'anydesk_id' => $this->input->post('anydesk_id'),
            'anydesk_password' => $this->input->post('anydesk_password'),            
            'implementation_date' => $this->input->post('implementation_date'),      
            'created_at' => $datenow->format('Y-m-d H:i:s'),
            'updated_at' => $datenow->format('Y-m-d H:i:s'),      
        );

        if ($this->M_iot->saveData_ev($data)) {
            $this->session->set_flashdata('success', 'Server IoT Added Successfully');
        } else {
            $this->session->set_flashdata('error', 'Server IoT Failed to Add');
        }
        redirect('iot-ev');
    }

    public function deleteEV() {
        $id = $this->input->post('id');
        
        if ($id) {
            if ($this->M_iot->deleteData($id)) {
                $this->session->set_flashdata('success', 'IOT data has been successfully deleted');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete IOT data');
            }
        }
        
        // Redirect kembali ke halaman IOT
        redirect('iot-ev');
    }


}
