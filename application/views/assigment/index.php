<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">My Assignment</h1>
    
    <!-- Menampilkan data statistik keluhan -->
    <div class="row" style="width: 70%;">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Ticket</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($count_all_data_teams); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card lain untuk On Progress dan Closed Ticket -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">On Progress Ticket</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($count_data_progress_teams); ?></div>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Close Tickets</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($count_data_closed_teams); ?></div>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Cancelled Tickets</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($count_data_cancelled_teams); ?></div>
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
                    <h6 class="m-0 font-weight-bold text-primary">Complaints Ticket</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                foreach ($dashboard_data_teams as $row): 
                                    $deadline = strtotime($row['deadline_date']);
                                    $today = strtotime(date('Y-m-d')); 
                                    $is_overdue = $deadline < $today;
                                    $row_style = $is_overdue ? 'style="animation: blink 2s linear infinite;"' : '';
                                ?>
                                <tr <?= $row_style ?>>
                                    <!-- <td><?= $no++; ?></td> -->
                                    <td><?= $row['id_ticket']; ?></td>
                                    <td><?= $row['issue_date']; ?></td>
                                    <td><?= $row['issue_title']; ?></td>
                                    <td><?= $row['reporter_name']; ?></td>
                                    <td><?= $row['reporter_email']; ?></td>
                                    <td><?= $row['reporter_phone']; ?></td>
                                    <td><?= $row['category']; ?></td>
                                    <td><?= $row['deadline_date']; ?></td>
                                    <td><?= $row['issue_description']; ?></td>
                                    <td><?= $row['created_at']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
