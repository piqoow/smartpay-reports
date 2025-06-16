<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assetmanagement extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('M_assetmanagement');
    }

// ======================================= STOCK ASSET =======================================  
    public function indexStockies() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        
        $data['title'] = 'Stockies';
        $data['stockincoming'] = $this->M_assetmanagement->getStockIncoming();
        $data['stockoutgoing'] = $this->M_assetmanagement->getStockOutgoing();
        $data['stockasset'] = $this->M_assetmanagement->getAllStockAsset();
        $data['categoryasset'] = $this->M_assetmanagement->getAllCategoryAsset();
        $data['content'] = 'administration/asset-inventory';
        $this->load->view('templates/main', $data);
        $this->load->view('templates/v_footer');
        $this->load->view('templates/v_header');
        
    }

    public function addAssetIncoming()
    {
        date_default_timezone_set('Asia/Jakarta');
        $datenow = date('Y-m-d H:i:s');

        $config['upload_path'] = './bukti-terima/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10240; // 10MB
        $this->load->library('upload', $config);

        if (!empty($_FILES['bukti_terima']['name'])) {
            if (!$this->upload->do_upload('bukti_terima')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('stockies');
                return;
            } else {
                $uploadData = $this->upload->data();
                $filePath = 'bukti-terima/' . $uploadData['file_name'];
            }
        } else {
            $this->session->set_flashdata('error', 'Bukti terima Kosong!');
            redirect('stockies');
            return;
        }

        // Ambil data dari form
        $id_category = $this->input->post('id_category');
        $nama_barang = $this->input->post('nama_barang');
        $jumlah_masuk = (int) $this->input->post('jumlah');

        // Data untuk tabel incoming
        $data = [
            'id_category' => $id_category,
            'nama_barang' => $nama_barang,
            'jumlah' => $jumlah_masuk,
            'keperluan' => $this->input->post('keperluan'),
            'tanggal' => $this->input->post('tanggal_masuk'),
            'penerima' => $this->session->userdata('username'),
            'bukti_terima' => $filePath,
            'user_input' => $this->session->userdata('username'),
            'created_at' => $datenow
        ];

        // Simpan incoming
        if ($this->M_assetmanagement->addStockIncoming($data)) {

            // Cek apakah stok berdasarkan id_category sudah ada
            $existingStock = $this->M_assetmanagement->getStockByIdCategory($id_category);

            if ($existingStock) {
                // Update stok: tambah jumlah
                $updatedJumlah = $existingStock['jumlah'] + $jumlah_masuk;

                $updateData = [
                    'jumlah' => $updatedJumlah,
                    'tanggal_update' => $datenow
                ];
                $this->M_assetmanagement->updateAssetStock($existingStock['id_category'], $updateData);
            } else {
                // Insert stok baru
                $insertData = [
                    'id_category' => $id_category,
                    'nama_barang' => $nama_barang,
                    'jumlah' => $jumlah_masuk,
                    'tanggal_update' => $datenow,
                    'jumlah_keluar' => 0,
                    'jumlah_pinjam' => 0,
                    'created_at' => $datenow
                ];
                $this->M_assetmanagement->insertAssetStock($insertData);
            }

            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data.');
        }

        redirect('stockies');
    }


    public function addAssetOutgoing()
    {
        date_default_timezone_set('Asia/Jakarta');
        $datenow = date('Y-m-d H:i:s');

        $config['upload_path'] = './bukti-terima/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10240; // 10MB
        $this->load->library('upload', $config);

        if (!empty($_FILES['bukti_terima']['name'])) {
            if (!$this->upload->do_upload('bukti_terima')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('stockies');
                return;
            } else {
                $uploadData = $this->upload->data();
                $filePath = 'bukti-terima/' . $uploadData['file_name'];
            }
        } else {
            $this->session->set_flashdata('error', 'Bukti terima wajib diunggah!');
            redirect('stockies');
            return;
        }

        // Ambil data dari form
        $id_category = $this->input->post('id_category_out');
        $nama_barang = $this->input->post('nama_barang_out');
        $jumlah_keluar = (int) $this->input->post('jumlah');
        $status = $this->input->post('status');

        $data = [
            'id_category' => $id_category,
            'nama_barang' => $nama_barang,
            'tujuan' => $this->input->post('tujuan'),
            'jumlah' => $jumlah_keluar,
            'status' => $status,
            'keperluan' => $this->input->post('keperluan'),
            'tanggal' => $this->input->post('tanggal_keluar'),
            'pengirim' => $this->session->userdata('username'),
            'bukti_terima' => $filePath,
            'user_input' => $this->session->userdata('username'),
            'created_at' => $datenow,
        ];

        if ($this->M_assetmanagement->outStockAsset($data)) {

            // Ambil stok berdasarkan id_category
            $existingStock = $this->M_assetmanagement->getStockByIdCategory($id_category);

            if ($existingStock) {
                // Update data stok tergantung status
                $updateData = ['tanggal_update' => $datenow];

                if ($status === 'Sementara') {
                    $updateData['jumlah_pinjam'] = $existingStock['jumlah_pinjam'] + $jumlah_keluar;
                } elseif ($status === 'Permanent') {
                    $updateData['jumlah_keluar'] = $existingStock['jumlah_keluar'] + $jumlah_keluar;
                }
        
                $updateData['jumlah'] = $existingStock['jumlah'] - $jumlah_keluar;
                $this->M_assetmanagement->updateAssetStock($existingStock['id_category'], $updateData);
            }

            $this->session->set_flashdata('success', 'Data berhasil ditambahkan dan stok diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data.');
        }

        redirect('stockies');
    }


    public function updateOutgoing() {
        date_default_timezone_set('Asia/Jakarta');
        $datenow = date('Y-m-d H:i:s');
    
        $config['upload_path'] = './bukti-pengembalian/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10240; // 10MB
        $this->load->library('upload', $config);

        $id_out = $this->input->post('id_out');
        $penerima_pengembalian = $this->input->post('penerima_pengembalian');
        $tanggal_pengembalian = $this->input->post('tanggal_pengembalian');
        log_message('debug', 'ID Out: ' . $id_out);
        log_message('debug', 'Tanggal: ' . $tanggal_pengembalian);
        log_message('debug', 'Penerima: ' . $penerima_pengembalian);
        if (!empty($_FILES['bukti_pengembalian']['name'])) {
            if (!$this->upload->do_upload('bukti_pengembalian')) {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('stockies');
                return;
            } else {
                $uploadData = $this->upload->data();
                $filePath = 'bukti-pengembalian/' . $uploadData['file_name'];
            }
        } else {
            $this->session->set_flashdata('error', 'Bukti pengembalian Kosong!');
            redirect('stockies');
            return;
        }

        // if ($upload_success) {
            $data = array(
                // 'status' => 'Dikembalika',
                'penerima_pengembalian' => $penerima_pengembalian,
                'tanggal_pengembalian'  => $tanggal_pengembalian,
                'bukti_pengembalian'    => $filePath,
                'updated_at'    => $datenow
            );

            if ($this->M_assetmanagement->updateOutgoing($id_out, $data)) // Passing id_out to the model
            {
                $this->session->set_flashdata('success', 'Data Bukti Transfer berhasil diupdate!');
            }
            else
            {
                $this->session->set_flashdata('error', 'Gagal mengupdate data Bukti Transfer.');
            }
        // }

        redirect('stockies');
    }
    
}