<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

/* Get live location */
$res = mysqli_query(
  $conn,
  "SELECT latitude, longitude
   FROM live_locations
   WHERE user_id = $user_id"
);

$loc = mysqli_fetch_assoc($res);

$lat = $loc['latitude'] ?? 28.6139;
$lng = $loc['longitude'] ?? 77.2090;

/* Save emergency event ONLY once per load */
mysqli_query(
  $conn,
  "INSERT INTO emergency_alerts (user_id, latitude, longitude)
   VALUES ($user_id, $lat, $lng)"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Emergency Mode</title>

<style>
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: #f9fafb;
}

/* Header */
.header {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 20px;
  background: linear-gradient(135deg, #dc2626, #b91c1c);
  color: white;
}

.back-btn {
  font-size: 26px;
  color: white;
  text-decoration: none;
}

/* Location box */
.map-box {
  background: #fee2e2;
  margin: 20px;
  padding: 30px;
  border-radius: 20px;
  text-align: center;
}

.location-pin {
  font-size: 40px;
}

.location-info span {
  font-size: 12px;
  color: #555;
}

/* Section title */
.section-title {
  margin: 20px;
  font-size: 20px;
}

/* Alert cards */
.alert-card {
  background: white;
  margin: 10px 20px;
  padding: 16px;
  border-radius: 14px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  font-weight: bold;
}

.sent {
  border-left: 6px solid #16a34a;
}

/* Quick call */
.quick-call {
  display: flex;
  gap: 12px;
  padding: 0 20px;
}

.quick-call a {
  flex: 1;
  background: #dc2626;
  color: white;
  padding: 14px;
  border-radius: 14px;
  text-align: center;
  font-size: 20px;
  text-decoration: none;
}

/* Navigation buttons */
.nav {
  display: flex;
  gap: 12px;
  margin: 30px 20px;
}

.nav a {
  flex: 1;
  padding: 16px;
  text-align: center;
  border-radius: 14px;
  text-decoration: none;
  font-weight: bold;
}

.back {
  background: #e5e7eb;
  color: #111;
}

.next {
  background: #2563eb;
  color: white;
}
</style>
</head>

<body>

<!-- HEADER WITH BACK BUTTON -->
<div class="header">
  <a href="live_tracking.php" class="back-btn">←</a>
  <div>
    <h1>Emergency Mode</h1>
    <p>Alerts being dispatched</p>
  </div>
</div>

<!-- LOCATION -->
<div class="map-box">
  <div class="location-pin">📍</div>
  <div class="location-info">
    <span>Current Location</span><br>
    <strong><?= $lat ?>°N, <?= $lng ?>°E</strong>
  </div>
</div>

<!-- ALERT STATUS -->
<h2 class="section-title">Alert Status</h2>

<div class="alert-card sent">Police (100) ✅</div>
<div class="alert-card sent">Ambulance (108) ✅</div>
<div class="alert-card sent">Family Members ✅</div>
<div class="alert-card sent">Friends ✅</div>
<div class="alert-card sent">Nearby Users ✅</div>

<!-- QUICK CALL -->
<h2 class="section-title">Quick Call</h2>

<div class="quick-call">
  <a href="tel:100">🚓 100</a>
  <a href="tel:108">🚑 108</a>
  <a href="tel:112">⚠ 112</a>
</div>

<!-- BACK & CONTINUE -->
<div class="nav">
  <a class="back" href="add_member.php">Back</a>
  <a class="next" href="iot_status.php">Continue</a>
</div>

</body>
</html>
