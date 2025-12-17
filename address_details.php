<?php
session_start();
include 'db.php';

/*
  Since user is not logged in yet,
  we take the LAST registered user.
  (This matches your current flow)
*/
$result = mysqli_query($conn, "SELECT id FROM users ORDER BY id DESC LIMIT 1");
$user = mysqli_fetch_assoc($result);
$user_id = $user['id'];

if (isset($_POST['save'])) {

  $temp_address = $_POST['temp_address'];
  $perm_address = $_POST['perm_address'];

  $stmt = mysqli_prepare($conn,
    "INSERT INTO address_details (user_id, temporary_address, permanent_address)
     VALUES (?, ?, ?)"
  );

  mysqli_stmt_bind_param(
    $stmt,
    "iss",
    $user_id,
    $temp_address,
    $perm_address
  );

  mysqli_stmt_execute($stmt);

  // Next page after address
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Address Details</title>
  <style>
    body {
      font-family: Arial;
      background: #eef2f7;
      padding: 20px;
    }
    .box {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 10px;
    }
    label {
      font-weight: bold;
      margin-top: 10px;
      display: block;
    }
    textarea {
      width: 100%;
      padding: 10px;
      min-height: 80px;
    }
    button {
      margin-top: 15px;
      width: 100%;
      padding: 12px;
      background: #4b7bec;
      color: white;
      border: none;
      cursor: pointer;
    }
    .back {
      background: #aaa;
      margin-top: 8px;
    }
  </style>
</head>

<body>

<div class="box">
  <h2>Address Details</h2>

  <form method="post">

    <label>Temporary Address</label>
    <textarea name="temp_address" placeholder="Enter temporary address" required></textarea>

    <label>Permanent Address</label>
    <textarea name="perm_address" placeholder="Enter permanent address" required></textarea>

    <button name="save">Continue</button>
    <button type="button" class="back" onclick="history.back()">Back</button>

        <a href="register.php">Back</a>
<a href="journey_mode.php">Continue</a>


  </form>
</div>

</body>
</html>
