<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
<title>Smartpay Reports</title>
<div class="main">
    <div class="container">
        <center>
            <div class="card">
                <div id="login">
                    <form action="<?= site_url('auth/login'); ?>" method="post">
                        <!-- <fieldset class="clearfix"> -->
                            <h3 class="card-title"></h3>
                            <p><input type="text" name="username" placeholder="Username" required></p>
                            <p><input type="password" name="password" placeholder="Password" required></p>
                            <div class="form-footer">
                                <span style="width:50%; text-align:right; display: inline-block;">
                                    <input type="submit" value="Sign In">
                                    <!-- <input type="submit" value="Reset Password"> -->
                                </span>
                            </div>
                        <!-- </fieldset> -->
                    </form>
                </div>
                <div class="logo">
                    <img src="<?= base_url('assets/images/rnd_logo.png'); ?>" alt="Logo">
                    <p>Powered by SmartPay Technology</p>
                </div>
            </div>
        </center>
    </div>
</div>

<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

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

        $(document).ready(function() {
            <?php if ($this->session->flashdata('success')): ?>
                toastr.success("<?= $this->session->flashdata('success'); ?>");
            <?php endif; ?>

            <?php if ($this->session->flashdata('error')): ?>
                toastr.error("<?= $this->session->flashdata('error'); ?>");
            <?php endif; ?>
        });
</script>
