<?php
session_start();
$name = '';
if (isset($_SESSION['admin_name'])) {
    $name = $_SESSION['admin_name'];
    $id = $_SESSION['admin_id'];
} else {
    header('location: login-reg.php');
}
?>

<?php
global $conn;
include_once '../config.php';


$sql = "SELECT * FROM customer";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/bootstrap-slider.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.0/css/bootstrap-slider.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Customers</title>
</head>

<body>
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="all-customers.php">
                    <h2><em><?php echo $name ?></em></h2>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="all-customers.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="orders.php"> Orders
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>

                    </ul>
                </div>
        </nav>
    </header>
    <div class="banner header-text">
        <div class="owl-banner owl-carousel">
        </div>
    </div>
    <div style="margin-bottom: 50px;"></div>
    <h1>Customers</h1>
    <div class="container" style=" margin-top:90px;">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        First Name
                    </th>
                    <th>
                        Last Name
                    </th>
                    <th>
                        Phone
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Address
                    </th>
                    <th>
                        User Status
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <?php
            if (mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {


            ?>
                    <tr>
                        <th scope="row">
                            <?php echo ($row['id']); ?>
                        </th>
                        <td>
                            <?php echo ($row['first_name']); ?>
                        </td>
                        <td>
                            <?php echo ($row['surname']); ?>
                        </td>
                        <td>
                            <?php echo ($row['phone']); ?>
                        </td>
                        <td>
                            <?php echo ($row['email']); ?>
                        </td>
                        <td>
                            <?php echo ($row['address']); ?>
                        </td>
                        <td>
                            <?php
                            if ($row['status'] == 1) {
                                echo "<font color='green'>Account Activated</font>";
                            } else {
                                echo "<font color='red'>Account Deactivated</font>";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            $id = $row['id'];
                            if ($row['status'] == 1) {
                                echo ('<a href="deactivate-customer.php?id=' . $id . '"><button class="btn btn-danger">Deactivate</button></a>');
                            } else {
                                echo ('<a href="activate-customer.php?id=' . $id . '"><button class="btn btn-primary">Activate</button></a>');
                            }
                            ?>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
    <<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <?php include('../inc/footer.php'); ?>