<?php
session_start();
include_once "../config/database.php";

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: ../login.php");
    exit();
}

$title = $_POST['title'];
$desc  = $_POST['description'];
$price = $_POST['starting_price'];
$end   = $_POST['end_time']; // <-- ADD THIS

$img_name = $_FILES['image']['name'];
$img_tmp  = $_FILES['image']['tmp_name'];

$img_path = "../img/auctions/" . $img_name;

// move uploaded file
if (!empty($img_name)) {
    move_uploaded_file($img_tmp, $img_path);
}

// Updated SQL including end_time
$sql = "INSERT INTO auctions (title, description, start_price, end_time, image) 
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->execute([$title, $desc, $price, $end, $img_name]);

header("Location: view_bids.php?success=1");
exit();
 ?>
