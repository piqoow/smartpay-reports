<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Stock</h1>

    <?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

<div class="container-fluid">
    <div class="card shadow mb-4">

        <!-- Pilihan Aset -->
        <div class="card-header py-2 px-3">
            <label for="pilihanAset" class="form-label mb-1">Pilih Jenis Inputan:</label>
            <select id="pilihanAset" class="form-control form-control-sm" style="width: 200px;">
                <option value="">Pilih</option>
                <option value="category">Tambah Nama Barang</option>
                <option value="incoming">Input Aset Masuk</option>
                <option value="outgoing">Input Aset Keluar</option>
            </select>
        </div>

        <!-- Form TAMBAH KATEGORI -->
        <div id="formCategory" class="p-2" style="display: none;">
            <form method="post" action="<?= base_url('assetmanagement/addAssetCategory'); ?>">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label class="mb-1">Nama Barang (Kategori Baru)</label>
                        <input type="text" class="form-control form-control-sm" name="nama_barang" id ="nama_barang" required>
                    </div>
                </div>
                <div class="text-end px-2">
                    <button type="submit" class="btn btn-success btn-sm">Tambah Kategori</button>
                </div>
            </form>
        </div>

        <!-- Form ASET MASUK -->
        <div id="formIncoming" class="p-2" style="display: none;">
            <form id="addAssetIncoming" method="post" action="<?= base_url('assetmanagement/addAssetIncoming'); ?>" enctype="multipart/form-data">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1">Nama Barang</label>
                            <select name="nama_barang" id="nama_barang" class="form-control form-control-sm">
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($categoryasset as $item): ?>
                                    <option value="<?= $item['nama_barang'] ?>" data-id="<?= $item['id_category'] ?>">
                                        <?= $item['nama_barang'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="id_category" id="id_category">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1">Jumlah</label>
                            <input type="number" class="form-control form-control-sm" name="jumlah" id="jumlah">
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1">Keperluan</label>
                            <input type="text" class="form-control form-control-sm" name="keperluan" id="keperluan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1">Tanggal</label>
                            <input type="date" class="form-control form-control-sm" name="tanggal_masuk" id="tanggal_masuk">
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1">Bukti Terima</label>
                            <input type="file" class="form-control form-control-sm" name="bukti_terima" id="bukti_terima">
                        </div>
                    </div>
                </div>

                <div class="text-end px-2">
                    <button type="submit" class="btn btn-primary btn-sm">Submit ASET MASUK</button>
                </div>
            </form>
        </div>

        <!-- Form ASET KELUAR -->
        <div id="formOutgoing" class="p-2" style="display: none;">
            <form id="addAssetOutgoing" method="post" action="<?= base_url('assetmanagement/addAssetOutgoing'); ?>" enctype="multipart/form-data">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1">Nama Barang</label>
                            <select name="nama_barang_out" id="nama_barang_out" class="form-control form-control-sm">
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($stockasset as $item): ?>
                                    <option value="<?= $item['nama_barang'] ?>" data-id-out="<?= $item['id_category'] ?>">
                                        <?= $item['nama_barang'] ?> (Tersedia: <?= $item['jumlah'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="id_category_out" id="id_category_out">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1">Jumlah</label>
                            <input type="number" class="form-control form-control-sm" name="jumlah" id="jumlah_out">
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1">Tujuan</label>
                            <input type="text" class="form-control form-control-sm" name="tujuan" id="tujuan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1">Tanggal</label>
                            <input type="date" class="form-control form-control-sm" name="tanggal_keluar" id="tanggal_keluar">
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1">Status</label>
                            <select class="form-control form-control-sm" id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="Permanent">Permanent</option>
                                <option value="Sementara">Sementara</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6" id="keperluan-fields" style="display: none;">
                        <div class="form-group mb-2">
                            <label class="mb-1">Keperluan</label>
                            <input type="text" class="form-control form-control-sm" name="keperluan" id="keperluan_out">
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1">Pengirim</label>
                            <input type="text" class="form-control form-control-sm" name="pengirim" id="pengirim">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label class="mb-1">Bukti Terima</label>
                            <input type="file" class="form-control form-control-sm" name="bukti_terima" id="bukti_terima_out">
                        </div>
                    </div>
                </div>

                <div class="text-end px-2">
                    <button type="submit" class="btn btn-primary btn-sm">Submit ASET KELUAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Stock Asset</h6>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"></h6>

                <!-- <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#addAssetKeluarModal">
                    <i class="fas fa-plus"></i> Category Asset
                </button> -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTablePetCash" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Nama Barang</th>
                            <th style="text-align: center;">Jumlah Keluar</th>
                            <th style="text-align: center;">Jumlah Pinjam</th>
                            <th style="text-align: center;">Stock</th>
                            <th style="text-align: center;">Total</th>
                            <th style="text-align: center;">Tanggal Update</th>
                            <!-- <th style="text-align: center;">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($stockasset as $row): 
                            date_default_timezone_set('Asia/Jakarta');

                            // $created_at = strtotime($row['created_at']);
                            // $today = strtotime(date('Y-m-d H:i:s'));
                            // $time_diff = $today - $created_at;
                            // $days_diff = floor($time_diff / (60 * 60 * 24));

                            // $row_style = '';
                            // if ($days_diff > 2 && $row['status'] != 'Transfered') {

                            //     $row_style = 'animation: blink 2s linear infinite;';
                            // }
                            ?>
                        <!-- <tr style="<?= $row_style ?>"> -->
                        <tr>
                            <style>
                                /* @keyframes blink {
                                    0% { background-color: #ffcdd2; }
                                    50% { background-color: #ffffff; }
                                    100% { background-color: #ffcdd2; }
                                } */
                            </style>
                            <td style="text-align: center;"><?= $no++; ?></td>
                            <td style="text-align: center;"><?= $row['nama_barang']; ?></td>
                            <td style="text-align: center;"><?= $row['jumlah_keluar']; ?></td>
                            <td style="text-align: center;"><?= $row['jumlah_pinjam']; ?></td>
                            <td style="text-align: center;"><?= $row['jumlah']; ?></td>
                            <td style="text-align: center;"><?= $row['total']; ?></td>
                            <td style="text-align: center;">
                                <?= date('H:i:s', strtotime($row['tanggal_update'])); ?><br>
                                <?= date('d-m-Y', strtotime($row['tanggal_update'])); ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<hr class="sidebar-divider">

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">History Masuk</h6>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"></h6>

                <!-- <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#addAssetMasukModal">
                    <i class="fas fa-plus"></i> Aset Masuk
                </button> -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableAssetIncoming" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Nama Barang</th>
                            <th style="text-align: center;">Jumlah</th>
                            <th style="text-align: center;">Keperluan</th>
                            <th style="text-align: center;">Tanggal</th>
                            <th style="text-align: center;">Penerima</th>
                            <th style="text-align: center;">Bukti Terima</th>
                            <th style="text-align: center;">User Input</th>
                            <!-- <th style="text-align: center;">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($stockincoming as $row): 
                            date_default_timezone_set('Asia/Jakarta');

                            // $created_at = strtotime($row['created_at']);
                            // $today = strtotime(date('Y-m-d H:i:s'));
                            // $time_diff = $today - $created_at;
                            // $days_diff = floor($time_diff / (60 * 60 * 24));

                            // $row_style = '';
                            // if ($days_diff > 2 && $row['status'] != 'Transfered') {

                            //     $row_style = 'animation: blink 2s linear infinite;';
                            // }
                            ?>
                        <!-- <tr style="<?= $row_style ?>"> -->
                        <tr>
                            <style>
                                /* @keyframes blink {
                                    0% { background-color: #ffcdd2; }
                                    50% { background-color: #ffffff; }
                                    100% { background-color: #ffcdd2; }
                                } */
                            </style>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                            <td><?= $row['keperluan']; ?></td>
                            <td style="text-align: center;">
                                <!-- <?= date('H:i:s', strtotime($row['tanggal'])); ?><br> -->
                                <?= date('d-m-Y', strtotime($row['tanggal'])); ?>
                            </td>
                            <td><?= $row['penerima']; ?></td>
                            <!-- <td><?= $row['bukti_terima']; ?></td> -->
                            
                            <!-- BUKTI -->
                            <td style="text-align: center;">
                                <?php if (!empty($row['bukti_terima'])): ?>
                                    <a href="<?= base_url($row['bukti_terima']); ?>" target="_blank" class="btn btn-primary">View</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= $row['user_input']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<hr class="sidebar-divider">

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">History Keluar</h6>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"></h6>

                <!-- <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#addAssetKeluarModal">
                    <i class="fas fa-plus"></i> Aset Keluar
                </button> -->
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableAssetOutgoing" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Nama Barang</th>
                            <th style="text-align: center;">Tujuan</th>
                            <th style="text-align: center;">Jumlah</th>
                            <th style="text-align: center;">Status</th>
                            <th style="text-align: center;">Tanggal</th>
                            <th style="text-align: center;">Pengirim</th>
                            <th style="text-align: center;">Bukti Terima</th>
                            <th style="text-align: center;">Bukti Pengembalian</th>
                            <th style="text-align: center;">Penerima Pengembalian</th>
                            <th style="text-align: center;">Tanggal Pengembalian</th>
                            <th style="text-align: center;">User Update</th>
                            <!-- <th style="text-align: center;">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($stockoutgoing as $row): 
                            date_default_timezone_set('Asia/Jakarta');

                            // $created_at = strtotime($row['created_at']);
                            // $today = strtotime(date('Y-m-d H:i:s'));
                            // $time_diff = $today - $created_at;
                            // $days_diff = floor($time_diff / (60 * 60 * 24));

                            // $row_style = '';
                            // if ($days_diff > 2 && $row['status'] != 'Transfered') {

                            //     $row_style = 'animation: blink 2s linear infinite;';
                            // }
                            ?>
                        <!-- <tr style="<?= $row_style ?>"> -->
                        <tr>
                            <style>
                                /* @keyframes blink {
                                    0% { background-color: #ffcdd2; }
                                    50% { background-color: #ffffff; }
                                    100% { background-color: #ffcdd2; }
                                } */
                            </style>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['tujuan']; ?></td>
                            <td><?= $row['jumlah']; ?></td>
                            <td><?= $row['status']; ?></td>
                            <td style="text-align: center;">
                                <!-- <?= date('H:i:s', strtotime($row['tanggal'])); ?><br> -->
                                <?= date('d-m-Y', strtotime($row['tanggal'])); ?>
                            </td>
                            <td><?= $row['pengirim']; ?></td>                            
                            <!-- BUKTI -->
                            <td style="text-align: center;">
                                <?php if (!empty($row['bukti_terima'])): ?>
                                    <a href="<?= base_url($row['bukti_terima']); ?>" target="_blank" class="btn btn-primary">View</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if (!empty($row['bukti_pengembalian'])): ?>
                                    <a href="<?= base_url($row['bukti_pengembalian']); ?>" target="_blank" class="btn btn-primary">View</a>
                                <?php else: ?>
                                    <?php if (strtolower($row['status']) == 'permanent'): ?>
                                        <span class="badge badge-secondary">Permanent</span>
                                    <!-- <?php elseif (strtolower($row['status']) == 'Dikembalikan'): ?>
                                        <span class="badge badge-success">Returned</span> -->
                                    <?php else: ?>
                                        <button type="button" class="btn btn-warning btn-update-outgoing" 
                                                data-toggle="modal" 
                                                data-target="#updateAssetOutgoingModal" 
                                                data-id="<?= $row['id_out']; ?>">
                                            Update<?= $row['id_out']; ?>
                                        </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if (!empty($row['penerima_pengembalian'])): ?>
                                    <?= $row['penerima_pengembalian']; ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <?php if (!empty($row['penerima_pengembalian'])): ?>
                                    <!-- <?= date('H:i:s', strtotime($row['tanggal_pengembalian'])); ?><br> -->
                                    <?= date('d-m-Y', strtotime($row['tanggal_pengembalian'])); ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= $row['user_input']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Asset -->
<div class="modal fade" id="addAssetMasukModal" tabindex="-1" role="dialog" aria-labelledby="addAssetMasukModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAssetMasukModalLabel">Asset Masuk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addAssetIncoming" method="post" action="<?= base_url('assetmanagement/addAssetIncoming'); ?>"enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <select name="nama_barang" id="nama_barang" class="form-control">
                                    <option value="">-- Pilih Barang --</option>
                                    <?php foreach ($categoryasset as $item): ?>
                                        <option 
                                            value="<?= $item['nama_barang'] ?>" 
                                            data-id="<?= $item['id_category'] ?>">
                                            <?= $item['nama_barang'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Hidden input untuk menyimpan id_category -->
                            <input type="hidden" name="id_category" id="id_category">

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Keperluan</label>
                                <input type="text" class="form-control" name="keperluan" id="keperluan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Penerima</label>
                                <input type="text" class="form-control" name="penerima" id="penerima">
                            </div>
                        </div>
                        <div class="col-md-6"> -->
                            <div class="form-group">
                                <label>Bukti Terima</label>
                                <input type="file" class="form-control" name="bukti_terima" id="bukti_terima">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Keluar Asset -->
<div class="modal fade" id="addAssetKeluarModal" tabindex="-1" role="dialog" aria-labelledby="addAssetKeluarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAssetKeluarModalLabel">Asset Keluar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addAssetOutgoing" method="post" action="<?= base_url('assetmanagement/addAssetOutgoing'); ?>"enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <select name="nama_barang_out" id="nama_barang_out" class="form-control">
                                    <option value="">-- Pilih Barang --</option>
                                    <?php foreach ($stockasset as $item): ?>
                                        <option 
                                            value="<?= $item['nama_barang'] ?>" 
                                            data-id-out="<?= $item['id_category'] ?>">
                                            <?= $item['nama_barang'] ?>(Tersedia: <?= $item['jumlah'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Hidden input untuk menyimpan id_category -->
                            <input type="hidden" name="id_category_out" id="id_category_out">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tujuan</label>
                                <input type="text" class="form-control" name="tujuan" id="tujuan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" name="tanggal_keluar" id="tanggal_keluar">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="Permanent">Permanent</option>
                                    <option value="Sementara">Sementara</option>
                                </select>
                                <!-- <input type="text" class="form-control" name="status" id="status"> -->
                            </div>
                        </div>
                        <div class="col-md-6" id="keperluan-fields" style="display: none;">
                            <div class="form-group">
                                <label>Keperluan</label>
                                <input type="text" class="form-control" name="keperluan" id="keperluan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pengirim</label>
                                <input type="text" class="form-control" name="pengirim" id="pengirim">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bukti Terima</label>
                                <input type="file" class="form-control" name="bukti_terima" id="bukti_terima">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Bukti Pengembalian -->
<div class="modal fade" id="updateAssetOutgoingModal" tabindex="-1" role="dialog" aria-labelledby="updateAssetOutgoingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAssetOutgoingModalLabel">Update Bukti Transfer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateTransferForm" method="post" action="<?= base_url('assetmanagement/updateOutgoing'); ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id_out">ID</label>
                        <input type="text" name="id_out" id="id_out" disabled> 
                    </div>
                    <div class="form-group">
                        <label for="penerima_pengembalian">Penerima Pengembalian</label>
                        <input type="text" class="form-control" id="penerima_pengembalian" name="penerima_pengembalian" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pengembalian">Tanggal Transfer</label>
                        <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
                    </div>
                    <div class="form-group">
                        <label for="bukti_pengembalian">Upload Bukti Terima</label>
                        <input type="file" class="form-control" id="bukti_pengembalian" name="bukti_pengembalian" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById('status').addEventListener('change', function() {
        var status = this.value;

        if (status === 'Sementara') {
            document.getElementById('keperluan-fields').style.display = 'block';
        } else {
            document.getElementById('keperluan-fields').style.display = 'none';
        }
    });
</script>

<script>
$(document).ready(function() {
    $('#updateAssetOutgoingModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id_out = button.data('id'); // Extract info from data-id attribute
        var modal = $(this);
        modal.find('.modal-body #id_out').val(id_out); // Set the value of #id_out
        // If you need to pre-fill other fields, you'd make an AJAX call here
        // to fetch the data for the given id_out.
    });
});
</script>
<script>
    document.getElementById('nama_barang').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var idCategory = selectedOption.getAttribute('data-id');
        document.getElementById('id_category').value = idCategory || '';
    });
</script>
<script>
    document.getElementById('nama_barang_out').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var idCategory = selectedOption.getAttribute('data-id-out');
        document.getElementById('id_category_out').value = idCategory || '';
        console.log("ID Category:", idCategory);
    });
</script>
<!-- Script Toggle -->
<script>
    document.getElementById('pilihanAset').addEventListener('change', function () {
        const selected = this.value;
        const incoming = document.getElementById('formIncoming');
        const outgoing = document.getElementById('formOutgoing');
        const category = document.getElementById('formCategory');

        if (selected === 'incoming') {
            incoming.style.display = 'block';
            outgoing.style.display = 'none';
            category.style.display = 'none';
        } else if (selected === 'outgoing') {
            incoming.style.display = 'none';
            outgoing.style.display = 'block';
            category.style.display = 'none';
        } else if (selected === 'category') {
            incoming.style.display = 'none';
            outgoing.style.display = 'none';
            category.style.display = 'block';
        } else {
            incoming.style.display = 'none';
            incoming.style.display = 'none';
            outgoing.style.display = 'none';
        }
    });

    // Optional: Tampilkan kolom keperluan jika status "Sementara" dipilih
    // document.getElementById('status').addEventListener('change', function () {
    //     const keperluanFields = document.getElementById('keperluan-fields');
    //     if (this.value === 'Sementara') {
    //         keperluanFields.style.display = 'block';
    //     } else {
    //         keperluanFields.style.display = 'none';
    //     }
    // });
</script>
<script>
    $(document).ready(function () {
        $('.btn-update-outgoing').on('click', function () {
            var idOut = $(this).data('id');
            $('#id_out_display').val(idOut); // tampilkan ke user
            $('#id_out').val(idOut);         // dikirim ke server
        });
    });
</script>

