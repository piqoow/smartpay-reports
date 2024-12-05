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
        $data = array(
            'reporter_name' => $this->input->post('reporter_name'),
            'reporter_email' => $this->input->post('reporter_email'),
            'reporter_phone' => $this->input->post('reporter_phone'),
            'issue_date' => $this->input->post('issue_date'),
            'category' => $this->input->post('category'),
            'issue_title' => $this->input->post('issue_title'),
            'issue_description' => $this->input->post('issue_description')
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
            'Network' => 'meapps09@gmail.com',
            'Parkee System' => 'eka.saputra@centreparkcorp.com',
            'IOT System' => 'rofiq.rifiansyah@centreparkcorp.com'
        );

        // $cc = ['achmad.chairul@centreparkcorp.com', 'rofiq.rifiansyah@centreparkcorp.com'];
        $cc = [''];
        $this->email->from('cs.ho@centreparkcorp.com', 'Helpdesk Admin');
        $this->email->to($category_email[$category]);
        $this->email->cc($cc);

        $this->email->subject($data['issue_title']);
        $link = base_url("complaint/detail/" . $data['id']);
        $message = "<h3>Complaint Report Data</h3>";
        $message .= "<p><strong>Reporter Name:</strong> {$data['reporter_name']}</p>";
        $message .= "<p><strong>Reporter Email:</strong> {$data['reporter_email']}</p>";
        $message .= "<p><strong>Reporter Phone:</strong> {$data['reporter_phone']}</p>";
        $message .= "<p><strong>Issue Date:</strong> {$data['issue_date']}</p>";
        $message .= "<p><strong>Issue Description:</strong><br>{$data['issue_description']}</p>";
        $message .= "<p><a href='{$link}' style='background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; display: inline-block;'>View and Update Status</a></p>";

        $this->email->message($message);


        if (!$this->email->send()) {
            echo $this->email->print_debugger();
        }
    }

    // view detail complaint
    public function detail($id) {
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
        if ($this->M_complaint->updateStatus($id, $status)) {
            $complaint = $this->M_complaint->getComplaintById($id);
            
            $this->sendStatusUpdateEmail($complaint);
            
            $this->session->set_flashdata('success', 'Status updated successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to update status.');
        }
        
        redirect('complaint/detail/' . $id);
    }
    
    // send email update status
    private function sendStatusUpdateEmail($complaint) {
        $this->email->from('developmentcentrepark@gmail.com', 'Helpdesk Admin');
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
