<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Request Petty Cash</h1>

    <?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Request</h6>

                <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#addRekeningModal">
                    <i class="fas fa-plus"></i> Tambah Rekening
                </button>
            </div>
        </div>
        <div class="card-body">
        <form action="<?= base_url('administration/addPettyCash'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Pettycash Code</label>
                                <input type="text" class="form-control" name="id_petcash" disabled>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lokasi</label>
                                <input type="text" class="form-control" name="location_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor PO</label>
                                <input type="text" class="form-control" name="nomor_po" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori Request</label>
                                <select class="form-control" name="kategori_request" id="kategori_request" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Internet">Internet</option>
                                    <option value="R&D">R&D</option>
                                    <option value="Dinas">Dinas</option>
                                    <option value="Pembelian Tools">Pembelian Tools</option>
                                    <option value="Uang Makan">Uang Makan</option>
                                    <option value="Akomodasi">Akomodasi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered" id="danaRequestTable">
                        <thead>
                            <tr>
                                <th>Nominal Request Dana</th>
                                <th>Rekening Tujuan</th>
                                <th>Keterangan Detail</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="number" class="form-control" name="request_dana[]" required>
                                </td>
                                <td>
                                    <select class="form-control" name="rekening_tujuan[]" required>
                                        <option value="">Pilih Rekening</option>
                                        <?php foreach($rekenings as $rekening): ?>
                                            <option value="<?= $rekening['nama_rekening'] ?> - <?= $rekening['nama_bank'] ?> - <?= $rekening['nomor_rekening'] ?>" <?= set_select('nama_rekening', $rekening['nama_rekening']); ?>><?= $rekening['nama_rekening'] ?> - <?= $rekening['nama_bank'] ?> - <?= $rekening['nomor_rekening'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <textarea class="form-control" name="kategori_detail[]" rows="4" required></textarea>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger deleteItemBtn">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-primary" id="addItemBtn">Add Item</button>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Upload Nota</label>
                                <input type="file" class="form-control" id="bukti_nota" name="bukti_nota" required>
                            </div>
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

<hr class="sidebar-divider">

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Petty Cash Data</h6>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTablePetCash" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">No</th>
                            <th style="text-align: center;">Nama Lokasi</th>
                            <th style="text-align: center;">Nomor PO</th>
                            <th style="text-align: center;">Tanggal Request</th>
                            <th style="text-align: center;">Request Dana</th>
                            <th style="text-align: center;">Transfer Finance</th>
                            <th style="text-align: center;">Difference</th>
                            <th style="text-align: center;">Nomor Rekening Tujuan</th>
                            <th style="text-align: center;">Jenis Request</th>
                            <th style="text-align: center;">Bukti Nota</th>
                            <th style="text-align: center;">Bukti Transfer</th>
                            <th style="text-align: center;">Finance Transfer</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($pettycash as $row): 
                            date_default_timezone_set('Asia/Jakarta');

                            $created_at = strtotime($row['created_at']);
                            $today = strtotime(date('Y-m-d H:i:s'));
                            $time_diff = $today - $created_at;
                            $days_diff = floor($time_diff / (60 * 60 * 24));

                            $row_style = '';
                            if ($days_diff > 2 && $row['status'] != 'Transfered') {

                                $row_style = 'animation: blink 2s linear infinite;';
                            }
                            ?>
                        <tr style="<?= $row_style ?>">
                            <style>
                                @keyframes blink {
                                    0% { background-color: #ffcdd2; }
                                    50% { background-color: #ffffff; }
                                    100% { background-color: #ffcdd2; }
                                }
                            </style>
                            <td><?= $no++; ?></td>
                            <td><?= $row['location_name']; ?></td>
                            <td><?= $row['po_number']; ?></td>
                            <td><?= $row['request_date']; ?></td>
                            <td><?= number_format($row['request_dana'], 0, ',', '.'); ?></td>
                            <td><?= number_format($row['nominal_finance'], 0, ',', '.'); ?></td>
                            <td><?= number_format($row['difference'], 0, ',', '.'); ?></td>
                            <td><?= $row['rekening_tujuan']; ?></td>
                            <td><?= $row['category_request']; ?></td>

                            <!-- NOTA -->
                            <td style="text-align: center;">
                                <?php if (!empty($row['bukti_nota'])): ?>
                                    <a href="<?= base_url($row['bukti_nota']); ?>" target="_blank" class="btn btn-primary">View</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>

                            <!-- TRANSFER DATE -->
                            <td style="text-align: center;">
                                <?php if (!empty($row['bukti_transfer'])): ?>
                                    <a href="<?= base_url($row['bukti_transfer']); ?>" target="_blank" class="btn btn-primary">View</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                                <!-- Tanggal -->
                                <?php if ($row['transfer_date'] == '0000-00-00'): ?>
                                    -
                                <?php else: ?>
                                    <?= $row['transfer_date']; ?>
                                <?php endif; ?>
                            </td>
                            
                            <!-- FINANCE DATE -->
                            <td style="text-align: center;">
                                <?php if (!empty($row['bukti_finance'])): ?>
                                    <a href="<?= base_url($row['bukti_finance']); ?>" target="_blank" class="btn btn-primary">View</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                                <!-- Tanggal -->
                                <?php if ($row['finance_date'] == '0000-00-00'): ?>
                                    -
                                <?php else: ?>
                                    <?= $row['finance_date']; ?>
                                <?php endif; ?>
                            </td>

                            <td style="text-align: center;">
                                <!-- JIKA REQ DANA BELUM DI TRANSFER -->
                                <?php if ($row['status'] == 'Pending' && $row['status_finance'] == 'Pending'): ?>
                                    <button class="btn btn-sm btn-warning edit-btn" data-id="<?= $row['id_pc']; ?>" 
                                            data-location-name="<?= $row['location_name']; ?>" 
                                            data-po-number="<?= $row['po_number']; ?>" 
                                            data-request-dana="<?= $row['request_dana']; ?>" 
                                            data-toggle="modal" data-target="#updateTransferModal">
                                        <i class="fas fa-edit"></i> Update Transfer
                                    </button>
                                <!-- JIKA FINANCE BELUM TRANSFER -->
                                <?php elseif ($row['status'] == 'Transfered' && $row['status_finance'] == 'Pending'): ?>
                                    <button class="btn btn-sm btn-warning next-btn" data-id="<?= $row['id_pc']; ?>" 
                                            data-location-name="<?= $row['location_name']; ?>" 
                                            data-po-number="<?= $row['po_number']; ?>" 
                                            data-request-dana="<?= $row['request_dana']; ?>" 
                                            data-toggle="modal" data-target="#updateFinanceTransferModal">
                                        <i class="fas fa-edit"></i> Update Finance
                                    </button>
                                    <!-- JIKA SEMUANYA DONE -->
                                <?php else: ?>
                                    <button class="btn btn-sm btn-success" disabled>
                                        <i class="fas fa-check"></i>
                                    </button>
                                <?php endif; ?>
                                    <button class="btn btn-sm btn-success next-btn" data-id="<?= $row['id_pc']; ?>" 
                                            data-location-name="<?= $row['location_name']; ?>" 
                                            data-po-number="<?= $row['po_number']; ?>" 
                                            data-request-dana="<?= $row['request_dana']; ?>" 
                                            data-toggle="modal" data-target="#updateFinanceTransferModal">
                                        <i class="fas fa-edit"></i> Detail
                                    </button>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Rekening -->
<div class="modal fade" id="addRekeningModal" tabindex="-1" role="dialog" aria-labelledby="addRekeningModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRekeningModalLabel">Tambah Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addRekeningForm" method="post" action="<?= base_url('administration/addRekening'); ?>">
                    <div class="form-group">
                        <label>Nama Rekening</label>
                        <input type="text" class="form-control" name="nama_rekening" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Bank</label>
                        <input type="text" class="form-control" name="nama_bank" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor Rekening</label>
                        <input type="text" class="form-control" name="nomor_rekening" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Bukti Transfer -->
<div class="modal fade" id="updateTransferModal" tabindex="-1" role="dialog" aria-labelledby="updateTransferModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateTransferModalLabel">Update Bukti Transfer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateTransferForm" method="post" action="<?= base_url('administration/updateTransfer'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_pc" id="id_pc">
                    <div class="form-group">
                        <label for="transfer_date">Tanggal Transfer</label>
                        <input type="date" class="form-control" id="transfer_date" name="transfer_date" required>
                    </div>
                    <div class="form-group">
                        <label for="bukti_transfer">Upload Bukti Transfer</label>
                        <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" required>
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

<!-- Modal Update Bukti Transfer Pemasukan-->
<div class="modal fade" id="updateFinanceTransferModal" tabindex="-1" role="dialog" aria-labelledby="updateFinanceTransferModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateFinanceTransferModalLabel">Update Bukti Transfer Finance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateFinanceTransferForm" method="post" action="<?= base_url('administration/updateTransferFinance'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="id_pc_finance" id="id_pc_finance">
                    <div class="form-group">
                        <label for="finance_date">Tanggal Transfer Finance</label>
                        <input type="date" class="form-control" id="finance_date" name="finance_date" required>
                    </div>
                    <div class="form-group">
                        <label for="nominal_finance">Nominal Transfer Finance</label>
                        <input type="number" class="form-control" id="nominal_finance" name="nominal_finance" required>
                    </div>
                    <div class="form-group">
                        <label for="bukti_finance">Upload Bukti Transfer Finance</label>
                        <input type="file" class="form-control" id="bukti_finance" name="bukti_finance" required>
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
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('id_pc').value = this.getAttribute('data-id');
        });
    });
</script>

<script>
    document.querySelectorAll('.next-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('id_pc_finance').value = this.getAttribute('data-id');
            console.log(document.getElementById('id_pc_finance').value);
        });
    });
</script>

<script>
    function updateCategories() {
        const category = document.getElementById('kategori_request').value;
        const detailCategory = document.getElementById('kategori_detail');
        
        // Reset options
        detailCategory.innerHTML = '';
        
        let options = [];

        if (category === 'Internet') {
            options = ['Talangan internet', 'Kuota Orbit', 'Kuota Maipu', 'Kuota Mobile Cashier', 'Kuota Vallet'];

        } else if (category === 'R&D') {
            options = ['kebutuhan PGS', 'Kebutuhan TDS', 'Kebutuhan DDS'];
        
        } else if (category === 'Dinas') {
            options = ['Dana Kasbon', 'Dana Talangan Kasbon', 'Realisasi Kelebihan Dinas', 'Realisasi kekurangan Dinas'];
        
        } else if (category === 'Uang Makan') {
            options = ['Uang Makan'];
        
        } else if (category === 'Akomodasi') {
            options = ['Akomodasi'];
        
        }

        // Add options to the select element
        options.forEach(option => {
            const newOption = document.createElement('option');
            newOption.value = option;
            newOption.textContent = option;
            detailCategory.appendChild(newOption);  // Corrected this line
        });
    }

    // Call updateCategories when category is changed
    document.getElementById('kategori_request').addEventListener('change', updateCategories);

    // Call on window load to initialize the options
    window.onload = updateCategories;

</script>

<script>
    document.getElementById('bukti_nota').addEventListener('change', function(event) {
        if (event.target.files.length > 0) {
            var fileName = event.target.files[0].name;
            console.log('File selected: ' + fileName);
        } else {
            console.log('No file selected');
        }
    });
</script>

<script>
    document.getElementById('bukti_transfer').addEventListener('change', function(event) {
        if (event.target.files.length > 0) {
            var fileName = event.target.files[0].name;
            console.log('File selected: ' + fileName);
        } else {
            console.log('No file selected');
        }
    });
</script>

<script>
    document.getElementById('bukti_finance').addEventListener('change', function(event) {
        if (event.target.files.length > 0) {
            var fileName = event.target.files[0].name;
            console.log('File selected: ' + fileName);
        } else {
            console.log('No file selected');
        }
    });
</script>

<script>
    // Add Item functionality
    document.getElementById('addItemBtn').addEventListener('click', function() {
        var tableBody = document.querySelector('#danaRequestTable tbody');
        var newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>
                <input type="number" class="form-control" name="request_dana[]" required>
            </td>
            <td>
                <select class="form-control" name="rekening_tujuan[]" required>
                    <option value="">Pilih Rekening</option>
                    <?php foreach($rekenings as $rekening): ?>
                        <option value="<?= $rekening['nama_rekening'] ?> - <?= $rekening['nama_bank'] ?> - <?= $rekening['nomor_rekening'] ?>" <?= set_select('nama_rekening', $rekening['nama_rekening']); ?>><?= $rekening['nama_rekening'] ?> - <?= $rekening['nama_bank'] ?> - <?= $rekening['nomor_rekening'] ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <textarea class="form-control" name="kategori_detail[]" rows="4" required></textarea>
            </td>
            <td>
                <button type="button" class="btn btn-danger deleteItemBtn">Delete</button>
            </td>
        `;

        tableBody.appendChild(newRow);
    });

    // Delete Item functionality
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('deleteItemBtn')) {
            e.target.closest('tr').remove();
        }
    });
</script>