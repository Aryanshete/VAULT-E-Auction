<?php
$servername = "localhost";
$username = "root";
$password = "";
$database_name = "database444";
$Name = $_POST['Name'];
$email = $_POST['email'];
$mobile_no = $_POST['Mobile'];
$service_type = $_POST['Service'];
$special_note = $_POST['SpecialNote'];
$conn = mysqli_connect($servername, $username, $password, $database_name);
if (!$conn) {
    
    die("connection failed" . mysqli_connect_errno());

}

$sql_query = "INSERT INTO login_details(Name,email,mobile_no,service_type,special_note)
VALUES('$Name','$email','$mobile_no','$service_type','$special_note')";
mysqli_query($conn, $sql_query)
    ?>