<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- <link href="<?php echo base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url('assets/js/sb-admin-2.min.js'); ?>"></script> -->
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header, footer {
            padding: 10px;
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
        }
        header img {
            width: 100px;
            margin-right: 15px;
        }
        .container {
            padding: 20px;
        }
        footer {
            text-align: center;
            margin-top: 20px;
        }
        .content {
            max-width: 800px;
            margin: auto;
        }

        table {
        width: 70%;
        position: relative;
        border-collapse: collapse;
        background-color: #f9f9f9;
        }

        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
            width: 1px;
            height: fit-content;
            font-family: 'Arial', sans-serif;
        }

        th {
            padding: 12px;
            border: 1px solid #ddd;
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        caption {
            font-size: 1.5em;
            margin: 10px;
        }
    </style>
</head>
<body>

<header>
    <img src="<?= base_url('assets/images/logo_cp.png'); ?>" alt="Logo">
    <!-- <h1><?php echo $title; ?></h1> -->
</header>

<div class="container">
    <h2><u>Log Modem Details</u></h2>
    <!-- <br> -->
    <p><strong>Kode Modem:</strong> <?= htmlspecialchars($datamodem['kode_modem']); ?></p>
    <p><strong>Lokasi:</strong> <?= htmlspecialchars($logmodem['lokasi']); ?></p>
    <p><strong>Tanggal Pinjam:</strong> <?= htmlspecialchars($logmodem['tanggal_pinjam']); ?></p>
    <p>
        <strong>Tanggal Kembali:</strong>
        <?php
        if (empty($logmodem['tanggal_kembali'])) {
            echo '-';
        } else {
            echo htmlspecialchars($logmodem['tanggal_kembali']);
        }
        ?>
    </p>
    <p>
        <strong>Bukti Pinjam:</strong>
        <?php if (empty($logmodem['bukti_pinjam'])): ?>
            -
        <?php else: ?>
            <a href="<?= base_url('bukti-pinjam-modem/' . htmlspecialchars($logmodem['bukti_pinjam'])); ?>" target="_blank">
                <button type="button" class="btn btn-secondary btn-sm">View</button>
            </a>
        <?php endif; ?>
    </p>
    <p>
        <strong>Bukti Kembali:</strong>
        <?php if (empty($logmodem['bukti_kembali'])): ?>
            -
        <?php else: ?>
            <a href="<?= base_url('bukti-kembali-modem/' . htmlspecialchars($logmodem['bukti_kembali'])); ?>" target="_blank">
                <button type="button" class="btn btn-secondary btn-sm">View</button>
            </a>
        <?php endif; ?>
    </p>
    
    <?php if (!empty($logmodem['user_update_kembali'])): ?>
    <p><strong>Dikembalikan Oleh:</strong> <?= htmlspecialchars($logmodem['user_update_kembali']); ?></p>
    <?php endif; ?>
</div>

<?php if (empty($logmodem['bukti_kembali'])): ?>
<hr class="sidebar-divider">  

<div class="container">
    <h2><u>Update Log Modem</u></h2>

    <?= form_open_multipart('detail-modem/updatelog/' . $logmodem['id_log'] . '/' . $datamodem['kode_modem']); ?>

    <div class="form-group">
        <label for="nama">Nama </label>
        <input type="text" name="nama" class="form-control">
    </div>
<br>
    <div class="form-group">
        <label for="tanggal_kembali">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" class="form-control" value="<?= set_value('tanggal_kembali', date('Y-m-d')); ?>">
    </div>
<br>
    <div class="form-group">
        <label for="bukti_kembali">Bukti Kembali (Upload File)</label>
        <input type="file" name="bukti_kembali" class="form-control-file">
        <?php if (!empty($logmodem['bukti_kembali'])): ?>
            <p>File saat ini: <a href="<?= base_url('bukti-kembali-modem/' . $logmodem['bukti_kembali']); ?>" target="_blank">Lihat</a></p>
        <?php endif; ?>
    </div>
<br>
    <button type="submit" class="btn btn-primary">Update</button>
    <?= form_close(); ?>
</div>
<?php endif; ?>


<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/css/toastr.min.css')?> ">
<script src="<?= base_url('assets/js/toastr.min.js')?> "></script>
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

<br>
<footer>
    <p>&copy; <?= date('Y'); ?></p>
</footer>

</body>
</html>

