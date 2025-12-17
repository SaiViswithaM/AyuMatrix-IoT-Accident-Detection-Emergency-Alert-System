<?php
$sid = "YOUR_TWILIO_SID";
$token = "YOUR_TWILIO_AUTH_TOKEN";
$from = "+1XXXXXXXXXX"; // Twilio number
$to   = "+91112";       // Emergency number

$url = "https://api.twilio.com/2010-04-01/Accounts/$sid/Calls.json";

$data = http_build_query([
  'To' => $to,
  'From' => $from,
  'Url' => 'http://demo.twilio.com/docs/voice.xml'
]);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "$sid:$token");

$response = curl_exec($ch);
curl_close($ch);

echo "Emergency call triggered";
