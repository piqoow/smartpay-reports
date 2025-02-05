<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_user');
        $this->load->library('session');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('daily-task');
        }
        $this->load->view('auth/v_login');
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
    
        $user = $this->M_user->getUserByUsername($username);
    
        if ($user && password_verify($password, $user['password'])) {
            $user_data = [
                'id' => $user['id'],
                'username' => $user['username'],
                'user_level' => $user['user_level'],
                'user_teams' => $user['user_teams'],
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($user_data);
            redirect('daily-task');
        } else {
            $this->session->set_flashdata('error', 'Invalid username or password');
            redirect('auth');
        }

        $user_teams = $this->session->userdata('user_teams');

        if (empty($user_teams)) {
            echo "user_teams tidak ditemukan di session!";
        } else {
            echo "user_teams: " . $user_teams;
        }

    }

    public function logout() {
        $this->session->unset_userdata(['id', 'username', 'user_level', 'logged_in']);
        redirect('auth');
    }
}
