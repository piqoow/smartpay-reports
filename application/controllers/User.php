<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('M_user');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        // if ($this->session->userdata('user_level') != 'admin') {
        //     redirect('dashboard');
        // }
        
        $data['title'] = 'User Management';
        $data['users'] = $this->M_user->getAllUsers();
        // $this->load->view('templates/v_header', $data);
        // $this->load->view('templates/v_sidebar');
        // $this->load->view('templates/v_topbar');
        // $this->load->view('user/index', $data);
        // $this->load->view('templates/v_footer');
        $data['content'] = 'user/index';
        $this->load->view('templates/main', $data);

    }

    public function add() {
        $data = [
            'username' => $this->input->post('username'),
            'user_email' => $this->input->post('user_email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'user_level' => $this->input->post('user_level'),
            'user_teams' => $this->input->post('user_teams'),
            // 'is_active' => $this->input->post('is_active')
        ];

        if ($this->M_user->addUser($data)) {
            $this->session->set_flashdata('success', 'User added successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to add user');
        }
        redirect('user');
    }

    public function edit() {
        $id = $this->input->post('id');
        $data = [
            'username' => $this->input->post('username'),
            'user_email' => $this->input->post('user_email'),
            'user_level' => $this->input->post('user_level'),
            'user_teams' => $this->input->post('user_teams')
        ];

        if ($this->input->post('password')) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        if ($this->M_user->updateUser($id, $data)) {
            $this->session->set_flashdata('success', 'User updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update user');
        }
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