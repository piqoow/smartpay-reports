<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

<!-- toastr -->
<link rel="stylesheet" href="<?= base_url('assets/css/toastr.min.css'); ?>">
<script src="<?= base_url('assets/js/toastr.min.js'); ?>"></script>

    <script>
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "onclick": null,
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "width": "auto",
        "white-space": "nowrap" 
    };
    </script>


    <?php if (isset($additional_scripts)) : ?>
        <?php foreach ($additional_scripts as $script) : ?>
            <script src="<?php echo base_url($script); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>


    <!-- toastr notification -->
    <?php if ($this->session->flashdata('success')): ?>
    <script>
        toastr.success("<?php echo $this->session->flashdata('success'); ?>");
    </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
    <script>
        toastr.error("<?php echo $this->session->flashdata('error'); ?>");
    </script>
    <?php endif; ?>

   
<!-- scripts.php atau bagian bawah halaman -->
<script>
    $(document).ready(function() {
        var table = $('#dataTable').DataTable({
            "paging": true,
            "pageLength": 10,
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

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
            // "dom": 'Bfrtip',               // Enable the Buttons extension
            // "buttons": [
            //     'excelHtml5'               // Tombol untuk export ke Excel
            // ]
        });
    });
</script>

