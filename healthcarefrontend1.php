<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission (e.g., sending email or saving to a database)
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Here you would typically process the form, like sending an email or saving it in the database
    // For now, just echoing the values to simulate the action
    echo "<p class='success'>Thank you, $name! Your message has been sent successfully.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simpson's Health Sphere</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
    font-family: 'Arial', sans-serif;
    background-image: url('doctors.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    color: #333;
    position: relative;
}
body::before {
    content: "";
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.7); /* Light overlay */
    z-index: -1;
}
.overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.7);
    z-index: -1;
}


        a {
            text-decoration: none;
        }

        /* Header */
        header {
            background-color:rgb(208, 218, 228);
            padding: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }

        nav .logo h1 {
            color: white;
            font-size: 36px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }

        .nav-links li a {
            color: white;
            font-size: 18px;
            padding: 12px 20px;
            border-radius: 30px;
            background-color:rgb(42, 168, 226);
            transition: background-color 0.3s ease;
        }

        .nav-links li a:hover {
            background-color:rgb(68, 129, 194);
        }

        /* Hero Section */
        .hero {
            background-color: #ffffff;
            text-align: center;
            padding: 80px 20px;
            margin: 30px 0;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .hero h2 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            color: #777;
            margin-bottom: 30px;
        }

        .cta-button {
            padding: 15px 30px;
            background-color:rgb(90, 139, 190);
            color: white;
            border: none;
            font-size: 1rem;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color:rgb(47, 193, 212);
        }

        /* Services Section */
        .services {
            display: flex;
            justify-content: space-around;
            gap: 30px;
            padding: 60px 20px;
            background-color: #ffffff;
            text-align: center;
        }
        .services {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            padding: 60px 20px;
            background-color: #ffffff;
            text-align: center;
}

    .service {
        position: relative;
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 300px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        color: white;
    }

    .service::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4); /* Dark overlay */
        z-index: 0;
}

    .service-content {
        position: relative;
        z-index: 1;
        padding: 20px;
    }

    .service h3 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #fff;
    }

    .service p {
        font-size: 16px;
        margin-bottom: 15px;
        color: #ddd;
    }

    .service .cta-button {
        background-color: #ffffff;
        color: #007BFF;
    }

    .service:hover {
        transform: scale(1.02);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.2);
    }

        /* Nutrition Tracker Section */
        .nutrition {
            text-align: center;
            padding: 60px 20px;
            background-color: #f7f7f7;
            margin: 30px 0;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .nutrition h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .nutrition p {
            font-size: 1.2rem;
            color: #777;
            margin-bottom: 20px;
        }

        .nutrition .cta-button {
            padding: 15px 30px;
            background-color: #ff5722;
            color: white;
            border: none;
            font-size: 1rem;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }

        .nutrition .cta-button:hover {
            background-color: #d64b1d;
        }

        /* Contact Section */
        .contact {
            text-align: center;
            padding: 60px 20px;
            background-color: #ffffff;
            margin: 30px 0;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .contact h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .contact form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            max-width: 500px;
            margin: auto;
        }

        .contact input,
        .contact textarea {
            padding: 15px;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
        }

        .contact button {
            padding: 15px 30px;
            background-color: #007BFF;
            color: white;
            border: none;
            font-size: 1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .contact button:hover {
            background-color: #0056b3;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            background-color:rgb(90, 194, 235);
            color: white;
        }

        footer p {
            margin: 0;
            font-size: 14px;
            font-weight: 500;
        }
        .ai-question {
            text-align: center;
            padding: 40px 20px;
            background-color: #ffffff;
            margin: 30px 0;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .ai-question input[type="text"] {
            padding: 15px;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
            max-width: 500px;
            margin-bottom: 15px;
        }

        .ai-question button {
            padding: 15px 30px;
            background-color: #007BFF;
            color: white;
            border: none;
            font-size: 1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .ai-question button:hover {
            background-color: #0056b3;
        }

        img {
            width: 80%;
            max-width: 500px;
            height: auto;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            margin: 20px 0;
            transition: transform 0.3s ease;
        }

        img:hover {
            transform: scale(1.05);
            }
            .service img {
        width: 100%;
        height: auto;
        max-width: 250px;
        margin-top: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .service img:hover {
        transform: scale(1.05);
    }
    /* Nutrition Tracker Section */
    .nutrition {
        background-color: #f7f7f7;
        padding: 60px 20px;
        text-align: center;
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        margin: 30px 0;
    }

    .nutrition h2 {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: #333;
}

.nutrition p {
    font-size: 1.2rem;
    color: #777;
    margin-bottom: 20px;
}

.nutrition form {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
    max-width: 600px;
    margin: 0 auto;
}

.nutrition label {
    font-size: 1.1rem;
    color: #555;
    text-align: left;
}

.nutrition input, .nutrition select {
    padding: 15px;
    border: 2px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    width: 100%;
}

.nutrition input[type="number"], .nutrition select, .nutrition input[type="date"] {
    background-color: #ffffff;
}

.nutrition button {
    padding: 15px 30px;
    background-color: #ff5722;
    color: white;
    border: none;
    font-size: 1rem;
    border-radius: 50px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.nutrition button:hover {
    background-color: #d64b1d;
}

/* Table for displaying nutrition data */
.nutrition-table {
    width: 100%;
    margin-top: 30px;
    border-collapse: collapse;
}

.nutrition-table th, .nutrition-table td {
    padding: 15px;
    border: 1px solid #ddd;
    text-align: center;
}

.nutrition-table th {
    background-color: #007BFF;
    color: white;
    font-size: 1.1rem;
}

.nutrition-table td {
    font-size: 1rem;
    color: #333;
}

.nutrition-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.nutrition-table tr:hover {
    background-color: #f1f1f1;
}

.nutrition-table td, .nutrition-table th {
    border-left: 1px solid #ddd;
}

.nutrition-table td:first-child, .nutrition-table th:first-child {
    border-left: none;
}

    </style>
</head>
<body>
    <div class="overlay"></div>
    <main style="position: relative; z-index: 1;">
            <!-- Header Section -->
    <header>
        <nav>
            <div class="logo">
                <h1>Health Sphere</h1>
            </div>
            <ul class="nav-links">
                <li><a href="home.php">Home</a></li>
                <li><a href="appointment.php">Appointments</a></li>
                <li><a href="telemedicine.php">Telemedicine</a></li>
                <li><a href="ehr.php">EHR</a></li>
                <li><a href="feedback.php">Enter feedback</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="doctors.php">Doctors</a></li>
    </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <h2>Welcome to Health Sphere</h2>
        <p>Your health, managed and monitored efficiently with the best care and technology.</p>
        <a href="family_planning.php" class="cta-button">Family planning</a>
        <a href="hiv.php" class="cta-button">HIV/AIDs</a>
        <a href="tuberculosis.php" class="cta-button">Tuberculosis</a>
        <a href="antenatal.html" class="cta-button">Antenatal/Maternal</a>
        <a href="pediatrics.html" class="cta-button">Pediatrics/Children</a>
    </section>

    <!-- Services Section -->
    <section id="appointments" class="services">
    <div class="service" style="background-image: url('appoint.jpg');">
        <div class="service-content">
            <h3>Appointments</h3>
            <p>Schedule your health checkups and consultations seamlessly.</p>
            <a href="appointment.php" class="cta-button">Book here</a>
        </div>
    </div>
    <div class="service" style="background-image: url('tel.jpg');">
        <div class="service-content">
            <h3>Telemedicine</h3>
            <p>Consult with doctors remotely through secure video calls.</p>
            <a href="telemedicine.php" class="cta-button">Consult here</a>
        </div>
    </div>

    <div class="service" style="background-image: url('ehr.jpg');">
        <div class="service-content">
            <h3>EHR</h3>
            <p>Manage and access your medical records easily anytime.</p>
            <a href="ehr.php" class="cta-button">View</a>
        </div>
    </div>

    <div class="service" style="background-image: url('aller.jpg');">
        <div class="service-content">
            <h3>Allergies</h3>
            <p>Find more information about your allergies and treatments.</p>
            <a href="allergy.html" class="cta-button">Check here</a>
        </div>
    </div>
</section>

    <section class="ai-question">
        <h2>Ask Watson AI</h2>
        <form method="POST" action="watson_ai.php">
            <input type="text" name="user_question" placeholder="Ask AI..." required>
            <button type="submit">Ask</button>
        </form>
    </section>

    <!-- Nutrition Tracker Section -->
    <section id="nutrition" class="nutrition">
    <h2>Track Your Nutrition</h2>
    <p>Stay on top of your daily nutrition by tracking your food intake and calories.</p>

    <!-- Form to add nutrition data -->
    <form action="nutrition_tracker.php" method="POST">
        <label for="food-item">Food Item:</label>
        <input type="text" name="food_item" id="food-item" required placeholder="Enter food name...">

        <label for="calories">Calories:</label>
        <input type="number" name="calories" id="calories" required placeholder="Enter calorie count...">

        <label for="meal-time">Meal Time:</label>
        <select name="meal_time" id="meal-time" required>
            <option value="breakfast">Breakfast</option>
            <option value="lunch">Lunch</option>
            <option value="dinner">Dinner</option>
            <option value="snack">Snack</option>
        </select>

        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>

        <button type="submit" class="cta-button">Track Nutrition</button>
    </form>
</section>

  <footer>
        <p>© 2025 Healthcare System. All rights reserved.</p>
        <p>Developed by Irahari Samson.</p>
        <p>™ simpsoncodes</p>
    </footer>
    </main>
</body>
</html>
