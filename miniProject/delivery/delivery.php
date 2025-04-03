<?php
//session_start(); // Start the session
/*ob_start(); 
// $connection = mysqli_connect("localhost:3307", "root", "");
// $db = mysqli_select_db($connection, 'demo');
include("connect.php"); 
include '../connection.php';
if($_SESSION['name']==''){
	header("location:deliverylogin.php");
}
$name=$_SESSION['name'];
$city=$_SESSION['city'];
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result=curl_exec($ch);
$result=json_decode($result);
// $city= $result->city;
// echo $city;

$id=$_SESSION['Did





$name = isset($_SESSION['name']) ? $_SESSION['name'] : "Guest"; // Use session value or fallback to "Guest"
*/

//session_start(); // Start the session
ob_start();
include("connect.php");
include '../connection.php';

if ($_SESSION['name'] == '') {
    header("location:deliverylogin.php");
    exit(); // Always exit after a redirect
}

$name = isset($_SESSION['name']) ? $_SESSION['name'] : "Guest"; // Use session value or fallback to "Guest"

// Initialize cURL to get the user's city based on their IP address
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://ip-api.com/json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
$result = json_decode($result);
$city = $result->city ?? 'Unknown'; // Fallback if city not found

// More of your HTML code follows...


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Home</title>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="delivery.css">
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Header Styles */
        header {
            background-color: #06C167;
            color: white;
            text-align: center;
            padding: 20px;
        }

        nav {
            margin-top: 10px;
        }

        .nav-bar ul {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .nav-bar ul li {
            list-style: none;
        }

        .nav-bar ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-bar ul li a:hover {
            background-color: #04a154;
        }

        /* Welcome Section */
        .welcome {
            font-size: 36px;
            text-align: center;
            margin: 40px auto;
            color: #333;
        }

        /* Service Section */
        .service-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            margin: 40px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .service {
            width: 280px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s;
            text-align: center;
            padding: 20px;
        }

        .service:hover {
            transform: scale(1.05);
        }

        .service img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }

        /* CTA Button */
        .cta-button {
            display: block;
            width: fit-content;
            margin: 30px auto;
            background-color: #06C167;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #04a154;
        }

        /* About Section */
        .about-section {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .about-section h2 {
            color: #06C167;
            margin-bottom: 15px;
            text-align: center;
        }

        /* Contact Section */
        .contact-section {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .contact-section h2 {
            color: #06C167;
            margin-bottom: 15px;
            text-align: center;
        }

        .contact-section form div {
            margin-bottom: 15px;
        }

        .contact-section label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .contact-section input, .contact-section textarea {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        /* Footer Styles */
        footer {
            background-color: #222;
            color: #fff;
            text-align: center;
            padding: 15px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<!--<header>
    <h1>Food Donate</h1>
    <nav class="nav-bar">
        <ul>
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="openmap.php">Map</a></li>
            <li><a href="deliverymyord.php">My Orders</a></li>
            <?php if (!isset($_SESSION['name'])): ?>
                <li><a href="deliverylogin.php">Login</a></li>
            <?php else: ?>
                <li><a href="logout.php">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>-->
<header>
    <h1>Food Donate</h1>
    <div class="hamburger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </div>
    <nav class="nav-bar">
        <ul>
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="openmap.php">Map</a></li>
            <li><a href="deliverymyord.php">My Orders</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<script>
    const hamburger = document.querySelector(".hamburger");
    hamburger.onclick = function() {
        const navBar = document.querySelector(".nav-bar");
        navBar.classList.toggle("active");
    }
</script>


<h2 class="welcome">Welcome, <?php echo htmlspecialchars($name); ?>!</h2>


<!-- Services Section -->
<div class="service-container">
    <div class="service">
        <img src="data:image/png;base64,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" alt="Fast Delivery">
        <h3>Fast Delivery</h3>
        <p>Ensuring prompt delivery, bringing food to those in need efficiently.</p>
    </div>
    <div class="service">
        <img src="data:image/jpeg;base64,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">
        <h3>Community Support</h3>
        <p>Connecting donors and charities, fostering community bonds.</p>
    </div>
    <div class="service">
        <img src="data:image/jpeg;base64,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" alt="Order Tracking">
        <h3>Order Tracking</h3>
        <p>Track your donations in real-time, promoting transparency.</p>
    </div>
    <div class="service">
        <img src="data:image/jpeg;base64,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" alt="Volunteer Opportunities">
        <h3>Volunteer Opportunities</h3>
        <p>Join as a volunteer, spreading kindness through our platform.</p>
    </div>
</div>

<a href="deliverymyord.php" class="cta-button">View My Orders</a>

<!-- About Section -->
<div class="about-section">
    <!--<h2>About Our Food Management System</h2>
    <p>Our platform aims to reduce food waste by connecting food donors with non-profits. Through this mission, we strive to make nutritious food accessible to everyone and combat hunger sustainably.</p>
    <h3>Features:</h3>
    <ul>
        <li>Real-Time Tracking of donations</li>
        <li>Community Engagement for volunteers</li>
        <li>Educational Resources on sustainability</li>
    </ul>-->
    <h2 style="color: #06C167;">About Our Food Management System</h2>
<p>Our Food Management System aims to reduce food waste by connecting donors with non-profit organizations and charities. We believe that everyone deserves access to nutritious food, and through our platform, we strive to make this possible. Join us in our mission to combat hunger and support sustainable food practices.</p>

<h3 style="color: #06C167;">Key Features:</h3>
<ul style="list-style-type: disc; padding-left: 20px; text-align: left; margin: 0 auto; max-width: 600px;">
    <li><strong>Real-Time Tracking:</strong> Monitor the journey of your food donations and ensure they reach those in need.</li>
    <li><strong>Community Engagement:</strong> Participate in local food drives and volunteer opportunities to make a tangible impact.</li>
    <li><strong>Educational Resources:</strong> Access guides and resources on food waste reduction and sustainable practices.</li>
    <li><strong>Seamless Connections:</strong> Easily connect with local non-profits and charities that align with your values.</li>
    <li><strong>Impact Reports:</strong> Receive feedback on how your contributions are making a difference in the community.</li>
    <li><strong>Flexible Options:</strong> Choose the type of food donations that fit your schedule and preferences.</li>
    <li><strong>Support Local:</strong> Help local communities thrive by donating food that might otherwise go to waste.</li>
</ul>

</div>

<!-- Contact Section -->
<div class="contact-section">
    <h2>Contact Us</h2>
    <form action="submit_contact.php" method="POST">
        <div>
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        <button type="submit">Send Message</button>
    </form>
</div>

<footer>
    <p>&copy; 2024 Food Donate. All Rights Reserved.</p>
</footer>

</body>
</html>
