<?php
include 'db.php';
$msg = "";

if (isset($_POST['register'])) {

  $title = $_POST['title'];
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $blood = $_POST['blood'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $caste = $_POST['caste'];
  $subcaste = $_POST['subcaste'];
  $medical = $_POST['medical'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = mysqli_prepare($conn,
    "INSERT INTO users
    (title, fullname, email, phone, blood_group, age, gender, caste, subcaste, medical_history, password)
    VALUES (?,?,?,?,?,?,?,?,?,?,?)"
  );

  mysqli_stmt_bind_param(
    $stmt,
    "sssssisisss",
    $title,
    $fullname,
    $email,
    $phone,
    $blood,
    $age,
    $gender,
    $caste,
    $subcaste,
    $medical,
    $password
  );

  if (mysqli_stmt_execute($stmt)) {
    header("Location: medical_history.php");
    exit();
  } else {
    $msg = "Email already exists";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <style>
    body { font-family: Arial; background:#eef2f7; padding:20px; }
    .box { max-width:550px; margin:auto; background:#fff; padding:25px; border-radius:10px; }
    label { display:block; margin-top:10px; font-weight:bold; }
    input, select, textarea { width:100%; padding:10px; margin-top:5px; }
    button { margin-top:15px; padding:12px; background:#4b7bec; color:white; border:none; width:100%; }
    .error { color:red; margin-top:10px; }
  </style>
</head>
<body>

<div class="box">
  <h2>Registration Form</h2>

  <form method="post" onsubmit="return validate()">

    <label>Title</label>
    <select name="title" required>
      <option>Mr</option>
      <option>Ms</option>
      <option>Mrs</option>
    </select>

    <label>Full Name</label>
    <input name="fullname" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Phone</label>
    <input name="phone" required>

    <label>Blood Group</label>
    <select name="blood" required>
      <option>A+</option><option>A-</option>
      <option>B+</option><option>B-</option>
      <option>O+</option><option>O-</option>
      <option>AB+</option><option>AB-</option>
    </select>

    <label>Age</label>
    <input type="number" name="age" required>

    <label>Gender</label>
    <select name="gender" required>
      <option>Male</option>
      <option>Female</option>
      <option>Other</option>
    </select>

    <label>Caste</label>
    <input name="caste" required>

    <label>Sub Caste</label>
    <input type="radio" name="subcaste" value="Brahmin" required> Brahmin
    <input type="radio" name="subcaste" value="Vyshya"> Vyshya
    <input type="radio" name="subcaste" value="Other"> Other

    <label>Medical History</label>
    <textarea name="medical"></textarea>

    <label>Password</label>
    <input type="password" id="p" name="password" required>

    <label>Confirm Password</label>
    <input type="password" id="cp" required>

    <button name="register">Register</button>
    <div class="error" id="err"><?= $msg ?></div>
  </form>
</div>
<a href="login.php">Back</a>
<a href="address_details.php">Continue</a>



<script>
function validate() {
  if (p.value !== cp.value) {
    err.innerText = "Passwords do not match";
    return false;
  }
  return true;
}


</script>

</body>
</html>
