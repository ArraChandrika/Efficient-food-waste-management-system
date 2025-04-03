<?php
ob_start();
session_start();
include("connect.php");

// Ensure the user is logged in
if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
    header("location:signin.php");
    exit();
}

// Initialize session variables
$loc = mysqli_real_escape_string($connection, $_SESSION['location']);
$id = $_SESSION['Aid'];

// Handle form submission for assigning donations
if (isset($_POST['food']) && isset($_POST['delivery_person_id'])) {
    $order_id = $_POST['order_id'];
    $delivery_person_id = $_POST['delivery_person_id'];

    // Check if the order is already assigned
    $checkQuery = "SELECT * FROM food_donations WHERE Fid = $order_id AND assigned_to IS NOT NULL";
    $checkResult = mysqli_query($connection, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        die("Sorry, this order has already been assigned.");
    }

    // Assign the order to the current delivery person
    $assignQuery = "UPDATE food_donations SET assigned_to = $delivery_person_id WHERE Fid = $order_id";
    $assignResult = mysqli_query($connection, $assignQuery);

    if (!$assignResult) {
        die("Error assigning order: " . mysqli_error($connection));
    }

    // Prevent form resubmission on page reload
    header('Location: ' . $_SERVER['REQUEST_URI']);
    ob_end_flush();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <title>Admin Dashboard Panel</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image"></div>
            <span class="logo_name">ADMIN</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#"><i class="uil uil-estate"></i><span class="link-name">Dashboard</span></a></li>
                <li><a href="analytics.php"><i class="uil uil-chart"></i><span class="link-name">Analytics</span></a></li>
                <li><a href="donate.php"><i class="uil uil-heart"></i><span class="link-name">Donates</span></a></li>
                <li><a href="feedback.php"><i class="uil uil-comments"></i><span class="link-name">Feedbacks</span></a></li>
                <li><a href="adminprofile.php"><i class="uil uil-user"></i><span class="link-name">Profile</span></a></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="../logout.php"><i class="uil uil-signout"></i><span class="link-name">Logout</span></a></li>
                <li class="mode">
                    <a href="#"><i class="uil uil-moon"></i><span class="link-name">Dark Mode</span></a>
                    <div class="mode-toggle"><span class="switch"></span></div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <p class="logo">Food <b style="color: #06C167;">Donate</b></p>
            <p class="user"></p>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i><span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="uil uil-user"></i>
                        <span class="text">Total Users</span>
                        <?php
                        $query = "SELECT COUNT(*) as count FROM login";
                        $result = mysqli_query($connection, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<span class=\"number\">".$row['count']."</span>";
                        ?>
                    </div>
                    <div class="box box2">
                        <i class="uil uil-comments"></i>
                        <span class="text">Feedbacks</span>
                        <?php
                        $query = "SELECT COUNT(*) as count FROM user_feedback";
                        $result = mysqli_query($connection, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<span class=\"number\">".$row['count']."</span>";
                        ?>
                    </div>
                    <div class="box box3">
                        <i class="uil uil-heart"></i>
                        <span class="text">Total Donations</span>
                        <?php
                        $query = "SELECT COUNT(*) as count FROM food_donations";
                        $result = mysqli_query($connection, $query);
                        $row = mysqli_fetch_assoc($result);
                        echo "<span class=\"number\">".$row['count']."</span>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i><span class="text">Recent Donations</span>
                </div>

                <div class="table-container">
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Food</th>
                                    <th>Category</th>
                                    <th>Phone No</th>
                                    <th>Date/Time</th>
                                    <th>Address</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch unassigned donations for the current location
                                $sql = "SELECT * FROM food_donations WHERE assigned_to IS NULL AND location='$loc'";
                                $result = mysqli_query($connection, $sql);

                                if (!$result) {
                                    die("Error executing query: " . mysqli_error($connection));
                                }

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                        <td data-label='Name'>{$row['name']}</td>
                                        <td data-label='Food'>{$row['food']}</td>
                                        <td data-label='Category'>{$row['category']}</td>
                                        <td data-label='Phone No'>{$row['phoneno']}</td>
                                        <td data-label='Date'>{$row['date']}</td>
                                        <td data-label='Address'>{$row['address']}</td>
                                        <td data-label='Quantity'>{$row['quantity']}</td>
                                        <td data-label='Action' style='margin:auto'>";

                                    // Form to assign donations
                                    if ($row['assigned_to'] == null) {
                                        echo "<form method='post' action=''>
                                                <input type='hidden' name='order_id' value='{$row['Fid']}'>
                                                <input type='hidden' name='delivery_person_id' value='$id'>
                                                <button type='submit' name='food'>Get Food</button>
                                              </form>";
                                    } elseif ($row['assigned_to'] == $id) {
                                        echo "Order assigned to you";
                                    } else {
                                        echo "Order assigned to another delivery person";
                                    }

                                    echo "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="admin.js"></script>
</body>
</html>