<!-- outstanding dashboard -->


    <!-- Menampilkan data statistik keluhan -->
    <div class="row" style="width: 70%;">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Request</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($count_all_data); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">On Progress Request</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($count_data_progress); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Closed Request</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($count_data_closed); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cancelled Request</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($count_data_cancelled); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ban fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Keluhan -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Requests Ticket</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableRequest" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Name</th>
                                    <th>E-Mail</th>
                                    <th>Phone</th>
                                    <th>Category</th>
                                    <th>Deadline</th>
                                    <th>Description</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                foreach ($dashboard_data as $row): 
                                    date_default_timezone_set('Asia/Jakarta');
                                    $deadline = strtotime($row->deadline_date);
                                    $today = strtotime(date('Y-m-d')); 
                                    $is_overdue = $deadline < $today;
                                    $row_style = '';
                                    // if($row->status == 'asa') {
                                    //     $row_style = 'background-color: #90EE90;';
                                    // } else 
                                    if($is_overdue) {
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
                                    <!-- <td><?= $no++; ?></td> -->
                                    <td><?= $row->id_ticket; ?></td>
                                    <td><?= $row->issue_date; ?></td>
                                    <td><?= $row->issue_title; ?></td>
                                    <td><?= $row->reporter_name; ?></td>
                                    <td><?= $row->reporter_email; ?></td>
                                    <td><?= $row->reporter_phone; ?></td>
                                    <td><?= $row->category; ?></td>
                                    <td><?= $row->deadline_date; ?></td>
                                    <td><?= $row->issue_description; ?></td>
                                    <td><?= $row->created_at; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
<script>
    $(document).ready(function() {
        // Inisialisasi DataTable dengan fitur Pagination dan Export buttons
        var table = $('#dataTableRequest').DataTable({
            "paging": true,                // Enable pagination
            "pageLength": 10,              // Set the number of records per page
            "lengthChange": true,          // Allow the user to change the page length
            "searching": true,             // Enable search functionality
            "ordering": false,             // Enable column sorting
            "info": true,                  // Show info like "Showing 1 to 10 of 100"
            "autoWidth": false,            // Disable auto width for table columns
            "responsive": true,            // Make the table responsive for small screens
        });
    });
</script>
