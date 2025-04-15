<!-- login_register.php -->
<?php
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $specialty = mysqli_real_escape_string($conn, $_POST['specialty']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $profile_picture = '';
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = $_FILES['profile_picture']['name'];
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], 'images/' . $profile_picture);
    }

    $user_query = "INSERT INTO users (username, email, password, role) 
                   VALUES ('$name', '$email', '$password', 'doctor')";

    if (mysqli_query($conn, $user_query)) {
        $user_id = mysqli_insert_id($conn);

        $doctor_query = "INSERT INTO doctors (user_id, name, specialty, phone, profile_picture) 
                         VALUES ('$user_id', '$name', '$specialty', '$phone', '$profile_picture')";

        if (mysqli_query($conn, $doctor_query)) {
            echo "<p style='color: green; text-align: center;'>Doctor registered successfully!</p>";
        } else {
            echo "<p style='color: red; text-align: center;'>Error registering doctor details: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color: red; text-align: center;'>Error registering user: " . mysqli_error($conn) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Registration</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #4f46e5;
            outline: none;
        }

        input[type="submit"] {
            background-color: #4f46e5;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #3730a3;
        }

        .view-doctors-btn {
            display: block;
            text-align: center;
            margin-top: 20px;
        }

        .view-doctors-btn a {
            background-color: #e0e7ff;
            color: #4f46e5;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .view-doctors-btn a:hover {
            background-color: #c7d2fe;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Doctor Registration</h2>
        <form action="login_register.php" method="post" enctype="multipart/form-data">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>

            <label for="specialty">Specialty</label>
            <input type="text" id="specialty" name="specialty" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" required>

            <label for="password">Create Password</label>
            <input type="password" id="password" name="password" required>

            <label for="profile_picture">Upload Profile Picture</label>
            <input type="file" id="profile_picture" name="profile_picture">

            <input type="submit" value="Register as Doctor">
        </form>

        <div class="view-doctors-btn">
            <a href="doctors_preview.php">View Registered Doctors</a>
        </div>
    </div>
</body>
</html>
