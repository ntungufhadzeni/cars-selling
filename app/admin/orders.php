<?php
session_start();
global $conn;
require('../config.php');
$name = '';
if (isset($_SESSION['admin_name'])) {
    $name = $_SESSION['admin_name'];
    $id = $_SESSION['admin_id'];
    $sql = "SELECT id, car_id,shipping_name,shipping_email,shipping_phone,shipping_address,payment_method,";
    $sql .= "DATE_FORMAT(date_created,'%d-%b-%Y') as date, customer_id ";
    $sql .= "FROM orders ";

    $result =  mysqli_query($conn, $sql);
} else {
    header('location: login-reg.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="../assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style_search.css">
    <title>Orders</title>
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
                        <li class="nav-item">
                            <a class="nav-link" href="all-customers.php">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item active">
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
    <div style="margin-bottom: 80px;"></div>
    <div class="container" style="min-height:500px;">
        <div class="row">
        <div class="col-md-10"> 
            <h1>Orders</h1>
        </div>
        <div class="col-md-2">
            <form class="form-inline" method="post" action="orders-report.php">
                <button type="submit" id="pdf" name="generate-pdf" class="btn btn-primary">
                    <i class="fa fa-pdf" aria-hidden="true"></i>
                    Generate PDF
                </button>
            </form>
            <br>
            <form class="form-inline" method="post" action="orders-csv.php">
                <button type="submit" id="csv" name="generate-csv" class="btn btn-primary">
                    <i class="fa fa-file-text" aria-hidden="true"></i>
                    Generate CSV
                </button>
            </form>
            <br>
        </div>
    </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>
                        Order Number
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Customer
                    </th>
                    <th>
                        Car
                    </th>
                    <th>
                        Grand Total
                    </th>
                    <th>
                        Shipping Address
                    </th>
                    <th>
                        Phone
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Payment Method
                    </th>
                </tr>
            </thead>
            <?php
            $status_colors = array(1 => '#00ff00', 0 => '#ff0000');
            while ($row = mysqli_fetch_assoc($result)) {
                $order_number = $row['id'];
                $date = $row['date'];
                $customer = $row['shipping_name'];
                $car_id = $row['car_id'];
                $address = $row['shipping_address'];
                $payment_method = $row['payment_method'];
                $phone = $row['shipping_phone'];
                $email = $row['shipping_email'];

                $sqlCar = "SELECT CONCAT(maker, ' ', model) AS item, price, currency FROM car WHERE id='" . $car_id . "'";
                $resultCar = mysqli_query($conn, $sqlCar);
                $rowCar = mysqli_fetch_assoc($resultCar);
                $price = $rowCar['price'];
                $car = $rowCar['item'];

                if ($rowCar['currency'] != 'R') {
                    $shipping = 'R10 000,00';
                    $grand_total = 10000 + (int) $price * 18.09;
                } else {
                    $shipping = 'R0,00';
                    $grand_total = (int) $price;
                }

            ?>
                <tr>
                    <td>
                        <?php echo ($order_number); ?>
                    </td>
                    <td>
                        <?php echo ($date); ?>
                    </td>
                    <td>
                        <?php echo ($customer); ?>
                    </td>
                    <td>
                        <?php echo ($car); ?>
                    </td>
                    <td>
                        R <?php echo (number_format($grand_total, 2, ',', ' ')); ?>
                    </td>
                    <td>
                        <?php echo ($address); ?>
                    </td>
                    <td>
                        <?php echo ($phone); ?>
                    </td>
                    <td>
                        <?php echo ($email); ?>
                    </td>
                    <td>
                        <?php echo ($payment_method); ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <?php include('../inc/footer.php'); ?>