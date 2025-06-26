<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Log Modem</h1>

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
                <option value="category">Tambah Master Data</option>
                <!-- <option value="incoming">Input Modem Keluar</option> -->
                <!-- <option value="outgoing">Input Aset Keluar</option> -->
            </select>
        </div>

        <!-- Form TAMBAH KATEGORI -->
        <div id="formCategory" class="p-2" style="display: none;">
            <form method="post" action="<?= base_url('administration/addMasterData'); ?>">
                <div class="row mb-2">
                    <div class="col-md-5">
                        <label class="mb-1">Kode Modem</label>
                        <input type="text" class="form-control form-control-sm" name="kode_modem" id ="kode_modem" required>
                    </div>
                    <div class="col-md-5">
                        <label class="mb-1">Lokasi</label>
                        <input type="text" class="form-control form-control-sm" name="lokasi" id ="lokasi" required>
                    </div>
                    <div class="col-md-5">
                        <label class="mb-1">Terdaftar</label>
                        <input type="text" class="form-control form-control-sm" name="terdaftar" id ="terdaftar" required>
                    </div>
                    <div class="col-md-5">
                        <label class="mb-1">User Email</label>
                        <input type="text" class="form-control form-control-sm" name="user_email" id ="user_email" required>
                    </div>
                    <div class="col-md-5">
                        <label class="mb-1">Password</label>
                        <input type="text" class="form-control form-control-sm" name="password" id ="password" required>
                    </div>
                </div>
                <div class="text-end px-2">
                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
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
                <h6 class="m-0 font-weight-bold text-primary">Master Data</h6>
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
                <table class="table table-bordered" id="dataTableMasterModem" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Kode Modem</th>
                            <th style="text-align: center;">Lokasi</th>
                            <th style="text-align: center;">Terdaftar</th>
                            <th style="text-align: center;">User Email</th>
                            <th style="text-align: center;">Password</th>
                            <th style="text-align: center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($datamodem as $row): 
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
                            <td style="text-align: center;"><?= $row['kode_modem']; ?></td>
                            <td style="text-align: center;"><?= $row['lokasi']; ?></td>
                            <td style="text-align: center;"><?= $row['terdaftar']; ?></td>
                            <td style="text-align: center;"><?= $row['user_email']; ?></td>
                            <td style="text-align: center;"><?= $row['password']; ?></td>
                            <?php
                            $id_modal = 'updateModalModem' . preg_replace('/[^a-zA-Z0-9_-]/', '', $row['kode_modem']);
                            ?>
                            <td style="text-align: center;">
                                <?php if (strtolower($row['status']) == 'ready'): ?>
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#<?= $id_modal; ?>">
                                        Keluarkan
                                    </button>
                                <?php else: ?>
                                    <span class="badge badge-danger">Dipinjam</span>
                                <?php endif; ?>
                            </td>


                            <div class="modal fade" id="<?= $id_modal; ?>" tabindex="-1" role="dialog" aria-labelledby="<?= $id_modal; ?>Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <?= form_open_multipart('Administration/insertLog'); ?>
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Input Log Modem: <?= htmlspecialchars($row['kode_modem']); ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="kode_modem" value="<?= htmlspecialchars($row['kode_modem']); ?>">
                                            <div class="form-group">
                                                <label>Lokasi</label>
                                                <input type="text" name="lokasi" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Pinjam</label>
                                                <input type="date" name="tanggal_pinjam" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Bukti Pinjam (Upload)</label>
                                                <input type="file" name="bukti_pinjam" class="form-control-file" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>


                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModalModem<?= htmlspecialchars($row['kode_modem']); ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalModemLabel<?= htmlspecialchars($row['kode_modem']); ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?= form_open_multipart('logmodem/insert'); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Log Modem: <?= htmlspecialchars($row['kode_modem']); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="kode_modem" value="<?= htmlspecialchars($row['kode_modem']); ?>">

                <div class="form-group">
                    <label>Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                </div>
                <div class="form-group">
                    <label>Bukti Pinjam (Upload)</label>
                    <input type="file" name="bukti_pinjam" class="form-control-file" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</div>

<hr class="sidebar-divider">

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">History Modem</h6>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableHistoryModem" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Kode Modem</th>
                            <th style="text-align: center;">Lokasi</th>
                            <th style="text-align: center;">Tanggal Pinjam</th>
                            <th style="text-align: center;">Tanggal Kembali</th>
                            <!-- <th style="text-align: center;">Bukti Pinjam</th> -->
                            <!-- <th style="text-align: center;">Bukti Kembali</th> -->
                            <th style="text-align: center;">Action</th>
                            </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($logmodem as $row):
                            date_default_timezone_set('Asia/Jakarta');
                        ?>
                        <tr>
                            <style>
                                /* @keyframes blink {
                                    0% { background-color: #ffcdd2; }
                                    50% { background-color: #ffffff; }
                                    100% { background-color: #ffcdd2; }
                                } */
                            </style>
                            <td style="text-align: center;"><?= $no++; ?></td>
                            <td style="text-align: center;"><?= htmlspecialchars($row['kode_modem']); ?></td>
                            <td style="text-align: center;"><?= htmlspecialchars($row['lokasi']); ?></td>
                            <td style="text-align: center;"><?= htmlspecialchars($row['tanggal_pinjam']); ?></td>
                            <td style="text-align: center;">
                                <?php if (!empty($row['tanggal_kembali'])): ?>
                                    <?= htmlspecialchars($row['tanggal_kembali']); ?>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <!-- <td>
                                <?php
                                if (empty($row['tanggal_kembali'])) {
                                    // If the data is null/empty, show the Update button for a modal
                                    // Using data-toggle and data-target for Bootstrap 4
                                    echo '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModal' . $row['id_log'] . '">';
                                    echo 'Update';
                                    echo '</button>';
                                } else {
                                    // If the data exists, display it
                                    echo htmlspecialchars($row['tanggal_kembali']);
                                }
                                ?>
                            </td> -->
                            <!-- Bukti Pinjam -->
                            <!-- <td class="text-center">
                                <?php if (!empty($row['bukti_pinjam'])): ?>
                                    <a href="<?= base_url('bukti-pinjam-modem/' . htmlspecialchars($row['bukti_pinjam'])); ?>" target="_blank">
                                        <button type="button" class="btn btn-sm btn-primary">View</button>
                                    </a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td> -->

                            <!-- Bukti Kembali -->
                            <!-- <td class="text-center">
                                <?php if (!empty($row['bukti_kembali'])): ?>
                                    <a href="<?= base_url('bukti-kembali-modem/' . htmlspecialchars($row['bukti_kembali'])); ?>" target="_blank">
                                        <button type="button" class="btn btn-sm btn-primary">View</button>
                                    </a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td> -->

                            <td style="text-align: center;">
                                <a href="detail-modem/<?= $row['id_log']; ?>/<?= $row['kode_modem']; ?>" class="btn btn-info btn-sm" target="_blank">
                                    <!-- <?= $row['id_log']; ?> -->
                                    Detail
                                </a>
                            </td>
                        </tr>

                        <div class="modal fade" id="updateModal<?= $row['id_log']; ?>" tabindex="-1" aria-labelledby="updateModalLabel<?= $row['id_log']; ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateModalLabel<?= $row['id_log']; ?>">Update Data (<?= htmlspecialchars($row['kode_modem']); ?>)</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?= form_open_multipart('administration/UpdateModemLog/' . $row['id_log']); ?>
                                            <input type="hidden" name="id_log" value="<?= $row['id_log']; ?>">

                                            <div class="form-group">
                                                <label for="tanggal_kembali_modal<?= $row['id_log']; ?>">Tanggal Kembali:</label>
                                                <input type="date" class="form-control" id="tanggal_kembali_modal<?= $row['id_log']; ?>" name="tanggal_kembali" value="<?= htmlspecialchars($row['tanggal_kembali'] ?? date('Y-m-d')); ?>" required>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label for="foto_modal<?= $row['id_log']; ?>">Upload Foto:</label>
                                                <input type="file" class="form-control-file" id="foto_modal<?= $row['id_log']; ?>" name="foto">
                                                <?php if (!empty($row['foto'])): ?>
                                                    <small class="form-text text-muted mt-2">Current Photo: <a href="<?= base_url('uploads/' . $row['foto']); ?>" target="_blank"><?= htmlspecialchars($row['foto']); ?></a></small>
                                                    <input type="hidden" name="old_foto" value="<?= htmlspecialchars($row['foto']); ?>">
                                                <?php endif; ?>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <?= form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<hr class="sidebar-divider">


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

