<?php
session_start();
include_once "../config/database.php";

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>VAULT | Create Auction</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>

<?php include_once "../nav.php"; ?>

<div class="container-fluid page-header py-5 mb-5">
    <div class="container py-5">
        <h2 class="display-3 text-white mb-3 animated slideInDown">Create Auction</h2>
    </div>
</div>

<div class="container-xxl py-5">
    <div class="container">
        <div class="section-title text-center">
            <h1 class="display-5 mb-5" style="color: rgb(215, 152, 75);">Create New Auction</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="save_auction.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label class="form-label">Auction Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Starting Price</label>
                        <input type="number" name="starting_price" step="0.01" class="form-control" required>
                    </div>

                    <!-- ✅ ADD THIS -->
                    <div class="mb-3">
                        <label class="form-label">End Time</label>
                        <input type="datetime-local" name="end_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Create Auction</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../js/main.js"></script>
</body>
</html>
