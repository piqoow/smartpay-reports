<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
        $this->load->model('M_task');
    }
    
    //======================================= Daily Task =======================================// 

    public function indexDaily() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $username = $this->session->userdata('username');
        $userlevel = $this->session->userdata('user_level');

        if ($userlevel == 'dev' || $userlevel == 'Manager') {
            $data['daily'] = $this->M_task->get_daily_task(); 
            $data['usernames'] = $this->M_task->get_all_username(); 
            $data['title'] = 'Daily Task Form';
            $data['content'] = 'task/daily-task';
            $this->load->view('templates/main', $data);
            $this->load->view('templates/v_footer');
            $this->load->view('templates/v_header');
        } else {
            $data['daily'] = $this->M_task->get_daily_task_by_username(); 
            $data['title'] = 'Daily Task Form';
            $data['content'] = 'task/daily-task';
            $this->load->view('templates/main', $data);
            $this->load->view('templates/v_footer');
            $this->load->view('templates/v_header');
        }
    }

    public function addDaily() {
        date_default_timezone_set('Asia/Jakarta');
        $datenow = new \DateTime();
        
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10240; // 10MB
        $this->load->library('upload', $config);
    
        if (!empty($_FILES['file_name']['name'])) {
            if (!$this->upload->do_upload('file_name')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('daily-task');
                return;
            } else {
                $uploadData = $this->upload->data();
                $filePath = 'uploads/' . $uploadData['file_name'];
            }
        } else {
            $filePath = null;
        }
    
        $data = array(
            'name_task' => $this->input->post('name_task'),
            // 'owner_task' => $this->input->post('username'),
            'owner_task' => $this->session->userdata('username'),
            'user_teams' => $this->session->userdata('user_teams'),
            'location_name' => $this->input->post('location_name'),
            'category_task' => $this->input->post('category_task'),
            'system_category' => $this->input->post('system_category'),
            'priority_task' => 'Daily',
            'status_task' => $this->input->post('status_task'),
            'startdate_task' => $this->input->post('startdate_task'),
            'enddate_task' => $this->input->post('startdate_task'),
            'starttime_task' => $this->input->post('starttime_task'),
            'endtime_task' => $this->input->post('endtime_task'),
            'report_task' => $this->input->post('report_task'),
            'outstanding_task' => $this->input->post('outstanding_task'),
            'file_name' => $filePath,
            'constraint_task' => $this->input->post('constraint_task'),
            'reason_task' => $this->input->post('reason_task'),
            'created_at' => $datenow->format('Y-m-d H:i:s'),
            'updated_at' => $datenow->format('Y-m-d H:i:s'),
        );
    
        if ($this->M_task->saveData($data)) {
            $this->session->set_flashdata('success', 'Task was successfully added');
        } else {
            $this->session->set_flashdata('error', 'Task failed to add');
        }
        redirect('daily-task');
    }
    

    public function deleteDaily() {
        $id = $this->input->post('id');
        
        if ($id) {
            if ($this->M_iot->deleteData($id)) {
                $this->session->set_flashdata('success', 'Task data has been successfully deleted');
            } else {
                $this->session->set_flashdata('error', 'Failed to delete Task data');
            }
        }
        
        redirect('iot');
    }
    
    //======================================= Dashboard Task =======================================// 

    public function indexDashboard() {
        // Fetch locations from model
        $data['dashboard'] = $this->M_iot->get_dashboard_data(); 
        $data['locations'] = $this->M_iot->get_locations(); 
        $data['title'] = 'IOT PGS Form';
        $data['content'] = 'iot/index-pgs';
        $this->load->view('templates/main', $data);
    }

    public function addPGS() {
        date_default_timezone_set('Asia/Jakarta');
        
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
        );

        if ($this->M_iot->saveData($data)) {
            $this->session->set_flashdata('success', 'The complaint was successfully sent');
        } else {
            $this->session->set_flashdata('error', 'Complaint failed to send');
        }
        redirect('iot');
    }

    public function deletePGS() {
        // Ambil ID dari input POST
        $id = $this->input->post('id');
        
        // Pastikan ID valid
        if ($id) {
            // Panggil fungsi deleteData pada model untuk menghapus data berdasarkan ID
            if ($this->M_iot->deleteData($id)) {
                // Beri feedback sukses jika berhasil dihapus
                $this->session->set_flashdata('success', 'IOT data has been successfully deleted');
            } else {
                // Jika gagal, beri feedback error
                $this->session->set_flashdata('error', 'Failed to delete IOT data');
            }
        }
        
        // Redirect kembali ke halaman IOT
        redirect('iot');
    }

    //======================================= DDS =======================================// 
    
    //======================================= TDS =======================================// 
    
    //======================================= EB =======================================// 
}
