<?php
session_start();
include 'db.php';

/* Get last registered user (current flow) */
$result = mysqli_query($conn, "SELECT id FROM users ORDER BY id DESC LIMIT 1");
$user = mysqli_fetch_assoc($result);
$user_id = $user['id'];

if (isset($_POST['save'])) {

  $diabetes = isset($_POST['diabetes']) ? 1 : 0;
  $bp = isset($_POST['bp']) ? 1 : 0;
  $asthma = isset($_POST['asthma']) ? 1 : 0;
  $heart = isset($_POST['heart']) ? 1 : 0;
  $epilepsy = isset($_POST['epilepsy']) ? 1 : 0;

  $allergies = $_POST['allergies'];
  $other = $_POST['other'];
  $meds = $_POST['medications'];
  $surgery = $_POST['surgeries'];

  $stmt = mysqli_prepare($conn,
    "INSERT INTO medical_history
    (user_id, diabetes, blood_pressure, asthma, heart_disease, epilepsy,
     allergies, other_conditions, current_medications, previous_surgeries)
     VALUES (?,?,?,?,?,?,?,?,?,?)"
  );

  mysqli_stmt_bind_param(
    $stmt,
    "iiiiisssss",
    $user_id,
    $diabetes,
    $bp,
    $asthma,
    $heart,
    $epilepsy,
    $allergies,
    $other,
    $meds,
    $surgery
  );

  mysqli_stmt_execute($stmt);

  header("Location: address_details.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Medical History</title>
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
      display: block;
      margin-top: 10px;
    }
    textarea {
      width: 100%;
      padding: 10px;
    }
    button {
      margin-top: 15px;
      width: 100%;
      padding: 12px;
      border: none;
      color: white;
      cursor: pointer;
    }
    .continue {
      background: #4b7bec;
    }
    .back {
      background: #95a5a6;
      margin-top: 8px;
    }
  </style>
</head>

<body>

<div class="box">
  <h2>Medical History</h2>
  <p>This information helps emergency responders provide better care</p>

  <form method="post">

    <label>Medical Conditions</label>
    <input type="checkbox" name="diabetes"> Diabetes<br>
    <input type="checkbox" name="bp"> Blood Pressure<br>
    <input type="checkbox" name="asthma"> Asthma<br>
    <input type="checkbox" name="heart"> Heart Disease<br>
    <input type="checkbox" name="epilepsy"> Epilepsy

    <label>Known Allergies</label>
    <textarea name="allergies"></textarea>

    <label>Other Conditions</label>
    <textarea name="other"></textarea>

    <label>Current Medications</label>
    <textarea name="medications"></textarea>

    <label>Previous Surgeries</label>
    <textarea name="surgeries"></textarea>

    <!-- Continue button -->
    <button type="submit" name="save" class="continue">Continue</button>

    <!-- Back button -->
    <button type="button" class="back" onclick="window.location.href='register.php'">
      Back
    </button>
    <a href="medical_history.php">Back</a>
<a href="journey_mode.php">Continue</a>


  </form>
</div>

</body>
</html>
