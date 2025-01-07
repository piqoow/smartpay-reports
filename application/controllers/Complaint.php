<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Complaint extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('email');
        $this->load->model('M_complaint');

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
            'title' => 'Complaint Form',
            'content' => 'complaint/index'
        ];

        $this->load->view('templates/main', $data);
    }

    
    // input database
    public function submit_complaint() {
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

        $last_id = $this->M_complaint->generateIdTicket();
        $id_ticket = $last_id;

        $data = array(
            'reporter_name' => $this->input->post('reporter_name'),
            'reporter_email' => $this->input->post('reporter_email'), 
            'reporter_phone' => $this->input->post('reporter_phone'),
            'issue_date' => $this->input->post('issue_date'),
            'category' => $this->input->post('category'),
            'location' => $this->input->post('location'),
            'priority' => $priority,
            'issue_title' => $this->input->post('issue_title'),
            'issue_description' => $this->input->post('issue_description'),
            'deadline_date' => $deadline,
            'user_update' => $this->session->userdata('username'),
            'id_ticket' => $id_ticket
        );

        if ($this->M_complaint->saveComplaint($data)) {
            $data['id'] = $this->M_complaint->getLastInsertedId();
            $this->sendEmail($data['reporter_email'], $data['category'], $data);
            $this->session->set_flashdata('success', 'The complaint was successfully sent');
        } else {
            $this->session->set_flashdata('error', 'Complaint failed to send');
        }

        redirect('complaint');
    }

    // send email complaint
    private function sendEmail($to, $category, $data) {

        $category_email = array(
            'Network' => 'raharja.permana@centreparkcorp.com',
            // 'Parkee System' => 'rofiq.rifiansyah@centreparkcorp.com',
            'IOT System' => ['tejo.wurianto@centreparkcorp.com', 'deny.ruswandy@centreparkcorp.com','topik.gunawan@centreparkcorp.com'],
            'Infra' => 'm.fahmi@centreparkcorp.com',
            'IT Support' => 'rofiq.rifiansyah@centreparkcorp.com',
        );

        $category_email_cc = array(
            'Network' => 'raharja.permana@centreparkcorp.com',
            // 'Parkee System' => 'rofiq.rifiansyah@centreparkcorp.com',
            'IOT System' => ['tejo.wurianto@centreparkcorp.com', 'deny.ruswandy@centreparkcorp.com'],
            'Infra' => 'm.fahmi@centreparkcorp.com',
            'IT Support' => ['harry.djohardin@centreparkcorp.com', 'moh.hamam@centreparkcorp.com'],
            // 'IT Support' => 'harry.djohardin@centreparkcorp.com',
        );

        $cc_email = array_merge(['rofiq.rifiansyah@centreparkcorp.com', $this->session->userdata('user_email')]);
        $cc_emails_string = implode(',', $cc_email);
        $cc =  $cc_emails_string;

        // $cc = [''];
        $this->email->from('cs.ho@centreparkcorp.com', 'Helpdesk Admin');
        $this->email->to($category_email[$category]);
        $this->email->cc($cc);
        // $this->email->cc($category_email_cc[$category]);

        $this->email->subject($data['issue_title']);
        $link = base_url("complaint/detail/" . $data['id']);
        $message = "<h3>Complaint Report Data</h3>";
        $message .= "<p><strong>Ticket Number :</strong> {$data['id_ticket']}</p>";
        $message .= "<p><strong>Reporter Name :</strong> {$data['reporter_name']}</p>";
        $message .= "<p><strong>Reporter Email :</strong> {$data['reporter_email']}</p>";
        $message .= "<p><strong>Reporter Phone :</strong> {$data['reporter_phone']}</p>";
        $message .= "<p><strong>Location Name :</strong> {$data['location']}</p>";
        $message .= "<p><strong>Issue Date :</strong> {$data['issue_date']}</p>";
        $message .= "<p><strong>Issue Description :</strong><br>{$data['issue_description']}</p>";
        $message .= "<p><strong>Deadline Date :</strong><br>{$data['deadline_date']}</p>";
        $message .= "<p><strong>Priority :</strong><br>{$data['priority']}</p>";
        $message .= "<p><a href='{$link}' style='background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; display: inline-block;'>View and Update Status</a></p>";

        $this->email->message($message);


        if (!$this->email->send()) {
            echo $this->email->print_debugger();
        }
    }

    // view detail complaint
    public function detail($id) {
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('login');
        // }
        $complaint = $this->M_complaint->getComplaintById($id);
        if (!$complaint) {
            show_404();
        }
    
        $data = [
            'title' => 'Complaint Details',
            'complaint' => $complaint
        ];
        $this->load->view('complaint/detail', $data);
    }

    // update satatus
    public function update_status($id) {
        $status = $this->input->post('status');
        date_default_timezone_set('Asia/Jakarta');
        if ($this->M_complaint->updateStatus($id, $status)) {
            $complaint = $this->M_complaint->getComplaintById($id);
            
            // Insert ke tabel log_update
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
        
        redirect('complaint/detail/' . $id);
    }

    public function insertLogUpdate($data) {
        $this->db->insert('log_update', $data);
        return $this->db->affected_rows() > 0;
    }
    
    // send email update status
    private function sendStatusUpdateEmail($complaint) {
        $this->email->from('cs.ho@centreparkcorp.com', 'Helpdesk Admin');
        $this->email->to($complaint['reporter_email']);
        $this->email->subject("Update on Your Complaint: " . $complaint['issue_title']);
        
        $message = "<p>Dear {$complaint['reporter_name']},</p>";
        $message .= "<p>Your complaint with the title '{$complaint['issue_title']}' has been updated to status: <strong>{$complaint['status']}</strong>.</p>";
        $message .= "<p>Thank you for your patience.</p>";
        $message .= "<p>Best regards,<br>Helpdesk Centrepark</p>";
    
        $this->email->message($message);
    
        if (!$this->email->send()) {
            echo $this->email->print_debugger();
        }
    }
    
    //update category and send email to correct tim
    public function redirectComplaint($id) {
        $newCategory = $this->input->post('new_category');
        if ($this->M_complaint->updateCategory($id, $newCategory)) {
            $complaint = $this->M_complaint->getComplaintById($id);
            
            $this->sendEmail($complaint['reporter_email'], $newCategory, $complaint);
            
            $this->session->set_flashdata('success', 'Complaint successfully redirected to the correct team.');
        } else {
            $this->session->set_flashdata('error', 'Failed to redirect complaint.');
        }
        
        redirect('complaint/detail/' . $id);
    }




    
}
