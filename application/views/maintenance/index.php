<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Font Awesome Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet"> <!-- Bootstrap CSS -->
    <style>
        /* Styling untuk halaman maintenance */
        body {
            background-color: #f8f9fc;
            font-family: Arial, sans-serif;
        }
        .maintenance-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .maintenance-message {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 50px;
            max-width: 600px;
            width: 100%;
        }
        .maintenance-message i {
            font-size: 80px;
            color: #f39c12;
        }
        .maintenance-message h1 {
            font-size: 2.5rem;
            color: #333;
        }
        .maintenance-message p {
            font-size: 1.2rem;
            color: #666;
        }
        .retry-btn {
            margin-top: 20px;
            font-size: 1rem;
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .retry-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="maintenance-container">
    <div class="maintenance-message">
        <i class="fas fa-tools"></i> <!-- Icon untuk pemeliharaan -->
        <h1>We are currently performing maintenance</h1>
        <p>Our website is undergoing scheduled maintenance. We apologize for the inconvenience. Please check back later.</p>
        <a href="#" class="retry-btn">Try Again</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script> <!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->

</body>
</html>
