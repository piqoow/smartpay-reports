<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Smartpay extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('M_smartpay');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        
        $data['title'] = 'Smartpay System';
        $data['systems'] = $this->M_smartpay->getAllSystem();
        $data['content'] = 'dashboard/smartpay-system';
        $this->load->view('templates/main', $data);
        $this->load->view('templates/v_footer');
        $this->load->view('templates/v_header');

    }

    public function add() {
        $data = [
            'system_name' => $this->input->post('system_name'),
            'system_category' => $this->input->post('system_category'),
            'system_url' => $this->input->post('system_url'),
            'launching_date' => $this->input->post('launching_date'),
        ];

        if ($this->M_smartpay->addSystem($data)) {
            $this->session->set_flashdata('success', 'User added successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to add user');
        }
        redirect('smartpay-system');
    }

    public function edit() {
        // Ambil data dari form
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $email = $this->input->post('user_email');
        $password = $this->input->post('password'); // Kosongkan jika tidak diubah
        $level = $this->input->post('user_level');
        $teams = $this->input->post('user_teams');
    
        // Jika password diubah, masukkan password baru, jika tidak kosongkan
        $data = [
            'username' => $username,
            'user_email' => $email,
            'user_level' => $level,
            'user_teams' => $teams
        ];
    
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT); // Pastikan mengenkripsi password
        }
    
        // Panggil model untuk memperbarui data user
        if ($this->M_user->updateUser($id, $data)) {
            $this->session->set_flashdata('success', 'User updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update user');
        }
    
        // Redirect kembali ke halaman user
        redirect('user');
    }
    

    public function delete($id) {
        if ($this->M_user->deleteUser($id)) {
            $this->session->set_flashdata('success', 'User deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete user');
        }
        redirect('user');
    }

}