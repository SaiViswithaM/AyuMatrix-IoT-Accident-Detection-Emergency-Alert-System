<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

$members = mysqli_query(
  $conn,
  "SELECT * FROM tracking_members WHERE user_id=$user_id"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>Live Tracking</title>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<style>
body { font-family:Arial; background:#eef2f7; padding:15px; }
.header {
  display:flex;
  align-items:center;
  gap:10px;
}
.header a {
  font-size:22px;
  text-decoration:none;
}
#map {
  height:250px;
  background:#ddd;
  margin:10px 0;
  border-radius:12px;
}
.actions {
  display:flex;
  gap:10px;
  margin:10px 0;
}
button {
  flex:1;
  padding:12px;
  border:none;
  border-radius:8px;
  font-weight:bold;
  cursor:pointer;
}
.add { background:#22c55e; color:white; }
.share { background:#2563eb; color:white; }
.contact {
  background:white;
  padding:12px;
  border-radius:10px;
  margin-bottom:8px;
  display:flex;
  justify-content:space-between;
}
.nav {
  display:flex;
  gap:10px;
  margin-top:15px;
}
.nav a {
  flex:1;
  padding:14px;
  text-align:center;
  border-radius:10px;
  text-decoration:none;
  font-weight:bold;
}
.back { background:#e5e7eb; color:#111; }
.next { background:#dc2626; color:white; }
</style>
</head>

<body>

<div class="header">
  <a href="journey_mode.php">←</a>
  <h2>Live Tracking</h2>
</div>

<div id="map">Loading map...</div>

<div class="actions">
  <button class="add" onclick="location.href='add_member.php'">➕ Add Member</button>
  <button class="share">Share Location</button>
</div>

<h3>Tracking Friends</h3>

<?php while ($m = mysqli_fetch_assoc($members)) { ?>
  <div class="contact">
    <div>
      <strong><?= $m['member_name'] ?></strong><br>
      <small><?= $m['relation'] ?></small>
    </div>
    <span>Live</span>
  </div>
<?php } ?>

<div class="nav">
<a href="journey_mode.php">Back</a>
<a href="add_member.php">Add Member</a>
<a href="iot_status.php">Continue</a>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
let map = L.map("map").setView([28.6139, 77.2090], 13);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);

navigator.geolocation.getCurrentPosition(pos => {
  let lat = pos.coords.latitude;
  let lon = pos.coords.longitude;
  L.marker([lat, lon]).addTo(map).bindPopup("You").openPopup();
  map.setView([lat, lon], 15);
});
</script>

</body>
</html>
