<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $message = isset($_POST['message']) ? mysqli_real_escape_string($conn, $_POST['message']) : '';
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $payment_details = isset($_POST['payment_details']) ? mysqli_real_escape_string($conn, $_POST['payment_details']) : '';

    $query = "INSERT INTO appointments (name, email, appointment_date, message, payment_method, payment_details) 
              VALUES ('$name', '$email', '$appointment_date', '$message', '$payment_method', '$payment_details')";
    if (mysqli_query($conn, $query)) {
        $success_message = "Appointment booked successfully!";
    } else {
        $error_message = "There was an error booking your appointment. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('appoint.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .appointment-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #218838;
        }

        .success-message {
            color: green;
            margin-top: 15px;
        }

        .error-message {
            color: red;
            margin-top: 15px;
        }

        .form-group {
            text-align: left;
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="appointment-container">
        <h2>Book an Appointment</h2>

        <?php if (isset($success_message)) { ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php } elseif (isset($error_message)) { ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php } ?>

        <form action="appointment.php" method="post">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="appointment_date">Preferred Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment_date" required>
            </div>

            <div class="form-group">
                <label for="message">Message or Details (Optional)</label>
                <textarea name="message" id="message" rows="4" placeholder="Any special requests or details about your appointment"></textarea>
            </div>

            <div class="form-group">
                <label for="payment_method">Select Payment Method</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="credit_card">Credit/Debit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="mobile_money">Mobile Money</option>
                </select>
            </div>

            <div class="form-group">
                <label for="payment_details">Payment Details (e.g., Card Number, PayPal Account, etc.)</label>
                <textarea name="payment_details" id="payment_details" rows="4" placeholder="Enter your payment details here" required></textarea>
            </div>

            <button type="submit">Book Appointment</button>
        </form>

        <a href="view_appointments.php" class="back-link">View Appointments</a>
        <a href="healthcarefrontend1.php" class="back-link">Back to Home</a>
    </div>

</body>
</html>
