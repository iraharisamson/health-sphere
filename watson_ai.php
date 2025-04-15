<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userQuestion = $_POST['user_question'];  // Get user question from form input

    // Replace these with your actual IBM Watson credentials
    $apiKey = 'YOUR_API_KEY';  // Replace with your IBM Watson API key
    $assistantId = 'YOUR_ASSISTANT_ID';  // Replace with your IBM Watson Assistant ID
    $urlBase = 'https://api.us-south.assistant.watson.cloud.ibm.com';  // Change URL if using a different region (e.g., eu-gb, ap-northeast)

    // Create Session with Watson Assistant
    $sessionUrl = "$urlBase/v2/assistants/$assistantId/sessions?version=2021-06-14";

    $headers = [
        "Content-Type: application/json",
        "Authorization: Basic " . base64_encode("apikey:$apiKey")
    ];

    $sessionOpts = [
        "http" => [
            "header"  => implode("\r\n", $headers),
            "method"  => "POST"
        ]
    ];

    $sessionContext = stream_context_create($sessionOpts);
    $sessionResponse = file_get_contents($sessionUrl, false, $sessionContext);
    $sessionData = json_decode($sessionResponse, true);

    if (!isset($sessionData['session_id'])) {
        echo "❌ Failed to create session with Watson Assistant. Check your API credentials and Assistant ID.";
        exit;
    }

    $sessionId = $sessionData['session_id'];

    // Send User Message to Watson Assistant
    $messageUrl = "$urlBase/v2/assistants/$assistantId/sessions/$sessionId/message?version=2021-06-14";

    $messageData = [
        "input" => [
            "message_type" => "text",
            "text" => $userQuestion
        ]
    ];

    $messageOpts = [
        "http" => [
            "header"  => implode("\r\n", $headers),
            "method"  => "POST",
            "content" => json_encode($messageData)
        ]
    ];

    $messageContext = stream_context_create($messageOpts);
    $messageResponse = file_get_contents($messageUrl, false, $messageContext);
    $messageData = json_decode($messageResponse, true);

    // Display Watson's reply
    if (isset($messageData['output']['generic'][0]['text'])) {
        $watsonReply = $messageData['output']['generic'][0]['text'];
        echo "<h3>Watson's Response:</h3>";
        echo "<p>$watsonReply</p>";
        
        // Connect to your MySQL database
        $host = "localhost";
        $username = "root"; // Change if needed
        $password = "";     // Change if needed
        $dbname = "healthsphere_ai"; // Replace with your actual database name

        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Database connection failed: " . $conn->connect_error);
        }

        // Insert into chat_logs table
        $stmt = $conn->prepare("INSERT INTO chat_logs (user_question, watson_response) VALUES (?, ?)");
        $stmt->bind_param("ss", $userQuestion, $watsonReply);
        $stmt->execute();
        $stmt->close();
        $conn->close();

    } else {
        echo "❌ Watson did not return a proper response.";
    }
} else {
    echo "Please submit a question.";
}
?>

<!-- HTML form to send questions to Watson Assistant -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask Watson</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            resize: vertical;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        .response {
            margin-top: 20px;
            background-color: #e8f5e9;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #4CAF50;
        }

        .error {
            margin-top: 20px;
            background-color: #f8d7da;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }
    </style>
</head>
<body>
    <h1>Ask Watson Assistant</h1>
    <div class="container">
        <form method="POST" action="">
            <label for="user_question">Your Question:</label>
            <textarea id="user_question" name="user_question" rows="4" cols="50"></textarea><br><br>
            <button type="submit">Submit</button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <div class="response">
                <h3>Watson's Response:</h3>
                <p><?php echo $watsonReply; ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
