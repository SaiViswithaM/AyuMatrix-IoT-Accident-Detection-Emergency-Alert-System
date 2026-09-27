<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Journey Mode</title>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<style>
body { margin:0; font-family:Arial; background:#f1f5f9; }

header {
  background:#2563eb;
  color:white;
  padding:15px;
  display:flex;
  align-items:center;
  gap:10px;
}

header a {
  color:white;
  font-size:22px;
  text-decoration:none;
}

.controls {
  padding:15px;
  background:white;
}

input, button {
  width:100%;
  padding:12px;
  margin-top:10px;
  border-radius:8px;
}

button {
  background:#16a34a;
  color:white;
  border:none;
  cursor:pointer;
}

#map { height:55vh; }

.nav {
  display:flex;
  gap:10px;
  padding:15px;
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
.next { background:#2563eb; color:white; }
</style>
</head>

<body>

<header>
  <a href="address_details.php">←</a>
  <h3>Journey Mode</h3>
</header>

<div class="controls">
  <input id="destination" placeholder="Enter destination (eg: Vijayawada)">
  <button onclick="startJourney()">Start Journey</button>
</div>

<div id="map"></div>

<div class="nav">
  <a class="back" href="address_details.php">Back</a>
  <a class="next" href="live_tracking_friends.php">Continue</a>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>

<script>
let map;
let route;
let currentLocation = [28.6139, 77.2090]; // fallback

navigator.geolocation.getCurrentPosition(
  pos => {
    currentLocation = [pos.coords.latitude, pos.coords.longitude];

    map = L.map("map").setView(currentLocation, 13);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      maxZoom: 19
    }).addTo(map);

    L.marker(currentLocation)
      .addTo(map)
      .bindPopup("📍 You are here")
      .openPopup();
  },
  err => {
    alert("Location permission denied");
  }
);

function startJourney() {
  let dest = document.getElementById("destination").value.trim();

  if (!dest) {
    alert("Enter destination");
    return;
  }

  fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(dest)}`)
    .then(res => res.json())
    .then(data => {
      if (!data.length) {
        alert("Destination not found");
        return;
      }

      let destLat = parseFloat(data[0].lat);
      let destLon = parseFloat(data[0].lon);

      if (route) {
        map.removeControl(route);
      }

      route = L.Routing.control({
        waypoints: [
          L.latLng(currentLocation[0], currentLocation[1]),
          L.latLng(destLat, destLon)
        ],
        addWaypoints: false,
        draggableWaypoints: false,
        routeWhileDragging: false,
        show: false
      }).addTo(map);
    });
}
</script>

</body>
</html>
