<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"></h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Task Report</h6>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTaskModal">
                    <i class="fas fa-plus"></i> New Task Report
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Task</th>
                            <th>Category</th>
                            <th>Location Name</th>
                            <th>Report</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($daily as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row->startdate_task; ?></td>
                                <td><?= $row->owner_task; ?></td>
                                <td><?= $row->name_task; ?></td>
                                <td><?= $row->category_task; ?></td>
                                <td><?= $row->location_name; ?></td>
                                <td><?= $row->report_task; ?></td>
                                <td><?= $row->status_task; ?></td>
                                <td>
                                    <!-- Edit Button -->
                                    <button class="btn btn-sm btn-warning edit-btn" data-toggle="modal" data-target="#editIOTModal" 
                                            data-id="<?= $row->id_task; ?>"
                                            data-name-task="<?= $row->name_task; ?>"
                                            data-owner-task="<?= $row->owner_task; ?>"
                                            data-user-teams="<?= $row->user_teams; ?>"
                                            data-location-name="<?= $row->location_name; ?>"
                                            data-category-task="<?= $row->category_task; ?>"
                                            data-system-category="<?= $row->system_category; ?>"
                                            data-priority-task="<?= $row->priority_task; ?>"
                                            data-status-task="<?= $row->status_task; ?>"
                                            data-startdate-task="<?= $row->startdate_task; ?>"
                                            data-enddate-task="<?= $row->enddate_task; ?>"
                                            data-reason-task="<?= $row->reason_task; ?>"
                                            data-constraint-task="<?= $row->constraint_task; ?>"
                                            data-report-task="<?= $row->report_task; ?>"
                                            data-outstanding-task="<?= $row->outstanding_task; ?>"
                                            data-file-name="<?= $row->file_name; ?>"
                                            data-last-update="<?= $row->created_at; ?>"
                                            >
                                        <i class="fas fa-file"></i> Detail
                                    </button>
                                    
                                    <?php if($this->session->userdata('user_teams') == 'SoftwareDev' || $this->session->userdata('user_teams') == 'Dev'): ?>
                                    <!-- Delete Button -->
                                    <button class="btn btn-sm btn-danger delete-btn" data-toggle="modal" data-target="#deleteIOTModal" 
                                            data-id="<?= $row->id_task; ?>">
                                        <i class="fas fa-trash"></i> Delete
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
<!-- /.container-fluid -->

<!-- Add Task Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">New Task Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('task/addDaily'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Pekerja</label>
                                <input type="text" class="form-control" name="username" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job Name</label>
                                <input type="text" class="form-control" name="name_task" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori Job</label>
                                <select class="form-control" name="category_task" id="category_task" required>
                                    <option value="">Select Category</option>
                                    <option value="Troubleshooting">Troubleshooting</option>
                                    <option value="Research">Research</option>
                                    <option value="Deployment">Deployment</option>
                                    <option value="Setup New Location">Setup New Location</option>
                                    <option value="Maintenance">Maintenance</option>
                                    <option value="Installation">Installation</option>
                                    <option value="Assembling">Assembling</option>
                                    <option value="Quality Control">Quality Control</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori Sistem</label>
                                <select class="form-control" name="system_category" id="system_category" required>
                                    <option value="">Select Category</option>
                                    <option value="Server">Server</option>
                                    <option value="PGS">PGS</option>
                                    <option value="DDS">DDS</option>
                                    <option value="TDS">TDS</option>
                                    <option value="EB">EB</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Lokasi</label>
                                <input type="text" class="form-control" name="location_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Report</label>
                                <input type="date" class="form-control" name="startdate_task" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status_task" id="status_task" required>
                                    <option value="">Select Status</option>
                                    <option value="Resolved">Resolved</option>
                                    <option value="Recommendation Service">Recommendation Service</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Additional fields for Troubleshooting -->
                    <div class="row" id="troubleshooting-fields" style="display: none;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kendala</label>
                                <input type="text" class="form-control" name="reason_task" id="reason_task">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Penyebab</label>
                                <input type="text" class="form-control" name="constraint_task" id="constraint_task">
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Report</label>
                                <input type="text" class="form-control" name="report_task" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Outstanding</label>
                                <input type="text" class="form-control" name="outstanding_task" placeholder="kosongkan jika selesai">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Upload File</label>
                                <input type="file" class="form-control" name="file_name" id="file_name" required>
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
                                <label>Nama Pekerja</label>
                                <input type="text" class="form-control" name="owner_task" id="edit_owner_task" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Job Name</label>
                                <input type="text" class="form-control" name="name_task" id="edit_name_task" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori Task</label>
                                <input type="text" class="form-control" name="category_task" id="edit_category_task" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori Sistem</label>
                                <input type="text" class="form-control" name="system_category" id="edit_system_category" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Port</label>
                                <input type="text" class="form-control" name="port" id="edit_port" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>IOT Category</label>
                                <input type="text" class="form-control" name="iot_category" id="edit_iot_category" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>DB User</label>
                                <input type="text" class="form-control" name="database_username" id="edit_db_user" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>DB Password</label>
                                <input type="text" class="form-control" name="database_password" id="edit_db_password" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>DB Name</label>
                                <input type="text" class="form-control" name="database_name" id="edit_db_name" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SSH User</label>
                                <input type="text" class="form-control" name="ssh_username" id="edit_ssh_user" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>SSH Password</label>
                                <input type="text" class="form-control" name="ssh_password" id="edit_ssh_password" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Anydesk ID</label>
                                <input type="text" class="form-control" name="anydesk_id" id="edit_anydesk_id" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Anydesk Password</label>
                                <input type="text" class="form-control" name="anydesk_password" id="edit_anydesk_password" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Implementation Date</label>
                                <input type="date" class="form-control" name="implementation_date" id="edit_implementation_date" disabled>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" class="btn btn-danger">Delete</button> -->
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Event listener untuk menangani perubahan pada input file
    document.getElementById('file_name').addEventListener('change', function(event) {
        // Cek apakah file ada
        if (event.target.files.length > 0) {
            // Dapatkan nama file yang dipilih
            var fileName = event.target.files[0].name;
            console.log('File selected: ' + fileName);
        } else {
            console.log('No file selected');
        }
    });
</script>

<script>
    // Fungsi untuk menangani perubahan pada kategori tugas
    document.getElementById('category_task').addEventListener('change', function() {
        var category = this.value;

        // Cek jika kategori adalah 'Troubleshooting'
        if (category === 'Troubleshooting') {
            // Tampilkan input "Form Kendala" dan "Form Penyebab"
            document.getElementById('troubleshooting-fields').style.display = 'block';
        } else {
            // Sembunyikan input jika bukan 'Troubleshooting'
            document.getElementById('troubleshooting-fields').style.display = 'none';
        }
    });
</script>

<!-- JavaScript for Modal Actions -->
<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            console.log('Button clicked!');
            console.log('ID:', this.getAttribute('data-id'));
            console.log('Name Task:', this.getAttribute('data-name-task'));
            console.log('Location Name:', this.getAttribute('data-location-name'));
            console.log('Owner Task:', this.getAttribute('data-owner-task'));
            console.log('User Teams:', this.getAttribute('data-user-teams'));
            console.log('Category Task:', this.getAttribute('data-category-task'));
            console.log('System Category:', this.getAttribute('data-system-category'));
            console.log('Priority Task:', this.getAttribute('data-priority-task'));
            console.log('Status Task:', this.getAttribute('data-status-task'));
            console.log('Start Date Task:', this.getAttribute('data-startdate-task'));
            console.log('End Date Task:', this.getAttribute('data-enddate-task'));
            console.log('Reason Task:', this.getAttribute('data-reason-task'));
            console.log('Constraint Task:', this.getAttribute('data-constraint-task'));
            console.log('Report Task:', this.getAttribute('data-report-task'));
            console.log('Outstanding Task:', this.getAttribute('data-outstanding-task'));
            console.log('File Name:', this.getAttribute('data-file-name'));
            console.log('Last Update:', this.getAttribute('data-last-update'));
            
            document.getElementById('edit_id').value = this.getAttribute('data-id');
            document.getElementById('edit_name_task').value = this.getAttribute('data-name-task');
            document.getElementById('edit_owner_task').value = this.getAttribute('data-owner-task');
            document.getElementById('edit_user_teams').value = this.getAttribute('data-user-teams');
            document.getElementById('edit_location_name').value = this.getAttribute('data-location-name');
            document.getElementById('edit_category_task').value = this.getAttribute('data-category-task');
            document.getElementById('edit_system_category').value = this.getAttribute('data-system-category');
            document.getElementById('edit_priority_task').value = this.getAttribute('data-priority-task');
            document.getElementById('edit_status_task').value = this.getAttribute('data-status-task');
            document.getElementById('edit_startdate_task').value = this.getAttribute('data-startdate-task');
            document.getElementById('edit_enddate_task').value = this.getAttribute('data-enddate-task');
            document.getElementById('edit_reason_task').value = this.getAttribute('data-reason-task');
            document.getElementById('edit_constraint_task').value = this.getAttribute('data-constraint-task');
            document.getElementById('edit_report_task').value = this.getAttribute('data-report-task');
            document.getElementById('edit_outstanding_task').value = this.getAttribute('data-outstanding-task');
            document.getElementById('edit_filename').value = this.getAttribute('data-file-name');
            document.getElementById('edit_last-update').value = this.getAttribute('data-last-update');
        });
    });


    // Delete Button Handler
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('delete_id').value = this.getAttribute('data-id');
        });
    });
</script>
