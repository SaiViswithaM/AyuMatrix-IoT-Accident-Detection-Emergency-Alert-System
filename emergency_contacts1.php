<?php
include 'auth.php';
include 'db.php';

if (isset($_POST['save_contact'])) {

    $user_id = $_SESSION['user_id'];
    $name  = $_POST['name'];
    $phone = $_POST['phone'];
    $blood = $_POST['blood'];
    $age   = $_POST['age'];
    $caste = $_POST['caste'];

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO emergency_contacts
        (user_id, name, phone, blood, age, caste)
        VALUES (?, ?, ?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "isssis",
        $user_id,
        $name,
        $phone,
        $blood,
        $age,
        $caste
    );

    mysqli_stmt_execute($stmt);

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Emergency Contacts</title>
</head>
<body>

<h2>Emergency Contact</h2>

<form method="POST">

  <label>Name</label><br>
  <input type="text" name="name" required><br><br>

  <label>Phone</label><br>
  <input type="text" name="phone" required><br><br>

  <label>Blood Group</label><br>
  <input type="text" name="blood"><br><br>

  <label>Age</label><br>
  <input type="number" name="age"><br><br>

  <label>Caste</label><br>
  <input type="text" name="caste"><br><br>

  <button type="submit" name="save_contact">
    Save & Finish
  </button>

</form>

</body>
</html>
