<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('email');
        $this->load->library('session');
        $this->load->model('M_request');

        $config = array(            
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.mail.yahoo.com',
            'smtp_port' => 587,
            'smtp_user' => 'cs.ho@centreparkcorp.com',
            'smtp_pass' => 'sqzqhvsrzwyoatoy',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'smtp_crypto' => 'tls'
        );
        $this->email->initialize($config);
    }

    public function index() {
        $data = [
            'title' => 'Request Form',
            // 'active_page' => 'request',
            'content' => 'request/index'
        ];

        $this->load->view('templates/main', $data);
    }

    
    // input database
    public function submit_request() {
        $priority = $this->input->post('priority');
        date_default_timezone_set('Asia/Jakarta');
        $deadline = date('Y-m-d');
        
        switch($priority) {
            case 'High':
                $deadline = date('Y-m-d', strtotime('+2 days'));
                break;
            case 'Medium': 
                $deadline = date('Y-m-d', strtotime('+4 days'));
                break;
            case 'Low':
                $deadline = date('Y-m-d', strtotime('+6 days'));
                break;
        }
    
        $last_id = $this->M_request->generateIdTicket();
        $id_ticket = $last_id;
    
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx|xls|xlsx|txt';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
    
        $file_name = '';
        if ($this->upload->do_upload('file')) {
            $file_data = $this->upload->data();
            $file_name = $file_data['file_name'];
        } else {
            $file_name = NULL;
        }
    
        $data = array(
            'reporter_name' => $this->input->post('reporter_name'),
            'reporter_email' => $this->input->post('reporter_email'),
            'reporter_phone' => $this->input->post('reporter_phone'),
            'request_date' => $this->input->post('request_date'),
            'category' => $this->input->post('category'),
            'location' => $this->input->post('location'),
            'priority' => $priority,
            'request_title' => $this->input->post('request_title'),
            'request_description' => $this->input->post('request_description'),
            'deadline_date' => $deadline,
            'user_update' => $this->session->userdata('username'),
            'id_ticket' => $id_ticket,
            'file_name' => $file_name
        );
    
        if ($this->M_request->saveRequest($data)) {
            $data['id'] = $this->M_request->getLastInsertedId();
            
            if ($file_name) {
                $this->M_request->saveFileName($data['id'], $file_name);
            }
    
            $this->sendEmail($data['reporter_email'], $data['category'], $data, $file_name);
    
            $this->session->set_flashdata('success', 'The request was successfully sent');
        } else {
            $this->session->set_flashdata('error', 'Request failed to send');
        }
    
        redirect('request');
    }
    
    private function sendEmail($to, $category, $data, $file_name) {
        $category_email = array(
            'Network' => 'raharja.permana@centreparkcorp.com',
            'Parkee System' => 'rofiq.rifiansyah@centreparkcorp.com',
            'IOT System' => ['tejo.wurianto@centreparkcorp.com', 'deny.ruswandy@centreparkcorp.com','topik.gunawan@centreparkcorp.com'],
            'Infra' => 'm.fahmi@centreparkcorp.com',
            'IT Support' => ['harry.djohardin@centreparkcorp.com', 'moh.hamam@centreparkcorp.com'],
            // 'IT Support' => 'harry.djohardin@centreparkcorp.com',
        );
    
        $category_email_cc = array(
            'Network' => 'rofik47@gmail.com',
            'Parkee System' => 'rofiq.rifiansyah@centreparkcorp.com',
            'IOT System' => ['rofik47@gmail.com'],
            'Infra' => 'rofik47@gmail.com',
            'IT Support' => 'rofik47@gmail.com',
        );
    
        $cc_email = array_merge(['rofiq.rifiansyah@centreparkcorp.com', $this->session->userdata('user_email')]);
        $cc_emails_string = implode(',', $cc_email);
        $cc =  $cc_emails_string;
    
        $this->email->from('cs.ho@centreparkcorp.com', 'Helpdesk Admin');
        $this->email->to($category_email[$category]);
        $this->email->cc($cc);
    
        $this->email->subject($data['request_title']);
        $link = base_url("request/detail/" . $data['id']);

        $file_url = base_url('uploads/' . $file_name);
    
        $message = "<h3>Request Report Data</h3>";
        $message .= "<p><strong>Ticket Number :</strong> {$data['id_ticket']}</p>";
        $message .= "<p><strong>Reporter Name:</strong> {$data['reporter_name']}</p>";
        $message .= "<p><strong>Reporter Email:</strong> {$data['reporter_email']}</p>";
        $message .= "<p><strong>Reporter Phone:</strong> {$data['reporter_phone']}</p>";
        $message .= "<p><strong>Request Date:</strong> {$data['request_date']}</p>";
        $message .= "<p><strong>Request Description:</strong><br>{$data['request_description']}</p>";
        
        $message .= "<p><strong>File :</strong> <a href='{$file_url}' style='background-color: #4CAF50; color: white; padding: 3px 10px; text-decoration: none; display: inline-block;'>View</a></p>";
        
        // $message .= "<p><a href='{$link}' style='background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; display: inline-block;'>View and Update Status</a></p>";
    
        $this->email->message($message);
    
        if (!$this->email->send()) {
            echo $this->email->print_debugger();
        }
    }
    

    // view detail complaint
    public function detail($id) {
        $this->load->model('M_Request');
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('login');
        // }
        $request = $this->M_Request->getRequestById($id);
        if (!$request) {
            show_404();
        }
    
        $data = [
            'title' => 'Detail Request',
            'request' => $request
        ];
        $this->load->view('request/detail', $data);
    }

    // update status
    public function update_status($id) {
        $status = $this->input->post('status');
        date_default_timezone_set('Asia/Jakarta');
        if ($this->M_Request->updateStatus($id, $status)) {
            $complaint = $this->M_Request->getComplaintById($id);
            
            $log_data = array(
                'id' => $id,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s')
            );
            $this->insertLogUpdate($log_data);
            
            $this->sendStatusUpdateEmail($complaint);
            
            $this->session->set_flashdata('success', 'Status updated successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to update status.');
        }
        
        redirect('request/detail/' . $id);
        
    }

    public function insertLogUpdate($data) {
        $this->db->insert('log_update', $data);
        return $this->db->affected_rows() > 0;
    }
    
    // send email update status
    private function sendStatusUpdateEmail($request) {
        $this->email->from('cs.ho@centreparkcorp.com', 'Helpdesk Admin');
        $this->email->to($request['reporter_email']);
        $this->email->subject("Update on Your request: " . $request['issue_title']);
        
        $message = "<p>Dear {$request['reporter_name']},</p>";
        $message .= "<p>Your request with the title '{$request['issue_title']}' has been updated to status: <strong>{$request['status']}</strong>.</p>";
        $message .= "<p>Thank you for your patience.</p>";
        $message .= "<p>Best regards,<br>Helpdesk Centrepark</p>";
    
        $this->email->message($message);
    
        if (!$this->email->send()) {
            echo $this->email->print_debugger();
        }
    }
    
    //update category and send email to correct tim
    public function redirectRequest($id) {
        $newCategory = $this->input->post('new_category');
        if ($this->M_Request->updateCategory($id, $newCategory)) {
            $request = $this->M_Request->getRequestById($id);
            
            $this->sendEmail($request['reporter_email'], $newCategory, $request);
            
            $this->session->set_flashdata('success', 'request successfully redirected to the correct team.');
        } else {
            $this->session->set_flashdata('error', 'Failed to redirect request.');
        }
        
        redirect('request/detail/' . $id);
    }    
}
