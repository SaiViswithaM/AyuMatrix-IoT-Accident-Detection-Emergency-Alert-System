<?php
$conn = mysqli_connect("localhost", "root", "", "login_demo");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
