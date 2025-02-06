<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard IOT</h1>
    
    <!-- Menampilkan data statistik keluhan -->
    <div class="row" style="width: 70%;">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="text-align: center;"><h5>IOT</h5>
                                <p>Internet Of Things</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="text-align: center;"><?= count($count_data_progress); ?></div>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="text-align: center;"><h5>IOT PGS</h5>
                                <p>Parking Guidance System</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="text-align: center;"><?= count($count_data_progress); ?></div>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="text-align: center;"><h5>IOT DDS</h5>
                                <p>Dynamic Display Signage</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="text-align: center;"><?= count($count_data_progress); ?></div>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="text-align: center;"><h5>IOT TDS</h5>
                                <p>Traffic Dispatch System</p>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" style="text-align: center;"><?= count($count_data_progress); ?></div>
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
                    <h6 class="m-0 font-weight-bold text-primary">List Data</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Location Name</th>
                                    <th>OS Server</th>
                                    <th>IP Address : Port</th>
                                    <th>IOT Category</th>
                                    <th>DB User</th>
                                    <th>DB Password</th>
                                    <th>DB Name</th>
                                    <th>SSH User</th>
                                    <th>SSH Password</th>
                                    <th>Anydesk ID</th>
                                    <th>Anydesk Password</th>
                                    <th>Created at</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php 
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
                                ?> -->
                                <tr style="<?= $row_style ?>">
                                <style>
                                    @keyframes blink {
                                        0% { background-color: #ffcdd2; }
                                        50% { background-color: #ffffff; }
                                        100% { background-color: #ffcdd2; }
                                    }
                                </style>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row->location_name; ?></td>
                                    <td><?= $row->category; ?></td>
                                    <td><?= $row->ip_address; ?> : <?= $row->port; ?></td>
                                    <td><?= $row->iot_category; ?></td>
                                    <td><?= $row->database_username; ?></td>
                                    <td><?= $row->database_password; ?></td>
                                    <td><?= $row->database_name; ?></td>
                                    <td><?= $row->ssh_username; ?></td>
                                    <td><?= $row->ssh_password; ?></td>
                                    <td><?= $row->anydesk_id; ?></td>
                                    <td><?= $row->anydesk_password; ?></td>
                                    <td><?= $row->created_at; ?></td>
                                    <!-- <td><?= $row->created_at; ?></td> -->
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

<hr class="sidebar-divider">