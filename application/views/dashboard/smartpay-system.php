<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Smartpay System</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Data</h6>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                    <i class="fas fa-plus"></i> Add System
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableUser" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name System</th>
                            <th>Category System</th>
                            <th>URL</th>
                            <th>Launching Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($systems as $system): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $system['system_name']; ?></td>
                            <td><?= $system['system_category']; ?></td>
                            <td>
                                <a href="<?= $system['system_url']; ?>" target="_blank">
                                    <button class="btn btn-primary">
                                        Go to System
                                    </button>
                                </a>
                            </td>
                            <td><?= $system['launching_date']; ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-sm btn-warning edit-btn" data-id="<?= $system['id_system']; ?>" 
                                        data-name="<?= $system['system_name']; ?>" data-category="<?= $system['system_category']; ?>"
                                        data-url="<?= $system['system_url']; ?>" data-launching="<?= $system['launching_date']; ?>" data-toggle="modal" data-target="#editSystemModal" disabled>
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <!-- Delete Button -->
                                <!-- <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $system['id_system']; ?>" data-toggle="modal" data-target="#deleteUserModal">
                                    <i class="fas fa-trash"></i> Delete
                                </button> -->
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

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('smartpay-system/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>System Name</label>
                        <input type="text" class="form-control" name="system_name" required>
                    </div>
                    <div class="form-group">
                        <label>System Category</label>
                        <select class="form-control" name="system_category" required>
                            <option value="Webbased">Webbased</option>
                            <!-- <option value="Staff">Staff</option> -->
                            <!-- <option value="User">User</option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <label>System Url</label>
                        <input type="text" class="form-control" name="system_url" required>
                    </div>
                    <div class="form-group">
                        <label>Launching Date</label>
                        <input type="date" class="form-control" name="launching_date" required>
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

<!-- Edit User Modal -->
<div class="modal fade" id="editSystemModal" tabindex="-1" role="dialog" aria-labelledby="editSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSystemModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/edit'); ?>" method="post">
                <div class="modal-body">
                    <!-- Hidden ID field for user -->
                    <input type="hidden" name="id" id="edit_id">

                    <!-- User Name Input -->
                    <div class="form-group">
                        <label for="edit_name">User Name</label>
                        <input type="text" class="form-control" name="username" id="edit_name" required>
                    </div>

                    <!-- Email Input -->
                    <div class="form-group">
                        <label for="edit_email">E-mail</label>
                        <input type="email" class="form-control" name="user_email" id="edit_email" required>
                    </div>

                    <!-- Password Input -->
                    <div class="form-group">
                        <label for="edit_password">Password</label>
                        <input type="password" class="form-control" name="password" id="edit_password" placeholder="Leave blank if no change">
                    </div>

                    <!-- User Level Input -->
                    <div class="form-group">
                        <label for="edit_level">Level</label>
                        <select class="form-control" name="user_level" id="edit_level" required>
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                            <option value="User">User</option>
                        </select>
                    </div>

                    <!-- Teams Input -->
                    <div class="form-group">
                        <label for="edit_teams">Teams</label>
                        <select class="form-control" name="user_teams" id="edit_teams" required>
                            <option value="Helpdesk">Helpdesk</option>
                            <option value="Network">Network</option>
                            <option value="Parkee System">Parkee System</option>
                            <option value="IOT System">IOT System</option>
                            <option value="Infra">Infrastructure</option>
                            <option value="IT Support">IT Support</option>
                        </select>
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

<!-- JavaScript for Modal Actions -->
<script>
    // Function to set the ID for the user to delete in the delete modal
    function setDeleteUserId(userId) {
        document.getElementById('deleteUserId').value = userId;
    }

    // Event listener for delete buttons
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            var userId = this.getAttribute('data-id');
            setDeleteUserId(userId);  // Set the user ID to delete
            document.querySelector('#deleteUserModal form').action = '<?= base_url("user/delete/"); ?>' + userId;
            $('#deleteUserModal').modal('show');  // Show the delete modal
        });
    });

    // Menangani klik tombol Edit untuk memuat data ke dalam modal edit
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Ambil data dari atribut tombol
            var userId = this.getAttribute('data-id');
            var username = this.getAttribute('data-name');
            var userEmail = this.getAttribute('data-email');
            var userLevel = this.getAttribute('data-level');
            var userTeams = this.getAttribute('data-teams');

            // Isi input di modal edit dengan data pengguna
            document.getElementById('edit_id').value = userId;
            document.getElementById('edit_name').value = username;
            document.getElementById('edit_email').value = userEmail;
            document.getElementById('edit_level').value = userLevel;
            document.getElementById('edit_teams').value = userTeams;

            // Tampilkan modal edit
            $('#editSystemModal').modal('show');
        });
    });

</script>
