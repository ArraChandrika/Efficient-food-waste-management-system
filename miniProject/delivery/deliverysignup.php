<?php
include '../connection.php';
$msg = 0;

if (isset($_POST['sign'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $location = $_POST['district'];

    $pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM delivery_persons WHERE email='$email'";
    $result = mysqli_query($connection, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        echo "<h1><center>Account already exists</center></h1>";
    } else {
        $query = "INSERT INTO delivery_persons(name, email, password, city) VALUES('$username', '$email', '$pass', '$location')";
        $query_run = mysqli_query($connection, $query);
        
        if ($query_run) {
            header("location:delivery.php");
        } else {
            echo '<script type="text/javascript">alert("Data not saved")</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="deliverycss.css">
</head>
<body>
    <div class="center">
        <h1>Register</h1>
        <form method="post" action="">
            <div class="txt_field">
                <input type="text" name="username" required/>
                <span></span>
                <label>Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required/>
                <span></span>
                <label>Password</label>
            </div>
            <div class="txt_field">
                <input type="email" name="email" required/>
                <span></span>
                <label>Email</label>
            </div>
            <div class="">
                <select id="district" name="district" style="padding:10px; padding-left: 20px;">
                    <option value="" disabled selected>Select District</option>
                    <option value="Hyderabad">Hyderabad</option>
                    <option value="Ranga Reddy">Ranga Reddy</option>
                    <option value="Warangal">Warangal</option>
                    <option value="Khammam">Khammam</option>
                    <option value="Karimnagar">Karimnagar</option>
                    <option value="Nizamabad">Nizamabad</option>
                    <option value="Medchal-Malkajgiri">Medchal-Malkajgiri</option>
                    <option value="Nalgonda">Nalgonda</option>
                    <option value="Mahbubnagar">Mahbubnagar</option>
                    <option value="Adilabad">Adilabad</option>
                    <option value="Medak">Medak</option>
                    <option value="Jagitial">Jagitial</option>
                    <option value="Peddapalli">Peddapalli</option>
                    <option value="Siddipet">Siddipet</option>
                    <option value="Vikarabad">Vikarabad</option>
                    <option value="Suryapet">Suryapet</option>
                    <option value="Yadadri Bhuvanagiri">Yadadri Bhuvanagiri</option>
                </select> 
            </div>
            <br>
            <input type="submit" name="sign" value="Register">
            <div class="signup_link">
                Already a member? <a href="deliverylogin.php">Sign in</a>
            </div>
        </form>
    </div>
</body>
</html>