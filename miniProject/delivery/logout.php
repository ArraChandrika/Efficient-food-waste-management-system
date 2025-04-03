<?php
session_start(); // Start the session
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Redirect to the login page
header("Location: deliverylogin.php");
exit(); // Always exit after a redirect
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<nav class="nav-bar">
    <ul>
        <li><a href="#home" class="active">Home</a></li>
        <li><a href="openmap.php">Map</a></li>
        <li><a href="deliverymyord.php">My Orders</a></li>
        <li><a href="logout.php">Logout</a></li> <!-- Updated this line -->
    </ul>
</nav>

</body>
</html>