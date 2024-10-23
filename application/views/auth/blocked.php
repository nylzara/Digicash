<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Not Found</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .error-page {
        height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
    }

    .error-title {
        font-size: 100px;
        color: #dc3545;
        /* Bootstrap danger color */
    }

    .error-message {
        font-size: 20px;
        color: #6c757d;
        /* Bootstrap muted color */
    }

    .btn-custom {
        background-color: #007bff;
        /* Bootstrap primary color */
        color: #fff;
    }

    .btn-custom:hover {
        background-color: #0056b3;
        /* Darker shade on hover */
    }
    </style>
</head>

<body>
    <div class="container error-page text-center">
        <h1 class="error-title">403</h1>
        <p class="error-message">Access Forbidden</p>
        <a href="<?= base_url('user'); ?>" class="btn btn-custom">Go to Homepage</a>
    </div>
    <!-- base url user adalah controlller -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>