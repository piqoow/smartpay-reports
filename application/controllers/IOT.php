<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IOT extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library(['email', 'form_validation']);
        $this->load->model('M_iot');
        
        // Initialize email configuration
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
        // Fetch locations from model
        $data['locations'] = $this->M_iot->get_locations(); 
        $data['title'] = 'IOT Form';
        $data['content'] = 'iot/index';
        $this->load->view('templates/main', $data);
    }

    public function submit() {
        // Form validation rules
        $this->form_validation->set_rules('location_name', 'Location Name', 'required');
        $this->form_validation->set_rules('server_category', 'Server Category', 'required');
        $this->form_validation->set_rules('reporter_email', 'Reporter Email', 'valid_email');
        $this->form_validation->set_rules('reporter_phone', 'Phone', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
        $this->form_validation->set_rules('issue_date', 'Issue Date', 'required');
        $this->form_validation->set_rules('category', 'Division', 'required');
        $this->form_validation->set_rules('priority', 'Priority', 'required');
        $this->form_validation->set_rules('issue_title', 'Issue Title', 'required');
        $this->form_validation->set_rules('issue_description', 'Issue Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the form with validation errors
            $data['locations'] = $this->M_iot->get_locations(); 
            $data['title'] = 'IOT Form';
            $data['content'] = 'iot/index';
            $this->load->view('templates/main', $data);
        } else {
            // Process the form data
            $form_data = array(
                'location_name' => $this->input->post('location_name'),
                'server_category' => $this->input->post('server_category'),
                'reporter_email' => $this->input->post('reporter_email'),
                'reporter_phone' => $this->input->post('reporter_phone'),
                'location' => $this->input->post('location'),
                'issue_date' => $this->input->post('issue_date'),
                'category' => $this->input->post('category'),
                'priority' => $this->input->post('priority'),
                'issue_title' => $this->input->post('issue_title'),
                'issue_description' => $this->input->post('issue_description'),
            );

            // Save data to database (e.g., using the model)
            $this->M_iot->insert_issue($form_data);

            // Send email notification
            if ($form_data['reporter_email']) {
                $this->send_email_notification($form_data['reporter_email'], $form_data);
            }

            // Redirect to a success page or display a success message
            $this->session->set_flashdata('success', 'Issue reported successfully!');
            redirect('iot');
        }
    }

    private function send_email_notification($to_email, $data) {
        $subject = 'New IoT Issue Reported';
        $message = "A new issue has been reported.\n\nDetails:\n";
        $message .= "Location: " . $data['location'] . "\n";
        $message .= "Issue Title: " . $data['issue_title'] . "\n";
        $message .= "Description: " . $data['issue_description'] . "\n";
        $message .= "Priority: " . $data['priority'] . "\n";
        $message .= "Reported by: " . $data['reporter_email'] . "\n";

        $this->email->from('cs.ho@centreparkcorp.com', 'IOT System');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);

        if (!$this->email->send()) {
            log_message('error', 'Email failed to send to ' . $to_email);
        }
    }
}
