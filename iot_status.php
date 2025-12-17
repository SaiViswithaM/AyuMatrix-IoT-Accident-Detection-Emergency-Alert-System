<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Accident Detected</title>

<style>
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background: #fff7ed;
  padding: 20px;
}

.container {
  max-width: 800px;
  margin: auto;
  background: #ffffff;
  padding: 25px;
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

h1 {
  color: #dc2626;
  margin-bottom: 5px;
}

.sub {
  color: #555;
  margin-bottom: 20px;
}

/* Section */
.section-title {
  font-size: 20px;
  margin: 25px 0 10px;
}

/* Sensor Data */
.data-row {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  border-bottom: 1px solid #eee;
}

.data-row strong {
  color: #111;
}

.highlight {
  color: #dc2626;
  font-weight: bold;
}

/* Info box */
.info-box {
  background: #fef3c7;
  padding: 15px;
  border-radius: 14px;
  margin-top: 20px;
}

/* Response list */
.response-item {
  background: #f1f5f9;
  padding: 14px;
  border-radius: 12px;
  margin-bottom: 10px;
}

/* Buttons */
.actions {
  display: flex;
  gap: 15px;
  margin-top: 25px;
}

.actions button {
  flex: 1;
  padding: 16px;
  font-size: 16px;
  border: none;
  border-radius: 14px;
  cursor: pointer;
  font-weight: bold;
}

.safe {
  background: #16a34a;
  color: white;
}

.help {
  background: #dc2626;
  color: white;
}
</style>
</head>

<body>

<div class="container">

  <h1>🚨 Accident Detected</h1>
  <p class="sub">Sudden impact detected by sensors</p>

  <!-- SENSOR DATA -->
  <h2 class="section-title">Sensor Data</h2>

  <div class="data-row">
    <span>Impact Force</span>
    <strong class="highlight">High (8.2G)</strong>
  </div>

  <div class="data-row">
    <span>Heart Rate</span>
    <strong>142 BPM</strong>
  </div>

  <div class="data-row">
    <span>Pulse Rate</span>
    <strong>138 BPM</strong>
  </div>

  <div class="data-row">
    <span>Gyro Tilting Position</span>
    <strong>-45° tilt detected</strong>
  </div>

  <div class="data-row">
    <span>Time</span>
    <strong>1:12:46 PM</strong>
  </div>

  <div class="data-row">
    <span>Location</span>
    <strong>MG Road, Bangalore</strong>
  </div>

  <div class="data-row">
    <span>Speed Change</span>
    <strong>45 → 0 km/h</strong>
  </div>

  <div class="data-row">
    <span>Accident Alert Time</span>
    <strong>5 minutes</strong>
  </div>

  <!-- INFO -->
  <div class="info-box">
    <strong>Are you okay?</strong>
    <p>
      If this is a false alarm, tap <b>"I'm Safe"</b> to cancel emergency protocols.
      Otherwise, emergency services will be contacted automatically.
    </p>
  </div>

  <!-- EMERGENCY RESPONSE -->
  <h2 class="section-title">Emergency Response Will Include</h2>

  <div class="response-item">
    📞 <strong>Call Emergency Services</strong><br>
    100, 108, 112 will be contacted
  </div>

  <div class="response-item">
    👨‍👩‍👧‍👦 <strong>Notify Family & Friends</strong><br>
    2 emergency contacts will be alerted
  </div>

  <div class="response-item">
    🩸 <strong>Find Blood Banks</strong><br>
    Nearby O+ compatible donors
  </div>

  <div class="response-item">
    📍 <strong>Alert Nearby Users</strong><br>
    AyuMatrix users within 2km
  </div>

  <!-- ACTION BUTTONS -->
  <div class="actions">
    <button class="safe">I'm Safe – Cancel Alert</button>
    <button class="help">I Need Help – Start Emergency Protocol</button>
  </div>

</div>

</body>
</html>
