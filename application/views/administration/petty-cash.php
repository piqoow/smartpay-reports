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
                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPetCashModal">
                    <i class="fas fa-plus"></i> Add Request
                </button> -->

                <button type="button" class="btn btn-success ml-2" data-toggle="modal" data-target="#addRekeningModal">
                    <i class="fas fa-plus"></i> Tambah Rekening
                </button>
            </div>
        </div>
        <div class="card-body">
        <form action="<?= base_url('administration/addPettyCash'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lokasi</label>
                                <input type="text" class="form-control" name="location_name" required>
                                <!-- <select class="form-control" name="location_name" id="location_name" required>
                                    <?php foreach($locations as $location): ?>
                                        <option value="<?= $location->nama_Lokasi ?>" <?= set_select('nama_Lokasi', $location->nama_Lokasi); ?>><?= $location->nama_Lokasi ?></option>
                                    <?php endforeach; ?>
                                </select> -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor PO</label>
                                <input type="text" class="form-control" name="nomor_po" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Request Dana</label>
                                <input type="number" class="form-control" name="request_dana" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Rekening Tujuan</label>
                                <select class="form-control" name="rekening_tujuan" id="rekening_tujuan" required>
                                    <?php foreach($rekenings as $rekening): ?>
                                        <option value="<?= $rekening['nama_rekening'] ?> - <?= $rekening['nama_bank'] ?> - <?= $rekening['nomor_rekening'] ?>" <?= set_select('nama_rekening', $rekening['nama_rekening']); ?>><?= $rekening['nama_rekening'] ?> - <?= $rekening['nama_bank'] ?> - <?= $rekening['nomor_rekening'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori Request</label>
                                <select class="form-control" name="kategori_request" id="kategori_request" required>
                                    <option value="">Select Category</option>
                                    <option value="Internet">Internet</option>
                                    <option value="R&D">R&D</option>
                                    <option value="Dinas">Dinas</option>
                                    <option value="Pembelian Tools">Pembelian Tools</option>
                                    <option value="Uang Makan">Uang Makan</option>
                                    <option value="Akomodasi">Akomodasi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kategori_detail">Keterangan Detail</label>
                                <select class="form-control" name="kategori_detail" id="kategori_detail" required>
                                    <option value="">Select Category</option>
                                </select>                       
                            </div>
                        </div>
                    </div>
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
                            <th>No</th>
                            <th>Nama Lokasi</th>
                            <th>Nomor PO -</th>
                            <th>Tanggal Request</th>
                            <th>Request Dana</th>
                            <th>Nomor Rekening Tujuan</th>
                            <th>Jenis Request</th>
                            <th>Keterangan</th>
                            <th>Bukti Nota</th>
                            <th>Status</th>
                            <th>Bukti Transfer</th>
                            <th>Tanggal Transfer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($pettycash as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['location_name']; ?></td>
                            <td><?= $row['po_number']; ?></td>
                            <td><?= $row['request_date']; ?></td>
                            <td><?= $row['request_dana']; ?></td>
                            <td><?= $row['rekening_tujuan']; ?></td>
                            <td><?= $row['category_request']; ?></td>
                            <td><?= $row['category_detail']; ?></td>
                            <td>
                                <?php if (!empty($row['bukti_nota'])): ?>
                                    <a href="<?= base_url($row['bukti_nota']); ?>" target="_blank" class="btn btn-primary">View</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td><?= $row['status']; ?></td>
                            <td>
                                <?php if (!empty($row['bukti_transfer'])): ?>
                                    <a href="<?= base_url($row['bukti_transfer']); ?>" target="_blank" class="btn btn-primary">View</a>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($row['transfer_date'] == '0000-00-00'): ?>
                                    -
                                <?php else: ?>
                                    <?= $row['transfer_date']; ?>
                                <?php endif; ?>
                            </td>	
                            <td>
                                <?php if ($row['status'] != 'Transfered'): ?>
                                    <!-- Tombol Update hanya aktif jika status bukan 'Transfered' -->
                                    <button class="btn btn-sm btn-warning edit-btn" data-id="<?= $row['id_pc']; ?>" 
                                            data-location-name="<?= $row['location_name']; ?>" 
                                            data-po-number="<?= $row['po_number']; ?>" 
                                            data-request-dana="<?= $row['request_dana']; ?>" 
                                            data-toggle="modal" data-target="#updateTransferModal">
                                        <i class="fas fa-edit"></i> Update
                                    </button>
                                <?php else: ?>
                                    <!-- Jika status 'Transfered', tombol akan dinonaktifkan -->
                                    <button class="btn btn-sm btn-success" disabled>
                                        <i class="fas fa-check"></i>
                                    </button>
                                <?php endif; ?>
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
                        <label for="transfer_date">Upload Bukti Transfer</label>
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

<script>
    $(document).ready(function() {
        // When the update button is clicked
        $(".edit-btn").click(function() {
            var id = $(this).data('id');
            // Set the id of the petty cash to be updated
            $("#id_pc").val(id);
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