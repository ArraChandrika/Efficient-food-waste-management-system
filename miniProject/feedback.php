<?php
session_start();
include 'connection.php';

if (isset($_POST['send'])) {
  $email = $_POST['email'];
  $name = $_POST['name'];
  $msg = $_POST['message'];

  // Sanitize input
  $sanitized_emailid = mysqli_real_escape_string($connection, $email);
  $sanitized_name = mysqli_real_escape_string($connection, $name);
  $sanitized_msg = mysqli_real_escape_string($connection, $msg);

  // Insert query
  $query = "INSERT INTO user_feedback(name, email, message) VALUES('$sanitized_name', '$sanitized_emailid', '$sanitized_msg')";
  $query_run = mysqli_query($connection, $query);

  // Redirect based on success or failure
  if ($query_run) {
    header("Location: contact.html");
    exit(); // Ensure the script stops executing after redirection
  } else {
    echo '<script type="text/javascript">alert("Data not saved")</script>';
  }
}
?>
