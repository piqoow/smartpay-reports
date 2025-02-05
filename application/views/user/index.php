<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">User Management</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
                    <i class="fas fa-plus"></i> Add User
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th>Teams</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($users as $user): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $user['username']; ?></td>
                            <td><?= $user['user_email']; ?></td>
                            <td><?= $user['user_level']; ?></td>
                            <td><?= $user['user_teams']; ?></td>
                            <td>
                                <!-- Edit Button -->
                                <button class="btn btn-sm btn-warning edit-btn" data-id="<?= $user['id']; ?>" 
                                        data-name="<?= $user['username']; ?>" data-email="<?= $user['user_email']; ?>"
                                        data-level="<?= $user['user_level']; ?>" data-toggle="modal" data-target="#editUserModal">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <!-- Delete Button -->
                                <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $user['id']; ?>" data-toggle="modal" data-target="#deleteUserModal">
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
            <form action="<?= base_url('user/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" class="form-control" name="user_email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select class="form-control" name="user_level" required>
                            <option value="Manager">Manager</option>
                            <option value="Staff">Staff</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Teams</label>
                        <select class="form-control" name="user_teams" required>
                            <option value="SoftwareDev">SoftwareDev</option>
                            <option value="Administration">Administration</option>
                            <option value="ResearchAndDevelopment">Research And Development</option>
                            <option value="IT_Support">IT Support</option>
                            <option value="Cashless">Cashless</option>
                        </select>
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
<div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
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



<!-- Delete User Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/delete/'.$user['id']); ?>" method="post">
                <div class="modal-body">
                    <p>Are you sure you want to delete this user?</p>
                    <input type="hidden" name="user_id" id="deleteUserId">
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
            $('#editUserModal').modal('show');
        });
    });

</script>
