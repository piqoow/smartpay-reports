<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('M_administration');
    }

    public function addRekening() {
        $this->form_validation->set_rules('nama_rekening', 'Nama Rekening', 'required');
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required');
        $this->form_validation->set_rules('nomor_rekening', 'Nomor Rekening', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Semua field harus diisi');
            redirect('petty-cash');
        } else {
            $data = [
                'nama_rekening' => $this->input->post('nama_rekening'),
                'nama_bank' => $this->input->post('nama_bank'),
                'nomor_rekening' => $this->input->post('nomor_rekening'),
            ];
    
            if ($this->M_administration->addRekening($data)) {
                $this->session->set_flashdata('success', 'Rekening berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan rekening');
            }
    
            redirect('petty-cash');
        }
    }
    

    public function indexPettyCash() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        
        $data['title'] = 'Petty Cash';
        $data['pettycash'] = $this->M_administration->getAllPettyCash();
        $data['locations'] = $this->M_administration->get_locations();
        $data['rekenings'] = $this->M_administration->get_all_rekening();
        $data['content'] = 'administration/petty-cash';
        $this->load->view('templates/main', $data);
        $this->load->view('templates/v_footer');
        $this->load->view('templates/v_header');

    }

    public function addPettyCash() {
        date_default_timezone_set('Asia/Jakarta');
        $datenow = date('Y-m-d H:i:s');
        
        $config['upload_path'] = './bukti-nota/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10240; // 10MB
        $this->load->library('upload', $config);
    
        if (!empty($_FILES['bukti_nota']['name'])) {
            if (!$this->upload->do_upload('bukti_nota')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('petty-cash');
                return;
            } else {
                $uploadData = $this->upload->data();
                $filePath = 'bukti-nota/' . $uploadData['file_name']; // Pastikan mengambil nama file dengan benar
            }
        } else {
            $filePath = null;
        }
    
        $data = [
            'location_name' => $this->input->post('location_name'),
            'po_number' => $this->input->post('nomor_po'),
            'request_dana' => $this->input->post('request_dana'),
            'request_date' => $datenow,
            'request_name' =>  $this->session->userdata('username'),
            'rekening_tujuan' => $this->input->post('rekening_tujuan'),
            'category_request' => $this->input->post('kategori_request'),
            'category_detail' => $this->input->post('kategori_detail'),
            'bukti_nota' => $filePath,
            'status' => 'Pending',
        ];
    
        if ($this->M_administration->addPettyCash($data)) {
            $this->session->set_flashdata('success', 'Data added successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to add data');
        }
    
        redirect('petty-cash');
    }

    public function updateTransfer() {
        $this->load->library('upload');
    
        $config['upload_path'] = './bukti-transfer/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10240; // 10MB
        $this->load->library('upload', $config);
    
        $this->upload->initialize($config);
    
        if ($this->upload->do_upload('bukti_transfer')) {
            $uploadData = $this->upload->data();
            $filePath = 'bukti-transfer/' . $uploadData['file_name'];
        } else {
            $filePath = null;
            $this->session->set_flashdata('error', $this->upload->display_errors());
            log_message('error', 'Upload error: ' . $this->upload->display_errors());
        }        
    
        $id_pc = $this->input->post('id_pc');
        $data = [
            'status' => 'Transfered',
            'bukti_transfer' => $filePath,
            'transfer_date' => $this->input->post('transfer_date'),
        ];
    
        if ($this->M_administration->updateTransfer($id_pc, $data)) {
            $this->session->set_flashdata('success', 'Bukti transfer updated successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to update bukti transfer');
            log_message('error', 'Database update failed: ' . $this->db->last_query());
        }
        // var_dump($id_pc);
        // var_dump($this->input->post('transfer_date'));
        // var_dump($filePath);
        // exit; // Untuk menghentikan eksekusi dan melihat hasilnya
            
        redirect('petty-cash');
    }
    

    public function editPettyCash() {
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
    

    public function deletePettyCash($id) {
        if ($this->M_user->deleteUser($id)) {
            $this->session->set_flashdata('success', 'User deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete user');
        }
        redirect('user');
    }

}