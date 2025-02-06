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
    </style>
</head>
<body>

<header>
    <img src="<?= base_url('assets/images/logo_cp.png'); ?>" alt="Logo">
    <!-- <h1><?php echo $title; ?></h1> -->
</header>

<div class="container">
    <h2>Complaint Details</h2>
    <p><strong>Reporter Name:</strong> <?= $complaint['reporter_name']; ?></p>
    <p><strong>Email:</strong> <?= $complaint['reporter_email']; ?></p>
    <p><strong>Phone:</strong> <?= $complaint['reporter_phone']; ?></p>
    <p><strong>Location Name:</strong> <?= $complaint['location']; ?></p>
    <p><strong>Report Date:</strong> <?= $complaint['issue_date']; ?></p>
    <p><strong>Issue Title:</strong> <?= $complaint['issue_title']; ?></p>
    <p><strong>Issue Description:</strong><br><?= $complaint['issue_description']; ?></p>
    <p><strong>Deadline:</strong> <?= $complaint['deadline_date']; ?></p>

    <form action="<?= base_url('complaint/update_status/' . $complaint['id']); ?>" method="post">
        <label for="status">Update Status:</label>
        <select name="status" id="status">
            <option value="in_progress">Please Select</option>
            <option value="in_progress">In Progress</option>
            <option value="resolved">Resolved</option>
            <option value="cancelled">Cancelled</option>
        </select>
        <button type="submit" <?= $complaint['status'] == 'resolved' || $complaint['status'] == 'cancelled' ? 'disabled' : ''; ?>>Update</button>
    </form>
    <br>
    <!-- <form action="<?= base_url('complaint/redirectComplaint/' . $complaint['id']); ?>" method="post">
    <label for="new_category">Redirect to Team/Category:</label>
    <select name="new_category" id="new_category">
        <option value="Network">Network</option>
        <option value="Parkee System">Parkee System</option>
        <option value="IOT System">IOT System</option>
    </select>
    <button type="submit">Redirect Complaint</button> -->
<br>
<h3>Log Update History</h3>
<table class="table table-bordered"style="border: 1px solid #ddd;">
    <thead>
        <tr>
            <th>No</th>
            <th>Status</th>
            <th>Last Update</th>
        </tr>
    </thead>
    <tbody style="border: 1px solid #ddd;">
        <?php
        $no = 1;
        $query = $this->db->get_where('log_update', ['id' => $complaint['id']]);
        $logs = $query->result_array();
        foreach($logs as $log): ?>
        <tr style="border: 1px solid #ddd;">
            <td style="border: 1px solid #ddd; padding: 8px;"><?= $no++; ?></td>
            <td style="border: 1px solid #ddd; padding: 8px;"><?= $log['status']; ?></td>
            <td style="border: 1px solid #ddd; padding: 8px;"><?= $log['created_at']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</form>
</div>

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

<footer>
    <p>&copy; <?= date('Y'); ?> Helpdesk System</p>
</footer>

</body>
</html>

