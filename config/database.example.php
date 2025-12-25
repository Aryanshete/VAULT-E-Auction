<?php
$host = "localhost";
$db_name = "auction_db";
$username = "db_user";
$password = "db_password";

try {
    $conn = new PDO(
        "mysql:host={$host};dbname={$db_name}",
        $username,
        $password
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed");
}
