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
    <h2>Complaint Details</h2>
    <p><strong>Reporter Name:</strong> <?= $complaint['reporter_name']; ?></p>
    <p><strong>Email:</strong> <?= $complaint['reporter_email']; ?></p>
    <p><strong>Phone:</strong> <?= $complaint['reporter_phone']; ?></p>
    <p><strong>Location Name:</strong> <?= $complaint['location']; ?></p>
    <p><strong>Report Date:</strong> <?= $complaint['issue_date']; ?></p>
    <!-- <p><strong>Executor Team:</strong> <?= $complaint['category']; ?></p> -->
    <p><strong>Issue Title:</strong> <?= $complaint['issue_title']; ?></p>
    <p><strong>Issue Description:</strong><br><?= $complaint['issue_description']; ?></p>
    <p><strong>Deadline:</strong> <?= $complaint['deadline_date']; ?></p>
    <!-- <p><strong>Status:</strong> <?= $complaint['status']; ?></p> -->

<hr class="sidebar-divider">    
<?php if($complaint['status'] == 'in_progress' || $complaint['status'] == 'no action yet' || $complaint['status'] == null): ?>
    <h2>Redirect Executor</h2>
        <form action="<?= base_url('complaint/redirectRequest/' . $complaint['id'] . '/' . $complaint['category']); ?>" method="post">
            <div class="form-group">
                <label for="new_category"><strong>Redirect to:</strong></label>
                <select name="new_category" id="new_category" required>
                    <option value="" disabled selected>Please Select</option>
                    <option value="IT Support">IT Support</option>
                    <option value="Network">Network</option>
                    <option value="Infra">Infra</option>
                    <option value="Parkee System">Parkee System</option>
                    <option value="IOT_Development">IOT/Development</option>
                </select>
                <button type="submit" <?= $complaint['status'] == 'resolved' || $complaint['status'] == 'cancelled' ? 'disabled' : ''; ?>>Redirect</button>
            </div>
            <small>*note : redirect ke tim terkait jika tidak sesuai laporannya atau membutuhkan eksekusi ke tim terkait</small>
        </form>

<hr class="sidebar-divider">
    
    <h2>Update Executor</h2>
    <form action="<?= base_url('complaint/update_status/' . $complaint['id'] . '/' . $complaint['category']); ?>" method="post">
        <div class="form-group">
            <label for="executor_name"><strong>Assigment Name:</strong></label>
            <select name="executor_name" id="executor_name" required>
            <option value="executor_name">Please Select</option>
                <?php if (!empty($executors)): ?>
                    <?php foreach ($executors as $executor): ?>
                        <option value="<?php echo $executor->username; ?>"><?php echo $executor->username; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="reason_execute"><strong>Description :</strong></label>
            <textarea style="font-size: 15px; height:50px; width: 250px;" class="form-control" id="reason_execute" name="reason_execute" required placeholder="" require></textarea>
        </div>
        <br>
        <div class="form-group">
            <label for="status"><strong>Update Status:</strong></label>
            <select name="status" id="status" required>
            <option value="in_progress">Please Select</option>
            <option value="in_progress">In Progress</option>
            <option value="resolved">Resolved</option>
            <option value="cancelled">Cancelled</option>
        </select>
        <button type="submit" <?= $complaint['status'] == 'resolved' || $complaint['status'] == 'cancelled' ? 'disabled' : ''; ?>>Update</button>
        </div>
    </form>
    <br>
<br>
<?php endif; ?>

<h2>Log Update History</h2>
<table class="table table-bordered"style="border: 2px solid #ddd;">
    <thead>
        <tr>
            <th>No</th>
            <th>Assigment</th>
            <th>Status</th>
            <th>Description</th>
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
            <td style="border: 1px solid #ddd; padding: 8px;"><?= $log['executor_name']; ?></td>
            <td style="border: 1px solid #ddd; padding: 8px;"><?= $log['status']; ?></td>
            <td style="border: 1px solid #ddd; padding: 8px;"><?= $log['reason_execute']; ?></td>
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

