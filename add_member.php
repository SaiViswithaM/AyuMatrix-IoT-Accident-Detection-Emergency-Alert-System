<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['add'])) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $relation = $_POST['relation'];

  $stmt = mysqli_prepare($conn,
    "INSERT INTO tracking_members (user_id, member_name, phone, relation)
     VALUES (?, ?, ?, ?)"
  );
  mysqli_stmt_bind_param($stmt, "isss", $user_id, $name, $phone, $relation);
  mysqli_stmt_execute($stmt);

  header("Location: live_tracking.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Member</title>
  <style>
    body {
      font-family: Arial;
      background: #eef2f7;
      padding: 20px;
    }
    .box {
      max-width: 400px;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 12px;
    }
    input, select, button {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
    }
    button {
      background: #20bf6b;
      color: white;
      border: none;
      border-radius: 6px;
    }
  </style>
</head>

<body>

<div class="box">
  <h2>Add Tracking Member</h2>

  <form method="post">
    <input name="name" placeholder="Member Name" required>
    <input name="phone" placeholder="Phone Number" required>
    <select name="relation" required>
      <option value="">Relation</option>
      <option>Father</option>
      <option>Mother</option>
      <option>Brother</option>
      <option>Sister</option>
      <option>Friend</option>
    </select>
        <a href="live_tracking_friends.php">Back</a>
<a href="emergency_mode.php">Continue</a>


    <button name="add">Add Member</button>
  </form>
</div>

</body>
</html>
