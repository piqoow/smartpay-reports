<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">EV Server/Client Management</h1>

    <?php if ($this->session->flashdata('success')) : ?>
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
                <h6 class="m-0 font-weight-bold text-primary">Data NUC EV</h6>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addIOTModal">
                    <i class="fas fa-plus"></i> Add New Device
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableIOT" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Location Name</th>
                            <th>Operation System</th>
                            <th>IP Address : Port</th>
                            <th>Category</th>
                            <th>SSH User</th>
                            <th>SSH Password</th>
                            <th>Anydesk ID</th>
                            <th>Anydesk Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($dashboard as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['location_name']; ?></td>
                                <td><?= $row['operation_system']; ?></td>
                                <td><?= $row['ip_address']; ?> : <?= $row['port']; ?></td>
                                <td><?= $row['category']; ?></td>
                                <td><?= $row['ssh_username']; ?></td>
                                <td><?= $row['ssh_password']; ?></td>
                                <td><?= $row['anydesk_id']; ?></td>
                                <td><?= $row['anydesk_password']; ?></td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-warning edit-btn" data-toggle="modal" data-target="#editIOTModal" 
                                            data-id="<?= $row['id_ev']; ?>"
                                            data-location-name="<?= $row['location_name']; ?>"
                                            data-os-server="<?= $row['operation_system']; ?>"
                                            data-ip-address="<?= $row['ip_address']; ?>"
                                            data-port="<?= $row['port']; ?>"
                                            data-iot-category="<?= $row['category']; ?>"
                                            data-implementation-date="<?= $row['implementation_date']; ?>"
                                            data-db-user="<?= $row['database_username']; ?>"
                                            data-db-password="<?= $row['database_password']; ?>"
                                            data-db-name="<?= $row['database_name']; ?>"
                                            data-ssh-user="<?= $row['ssh_username']; ?>"
                                            data-ssh-password="<?= $row['ssh_password']; ?>"
                                            data-anydesk-id="<?= $row['anydesk_id']; ?>"
                                            data-anydesk-password="<?= $row['anydesk_password']; ?>" disabled>
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <!-- Delete Button -->
                                    <button class="btn btn-sm btn-danger delete-btn" data-toggle="modal" data-target="#deleteIOTModal" 
                                            data-id="<?= $row['id_ev']; ?>" disabled>
                                        <i class="fas fa-trash"></i> Delete
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
<!-- /.container-fluid -->

<!-- Add IOT Modal -->
<div class="modal fade" id="addIOTModal" tabindex="-1" role="dialog" aria-labelledby="addIOTModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addIOTModalLabel">Add New Device</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('iot-ev/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Location Name</label>
                                <input type="text" class="form-control" name="location_name" required>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="location_name">Location Name</label>
                                <select class="form-control" name="location_name" id="location_name" required>
                                    <?php foreach($locations as $location): ?>
                                        <option value="<?= $location->nama_Lokasi ?>" <?= set_select('nama_Lokasi', $location->nama_Lokasi); ?>><?= $location->nama_Lokasi ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>OS Server</label>
                                <select class="form-control" name="os_server" id="os_server" required>
                                    <option value="Ubuntu">Linux Ubuntu</option>
                                    <option value="Windows">Windows</option>
                                    <option value="Raspberry">Raspberry</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IP Address</label>
                                <input type="text" class="form-control" name="ip_address" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Port IOT</label>
                                <input type="text" class="form-control" name="port" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IOT Category</label>
                                <select class="form-control" name="iot_category" id="iot_category" required>
                                    <!-- <option value="">Select Category</option> -->
                                    <!-- <option value="ALL">ALL</option> -->
                                    <!-- <option value="PGS">PGS</option> -->
                                    <!-- <option value="DDS">DDS</option> -->
                                    <!-- <option value="TDS">TDS</option> -->
                                    <option value="EVGATE">EVGATE</option>
                                    <option value="IOT">IOT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>DB User</label>
                                <input type="text" class="form-control" name="database_username" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>DB Password</label>
                                <input type="text" class="form-control" name="database_password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>DB Name</label>
                                <input type="text" class="form-control" name="database_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SSH User</label>
                                <input type="text" class="form-control" name="ssh_username" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SSH Password</label>
                                <input type="text" class="form-control" name="ssh_password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Anydesk ID</label>
                                <input type="text" class="form-control" name="anydesk_id" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Anydesk Password</label>
                                <input type="text" class="form-control" name="anydesk_password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Implementation Date</label>
                                <input type="date" class="form-control" name="implementation_date" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit IOT Modal -->
<div class="modal fade" id="editIOTModal" tabindex="-1" role="dialog" aria-labelledby="editIOTModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editIOTModalLabel">Edit IOT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('iot/edit'); ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Location Name</label>
                                <input type="text" class="form-control" name="location_name" id="edit_location_name" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>OS Server</label>
                                <select class="form-control" name="os_server" id="edit_os_server" required>
                                    <option value="Ubuntu">Linux Ubuntu</option>
                                    <option value="Windows">Windows</option>
                                    <option value="Raspberry">Raspberry</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IP Address</label>
                                <input type="text" class="form-control" name="ip_address" id="edit_ip_address" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Port</label>
                                <input type="text" class="form-control" name="port" id="edit_port" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IOT Category</label>
                                <input type="text" class="form-control" name="iot_category" id="edit_iot_category" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>DB User</label>
                                <input type="text" class="form-control" name="database_username" id="edit_db_user" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>DB Password</label>
                                <input type="text" class="form-control" name="database_password" id="edit_db_password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>DB Name</label>
                                <input type="text" class="form-control" name="database_name" id="edit_db_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SSH User</label>
                                <input type="text" class="form-control" name="ssh_username" id="edit_ssh_user" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SSH Password</label>
                                <input type="text" class="form-control" name="ssh_password" id="edit_ssh_password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Anydesk ID</label>
                                <input type="text" class="form-control" name="anydesk_id" id="edit_anydesk_id" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Anydesk Password</label>
                                <input type="text" class="form-control" name="anydesk_password" id="edit_anydesk_password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Implementation Date</label>
                                <input type="date" class="form-control" name="implementation_date" id="edit_implementation_date" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Delete IOT Modal -->
<div class="modal fade" id="deleteIOTModal" tabindex="-1" role="dialog" aria-labelledby="deleteIOTModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteIOTModalLabel">Delete IOT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('iot/delete'); ?>" method="post">
                <div class="modal-body">
                    <p>Are you sure you want to delete this IOT?</p>
                    <input type="hidden" name="id" id="delete_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for Modal Actions -->
<script>
    // Edit Button Handler
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            console.log('Button clicked!');
            console.log('ID:', this.getAttribute('data-id'));
            console.log('Location Name:', this.getAttribute('data-location-name'));
            console.log('OS Server:', this.getAttribute('data-os-server'));
            console.log('IP Address:', this.getAttribute('data-ip-address'));
            console.log('Port:', this.getAttribute('data-port'));
            
            document.getElementById('edit_id').value = this.getAttribute('data-id');
            document.getElementById('edit_location_name').value = this.getAttribute('data-location-name');
            const osServerSelect = document.getElementById('edit_os_server');
            osServerSelect.value = this.getAttribute('data-os-server'); // Memastikan ini sesuai
            
            document.getElementById('edit_ip_address').value = this.getAttribute('data-ip-address');
            document.getElementById('edit_port').value = this.getAttribute('data-port');
            document.getElementById('edit_iot_category').value = this.getAttribute('data-iot-category');
            document.getElementById('edit_implementation_date').value = this.getAttribute('data-implementation-date');
            document.getElementById('edit_db_user').value = this.getAttribute('data-db-user');
            document.getElementById('edit_db_password').value = this.getAttribute('data-db-password');
            document.getElementById('edit_db_name').value = this.getAttribute('data-db-name');
            document.getElementById('edit_ssh_user').value = this.getAttribute('data-ssh-user');
            document.getElementById('edit_ssh_password').value = this.getAttribute('data-ssh-password');
            document.getElementById('edit_anydesk_id').value = this.getAttribute('data-anydesk-id');
            document.getElementById('edit_anydesk_password').value = this.getAttribute('data-anydesk-password');
            document.getElementById('edit_last_update').value = this.getAttribute('data-last-update');
        });
    });


    // Delete Button Handler
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('delete_id').value = this.getAttribute('data-id');
        });
    });

</script>