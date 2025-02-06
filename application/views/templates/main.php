<?php $this->load->view('templates/v_header') ?>

<!-- Page Wrapper -->
<div id="wrapper">

<?php $this->load->view('templates/v_sidebar') ?>

    
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

                <?php $this->load->view('templates/v_topbar') ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                <?php $this->load->view($content); ?>
            </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; CP-Helpdesk 2024</span>
                    </div>
                </div>
                <?php $this->load->view('templates/v_footer') ?>
                </footer>    
            </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <?php $this->load->view('templates/scripts') ?>