<?php
include 'db.php'; // Database connection

// Handle form submission to add medical records
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_record'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $diagnosis = mysqli_real_escape_string($conn, $_POST['diagnosis']);
    $treatment = mysqli_real_escape_string($conn, $_POST['treatment']);
    $medication = mysqli_real_escape_string($conn, $_POST['medication']);
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);

    $query = "INSERT INTO medical_history (name, email, diagnosis, treatment, medication, appointment_date) 
              VALUES ('$name', '$email', '$diagnosis', '$treatment', '$medication', '$appointment_date')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Medical record added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding medical record: " . mysqli_error($conn) . "');</script>";
    }
}

// Fetch medical records
$query = "SELECT * FROM medical_history ORDER BY appointment_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronic Health Records (EHR)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('ehr.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.85);
            padding: 20px;
            border-radius: 10px;
        }

        .form-container, .records-container {
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #28a745;
            color: white;
        }

        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
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
    <div class="container">
        <h2>Electronic Health Records (EHR)</h2>

        <!-- Medical Record Entry Form -->
        <div class="form-container">
            <h3>Add Medical Record</h3>
            <form method="POST">
                <input type="text" name="name" placeholder="Patient Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="diagnosis" placeholder="Diagnosis" required></textarea>
                <textarea name="treatment" placeholder="Treatment" required></textarea>
                <textarea name="medication" placeholder="Medication" required></textarea>
                <input type="date" name="appointment_date" required>
                <button type="submit" name="submit_record">Add Record</button>
            </form>
        </div>

        <!-- Medical Records Display -->
        <div class="records-container">
            <h3>Medical Records</h3>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Diagnosis</th>
                    <th>Treatment</th>
                    <th>Medication</th>
                    <th>Appointment Date</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['diagnosis']); ?></td>
                    <td><?php echo htmlspecialchars($row['treatment']); ?></td>
                    <td><?php echo htmlspecialchars($row['medication']); ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>

        <a href="healthcarefrontend1.php" class="back-link">Back to Home</a>
    </div>
</body>
</html>
