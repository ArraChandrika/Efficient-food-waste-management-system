<?php
// Change mysqli_connect(host_name, username, password);
$connection = mysqli_connect("localhost", "root", "");

// Check if connection is successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select database
$db = mysqli_select_db($connection, 'demo');
if (!$db) {
    die("Database selection failed: " . mysqli_error($connection));
}

echo "Connected successfully to the database.";
?>
