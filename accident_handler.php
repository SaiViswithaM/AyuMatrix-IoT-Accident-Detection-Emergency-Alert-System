<?php
include 'db.php';

$user_id      = $_REQUEST['user_id'] ?? 1;
$impact_force = $_REQUEST['impact_force'] ?? 0;
$heart_rate   = $_REQUEST['heart_rate'] ?? 0;
$pulse_rate   = $_REQUEST['pulse_rate'] ?? 0;
$gyro_tilt    = $_REQUEST['gyro_tilt'] ?? '';
$speed_before = $_REQUEST['speed_before'] ?? 0;
$speed_after  = $_REQUEST['speed_after'] ?? 0;
$location     = $_REQUEST['location'] ?? 'Unknown';

$event_time = date("H:i:s");

/* Save sensor data */
mysqli_query($conn,
  "INSERT INTO accident_events
   (user_id, impact_force, heart_rate, pulse_rate, gyro_tilt,
    speed_before, speed_after, location, event_time)
   VALUES
   ($user_id, $impact_force, $heart_rate, $pulse_rate, '$gyro_tilt',
    $speed_before, $speed_after, '$location', '$event_time')"
);

/* 🚨 THRESHOLD CHECK */
if ($impact_force > 7.5 || $heart_rate > 140) {

  file_put_contents(
    "emergency.log",
    "EMERGENCY TRIGGERED for user $user_id at $event_time\n",
    FILE_APPEND
  );

  // 🔥 AUTO REDIRECT
  header("Location: auto_call.php");
  exit();

} else {
  echo "Normal data";
}
