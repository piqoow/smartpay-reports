
            
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-fw fa-home"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Smartpay Reports</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Heading -->
            <!-- <div class="sidebar-heading">
                Dashboard
            </div> -->

            <!-- Nav Item - Dashboard -->
            <!-- <?php if($this->session->userdata('user_teams') == 'Helpdesk' || $this->session->userdata('user_teams') == 'Dev'): ?> -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('assigment'); ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>My Task</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li> -->
            <!-- <?php else: ?> -->

            <!-- Assigment Dashboard -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="<?= base_url('assigment'); ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>My Assigment</span></a>
            </li> -->
            <!-- <?php endif; ?> -->

            <!-- <li class="nav-item">
                <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li> -->

            <!-- Heading -->
            <div class="sidebar-heading">
                Reporting
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('daily-task'); ?>">
                    <i class="fas fa-fw fa-sign"></i>
                    <span>Daily Task</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manage Assets
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('iot'); ?>">
                    <i class="fas fa-fw fa-microchip"></i>
                    <span>IOT Server</span>
                </a>
            </li>
            
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseManage"
                    aria-expanded="true" aria-controls="collapseManage">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>IOT Manage</span>
                </a>
                <div id="collapseManage" class="collapse" aria-labelledby="headingManage"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">IOT Data :</h6>
                        <a class="collapse-item" href="<?= base_url('iot-pgs'); ?>">PGS<br>(Parking Guidance System)</a>
                        <a class="collapse-item" href="<?= base_url('iot-dds'); ?>">DDS<br>(Dynamic Display Signage)</a>
                        <a class="collapse-item" href="<?= base_url('iot-tds'); ?>">TDS<br>(Traffic Dispatch System)</a>
                        <a class="collapse-item" href="<?= base_url('iot-eb'); ?>">EB<br>(Emergency Button)</a>
                    </div>
                </div>
            </li> -->
            
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport"
                    aria-expanded="true" aria-controls="collapseReport">
                    <i class="fas fa-fw fa-book"></i>
                    <span>IOT Report</span>
                </a>
                <div id="collapseReport" class="collapse" aria-labelledby="headingReport"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">IOT Data Report :</h6>
                        <a class="collapse-item" href="<?= base_url('iot'); ?>">PGS<br>(Parking Guidance System)</a>
                        <a class="collapse-item" href="<?= base_url('iot'); ?>">DDS<br>(Dynamic Display Signage)</a>
                        <a class="collapse-item" href="<?= base_url('iot'); ?>">TDS<br>(Traffic Dispatch System)</a>
                        <a class="collapse-item" href="<?= base_url('iot'); ?>">EB<br>(Emergency Button)</a>
                    </div>
                </div>
            </li> -->

            <hr class="sidebar-divider">
            <?php if($this->session->userdata('user_teams') == 'SoftwareDev' || $this->session->userdata('user_teams') == 'Dev'): ?>
            <div class="sidebar-heading">
                Dev Center
            </div>
            
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('user'); ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User Manage</span>
                </a>
            </li>
            <?php endif; ?>

            <!-- Nav Item - Utilities Collapse Menu -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilities</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Utilities:</h6>
                        <a class="collapse-item" href="utilities-color.html">Colors</a>
                        <a class="collapse-item" href="utilities-border.html">Borders</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>
            <?php if($this->session->userdata('user_level') == 'Dev'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('user'); ?>">
                        <i class="fas fa-fw fa-user"></i>
                        <span>User Manage</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('maintenance'); ?>">
                        <i class="fas fa-fw fa-history"></i>
                        <span>Log Update History</span>
                    </a>
                </li>
                <?php endif; ?>

                <!-- RND & DEVS TEAMS -->
           

            <!-- Nav Item - Charts -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li> -->

            <!-- Nav Item - Tables -->
            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li> -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->