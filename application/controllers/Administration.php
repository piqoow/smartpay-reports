<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('M_administration');
        $this->load->library('email');

        $config = array(
            
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.mail.yahoo.com',
            'smtp_port' => 587,
            // 'smtp_user' => 'cs.ho@centreparkcorp.com',
            // 'smtp_pass' => 'sqzqhvsrzwyoatoy',
            'smtp_user' => 'command.center@centreparkcorp.com',
            'smtp_pass' => 'thsqdtpcwldvqzhz',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'smtp_crypto' => 'tls'
        );

        $this->email->initialize($config);
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

    public function indexNewPettyCash() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        
        $data['title'] = 'Petty Cash';
        $data['pettycash'] = $this->M_administration->getAllPettyCash();
        $data['locations'] = $this->M_administration->get_locations();
        $data['rekenings'] = $this->M_administration->get_all_rekening();
        $data['content'] = 'administration/new-petty-cash';
        $this->load->view('templates/main', $data);
        $this->load->view('templates/v_footer');
        $this->load->view('templates/v_header');

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
            'status_finance' => 'Pending',
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
    
        $id_out = $this->input->post('id_out');
        $data = [
            'status' => 'Transfered',
            'bukti_transfer' => $filePath,
            'transfer_date' => $this->input->post('transfer_date'),
        ];
    
        if ($this->M_administration->updateTransfer($id_out, $data)) {
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

    public function updateTransferFinance() {
        // Load library upload
        $this->load->library('upload');
    
        // Konfigurasi upload file
        $config['upload_path'] = './bukti-finance/';
        $config['allowed_types'] = '*'; // Anda bisa menambahkan filter jenis file misalnya jpg, png, pdf
        $config['max_size'] = 10240; // Maksimal 10MB
        $this->upload->initialize($config);
    
        // Cek apakah file berhasil di-upload
        if ($this->upload->do_upload('bukti_finance')) {
            $uploadData = $this->upload->data();
            $filePath = 'bukti-finance/' . $uploadData['file_name'];  // Path file yang berhasil di-upload
        } else {
            // Jika file gagal di-upload, set filePath ke null dan tampilkan pesan error
            $filePath = null;
            $this->session->set_flashdata('error', $this->upload->display_errors());
            log_message('error', 'Upload error: ' . $this->upload->display_errors());
        }
    
        // Ambil data dari form
        $id_pc = $this->input->post('id_pc_finance');
        $nominal_finance = $this->input->post('nominal_finance');
        $finance_date = $this->input->post('finance_date');
    
        // Cek jika id_pc tidak ada atau tidak valid
        if (empty($id_pc)) {
            $this->session->set_flashdata('error', 'ID PC tidak ditemukan.');
            log_message('error', 'ID PC tidak ditemukan.');
            redirect('petty-cash');
        }
    
        // Data yang akan di-update
        $data = [
            'status_finance' => 'Transfered',
            'nominal_finance' => $nominal_finance,
            'finance_date' => $finance_date,
            'bukti_finance' => $filePath,  // Hanya diset jika ada file yang di-upload
        ];
    
        // Panggil model untuk update data
        if ($this->M_administration->updateTransfer($id_pc, $data)) {
            $this->session->set_flashdata('success', 'Bukti Transfer Finance berhasil diperbarui.');
            log_message('debug', 'Update berhasil untuk ID PC: ' . $id_pc);
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui bukti transfer.');
            log_message('error', 'Gagal memperbarui bukti transfer untuk ID PC: ' . $id_pc);
        }
    
        // Redirect ke halaman yang sesuai setelah proses
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

// ===================================== MODEM TRANSACTION =====================================

    public function indexModemTransaction() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        
        $data['title'] = 'Log Modem';
        $data['datamodem'] = $this->M_administration->getAllDataModem();
        $data['logmodem'] = $this->M_administration->getAllDataLogModem();
        $data['content'] = 'administration/index-modem';
        $this->load->view('templates/main', $data);
        $this->load->view('templates/v_footer');
        $this->load->view('templates/v_header');

    }

    

    public function addMasterData() {
    
            $data = [
                'kode_modem' => $this->input->post('kode_modem'),
                'lokasi' => $this->input->post('lokasi'),
                'terdaftar' => $this->input->post('terdaftar'),
                'user_email' => $this->input->post('user_email'),
                'password' => $this->input->post('password')
            ];
    
            if ($this->M_administration->insertMasterData($data)) {
                $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan Data');
            }
    
            redirect('modem');
    }

    public function UpdateModemLog($id, $kode_modem)
    {
        $this->load->model('M_administration');
        $this->load->library('upload');

        $route_segment = $this->uri->segment(2);

        $nama = $this->input->post('nama');
        $tanggal_kembali = $this->input->post('tanggal_kembali');
        $tanggal_pinjam = $this->input->post('tanggal_pinjam');
        $nama_lokasi = $this->input->post('nama_lokasi');

        $file_name = null;

        // ===== Upload file jika ada =====
        if (!empty($_FILES['bukti_kembali']['name'])) {
            // Upload langsung ke bukti-pinjam-modem
            $config['upload_path'] = './bukti-pinjam-modem/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 20480;
            $config['file_name'] = $_FILES['bukti_kembali']['name'];

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('bukti_kembali')) {
                $this->session->set_flashdata('error', 'Upload gagal: ' . $this->upload->display_errors());
                redirect('detail-modem/' . $id . '/' . $kode_modem);
                return;
            }

            $upload_data = $this->upload->data();
            $file_name = $upload_data['file_name'];
        }

        // === CASE: Update ke HO Biak ===
        if ($route_segment === 'updatelog') {
            $data_update = [
                'user_update_kembali' => $nama,
                'tanggal_kembali' => $tanggal_kembali
            ];

            if ($file_name) {
                // Copy ke folder bukti-kembali-modem juga
                @copy('./bukti-pinjam-modem/' . $file_name, './bukti-kembali-modem/' . $file_name);
                $data_update['bukti_kembali'] = $file_name;
            }

            if ($this->M_administration->UpdateModemLog($id, $data_update)) {
                $this->session->set_flashdata('success', 'Log berhasil diupdate (HO Biak)');
            } else {
                $this->session->set_flashdata('error', 'Gagal update log');
            }

        }

        // === CASE: Kirim ke lokasi baru ===
        elseif ($route_segment === 'updatekirimlog') {
            if (!$file_name) {
                $this->session->set_flashdata('error', 'Bukti kirim wajib diupload');
                redirect('detail-modem/' . $id . '/' . $kode_modem);
                return;
            }

            // Copy file ke bukti-kembali-modem juga
            @copy('./bukti-pinjam-modem/' . $file_name, './bukti-kembali-modem/' . $file_name);

            // Insert log baru
            $data_insert = [
                'tanggal_pinjam' => $tanggal_pinjam,
                'nama_pengirim' => $nama,
                'lokasi' => $nama_lokasi,
                'kode_modem' => $kode_modem,
                'bukti_pinjam' => $file_name
            ];

            $insert = $this->M_administration->insertLogModemTransaction($data_insert);

            if ($insert) {
                // Update log lama
                $data_update = [
                    'user_update_kembali' => $nama,
                    'tanggal_kembali' => $tanggal_pinjam,
                    'bukti_kembali' => $file_name
                ];
                $this->M_administration->UpdateModemLog($id, $data_update);
                $this->M_administration->updateModemStatus($kode_modem, 'dipinjam');

                $this->session->set_flashdata('success', 'Log kirim berhasil ditambahkan & status diperbarui');
            } else {
                $this->session->set_flashdata('error', 'Gagal insert log baru');
            }
        }

        redirect('detail-modem/' . $id . '/' . $kode_modem);
    }




    public function DetailModemTransaction($id, $sn) {        
        $data['title'] = 'Detail Log Modem';
        $data['datamodem'] = $this->M_administration->getModemBySN($sn);
        $data['logmodem'] = $this->M_administration->getLogModemByID($id);
        $this->load->view('administration/detail-modem', $data);
    }

    public function insertLog()
    {
        $this->load->library('upload');
        $kode_modem = $this->input->post('kode_modem');
        $lokasi = $this->input->post('lokasi');
        $tanggal_pinjam = $this->input->post('tanggal_pinjam');

        $data = [
            'kode_modem' => $kode_modem,
            'lokasi' => $lokasi,
            'tanggal_pinjam' => $tanggal_pinjam,
        ];

        if (!empty($_FILES['bukti_pinjam']['name'])) {
            $config['upload_path'] = './bukti-pinjam-modem/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 20480;
            $config['file_name'] = $_FILES['bukti_pinjam']['name'];

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('bukti_pinjam')) {
                $this->session->set_flashdata('error', 'Upload gagal: ' . $this->upload->display_errors());
                redirect('modem');
                return;
            } else {
                $upload_data = $this->upload->data();
                $data['bukti_pinjam'] = $upload_data['file_name'];
            }
        } else {
            $this->session->set_flashdata('error', 'File bukti pinjam wajib diupload');
            redirect('modem');
            return;
        }

        $insert = $this->M_administration->insertLogModemTransaction($data);

        if ($insert) {
            $update_status = $this->M_administration->updateModemStatus($kode_modem, 'dipinjam');

            if ($update_status) {
                $this->session->set_flashdata('success', 'Log modem berhasil ditambahkan dan status diupdate menjadi dipinjam');
            } else {
                $this->session->set_flashdata('error', 'Log modem ditambahkan tapi gagal update status modem');
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan log modem');
        }

        redirect('modem');
    }


}