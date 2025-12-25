<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli("localhost", "root", "", "vault");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query the database
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Check if user exists and password is correct
    if ($result->num_rows == 1) {
        // Authentication successful, set session variables
        $_SESSION['username'] = $username;
        // Redirect to dashboard or wherever you want to take the user after login
        header("Location: dashboard.php");
    } else {
        // Authentication failed, redirect back to login page with error message
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: index.php");
    }

    // Close connection
    $conn->close();
} else {
    // Redirect to login page if accessed directly
    header("Location: index.php");
}

