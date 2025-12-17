<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
include 'db.php';

$id = $_SESSION['user_id'];
$res = mysqli_query($conn, "SELECT fullname, email FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
</head>
<body>
<h2>Welcome <?= htmlspecialchars($user['fullname']) ?></h2>
<p>Email: <?= htmlspecialchars($user['email']) ?></p>
<a href="logout.php">Logout</a>
</body>
</html>
