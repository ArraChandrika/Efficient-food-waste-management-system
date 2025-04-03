<?php
session_start();
include '../connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate inputs
    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
        // Sanitize input for database
        $sanitized_name = mysqli_real_escape_string($connection, $name);
        $sanitized_email = mysqli_real_escape_string($connection, $email);
        $sanitized_message = mysqli_real_escape_string($connection, $message);

        // Insert into database
        $query = "INSERT INTO user_feedback (name, email, message) VALUES ('$sanitized_name', '$sanitized_email', '$sanitized_message')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            // Redirect to contact page with success message
            header("Location: contact.html?success=true");
            exit();
        } else {
            echo '<script type="text/javascript">alert("Failed to save data in the database.");</script>';
        }
    } else {
        echo '<script type="text/javascript">alert("Please fill in all fields correctly.");</script>';
    }
} else {
    echo '<script type="text/javascript">alert("Invalid request.");</script>';
}
?>
