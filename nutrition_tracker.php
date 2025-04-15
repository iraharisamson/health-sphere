<?php
// Connection
$host = 'localhost';
$user = 'root'; // change if needed
$password = ''; // change if needed
$dbname = 'nutrition';

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $food_item = $_POST['food_item'];
    $calories = $_POST['calories'];
    $meal_time = $_POST['meal_time'];
    $meal_date = $_POST['meal_date'];

    $stmt = $conn->prepare("INSERT INTO food_logs (food_item, calories, meal_time, meal_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $food_item, $calories, $meal_time, $meal_date);

    if ($stmt->execute()) {
        $message = "Data saved successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nutrition Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            display: flex;
            justify-content: center;
            padding-top: 50px;
        }

        .tracker-container {
            background: #fff;
            padding: 25px 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 15px;
            font-weight: bold;
        }

        input, select {
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            border: none;
            background: #4CAF50;
            color: white;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        .message {
            margin-top: 20px;
            text-align: center;
            color: green;
        }
    </style>
</head>
<body>

<div class="tracker-container">
    <h2>Nutrition Tracker</h2>
    <form method="POST" action="">
        <label for="food_item">Food Item:</label>
        <input type="text" id="food_item" name="food_item" required>

        <label for="calories">Calories:</label>
        <input type="number" id="calories" name="calories" required>

        <label for="meal_time">Meal Time:</label>
        <select id="meal_time" name="meal_time" required>
            <option value="">Select</option>
            <option value="Breakfast">Breakfast</option>
            <option value="Lunch">Lunch</option>
            <option value="Dinner">Dinner</option>
            <option value="Snack">Snack</option>
        </select>

        <label for="meal_date">Date:</label>
        <input type="date" id="meal_date" name="meal_date" required>

        <button type="submit">Save Entry</button>

        <?php if (isset($message)) : ?>
            <p class="message"><?= $message ?></p>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
