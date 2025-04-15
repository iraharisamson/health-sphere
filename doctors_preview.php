<?php
// Include database connection
include('db.php');

// Fetch doctors
$query = "SELECT * FROM doctors";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our Doctors</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            padding: 40px;
        }
        .doctor-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .doctor-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            text-align: center;
        }
        .doctor-card img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        .doctor-card h3 {
            margin: 15px 0 5px;
            color: #333;
        }
        .doctor-card p {
            color: #777;
            font-size: 14px;
        }
        .doctor-card a {
            display: inline-block;
            margin-top: 10px;
            background-color: #4f46e5;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .doctor-card a:hover {
            background-color: #3730a3;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Meet Our Doctors</h2>
    <div class="doctor-grid">
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="doctor-card">
                <img src="images/<?php echo htmlspecialchars($row['profile_picture']); ?>" alt="Doctor Photo">
                <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                <p><?php echo htmlspecialchars($row['specialty']); ?></p>
                <a href="doctors.php?id=<?php echo $row['id']; ?>">View More</a>
            </div>
        <?php } ?>
    </div>
</body>
</html>
