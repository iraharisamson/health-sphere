<?php
$apiKey = 'YOUR_API_KEY';
$assistantId = 'YOUR_ASSISTANT_ID';
$urlBase = 'https://api.us-south.assistant.watson.cloud.ibm.com';

// Create Session with Watson Assistant
$sessionUrl = "$urlBase/v2/assistants/$assistantId/sessions?version=2021-06-14";

$headers = [
    "Content-Type: application/json",
    "Authorization: Basic " . base64_encode("apikey:$apiKey")
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $sessionUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);

$sessionResponse = curl_exec($ch);
curl_close($ch);

$sessionData = json_decode($sessionResponse, true);

if (!isset($sessionData['session_id'])) {
    echo "❌ Failed to create session with Watson Assistant. Check your API credentials and Assistant ID.";
    exit;
}

$sessionId = $sessionData['session_id'];
echo "Session ID: $sessionId"; // for debugging
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Medical Symptom Checker</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      padding: 50px;
    }
    .container {
      max-width: 600px;
      background: white;
      padding: 20px;
      border-radius: 10px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    textarea {
      width: 100%;
      padding: 10px;
      height: 100px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      margin-top: 10px;
      padding: 10px 20px;
      border: none;
      background: #28a745;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }
    .result {
      margin-top: 20px;
      background: #e9f5e9;
      padding: 15px;
      border-left: 5px solid #28a745;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Medical Symptom Checker</h2>
    <form action="check.php" method="POST">
      <label for="symptoms">Enter your symptoms:</label><br>
      <textarea name="symptoms" required></textarea><br>
      <button type="submit">Check</button>
    </form>
  </div>
</body>
</html>